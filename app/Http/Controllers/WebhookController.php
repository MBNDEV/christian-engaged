<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Webhook;
use App\Transaction;
use App\Orders;
use App\DonationTransactions;
use App\Donations;

class WebhookController extends Controller
{   
    private $skey, $pkey, $endpoint_secret;
    public function __construct()
    {
        $environment = env('APP_ENV');
        if ($environment == 'local' || $environment == 'staging') {
            $this->skey = env('STRIPE_TEST_SK');
            $this->pkey = env('STRIPE_TEST_PK');
            $this->endpoint_secret = env('STRIPE_TEST_ENDPOINT_SECRET');
        } else {
            $this->skey = env('STRIPE_LIVE_SK');
            $this->pkey = env('STRIPE_LIVE_PK');
            $this->endpoint_secret = env('STRIPE_live_ENDPOINT_SECRET');
        }
        
        \Stripe\Stripe::setApiKey($this->skey);
    }
    
    public function chargehook(Request $request) {
        $event = null;
        try {
            $payload = @file_get_contents('php://input');
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];            

            $event = \Stripe\Webhook::constructEvent(
                        $payload, $sig_header, $this->endpoint_secret
                    );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Error\SignatureVerification $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }catch (\Exception $e) {
            // For any other exception
            http_response_code(400);
            exit();
        } 
        
        if(!$event){
            http_response_code(400);
            exit();
        }            
        
        $event->jsonSerialize();
        
        Webhook::create(['payload' => $event]);
        
        $eventData = $event['data']['object'];
                
        if($event['type']=='charge.failed' || $event['type']=='charge.pending'){
            $order_status = 0;
            $payment_status = 2;
        }else if($event['type']=='charge.captured' || $event['type']=='charge.succeeded'){            
            $order_status = 1;
            $payment_status = 1;    
        }
       // echo $order_status.'--'.$payment_status; exit;
        
        if($eventData['metadata']['transaction_made_for']=='donation'){
            $donationTransaction = DonationTransactions::where('txn_id', '=',$eventData['id'])->first(); 
            
            
            if($donationTransaction){

                $donation_id = $donationTransaction->doantions_id;            
                $donation = Donations::where('id', '=',$donation_id)->first();
                $donation->payment_status = $payment_status;     
                $donation->save();

                $donationTransaction->txn_status = $eventData['status'];
                $donationTransaction->payment_source_id = $eventData['source']['id'];
                $donationTransaction->payment_object = $eventData['source']['object'];
                $donationTransaction->payment_brand = $eventData['source']['brand'];
                $donationTransaction->payment_last4 = $eventData['source']['last4'];
                $donationTransaction->cvc_check = $eventData['source']['cvc_check'];
                $donationTransaction->failure_code = $eventData['failure_code'];
                $donationTransaction->failure_message = $eventData['failure_message'];

                $donationTransaction->save();

                echo 'Transaction & Donation updated successfully';
            }else{
                echo 'Invalid Transaction id';
            }
                     
            
        }
        else if($eventData['metadata']['transaction_made_for']=='product'){
            $transaction = Transaction::where('txn_id', '=',$eventData['id'])->first();

            if($transaction){

                $order_id = $transaction->order_id;            
                $order = Orders::where('id', '=',$order_id)->first();
                $order->order_status = $order_status;       
                $order->payment_status = $payment_status;     
                $order->save();

                $transaction->txn_status = $eventData['status'];
                $transaction->payment_source_id = $eventData['source']['id'];
                $transaction->payment_object = $eventData['source']['object'];
                $transaction->payment_brand = $eventData['source']['brand'];
                $transaction->payment_last4 = $eventData['source']['last4'];
                $transaction->cvc_check = $eventData['source']['cvc_check'];
                $transaction->address_zip_check = $eventData['source']['address_zip_check'];
                $transaction->failure_code = $eventData['failure_code'];
                $transaction->failure_message = $eventData['failure_message'];

                $transaction->save();

                echo 'Transaction & order details saved successfully';
            }else{
                echo 'Invalid Transaction id';
            }
        }
        else{
            echo 'Invalid meta-data';
        }
                      
        
        http_response_code(200);
        exit();
    }

}
