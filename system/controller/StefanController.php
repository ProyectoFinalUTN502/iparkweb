<?php

/**
 * Name         : StefanController.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan 
 * Description  : 
 * Notes        :
 */
class StefanController {

    /**
     * Redirects to a nother location.<br>
     * The redirection will use absolute URLs, that it will tak from the 
     * config array on the <b>domain</b> and <b>base_url</b> keys
     * @param type $url The Url to be redirected
     */
    public function redirect($url){
        global $config;
        
        $location = $config["domain"];
        if(isset($config["base_url"]) && $config["base_url"] != ""){
            $location .= "/" .$config["base_url"];
        } 
        $location .=  "/" . $url;
        
        header("Location: " . $location);
        exit();
    }
    /**
     * Stores a value on the superglobal session array.<br>
     * The value will be serialized and then encrypted before
     * saving
     * @param string $key The key used to save the value on the array
     * @param value $value The value to be saved.<br>It coud be any type of 
     * value, array or object
     */
    public function saveInSession($key, $value) {
        $serialized = serialize($value);
        $encrypted = Security::encrypt($serialized);
        Session::setValue($key, $encrypted);
    }

    /**
     * Returns the value saved on the superglobal session array
     * @param string $key The key used to save the value on the array
     * @return value The value saved on the session array.<br>It coud be any 
     * type of value, array or object.<br>Returns false
     * on failure
     */
    public function loadFromSession($key) {
        $encrypted = Session::getValue($key);
        $serialized = Security::decrypt($encrypted);
        return unserialize($serialized);
    }
    
    /**
     * Erase a key form the session array
     * @param string $key The key used to save the value on the array
     */
    public function deleteFromSession($key) {
        Session::deleteValue($key); 
    }
    
    /**
     * Performs the loading of the system view sesion.php, weach allows the
     * developer to see the content of the SESSION[] array in real time
     */
    public function sessionDebugger(){
        $file = SYSPATH . DS . "view" . DS . "sesion.php";
        if (file_exists($file)) {
            if (!(require_once $file)) {
               echo ERROR_101 . $file . "<br>";
            }
        } else {
            echo ERROR_101 . $file . "<br>";
        }
    }

    /**
     * Returns the value present on a POST or GET. 
     * <br>The value returnedd is already been filtered
     * @param iteger $type The type of input to obtained. E.g: INPUT_POST
     * @param string $name The key of the position of the value on the
     * array
     * @return string Filtered input value
     */
    public function getInput($type, $name, $filter = FILTER_DEFAULT, $options = "") {
        if($options == ""){
            
            $input = filter_input($type, $name);
            if($input == NULL || $input == false){
                $result = NULL;
            } else{
                $result = Security::cleanImput($input);
            }
        } else {
            
            $input = filter_input($type, $name, $filter, $options);
            $result = $input;
        }
        
        return $result;
    }

    /**
     * Get the entire $_POST send
     * @return array The Post just send
     */
    public function getAllPost(){
        return filter_input_array(INPUT_POST);
    }
    
    /**
     * Performs the sanitization of a value
     * @param mix $value The value to be sanitize.<br> Needs to be a primary 
     * value, it can not be an array or object
     * @return mix The sanitized value
     */
    public function filter($value){
        return Security::cleanImput($value);
    }

    /**
     * Performs the load of a certain view
     * @param string $name The name of the view with or without extension
     * @param array $params Variables to be loaded on the view. The parameters
     * must come in a key value array. Once the view is loaded, parameters
     * will be extracted and will be available to be used on the view directly
     * (no array needed)
     */
    public function loadView($name, $params = array()) {

        if (!strpos($name, ".php")) {
            $name .= ".php";
        }

        if (!empty($params)) {
            extract($params);
        }

        if (file_exists(APPPATH . DS . "views" . DS . $name)) {
            if (!(require_once APPPATH . DS . "views" . DS . $name)) {
                throw new Exception(ERROR_101 . $name . "<br>");
            }
        } else {
            throw new Exception(ERROR_101 . $name . "<br>");
        }
    }

}
