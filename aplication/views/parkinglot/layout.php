<?php
/* @var $pkl Parkinglot */
$pkl;

$group = new Group(PARKINGLOT_GROUP);
$ac = new AdminController();
$ac->control($group, new RedirectResult());

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="content">		

    <div id="content-header">
        <h1>
           Mapa de Establecimiento
        </h1>
    </div>

    <div id="content-container">
        <div class="panel-group accordion" id="accordion">
            <?php 
            
                $html = "";
                
                /* @var $layout Layout */
                foreach ($pkl->getLayouts() as $layout) {
                    /* @var $positions LayoutPosition */
                    $positions = $layout->getLayoutPositions();
                    
                    $html .= "<div class='panel panel-default'> 
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <a class='accordion-toggle' data-toggle='collapse' data-parent='.accordion' href='#level_" . $layout->getFloor() . "'>
                                    Nivel " . $layout->getFloor() . " | " . $layout->getMaxRows() . " x " . $layout->getMaxCols() . "
                                </a>
                            </h4>
                        </div>
                        <div id='level_" . $layout->getFloor() . "' class='panel-collapse collapse'>
                            <div class='panel-body'>
                                <table class='layoutTable'>";
                                $pos = 0;
                                for ($i = 0; $i < $layout->getMaxRows(); $i ++) {
                                    
                                    $html .= "<tr>";
                                    
                                    for($j = 0; $j < $layout->getMaxCols(); $j ++) { 
                                        
                                        /* @var $lp LayoutPosition */
                                        $lp = $positions[$pos];
                                        
                                        /* @var $vt VehicleType */
                                        $vt = $positions[$pos]->getVehicleType();
                                        
                                        $vtName = "";
                                        $vtColor = "";
                                        
                                        if ($vt == NULL && !$lp->isValid()) {
                                            $vtName = "";
                                            $vtColor = "#909090";
                                        }
                                        
                                        if ($vt == NULL && $lp->isValid()) {
                                            $vtName = "";
                                            $vtColor = "#FFFFFF";
                                        }
                                        
                                        if ($vt != NULL && $lp->isValid()) {
                                            $vtName = $vt->getName();
                                            $vtColor = $vt->getColor();
                                        }
                                        
                                        
                                        $html .= "<td style='background-color: " . $vtColor . ";' align='center'>
                                                    <b>" . $vtName . "</b>
                                                 </td>";
                                        $pos++;
                                    }
                                    
                                    $html .= "</tr>";
                                }
                                
                    
                    $html .= "</table>
                            </div>
                        </div>
                    </div>";
                }
                
                echo $html;
            ?>
        </div>
    </div>
</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

