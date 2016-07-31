<?php
$ac = new AdminController();
$ac->control(new Group(VT_GROUP), new RedirectResult());
require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
/* @var $vt VechicleType */
$vt;
?>
<div id="content">		

    <div id="content-header">
        <h1>
            <?php 
                if($vt != null){
                    echo "Edicion de Tipo de Vehiculo";
                } else {
                    echo "Nuevo Tipo de Vehiculo";
                }
            
            ?>
            
        </h1>
    </div>

    <div id="content-container">
        
        <?php 
            if($vt != null){
                echo Gui::form("frmVt", "VehicleType/edit/" . $vt->getId());
            } else {
                echo Gui::form("frmVt", "VehicleType/register");
            }
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            
                            
                            <?php 
                                if ($vt != null) {
                                    echo "<h4 class='touchable'>Color Anterior</h4>";
                                    echo "<div style='width:32px; height:32px; background-color:" . $vt->getColor() . "'></div>";
                                    echo "<h4 class='touchable'>Nuevo Color</h4>";
                                } else {
                                    echo "<h4 class='touchable'>Color</h4>";
                                }
                            ?>
                            <input type="text" id="colorPicker">
                            <input type="text" 
                                   id="color"
                                   name="color" 
                                   class="form-control"
                                   style="display:none;"
                                   value="<?php
                                        if($vt != null){
                                            echo $vt->getColor();
                                        }
                                   ?>">
                            <div id="errorDiv"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class="touchable">Nombre</h4>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Ingrese el Tipo de Vehiculo" 
                                   class="form-control" 
                                   value="<?php
                                        if($vt != null){
                                            echo $vt->getName();
                                        }
                                   ?>">
                        </div>
                    </td>
                </tr>
            </table>
            
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
            <?php echo Gui::href("vehicleType/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>

<script>
    $("#colorPicker").spectrum({
        preferredFormat: "hex",
        cancelText: "Cancelar",
        chooseText: "Selecionar",
        showInput: true,
        change: function (color) {
            var hex = color.toHexString();
            $("#color").val(hex);
        }
    });
</script>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

