<?php
$ac = new AdminController();
$ac->control(new Group(ROL_GROUP));
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
        <h1>Roles</h1>
    </div>

    <div id="content-container">
        
        <?php 
            echo Gui::form("frmRoles", "rol/all/" . $currentPage);
            
            if($error){
                echo Gui::error($errorMsg);
            }
        ?>
                           
        <div>
            <table>
                <tr>
                    <td>
                        <input class="form-control input-sm" style="width: 400px" type="text" name="q" placeholder="Buscar Rol por Nombre..."/>
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
                $href = Gui::href("rol/all", "[x]");
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
                        Editar
                    </th>
                    <th>
                        Eliminar
                    </th>
                </tr>
            </thead>
            <?php
            /* @var $rol Rol */
            foreach ($roles as $rol) {
                echo "<tr>"
                . "<td>" . $rol->getName() . "</td>"
                . "<td>" . Gui::href("role/upd/" . $rol->getId(), "Editar") . "</td>"
                . "<td>" . Gui::href("", "Eliminar", array("onclick" =>"confirm(" . $rol->getId() . ")")) . "</td>"
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
        <?php echo Gui::href("Role/add", "Agregar", array("class" => "btn btn-primary")); ?>
        <?php echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>
<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

