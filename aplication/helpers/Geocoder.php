<?php

class Geocoder {
    
    static private $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";

    static public function getLocation($address) {

        $result = array();

        $url = self::$url . urlencode($address);
        $jsonResponse = self::getResponse($url);
        $resp = json_decode($jsonResponse, true);

        if ($resp['status'] == 'OK') {
            $result["lat"] = $resp["results"][0]["geometry"]["location"]["lat"];
            $result["lng"] = $resp["results"][0]["geometry"]["location"]["lng"];
        }

        return $result;
    }

    static private function getResponse($url) {
        $result = false;
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        $content = curl_exec($c);
        curl_close($c);

        if ($content) {
            $result = $content;
        }

        return $result;
    }

}
