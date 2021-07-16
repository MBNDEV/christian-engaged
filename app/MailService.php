<?php

namespace App;

use App\Template;
use Mail;

class MailService {

    private function send_mail($data = array()) {
        
//        try {
//                Mail::send('web.mail', $data, function($msg) use($data) {
////                    $msg->from('Blessings@christianityengaged.org', 'Your Application');
////
////                    $msg->to('mukeshk@clavax.us', 'mukesh')->subject('Your Reminder!');
//                    $msg->from('Blessings@christianityengaged.org', env('MAIL_NAME'));
//                    $msg->to($data['to_email'], $data['name'])->subject($data['subject']);
//                });
//            } catch (Exception $e) {
//                print_r($e->getMessage());
//                die;
//            }
       
        try {
            Mail::send('web.mail', $data, function($msg) use($data) {
                $msg->from(env('FROM_MAIL','alphanew.clavax@gmail.com'), env('MAIL_NAME'));
                $msg->to($data['to_email'], $data['name'])->subject($data['subject']);
            });
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
        }
    }

// For order mail ,with pdf attchment
    private function send_mail_with_attachment($data = array()) {
       
        try {
            Mail::send('web.mail', $data, function($msg) use($data) {
                $msg->from(env('MAIL_USERNAME','alphanew.clavax@gmail.com'), env('MAIL_NAME'));
                $msg->to($data['to_email'], $data['name'])->subject($data['subject'])->attach($data['file'], [
                    'as' => 'donation_Invoice.pdf',
                    'mime' => 'application/pdf',
                ]);

            });
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
        }
    }

    /**
     * Send newsletter subscription email to user
     */
    public function newsletter_subscription($email) {
        $newsletterTemplate = Template::where('id', '=', '2')->where('publish_status', '=', '1')->first();
        $newsletterAdminTemplate = Template::where('id', '=', '12')->where('publish_status', '=', '1')->first();
        $template = array();
        if ($newsletterTemplate) {
            $template['to_email'] = $email;
            $template['name'] = $email;
            $template['template'] = $newsletterTemplate->message;
            $template['subject'] = $newsletterTemplate->subject;
            $this->send_mail($template);
            // if($newsletterAdminTemplate){
            //     $template = array();
            //     $template['to_email'] = env('MAIL_ADMIN_ID');;
            //     $template['name'] = 'newsletter';;
            //     $template['subject'] = $newsletterAdminTemplate->subject;
            //
            //     $text_admin = ["{{user_mail_id}}"];
            //     $rpc_admin = [$email];
            //     $newsletter_for_admin = str_replace($text_admin, $rpc_admin, $newsletterAdminTemplate->message);
            //
            //     $template['template'] = $newsletter_for_admin;
            //     $this->send_mail($template);
            // }
            return true;
        } else {
            return false;
        }
    }


     public function newsletter_subscriptionlatest($email) {
        
        $newsletterAdminTemplate = Template::where('id', '=', '12')->where('publish_status', '=', '1')->first();
        $template = array();
        
            if($newsletterAdminTemplate){
                $template = array();
                $template['to_email'] = env('MAIL_ADMIN_ID');;
                $template['name'] = 'newsletter';;
                $template['subject'] = $newsletterAdminTemplate->subject;
            
                $text_admin = ["{{user_mail_id}}"];
                $rpc_admin = [$email];
                $newsletter_for_admin = str_replace($text_admin, $rpc_admin, $newsletterAdminTemplate->message);
            
                $template['template'] = $newsletter_for_admin;
                $this->send_mail($template);
                return true;
            }
           
         else {
            return false;
        }
    }


    public function contactUs($data) {

        $contact_us_admin = Template::where('id', '=', '4')->where('publish_status', '=', '1')->first();

        $contact_us_user = Template::where('id', '=', '3')->where('publish_status', '=', '1')->first();



        $text_admin = ["{{name}}", "{{email}}", "{{phone}}", "{{message}}"];
        $rpc_admin = [$data->name, $data->email, $data->phone, $data->message];

        $text_user = ["{{name}}"];
        $rpc_user = [$data->name];


        $new_message_for_admin = str_replace($text_admin, $rpc_admin, $contact_us_admin->message);

        $new_message_for_user = str_replace($text_user, $rpc_user, $contact_us_user->message);

        //

        if ($contact_us_admin != null && $new_message_for_user != null) {

            //For admin Email
            $template['to_email'] = env('MAIL_CONTACT_ID');
            $template['name'] = $data->name;
            $template['template'] = $new_message_for_admin;
            $template['subject'] = $contact_us_admin->subject;

            //For User
            $template2['to_email'] = $data->email;
            $template2['name'] = $data->name;
            $template2['template'] = $new_message_for_user;
            $template2['subject'] = $contact_us_user->subject;

            $this->send_mail($template);
            $this->send_mail($template2);
            return true;
        } else {
            return false;
        }
    }

    public function order_confirm_mail($body, $email, $data) {
        //Admin Email
        if ($data) {
            $order_template = Template::where('id', '=', '5')->where('publish_status', '=', '1')->first();
            $product = [];
            $i = 1;
            foreach ($data['orderItems'] as $key => $value) {
                $product[$i] = $value->product_name;
                $i++;
            }
            $final_product = implode(",", $product);


            $text_admin = ["{{name}}", "{{email}}", "{{phone}}", "{{product}}", "{{prize}}"];
            $rpc_admin = [$data['orderdetails']->first_name . ' ' . $data['orderdetails']->last_name, $data['orderdetails']->email, $data['orderdetails']->telephone, $final_product, $data['orderdetails']->order_amount];

            $new_message_for_admin = str_replace($text_admin, $rpc_admin, $order_template->message);

            $template['to_email'] = env('MAIL_ADMIN_ID');
            $template['name'] = env('MAIL_ORDER_NAME');
            // $template['template'] = $new_message_for_admin;
            $template['template'] = $body;
            $template['subject'] = $order_template->subject;
            $this->send_mail($template);
        }
        //User Email
        if ($email) {
            $template['to_email'] = $email;
            $template['name']     = env('MAIL_ORDER_NAME');
            $template['template'] = $body;
            $template['subject']  = env('MAIL_ORDER_SUBJECT');
            $this->send_mail($template);
            return true;
        } else {
            return false;
        }
    }

    public function reorder_confirm_mail_to_admin($body, $email, $data) {
        //Admin Email
        if ($data) {
            $order_template = Template::where('id', '=', '5')->where('publish_status', '=', '1')->first();
            $product = [];
            $i = 1;
            foreach ($data['orderItems'] as $key => $value) {
                $product[$i] = $value->product_name;
                $i++;
            }
            $final_product = implode(",", $product);


            $text_admin = ["{{name}}", "{{email}}", "{{phone}}", "{{product}}", "{{prize}}"];
            $rpc_admin = [$data['orderdetails']->first_name . ' ' . $data['orderdetails']->last_name, $data['orderdetails']->email, $data['orderdetails']->telephone, $final_product, $data['orderdetails']->order_amount];

            $new_message_for_admin = str_replace($text_admin, $rpc_admin, $order_template->message);

            $template['to_email'] = env('MAIL_ADMIN_ID');
            $template['name'] = env('MAIL_ORDER_NAME');
            // $template['template'] = $new_message_for_admin;
            $template['template'] = $body;
            $template['subject'] = $order_template->subject;
            $this->send_mail($template);
        }else{
          return false;
        }
    }

    public function reorder_confirm_mail_to_user($body, $email, $data) {
        if ($email) {
            $template['to_email'] = $email;
            $template['name']     = env('MAIL_ORDER_NAME');
            $template['template'] = $body;
            $template['subject']  = env('MAIL_ORDER_SUBJECT');
            $this->send_mail($template);
            return true;
        } else {
            return false;
        }
    }


    // Donation mail with pdf attchment
    public function donation_mail($body, $email, $donation, $pdfTemplate) {
        //Admin Email
        if ($donation) {
            $donation_admin = Template::where('id', '=', '1')->where('publish_status', '=', '1')->first();

            $text_admin = ["XXXXXX", "{{donation_date}}","{{donation_type}}","{{name}}", "{{email}}", "{{phone}}", "{{amount}}"];
            $rpc_admin = [$donation->id, date('Y-m-d', strtotime($donation->donation_date)), $donation->donation_type,$donation->first_name . ' ' . $donation->last_name, $donation->email, $donation->phone, $donation->donation_amount];

            $new_message_for_admin = str_replace($text_admin, $rpc_admin, $donation_admin->message);

            $template['to_email'] = env('MAIL_ADMIN_ID');
            $template['name'] = env('MAIL_DONATION_NAME');
            $template['template'] = $new_message_for_admin;
            $template['subject'] = $donation_admin->subject;
            $this->send_mail($template);
        }
        //For User Email with attchment
        if ($email) {
            // $email ='manishd@clavax.us';
            $template['to_email'] = $email;
            $template['name'] = env('MAIL_DONATION_NAME');
            $template['template'] = $body;
            $template['subject'] = env('MAIL_DONATION_SUBJECT');
            $template['file'] = $pdfTemplate;
            $this->send_mail($template);
            //$this->send_mail_with_attachment($template);
            return true;
        } else {
            return false;
        }
    }

    // Donation Goal mail
    public function donationgoal_mail($donationgoal_name,$donationgoal_val) {
        //Admin Email
            $donation_admin = Template::where('id', '=', '9')->where('publish_status', '=', '1')->first();

            $text_admin = ["{{donationgoal_val}}", "{{donationgoal_name}}"];
            $rpc_admin  = [$donationgoal_val,$donationgoal_name];

            $new_message_for_admin = str_replace($text_admin, $rpc_admin, $donation_admin->message);

            $template['to_email'] = env('MAIL_ADMIN_ID');
            $template['name'] = env('MAIL_DONATION_NAME');
            $template['template'] = $new_message_for_admin;
            $template['subject'] = $donation_admin->subject;
            $this->send_mail($template);

    }

    // // Payment Failed mail
    // public function payment_fail_mail($payment_name,$user_error_message,$actual_error_message) {
    //     //Admin Email
    //         $donation_admin = Template::where('id', '=', '10')->where('publish_status', '=', '1')->first();

    //         $text_admin = ["{{payment_name}}","{{user_error_message}}","{{actual_error_message}}"];
    //         $rpc_admin  = [$payment_name,$user_error_message,$actual_error_message];

    //         $new_message_for_admin = str_replace($text_admin, $rpc_admin, $donation_admin->message);

    //         $template['to_email'] = env('MAIL_ADMIN_ID');
    //         $template['name'] = env('MAIL_PAYMENTFAIL_NAME');
    //         $template['template'] = $new_message_for_admin;
    //         $template['subject'] = $payment_name." ".$donation_admin->subject;
    //         $this->send_mail($template);

    // }


        //Order Payment Failed mail
    public function payment_fail_mail($mailbody,$subject) {
            $template['to_email'] = env('MAIL_ADMIN_ID');
            $template['name']     = env('MAIL_PAYMENTFAIL_NAME');
            $template['template'] = $mailbody;
            $template['subject']  = $subject;
            $this->send_mail($template);

    }

}
