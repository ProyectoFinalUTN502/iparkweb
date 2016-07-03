<?php
class Ioc {
   
    private static $services = array();
    
    /**
     * Adds a Service to the service collection on the Controll Inversion object
     * <br>Each Service will be store and access in a Key => Value pair
     * @param string $key The key in which de IOC will store your service
     * @param object $object The object you want to store
     * @throws Exception Invalid Key reference Exception if the key is already 
     * in use
     */
    public static function addService($key, $object){
        if(!array_key_exists($key, self::$services)){
            self::$services[$key] = $object;
        } else {
            throw new Exception("Invalid Key reference");
        }
    }
    
    /**
     * Returns the instance of the service that is store under the key<br>
     * If the key does not exists, the method will throw an Exception
     * @param string $key The key in which your service is stored
     * @throws Exception Ivalid Key Reference exception if the key does not 
     * exists on the collection
     */
    public static function getService($key){
        if(array_key_exists($key, self::$services)){
            return self::$services[$key];
        } else {
            throw new Exception("Invalid Key reference");
        }
    }
//    
//    public static function getExistingKeys(){
//        foreach(self::$services as $k => $v){
//            echo $k . " : " . $v . "<hr>";
//        }
//    }
}
