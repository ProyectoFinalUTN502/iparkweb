<?php
$group = new Group(CONFIG_GROUP);
$ac = new AdminController();
$ac->control($group, new RedirectResult());
require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="content">		

    <div id="content-header">
        <h1>Configuracion</h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmParam", "param/edit");
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
        
        <table style="width: 50%;">
            <?php
            /* @var $param Param */
            foreach ($params as $param) {
                echo "
                        <tr>
                            <td>
                                <span><strong>" . $param->getKeyText() . "</strong></span>
                            </td>
                            <td> 
                                <input type='text' name='" . $param->getKeyParam() . "' class='form-control' style='width: 300px;' value='" . $param->getValueParam() . "' >
                            </td>
                            <td>
                                <p><i>" . $param->getValueText() . "</i></p>
                            </td>
                        </tr>";
            }
            ?>
        </table>
        <hr>
        <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

