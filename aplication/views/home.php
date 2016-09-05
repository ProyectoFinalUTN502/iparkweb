<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php 
        global $config;
        $base = $config["base_url"];
    ?>
    
    <title>iParking | Facil, Rapido y Comodo</title>

    <link rel="shortcut icon" type="image/png" href="/<?php echo $base; ?>/aplication/public/img/favicon.ico"/>
    
    <!-- Bootstrap Core CSS -->
    <link href="/<?php echo $base; ?>/aplication/public/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/<?php echo $base; ?>/aplication/public/landing/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="/<?php echo $base; ?>/aplication/public/landing/css/agency.min.css" rel="stylesheet">

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color: #000000;">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">iParking</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Que es iParking?</a>
                    </li>
                   <li>
                        <a class="page-scroll" href="#team">Sobre Nosotros</a>
                    </li>
                   <li>
                        <a class="page-scroll" href="#contact">Contacto</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/<?php echo $base; ?>/admin/login">Ingresar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header  style="border-bottom: 2px solid black;">
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading" style="color: #fed136; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">
                    Bienvenido a iParking!
                </div>
                <div class="intro-lead-in" style="color: #fed136; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">
                    Facil, Rapido y Comodo
                </div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Que es iParking?</h2>
                    <h3 class="section-subheading text-muted">
                        Es una Red de Establecimientos que permiten vincular al usuario, 
                        con un establecimiento en el que pueda estacionar, de manera rápida y sencilla<br>
                        Descargate nuestra App desde la <i>Play Store</i> de Google, y deja de preocuparte por encontrar estacionamiento!
                    </h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">1. Registrate</h4>
                    <p class="text-muted">
                        Descargate la App desde la <i>Play Store</i> de Android y crea tu cuenta de iParking
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-search fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">2. Busca</h4>
                    <p class="text-muted">
                        Encontra el establecimiento que mejor se ajuste a tus preferencias (Rango, Horario de Trabajo, Precio por Hora y Vehiculo)
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-car fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">3. Estaciona</h4>
                    <p class="text-muted">
                        Segui la guia que te proporciona la aplicacion para estacionar dentro del establecimiento 
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Sobre Nosotros</h2>
                    <h3 class="section-subheading text-muted">
                        Conoce al equipo que trabaja dia a dia en este proyecto
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img style="width: 215px; height: 215px;" src="/<?php echo $base; ?>/aplication/public/landing/img/team/alejo.jpg" class="img-responsive img-circle" alt="">
                        <h4>Alejo Gariglio</h4>
                        <p class="text-muted">Analisis</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img style="width: 215px; height: 215px;" src="/<?php echo $base; ?>/aplication/public/landing/img/team/tomas.jpg" class="img-responsive img-circle" alt="">
                        <h4>Tomas Lopez</h4>
                        <p class="text-muted">Director</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img style="width: 215px; height: 215px;" src="/<?php echo $base; ?>/aplication/public/landing/img/team/cesar.jpg" class="img-responsive img-circle" alt="">
                        <h4>Cesar Cappetto</h4>
                        <p class="text-muted">Desarrollo</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img style="width: 215px; height: 215px;" src="/<?php echo $base; ?>/aplication/public/landing/img/team/federico.jpg" class="img-responsive img-circle" alt="">
                        <h4>Federico Lago</h4>
                        <p class="text-muted">Seguridad e Infraestructura</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img style="width: 215px; height: 215px;" src="/<?php echo $base; ?>/aplication/public/landing/img/team/nicolas.jpg" class="img-responsive img-circle" alt="">
                        <h4>Nicolas Carusso</h4>
                        <p class="text-muted">Comunicaciones y Redes</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contacto</h2>
                    <h3 class="section-subheading text-muted">Se parte de la Red iParking, contactate con nosotros!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nombre" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Telefono" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Presentate" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; iParking Solutions <?php echo date("Y"); ?></span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/<?php echo $base; ?>/aplication/public/landing/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/<?php echo $base; ?>/aplication/public/landing/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/<?php echo $base; ?>/aplication/public/landing/js/jqBootstrapValidation.js"></script>
    <script src="/<?php echo $base; ?>/aplication/public/landing/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/<?php echo $base; ?>/aplication/public/landing/js/agency.min.js"></script>

</body>

</html>
