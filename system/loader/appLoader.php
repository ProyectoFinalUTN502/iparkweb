<?php
/**
 * App configuration Loading
 */
$file = APPPATH . DS . "config" . DS . "config.php";
if (file_exists($file)) {
    if (!(require_once $file)) {
        echo ERROR_100 . basename($file) . "<br>";
        exit(1);
    }
} else {
    echo ERROR_100 . basename($file) . "<br>";
    exit(1);
}

/**
 * App User autoloading 
 */
if (isset($config["user_autoload"])) {
    foreach ($config["user_autoload"] as $folder) {
        $dir = APPPATH . DS . $folder;
        if (file_exists($dir)) {
            foreach (glob($dir . DS . "*.php") as $lib) {
                if (file_exists($lib)) {
                    if (!(require_once $lib)) {
                        echo ERROR_100 . basename($lib) . "<br>";
                        exit(1);
                    }
                } else {
                    echo ERROR_100 . basename($lib) . "<br>";
                    exit(1);
                }
            }
        } else {
            echo ERROR_100 . basename($folder) . "<br>";
            exit(1);
        }
    }
}

/**
 * App Controller Loading
 */
foreach (glob(APPPATH . DS . "controllers" . DS . "*.php") as $lib) {
    if (file_exists($lib)) {
        if (!(require_once $lib)) {
            echo ERROR_100 . basename($lib) . "<br>";
            exit(1);
        }
    } else {
        echo ERROR_100 . basename($lib) . "<br>";
        exit(1);
    }
}
