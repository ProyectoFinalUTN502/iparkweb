<?php
/* @var $pkl Parkinglot */
$pkl;

$group = new Group(PARKINGLOT_GROUP);
$ac = new AdminController();

if($pkl != null){
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
                if ($pkl != NULL) {
                    echo "Edicion de Layout";
                } else {
                    echo "Paso 3: Generar Layout";
                }
            ?>
        </h1>
    </div>

    <div id="content-container">

        <?php
        if ($error) {
            echo Gui::error($errorMsg);
        }
        
        if ($pkl != null) {
            echo Gui::form("frmStep_3", "parkinglot/editLayout/" . $pkl->getId());
            
            $title = "IMPORTANTE";
            $msg = "Debido a la complejidad que representa la creacion del "
                    . "Layout, la edicion del mismo se realizara creando un "
                    . "nuevo Layout<br> (uno por cada nivel necesario) que "
                    . "reemplazara al anterior";
            
            echo "<div class='portlet' style='width: 50%;'>
                    <div class='portlet-header'>
			<h3><i class='fa fa-info'></i>" . $title . "</h3>
                    </div> 
                    <div class='portlet-content'>
			<p>" . $msg . "</p>
                    </div>
		</div>";
            
        } else {
            echo Gui::form("frmStep_3", "parkinglot/register");
        }

        ?>
        
        <table style='width: 30%;'>
            <tr>
                <td>
                    <h4 class='touchable'>Nivel</h4>
                </td>
                <td>
                    <input type='text' 
                           id='floor'
                           name='floor' 
                           placeholder='Ingrese el Identificador de Nivel' 
                           class='form-control' 
                           value=''>
                </td>
            </tr>
            <tr>
                <td>
                    <h4 class='touchable'>Pos. En Horizontal</h4>
                </td>
                <td>
                    <input type='text' 
                           id='maxRows'
                           name='maxRows' 
                           placeholder='Ingrese Cantidad de Filas' 
                           class='form-control' 
                           value=''>
                </td>
            </tr>
            <tr>
                <td>
                    <h4 class='touchable'>Pos. En Vertical</h4>
                </td>
                <td>
                    <input type='text'
                           id='maxCols'
                           name='maxCols' 
                           placeholder='Ingrese Cantidad de Columnas' 
                           class='form-control' 
                           value=''>
                </td>
            </tr>
            <tr>
                <td></td>
                <td align='right' style='margin-bottom: 20px;'>
                    <input type="button" 
                           id="createLayout" 
                           class='btn btn-primary'
                           value="Crear Layout" 
                           onclick="createTable();">   
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id='errorDiv' class='error'></div>
                </td>
            </tr>
        </table>
        <br><br>

        <div id="tableArea" class='col-md-12'>
            <table id = "layoutTable" class='layoutTable' style="table-layout: fixed;"></table>
            <br>
        </div>
        <div class='col-md-12'>
            <input type="text" id="rangeColor" value="" style="display: none;">
            <input type="text" id="vehicleType" value="" style="display: none;">
            <?php 
                /* @var $vt VehicleType */
                foreach($vTypes as $vt){
                    echo "<input    type='button'
                                    onclick='setColor(\"" . $vt->getColor() . "\", " . $vt->getId() . ");'
                                    class='btn btn-default'
                                    style='background-color: " . $vt->getColor() . ";'
                                    value='" . $vt->getName() . "'>&nbsp;";
                }
            ?>
            <br><br>
            <table style="width: 35%; table-layout: fixed;">
                <tr>
                    <td>
                        <input type="button" 
                               onclick="setInvalid();" 
                               class='btn btn-default' 
                               style='background-color: #909090; width: 100%;' 
                               value="No Disponible">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="setCirculation();" 
                               class='btn btn-default' 
                               style="background-color: #262626; color: #ffffff; width: 100%;"
                               value="Circulacion">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="clean();" 
                               class='btn btn-default' 
                               style="width: 100%;"
                               value="Limpiar">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="cleanAll();" 
                               class='btn btn-default' 
                               style="width: 100%;"
                               value="Limipiar Todo">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" 
                               onclick="setInput();" 
                               class='btn btn-default' 
                               style='background-color: #8cff66; width: 100%;' 
                               value="Entrada">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="setOutput();" 
                               class='btn btn-default' 
                               style="background-color: #ff4d4d; width: 100%;"
                               value="Salida">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="setRampIn();" 
                               class='btn btn-default' 
                               style="background-color: #6699ff; width: 100%;"
                               value="Rampa de Subida">
                    </td>
                    <td>
                        <input type="button" 
                               onclick="setRampOut();" 
                               class='btn btn-default'
                               style="background-color: #ff4dff; width: 100%;"
                               value="Rampa de Bajada">
                    </td>
                </tr>
            </table>
            <br><br>
            <input type="button" onclick="generate();" class="btn btn-info" value="Guardar Nivel">
        </div>
        <hr>
        <?php 
            if ($pkl != NULL) {
                echo "<input type='submit' name='submit' class='btn btn-primary' value='Editar'>&nbsp;";
                echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); 
            } else {
                echo "<input type='submit' name='submit' class='btn btn-primary' value='Finalizar'>&nbsp;";
                echo Gui::href("parkinglot/cancel", "Cancelar", array("class" => "btn btn-default")); 
            }
        ?>
        </form>
    </div>
</div>
<?php echo Gui::script("layoutCustmization.js"); ?>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

