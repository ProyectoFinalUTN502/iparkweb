<!DOCTYPE html>
<html style="height: 100%;">
    <head>
        <!--<meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>-->
        <title></title>
        <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
        <style>
            .layoutTable { width: 100%; height: 100%; border-collapse: collapse; }
            .layoutTable td { border: 1px solid black;}
        </style>
    </head>
    <body style="height: 100%;">
        <?php 
            
                $html = "";
                
                /* @var $layout Layout */
                foreach ($pkl->getLayouts() as $layout) {
                    /* @var $positions LayoutPosition */
                    $positions = $layout->getLayoutPositions();
                    
                    $html .= "<table class='layoutTable'>";
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
                                        
                                        
                                        $html .= "<td style='background-color: " . $vtColor . ";' align='center'></td>";
                                        $pos++;
                                    }
                                    
                                    $html .= "</tr>";
                                }
                                
                    
                    $html .= "</table>";
                }
                
                echo $html;
        ?>
    </body>
<!--    <script>
        function getRandID(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        }
        
        var selectedId = getRandID(1, 144);
        
        $("#" + selectedId).css("background-color", "#DDD");
        
    </script>-->
</html>
