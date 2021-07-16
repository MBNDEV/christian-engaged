<?php

namespace App;
use MichaelB\ShipStation\ShipStationApi;
use MichaelB\ShipStation\Models\Order;

class ShipStation {

    private $SHIPSTATION_API_KEY, $SHIPSTATION_API_SECRET, $shipstation, $orderService;
    
    public function __construct() {
        $this->SHIPSTATION_API_KEY = env('SHIPSTATION_API_KEY');
        $this->SHIPSTATION_API_SECRET = env('SHIPSTATION_API_SECRET');
        $this->shipstation = new ShipStationApi($this->SHIPSTATION_API_KEY, $this->SHIPSTATION_API_SECRET, []);
        $this->orderService = $this->shipstation->orders;
    }    
    
    public function getOrder($order_id=0){
        try{
            $order = $this->orderService->getOrder($order_id);
            $resultcontents = $order->getBody()->getContents();            
            return json_encode(['error'=>false, 'message'=>'', 'response' =>$resultcontents]);            
        }catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return json_encode(['error'=>true, 'message'=>$responseBodyAsString]);
        }
    }
    
    public function CreateOrder($orderData = []){
        try{
            $order = $this->orderService->createOrder($orderData);
            $resultcontents = $order->getBody()->getContents();            
            return json_encode(['error'=>false, 'message'=>'', 'response' =>$resultcontents]);            
        }catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return json_encode(['error'=>true, 'message'=>$responseBodyAsString]);
        }

    }    
    
}
