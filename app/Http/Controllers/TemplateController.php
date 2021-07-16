<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use Exception;

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

}
