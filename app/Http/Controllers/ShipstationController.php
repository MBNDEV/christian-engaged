<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Webhook;
use App\Orders;

class ShipstationController extends Controller {

    public function shipstationrequest(Request $request) {
        Webhook::create(['payload' => $request->fullUrl()]);
        //print_r($_GET);
        $UserName = $request->input('SS-UserName');
        $Password = $request->input('SS-Password');
        $action   = $request->input('action');

        if($UserName=='christianity' || $Password=='christianity'){

            if($action=='export'){
                $start_date = $request->input('start_date');
                $end_date = $request->input('end_date');

                $orderObj = new Orders();

                $orders = $orderObj->getAllOrders('', $start_date, $end_date);
                foreach($orders as $order){
                    $orderItems = $orderObj->getOrderItems($order->id);
                    $order->orderItems = $orderItems;

                    $orderdetails = $orderObj->getOrderDetails($order->id);
                    $order->orderdetails = $orderdetails;
                }
                return view('web.shipstationrequest', compact('orders'));
            }else if($action=='shipnotify'){
                $order_number = $request->input('order_number');
                $carrier = $request->input('carrier');
                $service = $request->input('service');
                $tracking_number = $request->input('tracking_number');
                if($order_number != ''){
                    try{
                        $order = Orders::where('order_number', '=', $order_number)->update(array('order_status' => 3,'carrier'=>$carrier,'service'=>$service,'tracking_number'=>$tracking_number));
                        http_response_code(200);
                    }catch (\Exception $e) {
                        // For any exception
                        http_response_code(400);
                    }
                }
            }
        }else{
            http_response_code(401); // UnAuthorized
        }
        exit();

    }

    public function shipstationresponse(Request $request) {
        Webhook::create(['payload' => 'shipstationresponse']);
        Webhook::create(['payload' => $request->fullUrl()]);
        $order_number = $request->input('order_number');
        $carrier = $request->input('carrier');
        $service = $request->input('service');
        $action   = $request->input('action');
        $tracking_number = $request->input('tracking_number');

        if(isset($action) && $action=='shipnotify' && isset($order_number) && $order_number!= ''){
            try{
                $order = Orders::where('order_number', '=', $order_number)->update(array('order_status' => 3,'carrier'=>$carrier,'service'=>$service,'tracking_number'=>$tracking_number));
                http_response_code(200);

            }catch (\Exception $e) {
                // For any exception
                http_response_code(400);
            }
        }
        http_response_code(200);
        exit();
    }


}
