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
            Paso 2: Registro de Establecimiento
        </h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmStep_2", "parkinglot/save/2");
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>

        
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class='touchable'>SSID</h4>
                            <input type='text' 
                                   name='ssid' 
                                   placeholder='Ingrese el Identificador de Red para el Establecimiento' 
                                   class='form-control' 
                                   value=''>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class='touchable'>Nombre</h4>
                            <input type='text' 
                                   name='name' 
                                   placeholder='Ingrese el Nombre del Establecimiento' 
                                   class='form-control' 
                                   value=''>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='col-md-6' style='margin-bottom:10px;'>
                            <h4 class='touchable'>Descripcion</h4>
                            <textarea name="description" 
                                      placeholder="Ingrese una Breve Descripcion del Establecimiento"
                                      class="form-control"
                                      style="resize: none;"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="margin-bottom:10px;">
                            <h4 class="touchable">Direccion</h4>
                            <input type="text" 
                                   name="addressName" 
                                   placeholder="Ingrese la calle del establecimiento" 
                                   class="form-control" 
                                   value=""
                                   style="display: inline-block; width: 85%;">
                            &nbsp;
                            <input type="text" 
                                   name="addressNumber" 
                                   placeholder="Altura" 
                                   class="form-control" 
                                   value=""
                                   style="display: inline-block; width: 13%;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6  bootstrap-timepicker" style="margin-bottom:10px;">
                            <h4 class="touchable">Hora de Inicio</h4>
                            <input type="text" 
                                   id="openTime"
                                   name="openTime" 
                                   placeholder="" 
                                   class="form-control" 
                                   value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                            <h4 class='touchable'>Hora de Cierre*</h4>
                            <input type='text'
                                   id="closeTime"
                                   name='closeTime' 
                                   placeholder="" 
                                   class='form-control' 
                                   value=''>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-6" style="font-size: 16px;">
                            El Establecimiento posee Cocheras Cubiertas&nbsp;
                            <input type="radio" name="isCovered" value="1">&nbsp;Si&nbsp;
                            <input type="radio" name="isCovered" value="0" checked>&nbsp;No
                        </div>
                    </td>
                </tr>
            </table>
            
            <div id="map" class="col-md-8"></div>
            <div class="col-md-4"></div>
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
            <?php echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>

<script src="http://maps.google.com/maps/api/js?sensor=false&callback=init"></script>
<script type="text/javascript">
    var map;
    
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(-34.6033451,-58.3814246),
            zoom: 15,
            maTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
    }
</script>

<!--<script>
$(function(){
    $('#openTime').timepicker({defaultTime: '00:00'});
    $('#closeTime').timepicker({defaultTime: '00:00'});
});
</script>-->

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

