-- -----------------------------------------------------------------------------
-- Nombre	: vw_historic.sql
-- Autor	: Grupo 502
-- Fecha        : Octubre 2016
-- Descripcion	: Vista de Historicos
-- Notras	: 
-- -----------------------------------------------------------------------------
DROP VIEW IF EXISTS vw_historic;
CREATE VIEW vw_historic AS 
SELECT 
    vp.id, 
    vp.creationDate AS date, 
    v.name AS vehicle,
    p.name AS parkinglot,
    concat(p.address,', ',c.description) AS address,
    p.latMap AS lat,
    p.longMap AS lng,
    lp.xPoint,
    lp.yPoint,
    v.client_id
FROM 
    vehicle_parking vp 
    LEFT JOIN vehicle v ON vp.vehicle_id = v.id
    LEFT JOIN layout_position lp ON vp.layout_position_id = lp.id
    LEFT JOIN layout l ON lp.layout_id = l.id
    LEFT JOIN parkinglot p ON l.parkinglot_id = p.id
    LEFT JOIN city c ON p.city_id = c.id;