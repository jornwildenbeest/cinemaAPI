<?php

require_once 'database_object.php'; 


class apikey extends database_object
{
    private $pdo;
    public static $table_name = "apiKeys";
    public static $id = "Id";
    public static $db_fields = array("Id", "Domain", "Apikey", "Level", "Used");
    public $Id;
    public $Domain;
    public $Apikey;
    public $Level;
    public $Used = 0;
    private $headers = array();
    private $apikeys;
    private $payload = array();
    protected $jwtkey;
    protected $status = 0;

    function __construct(){
        $this->pdo = $this->connect();
    }  

    function getstatus() {
        return $this->status;
    }

    function getjwtkey() {
        return $this->jwtkey;
    }
    
    function getused() {
        $Apikey = $this->find_by_id($this->Id);
        return $Apikey[0]->Used;
    }

    function getlevel() {
        $Apikey = $this->find_by_id($this->Id);
        return $Apikey[0]->Level;
    }

    function checkkey(){
        // filter HTTP_ from $_SERVER array.
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $this->headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        // get all keys.
        $this->apikeys = $this->find_by_sql("SELECT * FROM apiKeys", null);
        // print_r($this->apikeys);
        for ($i=0; $i < count($this->apikeys); $i++) { 
            // check if XApiKey exist.
            if(!empty($this->headers['XApiKey']) && in_array($this->headers['XApiKey'], (array) $this->apikeys[$i])){
                $this->apikeys = $this->find_by_sql("SELECT * FROM apiKeys WHERE Apikey = :param", $this->headers['XApiKey']);
                if($this->apikeys[0]->Domain == $this->headers['Origin']){
                
                    // updated used in database to 1.
                    $this->Id = $this->apikeys[0]->Id;
                    $this->Domain = $this->apikeys[0]->Domain;
                    $this->Apikey = $this->apikeys[0]->Apikey;
                    $this->Level = $this->getlevel();
                    
                    // create jwt key.
                    $this->payload['origin'] = $this->apikeys[0]->Domain;
                    $this->payload['x-api-key'] = $this->headers['XApiKey'];
                    $this->jwtkey = $this->createjwt($this->payload);

                    if($this->getused() == 0){
                        // update status.
                        $this->status = 1;
                    } else if($this->jwtkey == $this->headers['Authorization']) {
                        // update status.
                        $this->status = 1;
                    }
                    
                } else {
                    // origin is invalid.
                    // echo "Invalid origin";
                    $this->status = 0;
                }
            } else {
                // key is invalid.
                // echo "Invalid key";
                $this->status = 0;
                // break;
            }
        }
    }

    // playload needs to be an array.    
    function createjwt($payload) {
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode($payload);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }


}
