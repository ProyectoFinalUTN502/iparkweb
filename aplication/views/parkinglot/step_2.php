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
            <tr>
                <td>
                    <div class="col-md-6  bootstrap-timepicker" style="margin-bottom:10px;">
                        <h4 class="touchable">Hora de Inicio</h4>
                        <input type="text" 
                               id="openTime"
                               name="openTime" 
                               class="form-control" 
                               value=""
                               placeholder="Ingrese el Horario de Apertura"
                               maxlength="5">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Hora de Cierre</h4> 
                        <span style="font-size: 11px;">
                            (Para 24 Hs, ingrese el Horario de Inicio)
                        </span>
                        <input type="text" 
                               id="closeTime"
                               name="closeTime" 
                               class="form-control" 
                               value=""
                               placeholder="Ingrese el Horario de Cierre"
                               maxlength="5">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Pais</h4>
                        <select id="country" name="country" class="form-control" onchange="getProvinces();">
                        <?php
                                /* @var $countries Country */
                            foreach($countries as $country){
                                echo "<option value='" . $country->getId() . "'>" . $country->getDescription() . "</option>";
                            }
                        ?>    
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Provincia</h4>
                        <select id="province" name="province" class="form-control" onchange="getStates();">
                            <option value="1">No disponible</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Partido</h4>
                        <select id="state" name="state" class="form-control" onchange="getCities();">
                            <option value="1">No disponible</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6  bootstrap-timepicker' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Localidad</h4>
                        <select id="city" name="city" class="form-control">
                            <option value="1">No disponible</option>
                        </select>
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
        <div id="gMapsArea" class="col-md-12" style="display:none;">
            <table style="width: 100%;">
                <tr>
                    <td>
                         <div class="col-md-6">
                            <h4 class='touchable'>Ubicacion de Establecimiento</h4>
                             <p>
                                 Ingrese la calle y la altura del establecimiento en el buscador. Al finalizar presione el boton <i>Buscar</i>.
                                 <br>El sistema realizara la busqueda del Establecimiento y marcara en el mapa la 
                                 posicion del mismo.<br>Si la posicion no es correcta, realice la busqueda nuevamente
                             </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="searchArea" class="col-md-5" style="height: 50px;">
                            <input type="search" id="addressSearch" class="form-control" placeholder="Ingrese Calle y Altura del Establecimiento">
                        </div>
                        <div class="col-md-1" style="padding-left: 0px;">
                            <input type="button" id="btnSearch" class="btn btn-primary" value="Buscar">
                        </div>
                        <div id="imgSearch" class="col-md-6"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="map" class="col-md-6" style="height: 400px;"></div>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <!--style="display: none;" -->
        <input type="text" id="address" name="address" style="display: none;" value="">
        <input type="text" id="lat" name="lat" style="display: none;" value="">
        <input type="text" id="lng" name="lng" style="display: none;" value="">
        <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
        <?php echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA-kRCMxJ66iI2909Ti5WopU3m0_kfgyA"></script>
<script>
    //^([01]\d|2[0-3]):?([0-5]\d)$
    $('#btnSearch').click(function (e){
        getLocation();
    });
    
    $('#addressSearch').keypress(function (e) {
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var regex = new RegExp("^[a-zA-Z0-9\\-\\s]+$");
        if (!regex.test(key)) {
           e.preventDefault();
           return false;
        }
    });
    
    $('#openTime').keypress(function (e) {
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var regex = new RegExp("^[0-9]+|\:$");
        if (!regex.test(key)) {
           e.preventDefault();
           return false;
        }
    });
    
    $('#openTime').keydown(function (e) {
        var element = $("#openTime");
        var keyCode = e.keyCode || e.which;
        var key =  String.fromCharCode(keyCode);
        
        var value = element.val();
        var text = value + key;
                
        if (e.keyCode >= 96 && e.keyCode <= 105){
            e.preventDefault();
            return false;
        }
        
        if(text.length === 2 && keyCode !== 8){
            element.empty();
            element.val(text + ":00");
            e.preventDefault();
            return false;
        }
    });
    
    $('#closeTime').keypress(function (e) {
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var regex = new RegExp("^[0-9]+|\:$");
        if (!regex.test(key)) {
           e.preventDefault();
           return false;
        }
    });
    
    $('#closeTime').keydown(function (e) {
        var element = $("#closeTime");
        var keyCode = e.keyCode || e.which;
        var key =  String.fromCharCode(keyCode);
        
        var value = element.val();
        var text = value + key;
                
        if (e.keyCode >= 96 && e.keyCode <= 105){
            e.preventDefault();
            return false;
        }
        
        if(text.length === 2 && keyCode !== 8){
            element.empty();
            element.val(text + ":00");
            e.preventDefault();
            return false;
        }
    });
</script>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

