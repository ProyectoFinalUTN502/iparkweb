<?php
require_once APPPATH . DS . 'html' . DS . 'backend' . DS . 'headerLogin.php';
?>
<div id="login-container">
    
    <div id="logo">
        <img src="../aplication/public/backend/img/logos/logo-login.png" alt="Logo" />
    </div>
    
    <div id="login">

        <h3>Bienvenido a iParking</h3>

        <h5>Por favor, inice sesion para obtener acceso</h5>

        <form id="login-form" 
              action="authenticate" 
              class="form" 
              method="post">
            
            <?php 
                if($error){
                    echo "<span style='color: red;'>"
                    . "<strong>** Nombre de Usuario y/o Contrase&ntilde;a incorrecta **</strong>"
                            . "</span>";
                }
            ?>

            <div class="form-group">
                <label for="login-username">Usuario</label>
                <input type="text" class="form-control" id="login-username" placeholder="Usuario" name="user">
            </div>

            <div class="form-group">
                <label for="login-password">Contrase&ntilde;a</label>
                <input type="password" class="form-control" id="login-password" placeholder="contrase&ntilde;a" name="password">
            </div>

            <div class="form-group">
                <button type="submit" 
                        id="login-btn" 
                        class="btn btn-primary btn-block" 
                        name="submit">
                    Entrar &nbsp; <i class="fa fa-play-circle"></i>
                </button>
            </div>

        </form>

        <a href="password/recuperar" class="btn btn-default">Recuperar Contrase&ntilde;a</a>

    </div>
</div>

<?php
require_once APPPATH . DS . 'html' . DS . 'backend' . DS . 'footerLogin.php';
