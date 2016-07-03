<html>
<head>
    <meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>
    <title>Sesion Debuger</title>
</head>

<?php
    $html = "<body><h1>Session Values</h1><hr>"; 

    session_start();
    while(list($clave,$valor) = each($_SESSION))
    {
        $html .= $clave.": ".$valor."<hr>";
    }

    reset($_SESSION);

    $html .= "</body>";
    echo $html;
?>
</html>



