<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use Exception;
use Mail;

class TemplateController extends Controller {


    public function index() {
        
        $records_per_page = env('RECORDS_PER_PAGE', 10);        
        $templates = Template::orderBy('id', 'desc')->paginate($records_per_page);        
        $data['content'] = view('admin.template.index', compact('templates'));
        return view('layouts.template', $data);
    }

    public function getTemplate($id) {
        $template = Template::find($id);
        $data['content'] = view('admin.template.edit', compact('template'));
        return view('layouts.template', $data);
    }

    public function updateTemplate(Request $request, $id) {
       $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);
        try {
            $template = Template::find($id);
            $template->subject = $request->subject;
            $template->message = $request->message;
            $template->save();
            
            return redirect(url('manage/templates'))->with('success', 'Template updated successfully!.');
        } catch (Exception $e) {
             return redirect(url('manage/templates/edit/'.$id))->with('error', 'Some problem occured please try after some times!.');
        }
    }

    public function sendTestEmail(Request $request) {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'email' => 'required|email',
            'temp_id' => 'required'
        ]);

        $donation_admin = Template::where('id', '=', $request->temp_id)->first();

        $text_admin = ["XXXXXX", "{{date('Y-m-d')}}","Test","John Doe", "email@email.com", "4805678567", "100"];
        $rpc_admin = [1, date('Y-m-d'), 'Test','John Doe', 'email@email.com', '4805678567', 100];

        $new_message_for_admin = str_replace($text_admin, $rpc_admin, $donation_admin->message);

        $template['to_email'] = $request->email;
        $template['name'] = env('MAIL_DONATION_NAME');
        $template['template'] = $new_message_for_admin;
        $template['subject'] = $donation_admin->subject;
        try {
            Mail::send('web.mail', $template, function($msg) use($template) {
                $msg->from(env('FROM_MAIL'), env('MAIL_NAME'));
                $msg->to($template['to_email'], $template['name'])->subject($template['subject']);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false]);
            die;
        }

        return response()->json(['status' => true]);
    }

}
