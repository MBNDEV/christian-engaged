<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use MetaTag;

class ErrorHandlerController extends Controller {

	public function pagenotfound(){

        MetaTag::set('title', 'Page Not Found');
        MetaTag::set('description', 'Page Not Found');
        MetaTag::set('keywords', 'Page Not Found');

		$data['content'] = view('error.pagenotfound');
        return view('layouts.web-template', $data);
	}

}