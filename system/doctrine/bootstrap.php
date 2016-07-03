<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once ORMPATH . DS . "autoload.php";

$entitiesDirectory  = APPPATH . DS . "entities";
$metadataConfig     = array($entitiesDirectory);
$isDevMode          = true;
$doctrinConfig      = Setup::createAnnotationMetadataConfiguration($metadataConfig, $isDevMode);

$conn = array(
    'driver'    => $config["db_driver"],
    'host'      => $config["db_server"],
    'dbname'    => $config["db_schema"],
    'user'      => $config["db_user"],
    'password'  => $config["db_password"]
);

$entityManager = EntityManager::create($conn, $doctrinConfig);
Ioc::addService("orm", $entityManager);
