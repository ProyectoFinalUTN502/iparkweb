<?php

/**
 * Name         : Sesion.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Static Class. Provides a collection of services
 *              : to asist Session handling
 * Notes        :
 */
class Session {

    /**
     * Performs a session_start only if there is no session_id activated
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    private static function activate() {
        $result = false;
        if (session_id() == "") {
            $result = session_start();
        }

        return $result;
    }

    /**
     * Performs a regeneration of the session_id keeping the session alive
     */
    public static function update() {
        session_regenerate_id(true);
    }

    /**
     * Saves a value into the SESSION[] key => value array 
     * @param string $key The key used to save the value on the array
     * @param value $value The value to be saved.<br>It coud be any type of 
     * value, a serialize array or a serialized object
     */
    public static function setValue($key, $value) {
        global $config;
        self::activate();
        $_SESSION[$config["sesion_project"] . $key] = $value;
    }

    /**
     * Returns the value saved on the SESSION[] key => value array
     * @param string $key The key used to save the value on the array
     * @return value The value saved on the SESSION[] array.<br>It coud be any 
     * type of value, a serialize array or a serialized object.<br>Returns false
     * on failure
     */
    public static function getValue($key) {
        global $config;
        
        $result = false;

        self::activate();
        if (isset($_SESSION[$config["sesion_project"] . $key])) {
            $result = $_SESSION[$config["sesion_project"] . $key];
        }

        return $result;
    }

    /**
     * Deletes a value saved on the SESSION[] key => value array
     * @param string $key The key used to save the value on the array
     * @return boolean
     */
    public static function deleteValue($key) {
        global $config;
        $result = false;

        self::activate();
        if (isset($_SESSION[$config["sesion_project"] . $key])) {
            unset($_SESSION[$config["sesion_project"] . $key]);
            $result = true;
        }

        return $result;
    }

    /**
     * Performs te closure of the session of a project.
     */
    public static function close() {
        global $config;
        self::activate();

        reset($_SESSION);
        while (list($key, $val) = each($_SESSION)) {
            if (String::contains($key, $config["sesion_project"])) {
                unset($_SESSION[$key]);
                //self::deleteValue($key);
            }
        }

        reset($_SESSION);
    }

    /**
     * Performs the destruction of the current session
     */
    public static function destroy() {
        self::activate();
        session_destroy();
    }

}
