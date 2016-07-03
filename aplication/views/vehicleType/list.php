<?php
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
        <h1>Tipos de Vehiculo</h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmVts", "VehicleType/all/" . $currentPage);
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
                           
        <div>
            <table>
                <tr>
                    <td>
                        <input class="form-control input-sm" style="width: 400px" type="text" name="q" placeholder="Buscar Tipo de Vehiculo por Nombre..."/>
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
                $href = Gui::href("VehicleType/all", "[x]");
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
                        Tipo de Vehiculo
                    </th>
                    <th>
                        Editar
                    </th>
                    <th>
                        Eliminar
                    </th>
                </tr>
            </thead>
            <?php
            /* @var $vt VehicleType */
            foreach ($vTypes as $vt) {
                echo "<tr>"
                . "<td>" . $vt->getName() . "</td>"
                . "<td><a href='upd/" . $vt->getId() . "'>Editar<a></td>"
                . "<td><a href='javascript:;' onclick='confirmVt(" . $vt->getId() . ")'>Eliminar</a></td>"
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
        <?php echo Gui::href("vehicleType/add", "Agregar", array("class" => "btn btn-primary")); ?>
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

