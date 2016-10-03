-- -----------------------------------------------------------------------------
-- Nombre	: sp_search_parkinglot_by.sql
-- Autor	: Grupo 502
-- Fecha	: Octubre 2016
-- Descripcion  : Store Procedure para Busqueda de Establecimiento 
-- Notras	: Ref. CU0007 Busqueda de Establecimiento Por Parametros
-- 		: Depende de Vista vw_layout
-- -----------------------------------------------------------------------------

DELIMITER $$

CREATE PROCEDURE `searchParkinglotBy` (
	IN vehicleTypeID INT, 
	IN lat DOUBLE, 
	IN lng DOUBLE, 
	IN maxRange INT, 
	IN maxPrice DOUBLE, 
	IN is24 INT, 
	IN isCovered INT
)
BEGIN
	
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
		t.isCovered = isCovered AND 
		t.is24 = is24 AND 
		t.price <= maxPrice AND 
		t.distance <= maxRange AND 
		t.positions > 0  
	ORDER BY t.distance ASC; 

END