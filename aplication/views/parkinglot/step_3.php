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
            Paso 3: Generar Layout
        </h1>
    </div>

    <div id="content-container">

        <?php
        echo Gui::form("frmStep_3", "parkinglot/save/3");

        if ($error) {
            echo Gui::error($errorMsg);
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
            <table id = "layoutTable" class='layoutTable'></table>
            <br><br>
        </div>
        <div class='col-md-12'>
            <input type="hidden" id="rangeColor" value="">
            <?php 
                /* @var $vt VehicleType */
                foreach($vTypes as $vt){
                    echo "<input    type='button'
                                    onclick='setColor(\"" . $vt->getColor() . "\");'
                                    class='btn btn-default'
                                    style='background-color: " . $vt->getColor() . ";'
                                    value='" . $vt->getName() . "'>&nbsp;";
                }
            ?>
            <br><br>
            <input type="button" onclick="setColor('#909090');" class='btn btn-default' style='background-color: #909090;' value="No Disponible">
            &nbsp;
            <input type="button" onclick="setCirculation();" class='btn btn-default' value="Circulacion">
            &nbsp;
            <input type="button" onclick="clean();" class='btn btn-default' value="Limpiar">
            &nbsp;
            <input type="button" onclick="cleanAll();" class='btn btn-default' value="Limipiar Todo">
            
<!--            <input type="button" onclick="readAll();" value="Leer">
            <input type="button" onclick="generate();" value="Generar POST">    -->
            <br><br>
        </div>
        <hr>
        <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
        <?php echo Gui::href("parkinglot/cancel", "Cancelar", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<?php echo Gui::script("layoutCustmization.js"); ?>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

