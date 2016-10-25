<?php

$config["db_server"] = "127.0.0.1";
$config["db_schema"] = "central_dev";
$config["db_user"] = "root";
$config["db_password"] = "";
$config["db_port"] = "";
$config["db_charset"] = "utf8";

$config["user_autoload"] = array("entities", "helpers");
$config["page_size"] = "10";

define("ROL_GROUP", 1);
define("USER_GROUP", 2);
define("PARKINGLOT_GROUP", 3);
define("VT_GROUP", 4);
define("CONFIG_GROUP", 5);

define("PARKINGLOT_EDITION_GROUP", 6);
define("PRICE_GROUP", 7);
define("CAPACITY_GROUP", 8);
