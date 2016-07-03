<?php

/**
 * System Enviroment configuration
 */
if ($config["app_development"]) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', DEBUGPATH . DS . "error.log");
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', DEBUGPATH . DS . "error.log");
}

/**
 * System Library Loading
 */
if ($config["app_libraries"] == "*") {
    foreach (glob(LIBRARYPATH . DS . "*.php") as $lib) {
        if (file_exists($lib)) {
            if (!(require_once $lib)) {
                echo ERROR_100 . basename($lib) . "<br>";
            }
        } else {
            echo ERROR_100 . basename($lib) . "<br>";
        }
    }
} else {
    foreach ($config["app_libraries"] as $lib) {
        if (file_exists(LIBRARYPATH . DS . $lib . ".php")) {
            if (!(require_once LIBRARYPATH . DS . $lib . ".php")) {
                echo ERROR_100 . basename($lib) . ".php <br>";
            }
        } else {
            echo ERROR_100 . basename($lib) . ".php <br>";
        }
    }
}

/**
 * System Collections Loading
 */
foreach (glob(COLLECTIONPATH . DS . "*.php") as $lib) {
    if (file_exists($lib)) {
        if (!(require_once $lib)) {
            echo ERROR_100 . basename($lib) . "<br>";
        }
    } else {
        echo ERROR_100 . basename($lib) . "<br>";
    }
}

/**
 *  System Controller Loading
 */
$file = CONTROLLERPATH . DS . "StefanController.php";
if (file_exists($file)) {
    if (!(require_once $file)) {
        echo ERROR_100 . basename($file);
        exit(1);
    }
} else {
    echo ERROR_100 . basename($file);
    exit(1);
}

/**
 * Basic Service Loader
 */
Ioc::addService("domain", $config["base_url"]);
