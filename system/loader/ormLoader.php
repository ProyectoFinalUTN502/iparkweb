<?php
/**
 *  Doctrine Loader
 */
$file = ORMPATH . DS . "bootstrap.php";
if (file_exists($file)){
    if (!(require_once $file)) {
        echo ERROR_100 . basename($file) . "<br>";
        exit(1);
    }
} else {
    echo ERROR_100 . basename($file) . "<br>";
    exit(1);
}