<?php

$config["db_server"] = "127.0.0.1";
$config["db_schema"] = "central_dev";
$config["db_user"] = "root";
$config["db_password"] = "";
$config["db_port"] = "";
$config["db_charset"] = "";

$config["user_autoload"] = array("entities", "helpers");
$config["page_size"] = "10";

define("ROL_GROUP", 1);
define("USER_GROUP", 2);
define("PARKINGLOT_GROUP", 3);
define("PARKINGLOT_EDITION_GROUP", 4);
define("MAP_GROUP", 5);
define("PRICE_GROUP", 6);
define("VT_GROUP", 7);
define("CONFIG_GROUP", 8);
define("REPORT_GROUP", 9);