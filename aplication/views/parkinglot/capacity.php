<?php
/* @var $pkl Parkinglot */
$pkl;

$group = new Group(CAPACITY_GROUP);
$ac = new AdminController();
$ac->control($group, new RedirectResult());

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";


function createLayout($parkinglot) {
    $html = "";

    /* @var $layout Layout */
    foreach ($parkinglot->getLayouts() as $layout) {
        /* @var $positions LayoutPosition */
        $positions = $layout->getLayoutPositions();

        $html .= "<div class='panel panel-default'> 
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <span style='
                                display: block;
                                padding: 10px 15px;
                                font-size: 14px;
                                background-color: #f0ad4e;
                                color: #FFFFFF;'>Nivel " . $layout->getFloor() . " | " . $layout->getMaxRows() . " x " . $layout->getMaxCols() . "</span>
                            </h4>
                        </div>
                        <div id='level_" . $layout->getFloor() . "' class='panel-collapse'>
                            <div class='panel-body'>
                            
                                <div class='portlet'>
                                    <div class='portlet-header'>
                                        <h3><i class='fa fa-info'></i>Informaci&oacute;n de Piso</h3>
                                    </div> 
                                    <div class='portlet-content'>
                                        <p>
                                            <b>Cantidad de Plazas Ocupadas: " . ($layout->getBookedPositions() + $layout->getUnavailablePositions()) . "</b><br><br>
                                            <b>Cantidad de Plazas Disponibles: " . $layout->getFreePositions() . "</b>
                                        </p>
                                    </div>
                                </div>
                                
                                <table class='layoutTable' style='width:100%; table-layout: fixed;'>";
        $pos = 0;
        for ($i = 0; $i < $layout->getMaxRows(); $i ++) {

            $html .= "<tr>";

            for ($j = 0; $j < $layout->getMaxCols(); $j ++) {

                /* @var $lp LayoutPosition */
                $lp = $positions[$pos];

                /* @var $vt VehicleType */
                $vt = $positions[$pos]->getVehicleType();

                $vtName = "";
                $vtColor = "";

                // Es vehiculo
                if ($vt != NULL && $lp->isValid()) {
                    $vtName = Gui::img("car.png", "width:50px;height:50px;");
                    $vtColor = $lp->getStateColor();
                }

                // Es Entrada
                if ($lp->isIn()) {
                    $vtName = "ENTRADA";
                    $vtColor = "";
                }

                // Es Salida
                if ($lp->isOut()) {
                    $vtName = "SALIDA";
                    $vtColor = "";
                }

                // Es Rampa de Subida
                if ($lp->isRampIn()) {
                    $vtName = "&#62;";
                    $vtColor = "#6699ff";
                }

                // Es Rampa de Bajada
                if ($lp->isRampOut()) {
                    $vtName = "&#60;";
                    $vtColor = "#ff4dff";
                }

                // Es Posicion para Caminar
                $cv = $lp->getCirculationValue();
                if ($cv != 0) {
                    $vtName = "";
                    $vtColor = "#FFFFFF";
                }

                if ($lp->isInvalid()) {
                    $html .= "<td style='height:50px; background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%), url(/" . Ioc::getService("domain") . "/aplication/public/backend/img/ocupado.png);'></td>";
                } else {
                    $html .= "<td style='height:50px; background-color: " . $vtColor . ";' align='center'>
                                                        <b>" . $vtName . "</b>
                                                     </td>";
                }

                $pos++;
            }

            $html .= "</tr>";
        }

        $html .= "</table>
                            </div>
                        </div>
                    </div>";
    }
    
    return $html;
}
?>

<div id="content">		

    <div id="content-header">
        <h1>
           Capacidad Actual
        </h1>
    </div>

    <div id="content-container">
        <div id="parkingLayout" class="panel-group accordion" id="accordion">
            <?php echo createLayout($pkl); ?>
        </div>
        <hr>
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
    </div>
</div>

<script>
    var interval = 1000;
    var tid = setInterval(controlProcess, interval);
    function abortTimer() { 
      clearInterval(tid);
    }
    
    function controlProcess() {
        abortTimer();
        checkCapacity();
    }
    
    function checkCapacity() {
        $.ajax({
            url: "./capacityControl",
            type: 'POST',
            success: function (response) {
                tid = setInterval(controlProcess, interval);
                $("#parkingLayout").html(response);
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
                tid = setInterval(controlProcess, interval);
            }
        });
    }
</script>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

