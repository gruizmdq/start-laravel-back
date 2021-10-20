<?php
namespace App\Utils\models;
 
class DefaultResponse {

    private $data;
    private $statusCode;
    private $error;
    private $message;

    public function __construct($data, $statusCode) {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}