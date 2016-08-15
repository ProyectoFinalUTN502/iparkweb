<?php
$group = new Group(PARKINGLOT_GROUP);
$ac = new AdminController();
$ac->control($group, new RedirectResult());
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
             width: 400px;
             position: fixed;
             left: 57%;
             top: 50%;
             z-index: 5001;
             opacity: 0;
             display: none;
             height: 210px;
             overflow: auto;">
    <div class="modalHeader">
        <h1 class="titleModal">Eliminar Elemento</h1>
    </div>
    <div id="contentEliminar" class="modalContent">
        &#191;Est&aacute; seguro que desea eliminar este elemento?
    </div>
    <div class="modalFooter">
        <div class="modalButtons">
            <span onclick="" class="btn btn-primary" id="confirm">Aceptar</span>
            <span onclick="" class="btn btn-default" id="cancel">Cancelar</span>
        </div>
    </div>
</div> 


<div id="content">		

    <div id="content-header">
        <h1>Establecimientos Registrados</h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmPkl", "Parkinglot/all/" . $currentPage);
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
                           
        <div>
            <table>
                <tr>
                    <td>
                        <input class="form-control input-sm" style="width: 400px" type="text" name="q" placeholder="Buscar Establecimiento por Nombre"/>
                    </td>
                    <td>
                        <button type="submit" id="search-btn" class="btn btn-default">Buscar</button>       
                    </td>
                </tr>
            </table>
            <br>
        </div>
        <div>
        <?php 
        
            if($q != ""){
                $href = Gui::href("Parkinglot/all", "[x]");
                echo "<table>"
                        . "<tr>"
                            . "<td>Resultados para la Busqueda : \"". $q ."\"</td>"
                            . "<td>" . $href . "</td>"
                        . "</tr>"
                    . "</table><br>";
            }
        
        ?>
        </div>
        
        <table class='table table-bordered table-highlight table-hover table-striped'>
            <thead>
                <tr>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Responsable
                    </th>
                    <th>
                        Ubicacion
                    </th>
                    <th>
                        Layout
                    </th>
                    <th>
                        Editar
                    </th>
                    <th>
                        Editar Layout
                    </th>
                    <th>
                        Eliminar
                    </th>
                </tr>
            </thead>
            <?php
            /* @var $pkl Parkinglot */
            foreach ($parkinglots as $pkl) {
                
                $name = ucfirst($pkl->getName());
                
                /* @var $userClient User */
                $userClient = $pkl->getUser();
                $client = ucfirst($userClient->getName()) . " " . ucfirst($userClient->getLastName());
                
                /* @var $pklCity City */
                $pklCity = $pkl->getCity();
                /* @var $pklState State */
                $pklState = $pklCity->getState();
                $location = ucfirst($pkl->getAddress()) . ", " . 
                            ucfirst($pklCity->getDescription()) . ", " . 
                            ucfirst($pklState->getDescription());
                
                $layout = Gui::href("parkinglot/layout/" . $pkl->getId(), "Ver", array("target" => "_blank"));
                $edit = $ac->controlUpdate($group, new BooleanResult()) ? Gui::href("parkinglot/upd/" . $pkl->getId(), "Editar") : "Editar";
                $editLayout = $ac->controlUpdate($group, new BooleanResult()) ? Gui::href("parkinglot/updLayout/" . $pkl->getId(), "Editar") : "Editar";
                $delete = $ac->controlDelete($group, new BooleanResult()) ? Gui::href("", "Eliminar", array("onclick" =>"confirm(" . $pkl->getId() . ")")) : "Eliminar";
                
                echo "<tr>"
                    . "<td>" . $name . "</td>"
                    . "<td>" . $client . "</td>"
                    . "<td>" . $location . "</td>"
                    . "<td>" . $layout . "</td>"
                    . "<td>" . $edit . "</td>"
                    . "<td>" . $editLayout . "</td>"
                    . "<td>" . $delete . "</td>"
                . "</tr>";
            }
            ?>
        
        </table>
       
        <?php 
            $cp = new CanvasPaginator();
            $cp->setCurrentPage($currentPage);
            $cp->setPagesCount($pagesCount);
            $cp->setPrev($prev);
            $cp->setNext($next);
            echo $cp->display();
        ?>
        <hr>
        <?php 
            if($ac->controlCreate($group, new BooleanResult())){
                echo Gui::href("parkinglot/step/1", "Agregar", array("class" => "btn btn-primary")); 
            }
        ?>
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

