<?php

class OzonApi{
    protected $client_id = "";
    protected $api_key = "";

    public function __construct($client_id,$api_key){
        $this->client_id = $client_id;
        $this->api_key = $api_key;
    }

    public function getProducts(){

    }

    public function getOrder(){

        $arParams = array(
    "dir"=> "ASC",
    "filter" => array(
        "delivery_method_id"=> [],
        "provider_id"=> [],
        "since"=> "2023-12-01T00:00:11Z",
        "status"=> "delivered",
        "to"=> "2024-01-24T00:00:11Z",
        "warehouse_id"=> []
    ),
    "limit"=> 100,
    "offset"=> 0,
    "with"=> array(
        "analytics_data"=> true,
        "barcodes"=> true,
        "financial_data"=> true,
        "translit"=> true)
        );
    
        return $this->curl("/v3/posting/fbs/list", $arParams);
    }

    protected function getWhereHouse(){
    
    }

    protected function curl($method, $arParams){
        $ch = curl_init("https://api-seller.ozon.ru".$method);
        curl_setopt_array($ch, array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Client-Id: ".$this->client_id, "Api-Key: ".$this->api_key),
            CURLOPT_POSTFIELDS => json_encode($arParams)
        ));

        $get = curl_exec($ch);
        $get = json_decode($get,1);

        curl_close($ch);

        return $get;
    }
}