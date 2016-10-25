
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE central_dev.group;
TRUNCATE central_dev.permission;

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de Roles', 'Roles', 'Gestion de Permisos y Accesos', 'fa fa-th-list', 'role/all', 1, 1, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de Usuarios', 'Usuarios', 'Creacion y Edicion de Usuarios Administradores', 'fa fa-male', 'user/all', 1, 1, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Habilitacion de Establecimiento', 'Establecimientos', 'Registro y Baja de Establecimiento', 'fa fa-hospital', 'parkinglot/all', 1, 1, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de TIpo de Vehiculo', 'Tipo de Vehiculo', 'Creacion y Edicion de Tipos de Vehiculo', 'fa fa-road', 'vehicleType/all', 1, 1, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de Configuracion', 'Configuracion', 'Configuracion de la Plataforma', 'fa fa-cogs', 'param/all', 1, 1, 1, 1, 1);



INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`)  
VALUES ('Edicion de Establecimiento', 'Mi Establecimiento', 'Edicion de informacion de Establecimiento', 'fa fa-star-o', 'parkinglot/view', 0, 0, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de Tarifas', 'Tarifas', 'Carga y Actualizacion de Tarifas', 'fa fa-dollar', 'price/all', 1, 0, 1, 1, 1);

INSERT INTO `group` (`name`, `text`, `description`, `style`, `ref`, `create` , `delete`, `update`, `list`, `search`) 
VALUES ('Gestion de Ubicaciones', 'Capacidad', 'Capacidad en Tiempo Real del Establecimiento', 'fa fa-tachometer', 'parkinglot/capacity', 1, 0, 1, 1, 1);

-- ROL GRUPO
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (1, 1);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (1, 2);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (1, 3);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (1, 4);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (1, 5);

INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (2, 6);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (2, 7);
INSERT INTO `permission` (`rol_id`, `group_id`) VALUES (2, 8);

SELECT * FROM central_dev.group;

SET FOREIGN_KEY_CHECKS = 1;