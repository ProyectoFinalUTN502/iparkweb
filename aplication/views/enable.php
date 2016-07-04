<?php
require_once APPPATH . DS . 'html' . DS . 'backend' . DS . 'headerLogin.php';
?>
<div id="login-container">
    
    <div id="logo">
        <img src="../aplication/public/backend/img/logos/logo-login.png" alt="Logo" />
    </div>
    <div id="login">

            <h3>Acceso Denegado!</h3>

            <p>
                Usted no tiene permisos suficientes para acceder a la vista solicitada
                <br>Por favor, comuniquese con el administrador de la plataforma
            </p>
            
            <?php echo Gui::href("admin/main", "Inicio", array("class" => "btn btn-primary")); ?>
    </div> 
</div> 

<?php
require_once APPPATH . DS . 'html' . DS . 'backend' . DS . 'footerLogin.php';


