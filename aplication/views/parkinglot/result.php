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
            Registro Finalizado
        </h1>
    </div>

    <div id="content-container">
        <?php 
            if ($error) {
                echo Gui::error($msg);
            } else {
                echo "<p>Un nuevo Establecimiento ha sido dado de alta exitosamente en el sistema"
                        . "<br>"
                        . "Haga click en el boton de <i>Inicio</i> para volver al menu principal"
                   . "</p>";
            }
            echo "<hr>";
            echo Gui::href("parkinglot/cancel", "Volver a Inicio", array("class" => "btn btn-primary"));
        ?>
    </div>
</div>
    
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

