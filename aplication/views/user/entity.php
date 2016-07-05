<?php
/* @var $usr User */
$usr;
$group = new Group(USER_GROUP);
$ac = new AdminController();

if($usr != null){
    $ac->controlUpdate($group, new RedirectResult());
} else {
     $ac->controlCreate($group, new RedirectResult());
}

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>
<div id="content">		

    <div id="content-header">
        <h1>
            <?php 
                if($usr != null){
                    echo "Edicion de Usuario";
                } else {
                    echo "Nuevo Usuario";
                }
            
            ?>
            
        </h1>
    </div>

    <div id="content-container">
        
        <?php 
            if($usr != null){
                echo Gui::form("frmUsr", "User/edit/" . $usr->getId());
            } else {
                echo Gui::form("frmUsr", "User/register");
            }
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
            <table style="width: 100%;">
                <?php 
                    if($usr == null){
                        echo "  <tr>
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
                                </tr>"; 
                    }
                ?>
                
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Nombre</h4>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Ingrese el Nombre del Administrador" 
                                   class="form-control" 
                                   value="<?php
                                        if($usr != null){
                                            echo $usr->getName();
                                        }
                                   ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Apellido</h4>
                            <input type="text" 
                                   name="lastName" 
                                   placeholder="Ingrese el Apellido del Administrador" 
                                   class="form-control" 
                                   value="<?php
                                        if($usr != null){
                                            echo $usr->getLastName();
                                        }
                                   ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Email</h4>
                            <input type="text" 
                                   name="email" 
                                   placeholder="Ingrese el Email del Administrador" 
                                   class="form-control" 
                                   value="<?php
                                        if($usr != null){
                                            echo $usr->getEmail();
                                        }
                                   ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Rol</h4>
                            <select name="rol_id" class="form-control">
                                <?php 
                                    if($usr == null){
                                        /* @var $rol Rol */
                                        foreach($roles as $rol){
                                            echo "<option value='" . $rol->getId() . "'>" . $rol->getName() . "</option>";
                                        }
                                    } else {
                                        /* @var $rol Rol */
                                        foreach($roles as $rol){
                                            if($usr->getRol()->getId() == $rol->getId()){
                                                echo "<option value='" . $rol->getId() . "' selected>" . $rol->getName() . "</option>";
                                            } else {
                                                echo "<option value='" . $rol->getId() . "'>" . $rol->getName() . "</option>";
                                            }
                                        }
                                    }
                                
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
            <?php echo Gui::href("User/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
    
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

