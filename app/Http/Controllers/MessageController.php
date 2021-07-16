<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller {

    public function index() {
        // $messages = Message::all();
        $messages = Message::where('publish_status', '=', '1')->get();
        $data['content'] = view('admin.message.index', compact('messages'));
        return view('admin.layout', $data);
    }

    public function create() {
        $data['content'] = view('admin.message.add');
        return view('admin.layout', $data);
    }

    public function edit($id) {
        $message = Message::find($id);
        $data['content'] = view('admin.message.edit', compact('message'));
        return view('admin.layout', $data);
    }

    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:ce_message',
            'value' => 'required'
        ]);
        try {
            $message = Message::create($request->all());

            if ($message->id) {
                return redirect('manage/message')->withSuccess('Message Created Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|unique:ce_message,name,' . $id,
            'value' => 'required',
           // 'publish_status' => 'required'
        ]);
        try {
            $message = Message::find($id);
            $message->name = $request->name;
            $message->value = $request->value;
            //$message->publish_status = $request->publish_status;

            if ($message->save()) {
                return redirect('manage/message')->withSuccess('Message Updated Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function delete(Request $request, $id) {

        $message = Message::find($id);
        $message->active_status = '2';
        try {
            if ($user->save()) {
                return redirect('manage/message')->withSuccess('Message Deleted Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

}
