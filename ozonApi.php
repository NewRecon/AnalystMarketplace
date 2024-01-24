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
        "filter"=> array(
                    "delivering_date_from"=> "2023-08-24T14:15:22Z",
                    "delivering_date_to"=> "2023-08-25T14:15:22Z",
                    "delivery_method_id"=> [],
                    "provider_id"=> [],
                    "status"=> "awaiting_packaging",
                    "warehouse_id"=> []),
        "limit"=> 100,
        "offset"=> 0,
        "with"=> array(
                    "analytics_data"=> true,
                    "barcodes"=> true,
                    "financial_data"=> true,
                    "translit"=> true),
        );
        return $this->curl("/v3/posting/fbs/unfulfilled/list", $arParams);
    }

    protected function getWhereHouse(){
    
    }

    protected function curl($method, $arParams){
        $ch = curl_init("https://api-seller.ozon.ru".$method);
        curl_setopt_array($ch, array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Client-Id: ".$this->client_id, "Api-Key: ".$this->api_key),
            CURLOPT_POSTFIELDS => json_encode($arParams)
        ));

        $get = curl_exec($ch);
        $get = json_decode($get,1);

        return $get;
    }
}