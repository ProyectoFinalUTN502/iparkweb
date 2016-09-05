<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <title>iParking | Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="author" content="" />
        
        <?php 
            global $config;
            $base = $config["base_url"];
        ?>
        <link rel="shortcut icon" type="image/png" href="/<?php echo $base; ?>/aplication/public/img/favicon.ico"/>
        <!-- ESTILOS -->
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/css/openSans.css" type="text/css">
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/css/font-awesome.min.css" type="text/css" />		
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/css/bootstrap.min.css" type="text/css" />	
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/css/App.css" type="text/css" />
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/css/custom.css" type="text/css" />
        <link rel="stylesheet" href="/<?php echo $base; ?>/aplication/public/backend/js/plugins/spectrum/spectrum.css" type="text/css" />
        <!-- -- -->
        
        <!-- JS -->
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/libs/jquery-1.9.1.min.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/libs/jquery.validate.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/libs/jquery.adds.js"></script>

        <script src="/<?php echo $base; ?>/aplication/public/backend/js/libs/bootstrap.min.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/App.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/Validations.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/confirm.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/gMaps.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/ajax.js"></script>
        <script src="/<?php echo $base; ?>/aplication/public/backend/js/plugins/spectrum/spectrum.js"></script>
        <!-- -- -->
    </head>

    <body>
        <div id="cover"></div>

        <div id="wrapper">

            <header id="header">

                <h1 id="site-logo">
                    <img style='width: 158px; height: 40px;' src="/<?php echo $base; ?>/aplication/public/backend/img/logos/iParking_1_1.png" alt="Site Logo" />
                </h1>	

                <a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
                    <i class="fa fa-cog"></i>
                </a>

                <a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
                    <i class="fa fa-reorder"></i>
                </a>

            </header> 


