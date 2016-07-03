<?php
//==============================================================================
// User seteable core configuration
// WARNING : A misuse of this global variable could result in a critical
// error and a total malfunction of the framework...so be carefull
//==============================================================================

$config = array();

/**
 * Base URL of the app
 */
$config["base_url"] = "iParkTest";
/**
 * Application Domain. No Slashes at the end
 */
$config["domain"] = "http://localhost" ;
/**
 * The folder where the aplication is going to be. Sugested name "aplication"
 */
$config["app_folder"] = "aplication";
/**
 * The folder where all the framework is going to be. 
 * Sugested name "system"
 */
$config["system_folder"] = "system";
/**
 * Indicates whether the application is enable for use or not. In the case that
 * the application is not able for use, the system redirects to a 
 * "not available" view
 */
$config["app_enable"] = true;
/**
 * "Not Available" view. If set, the view to be load should be saved on the
 * application/view folder. If not set, the system redirects to a default view
 */
$config["app_enable_view"] = "";
/**
 * Initial view. Indicates which is the initial wiew to be loaded.
 * If set, the view to be load should be saved on the application/view folder. 
 * If not set, the system redirects to a default view
 */
$config["app_welcome_view"] = "home.php";
/**
 * Indicates whether the application is running on a development enviroment or
 * in a production enviroment. In production enviroments (false) errors ar not 
 * shown on the views and are log in a log file. 
 * In development enviroments (true) errors are also log in a log file, but 
 * there are shown on the view 
 */
$config["app_development"] = true;
/**
 * Needed libraries for your application. If yo want all the libraries to load
 * automatically, set the variable to "*", otherwise, you must form an array()
 * in which each element is a library file (name only, no extension)
 * E.g: 
 *  - All libraries $config["app_libraries"] = "*";
 *  - Just the two I nedd $config["app_libraries"] = array("Validator", "Email");
 * 
 * Library names should be the same as the files existing on system/library 
 * folder
 * 
 */
$config["app_libraries"] = "*";
/**
 * The value of the key to be ussed on all the encryption process. 
 * Encryption is made using AES security
 */
$config["aes_key"] = "proyecto%2016";
/**
 * Sets the driver to be used to perform all the DB Operations
 * Available Drivers:
 * - MySqlDriver    : Classic mysql functions
 * - MySqliDriver   : mysqli functions
 * - MySqlPDODriver : PDO db functions
 */
$config["db_driver"] = "pdo_mysql";
/**
 * Sets the time to live of a sesion. In seconds
 */
$config["sesion_ttl"] = 1200;
$config["sesion_project"] = "iparking_";

//==============================================================================
// System core configuration. Don't mess with this, don't be a pussy
//==============================================================================

/**
 * System definitions
 */
define("SF_VERSION_NUMBER", "3.1");
define("SF_VERSION", "Special Edition: Proyecto Final 2016");

define("DS", DIRECTORY_SEPARATOR);
define("APPPATH" , dirname(__FILE__) . DS . $config["app_folder"]);
define("SYSPATH", dirname(__FILE__) . DS . $config["system_folder"]);

define("LOADPATH", SYSPATH . DS . "loader");
define("LIBRARYPATH", SYSPATH . DS . "library");
define("DEBUGPATH", SYSPATH . DS . "debug");
define("ORMPATH", SYSPATH . DS . "doctrine");
define("VIEWPATH", SYSPATH . DS . "view");
define("CONTROLLERPATH", SYSPATH . DS . "controller");
define("COLLECTIONPATH", SYSPATH . DS . "collections");

define("VIEW_VERSION", "system/version");
define("VIEW_WELCOME", "");

/**
 * Error definition
 */
define("ERROR_100", "<b>Error - 100:</b> System could not load ");
define("ERROR_101", "<b>Error - 101:</b> System could not load view ");
define("ERROR_102", "<b>Error - 102:</b> Invalid method ");
define("ERROR_103", "<b>Error - 103:</b> Invalid class ");

define("ERROR_200", "Invalid Key reference");

//define("ERROR_101", "<b>Error - 101:</b> System could not load ");
//define("ERROR_102", "<b>Error - 102:</b> System could not perform autoloading process");
//define("ERROR_103", "<b>Error - 103:</b> System could not load library ");
//define("ERROR_104", "<b>Error - 104:</b> System could not load aplication config");
//define("ERROR_105", "<b>Error - 105:</b> System could not find loader file");
//define("ERROR_106", "<b>Error - 106:</b> Invalid method call ");
//define("ERROR_107", "<b>Error - 107:</b> System could not load controller ");
//define("ERROR_108", "<b>Error - 108:</b> System could not load view ");
//define("ERROR_109", "<b>Error - 109:</b> System could not load user library ");
//define("ERROR_110", "<b>Error - 110:</b> System could not find system autoloader file");
//define("ERROR_111", "<b>Error - 111:</b> System could not find aplication autoloader file");
//define("ERROR_112", "<b>Error - 112:</b> System could not load model ");
//define("ERROR_113", "<b>Error - 113:</b> System could not load db driver ");
//
//define("ERROR_201" , "<b>Error - 201:</b> Unable to connect with db");

/**
 * Bootstrap launch
 */
if (file_exists(LOADPATH . DS . "bootstrap.php")) {
    if (!(require_once LOADPATH . DS . "bootstrap.php")){
        echo ERROR_101 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_101 . "<br>";
    exit(1);
}

