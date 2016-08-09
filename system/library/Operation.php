<?php

class Operation {
    private $data;
    private $isError;
    private $code;
    private $message;
    
    public function __construct() {
        $this->data = null;
        $this->code = "";
        $this->message = "";
        $this->isError = false;
    }
    
    public function __toString() {
        return "<strong>Error</strong> " . $this->code . ": " . $this->message;
    }
    
    public function getData() {
        return $this->data;
    }

    public function getCode() {
        return $this->code;
    }

    public function getMessage() {
        return $this->message;
    }
    
    public function isError() {
        return $this->isError;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function setError() { 
        $this->isError = true;
    }
}
