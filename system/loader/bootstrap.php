<?php
/**
 * System Loader
 */
$file = LOADPATH . DS . "systemLoader.php";
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
 * App Loader
 */
$file = LOADPATH . DS . "appLoader.php";
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
 * ORM Loader
 */
$file = LOADPATH . DS . "ormLoader.php";
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
 * View Loader
 */
$file = LOADPATH . DS . "viewLoader.php";
if (file_exists($file)) {
    if (!(require_once $file)) {
        echo ERROR_100 . basename($file) . "<br>";
        exit(1);
    }
} else {
    echo ERROR_100 . basename($file) . "<br>";
    exit(1);
}

