<?php
class Debugger {
    
    /**
     * Performs an echo of the variable that is passed as argument
     * @param mix $var
     */
    public static function printVar($var){
     
        if(is_bool($var)){
            echo (int) $var . "<hr>"; 
        } elseif (is_array($var)) {
            foreach($var as $k => $v){
                echo $k . " : " . $v . "<hr>";
            }
        } else {
            echo $var;
        }
    }
    
    /**
     * Performs an echo of the messagge passed as argument<br>
     * After printing the message it will add a New Line with an html line
     * @param type $msg
     */
    public static function show($msg){
        echo $msg . "<hr>";
    }
}
