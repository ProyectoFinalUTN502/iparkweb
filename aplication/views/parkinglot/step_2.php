<?php
$group = new Group(PARKINGLOT_GROUP);
$ac = new AdminController();
$ac->controlCreate($group, new RedirectResult());

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="modal" class="modal" style="font-family: 'Raleway', sans-serif;
             background: white;
             border-radius: 0px;
             -webkit-box-shadow: 0px 0px 68px 3px rgba(0,0,0,0.39);
             -moz-box-shadow: 0px 0px 68px 3px rgba(0,0,0,0.39);
             box-shadow: 0px 0px 68px 3px rgba(0,0,0,0.39);
             margin: -205px auto auto -310px;
             width: 450px;
             position: fixed;
             left: 57%;
             top: 50%;
             z-index: 5001;
             opacity: 0;
             display: none;
             height: 250px;
             overflow: auto;">
    <div class="modalHeader">
        <h1 class="titleModal">Posicion No Encontrada</h1>
    </div>
    <div id="contentEliminar" class="modalContent">
        La direccion ingresada no ha podido ser ubicada en el mapa<br>
        Por favor, controle la informacion ingresada e intente nuevamente
    </div>
    <div class="modalFooter">
        <div class="modalButtons">
            <span onclick="" class="btn btn-primary" id="confirm">Aceptar</span>
        </div>
    </div>
</div> 

<div id="content">		

    <div id="content-header">
        <h1>
            Paso 2: Registro de Establecimiento
        </h1>
    </div>

    <div id="content-container">

        <?php
        echo Gui::form("frmStep_2", "parkinglot/save/2");

        if ($error) {
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
<!--            <tr>
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
            </tr>-->
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
        <br>
        <table style="width: 100%;">
            <tr>
                <td>
                     <div class="col-md-6">
                         <p>
                             <strong>Ubicacion de Establecimiento: </strong>Ingrese la calle y la altura 
                             del establecimiento en el buscador. Al finalizar presione la Tecla <i>Enter</i>.
                             <br>El sistema realizara la busqueda del Establecimiento y marcara en el mapa la 
                             posicion del mismo. Si la posicion no es correcta, realice la busqueda nuevamente
                         </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="col-md-6" style="height: 50px;">
                        <input type="search" id="addressSearch" class="form-control" placeholder="Direccion, Localidad, Partido, Provincia, Pais">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="map" class="col-md-6" style="height: 400px;"></div>
                </td>
            </tr>
        </table>
        <hr>
        <input type="text" id="lat" name="lat" style="display: none;" value="">
        <input type="text" id="lng" name="lng" style="display: none;" value="">
        <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
        <?php echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA-kRCMxJ66iI2909Ti5WopU3m0_kfgyA&callback=initMap"></script>
<script>
    $('#addressSearch').keypress(function (e) {
        var key = e.which;
        if (key === 13) {
            var val = $("#addressSearch").val();
            console.log(val);
            getLocation(val);
            return false;
        }
    });
</script>


<!--<script>
$(function(){
    $('#openTime').timepicker({defaultTime: '00:00'});
    $('#closeTime').timepicker({defaultTime: '00:00'});
});
</script>-->

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

