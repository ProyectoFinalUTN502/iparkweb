<?php
$group = new Group(ROL_GROUP);
$ac = new AdminController();

if($rol != null){
    $ac->controlUpdate($group, new RedirectResult());
} else {
     $ac->controlCreate($group, new RedirectResult());
}

$ac->control($group, new RedirectResult());
require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
/* @var $rol Rol */
$rol;
?>
<div id="content">		

    <div id="content-header">
        <h1>
            <?php 
                if($rol != null){
                    echo "Edicion de Rol";
                } else {
                    echo "Nuevo Rol";
                }
            
            ?>
            
        </h1>
    </div>

    <div id="content-container">
        
        <?php 
            if($rol != null){
                echo Gui::form("frmRol", "Role/edit/" . $rol->getId());
            } else {
                echo Gui::form("frmRol", "Role/register");
            }
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Nombre</h4>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Ingrese el Nombre del Rol" 
                                   class="form-control" 
                                   value="<?php
                                        if($rol != null){
                                            echo $rol->getName();
                                        }
                                   ?>">
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Permisos Asignados</h4>
                            <?php
                                $i = 0;
                                $data = array();
                                
                                if($rol == null){
                                    
                                    foreach ($groups as $group) {
                                        /* @var $group Group */
                                        $data[$i] = "<input type='checkbox' value='" . $group->getId() . "' name='groups[]'/>&nbsp;" . $group->getText();
                                        $i++;
                                    }
                                } else {

                                     $permissionsGranted = array();
                                    /* @var $rp Permission */
                                    foreach($rol->getPermissions() as $rp){
                                        $groupId = $rp->getGroup()->getId();
                                        array_push($permissionsGranted, $groupId);
                                    }
                                    
                                    foreach ($groups as $group) {
                                        /* @var $group Group */ 
                                        if(in_array($group->getId(), $permissionsGranted)){
                                            $data[$i] = "<input type='checkbox' value='" . $group->getId() . "' name='groups[]' checked />&nbsp;" . $group->getText();    
                                        } else {
                                            $data[$i] = "<input type='checkbox' value='" . $group->getId() . "' name='groups[]'/>&nbsp;" . $group->getText();
                                        }
                                        $i++;
                                    }
                                    
                                }

                                echo Gui::grid($data);
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><div id="errorDiv" class="col-md-6"></div></td>
                </tr>
            </table>
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
            <?php echo Gui::href("Role/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
    
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

