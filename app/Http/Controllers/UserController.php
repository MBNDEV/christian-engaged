<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function index(Request $request) {
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $users = User::where('user_type', '=', '2')->where('status', '!=', '3')->orderBy('id', 'desc')->paginate($records_per_page);
        
        $page = $request->query('page');
        $data['content'] = view('admin.users.listing', compact('users', 'page'));
        return view('layouts.template', $data);
    }

    public function add(Request $request) {
        $data['content'] = view('admin.users.add');
        return view('layouts.template', $data);
    }

    public function save(Request $request) {

        $this->validate($request, [
            'first_name' => 'required|max:190',
            'last_name' => 'required|max:190',            
            'email' => 'required|email|max:190|unique:ce_users',
            'password' => 'required|min:6|confirmed',
            'status' => 'required',
        ]);
        $activation_key = $this->generateActivationLink($request->email);
        $request->merge(['hash_token' => $activation_key]);        
        $request->merge(['password' => Hash::make($request->password)]);
        
        $user = User::create($request->all());

        if ($user->id) {
            return redirect('/manage/users')->withSuccess('User Created Successfully!');
        }

        return redirect()->back()
                        ->withInput($request->except(['password', 'password_confirmation']))
                        ->withErrors('Please try after some time.');
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);        
        $data['content'] = view('admin.users.edit', compact('user'));
        return view('layouts.template', $data);
    }

    public function update(Request $request, $id) {

        $this->validate($request, [
            'first_name' => 'required|alpha|max:190',
            'last_name' => 'required|alpha|max:190',            
            'status' => 'required',
            'email' => 'required|email|max:190|unique:ce_users,email,' . $id,
        ]);
        $user = User::find($id);
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;        
        $user->email = $request->email;
        $user->status = $request->status;

        if ($user->save()) {
            return redirect('/manage/users')->withSuccess('User Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function delete(Request $request, $id) {
        $user = User::find($id);
        $user->status = '3';

        if ($user->save()) {
            return redirect('/manage/users')->withSuccess('User Deleted Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }
    
    public function bulkUserUpdate(Request $request){
        print_r($request->all());exit;
    }

    private function generateActivationLink($email) {
        $activation_key = str_random(40);
        return $activation_key;
    }

}
