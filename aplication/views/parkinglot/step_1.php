<?php
$group = new Group(PARKINGLOT_GROUP);
$ac = new AdminController();
$ac->controlCreate($group, new RedirectResult());

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>
<div id="content">		

    <div id="content-header">
        <h1>
            Paso 1: Registro de Usuario
        </h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmStep_1", "parkinglot/save/1");
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
        
<!--            <div> 
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div> -->
        
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class='touchable'>Usuario</h4>
                            <input type='text' 
                                   name='user' 
                                   placeholder='Ingrese el Nombre de Usuario' 
                                   class='form-control' 
                                   value=''>
                        </div>
                    </td>
                </tr>
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
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Nombre</h4>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Ingrese el Nombre del Cliente" 
                                   class="form-control" 
                                   value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Apellido</h4>
                            <input type="text" 
                                   name="lastName" 
                                   placeholder="Ingrese el Apellido del Cliente" 
                                   class="form-control" 
                                   value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class='touchable'>Email</h4>
                            <input type='text' 
                                   name='email' 
                                   placeholder='Ingrese el Email del Cliente' 
                                   class='form-control' 
                                   value=''>
                        </div>
                    </td>
                </tr>
            </table>
        
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
            <?php echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
    
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

