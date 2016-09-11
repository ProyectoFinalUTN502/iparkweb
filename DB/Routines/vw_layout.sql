-- --------------------------------------------------------------------------------------------------
-- Nombre		: vw_layout.sql
-- Autor		: Grupo 502
-- Fecha		: Septiembre 2016
-- Descripcion	: Vista de Layout de Establecimiento
-- Notras		: 
-- --------------------------------------------------------------------------------------------------
DROP VIEW IF EXISTS vw_layout;
CREATE VIEW vw_layout AS
SELECT 
	lp.id, 
	lp.xPoint, 
	lp.yPoint, 
	lp.valid, 
	lp.circulationValue, 
	lp.state, 
	lp.vehicle_type_id,
	lp.layout_id, 
	plot.id AS parkinglot_id 
FROM 
	layout_position lp 
	LEFT JOIN layout l ON lp.layout_id = l.id
	LEFT JOIN parkinglot plot ON l.parkinglot_id = plot.id;