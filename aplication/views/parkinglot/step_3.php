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


        <input type="submit" name="submit" class="btn btn-primary" value="Siguiente">
        <?php echo Gui::href("parkinglot/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

