<?php

namespace common\models;

/*
 * API Helper
 */

use Yii;
use yii\helpers\Json;

class ApiRequestHelper {

    /**
     * URL to the API server
     * @var type 
     */
    public $api_url;
    public $api;

     public function __construct($system_api) {
        $this->api = $system_api;
        switch ($this->api) {
            case 'admin': //Backend ENDPOINT
               $this->api_url = 'http://localhost:4500/admin';
                break;
            case 'sacco': //FRONTEND ENDPOINT
               $this->api_url = 'http://localhost:4500/sacco';
                break;
         
        
        }
    }
    /**
     * Make a POST request
     * @param String $endpoint
     * @param Array $params
     * @return mixed
     */
    public function makePost($endpoint, $params) {
        $curl = curl_init();
        //Options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . '/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => Json::htmlEncode($params),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        //Server Response
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
    
    /**
     * Make an update
     * @param String $endpoint
     * @param Array $params
     * @return type
     */
    public function makePatch($endpoint, $params) {
        $curl = curl_init();
        //Options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . '/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => Json::htmlEncode($params),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        //Server Response
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**PATCH
     * Make a GET Request
     */
    public function makeGet($endpoint) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . '/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}
