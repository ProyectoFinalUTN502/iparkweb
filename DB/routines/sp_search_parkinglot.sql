-- -----------------------------------------------------------------------------
-- Nombre	: sp_search_parkinglot.sql
-- Autor	: Grupo 502
-- Fecha        : Septiembre 2016
-- Descripcion	: Store Procedure para Busqueda de Establecimiento 
-- Notras	: Ref. CU0005 Busqueda de Establecimiento Durante el Manejo
-- 		: Depende de Vista vw_layout
-- -----------------------------------------------------------------------------

DELIMITER $$

CREATE PROCEDURE `searchParkinglot` (IN clientID INT, IN vehicleTypeID INT, IN lat DOUBLE, IN lng DOUBLE)
BEGIN
	
	DECLARE profileRange INT;
	DECLARE profileMaxPrice DOUBLE;
	DECLARE profileIs24 INT;
	DECLARE profileIsCovered INT;

	SELECT 
		cp.range, cp.maxPrice, cp.is24, cp.isCovered INTO 
		profileRange, profileMaxPrice, profileIs24, profileIsCovered 
	FROM 
		client_profile cp
	WHERE 
		client_id = clientID 
	LIMIT 1;

	SELECT 
		* 
	FROM 
		(
			SELECT
				plot.id, 
				plot.ssid, 
				plot.name, 
				plot.description, 
				plot.address,
				plot.latMap AS lat, 
				plot.longMap AS lng, 
				plot.openTime, 
				plot.closeTime,
				plot.isCovered,
				(
					CASE WHEN plot.openTime = plot.closeTime THEN 1
					ELSE 0
					END
				) AS is24,
				(
					6371 *
					ACOS(
						COS( RADIANS( lat ) ) *
						COS( RADIANS( latMap ) ) *
						COS(
							RADIANS( longMap ) - RADIANS( lng )
						) +
						SIN( RADIANS( lat ) ) *
						SIN( RADIANS( latMap ) )
					)
				) AS distance,
				(
					SELECT 
						TRUNCATE( IFNULL( price , 0 ), 0 ) 
					FROM 
						price 
					WHERE 
						parkinglot_id = plot.id AND 
						vehicle_type_id = vehicleTypeID
				) AS price,
				(
					SELECT 
						COUNT(*) 
					FROM 
						vw_layout vw
					WHERE 
						vw.parkinglot_id = plot.id AND
						vw.vehicle_type_id = vehicleTypeID AND
						vw.state = 'LIBRE'
				) AS positions
			FROM
				parkinglot plot 
		) t  
	WHERE 
		t.isCovered = profileIsCovered AND 
		t.is24 = profileIs24 AND 
		t.price <= profileMaxPrice AND 
		t.distance <= profileRange AND 
		t.positions > 0 
	ORDER BY t.distance ASC; 

END