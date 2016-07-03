<?php

class Gui {

    public static function form($name, $action, $method = "POST", $arg = array()) {
        $domain = Ioc::getService("domain");
        $fullAction = "/" . $domain . "/" . $action;
        $tags = "";
        foreach ($arg as $k => $v) {
            $tags .= $k . " = '" . $v . "' ";
        }

        $html = "<form "
                . "id = '" . $name . "' "
                . "name = '" . $name . "' "
                . "method = '" . $method . "' "
                . "action='" . $fullAction . "' " . $tags . ">";

        return $html;
    }

    public static function href($ref, $text, $arg = array()) {

        if($ref == ""){
            $href = "javascript:;";
        } else {
            $domain = Ioc::getService("domain");
            $href = "/" . $domain . "/" . $ref;
        }
        $tags = "";
        foreach ($arg as $k => $v) {
            $tags .= $k . " = '" . $v . "' ";
        }

        
        $html = "<a href='" . $href . "' " . $tags . ">" . $text . "</a>";
        return $html;
    }

    public static function error($msg = "Comportamiento Indevido") {

        $html = "   <div class='alert alert-danger'>
                        <strong>Ha Ocurrido un Error!</strong>
                        <hr>
                        <strong>Detalles:</strong> " . $msg . " 
                        <br><br>
                        Por favor controle la informacion ingresada e intente nuevamente
                    </div>";

        return $html;
    }

    public static function messageBox($title, $msg) {
        $html = "<div class='portlet portlet-plain'>
                    <div class='portlet-header'>
			<h3>" . $title . "</h3>
                    </div> 
                    <div class='portlet-content'>
			<p>" . $msg . "</p>
                    </div>
		</div>";

        return $html;
    }

    public static function grid($data = array(), $columns = 4) {
        $elements = count($data);
        $fullElements = floor($elements / $columns);

        $html = "<table>";
        $html .= "<tr>";

        $cells = 0;
        for ($i = 0; $i < ($fullElements * $columns); $i++) {

            if ($cells < $columns) {
                $html .= "<td>" . $data[$i] . "</td>";
            } else {
                $html .= "</tr>";

                $cells = 0;

                $html .= "<tr>";
                $html .= "<td>" . $data[$i] . "</td>";
            }
            $cells++;
        }
        $html .= "</tr>";

        //ACA SE CARGAN LOS IMPARES, O SEA, LOS QUE NO FORMAN UNA FILA COMPLETA
        $html .= "<tr>";
        for ($i = ($fullElements * $columns); $i < $elements; $i++) {
            $html .= "<td>" . $data[$i] . "</td>";
        }
        $html .= "</tr>";

        $html .= "</table>";

        return $html;
    }

}
