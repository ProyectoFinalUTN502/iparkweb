<?php
/* @var $usr User */
$usr;

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>
<div id="content">		

    <div id="content-header">
        <h1>Restablecer Password</h1>
    </div>

    <div id="content-container">

        <?php
            echo Gui::form("frmUsrPassword", "User/editPasswordClient/" . $usr->getId());
            if ($error) {
                echo Gui::error($errorMsg);
            }
        ?>
        
        <div class='portlet' style='width: 800px;'>
            <div class='portlet-header'>
                <h3><i class='fa fa-info'></i>Nuevo Password</h3>
            </div> 
            <div class='portlet-content'>
                <p>
                    Ingrese la nueva contrase&ntilde;a en los cuadros de texto y
                    luego haga click en <i>Guardar</i>.
                    <br>Le recordamos que luego de cambiar la contrase&ntilde;a, 
                    el sistema cerrara su sesion, y debera<br>
                    loguearse nuevamente, utilizando la nueva contrase&ntilde;a establecida
                </p>
            </div>
        </div>
        
        <table style="width: 100%;">
            <tr>
                <td>
                    <div class='col-md-6' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Password</h4>
                        <input type='password'
                               id='password'
                               name='password' 
                               placeholder='Contrase&ntilde;a' 
                               class='form-control' 
                               value=''>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Confirmar Password</h4>
                        <input type='password' 
                               name='repassword' 
                               placeholder='Contrase&ntilde;a' 
                               class='form-control' 
                               value=''>
                    </div>
                </td>
            </tr>

        </table>
        <hr>
        <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
        <?php echo Gui::href("user/profile", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

