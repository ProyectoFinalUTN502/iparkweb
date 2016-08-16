<?php
$ac = new AdminController();
$ac->control(new Group(PRICE_GROUP), new RedirectResult());

/* @var $pkl Parkinglot */
$pkl;

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="content">		

    <div id="content-header">
        <h1>Tarifas</h1>
    </div>

    <div id="content-container">

        
        <?php 
            echo Gui::form("frmPrices", "price/register"); 
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
        <div class='portlet' style='width: 800px;'>
            <div class='portlet-header'>
                <h3><i class='fa fa-info'></i>Carga de Tarifas</h3>
            </div> 
            <div class='portlet-content'>
                <p>
                    Ingrese el valor de la tarifa por hora, para el tipo de Vehiculo que se lista a continuacion<br>
                    Le recordamos que los valores deben ser numericos y no podran estar fraccionados. <br>
                    Al finalizar, puede guardar los cambios haciendo click en el boton <i>Guardar</i>
                </p>
            </div>
        </div>
        
        <div id="controls">
            <table style="width: 800px;">
                <?php 
                    $html = "";

                    /* @var $vt VehicleType */
                    foreach ($vTypes as $vt) {
                        $value = $pkl->getPriceForVt($vt);
                        $html .= "<tr>
                                    <td style='width: 150px;'>
                                        <b>" . $vt->getName() . "</b>
                                    </td>
                                    <td>
                                        <input type='text' 
                                                name='" . $vt->getId() . "' 
                                                placeholder='Tarifa por hora para " . $vt->getName() . "' 
                                                class='form-control'
                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                value='" . $value . "'>
                                    </td>
                                </tr>";
                    }

                    echo $html;
                ?>
            </table>
            <div id="errorDiv" class="error">
                
            </div>
        </div>
        
        <hr>
        <input type="button" id="btnSave" class="btn btn-primary" value="Guardar">
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<script>
    $("#btnSave").click(function (e) {
        var validate = true;
        $('#controls :input').each(function() { 
            var val = $(this).val();
            
            if (val === "") {
                validate = false;
            }
        });
        
        if (validate) {
            $("#errorDiv").empty();
            $("#frmPrices").submit();
        } else {
           $("#errorDiv").html("<b>Los campos de Tarifas son obligatorios y no pueden quedar vacios</b>"); 
        }
        
    });
</script>
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";




