<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use App\Donations;
use App\Orders;
use \Carbon\Carbon;
class AdminController extends Controller {

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function __construct() {
       //$this->middleware('guest')->only(['showLoginForm','login','logout']);
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    public function dashboard(Request $request) {
       
  //data for donation
        $donation['donationsCurrentMonth'] = Donations::where('payment_status','=','1')->whereMonth('donation_date', Carbon::now()->month)->sum('donation_amount');

         $donation['donationsCurrentYear'] = Donations::where('payment_status','=','1')->whereBetween('donation_date', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
            ])->sum('donation_amount');

         $donation['donationsCurrentWeek'] = Donations::where('payment_status','=','1')->whereBetween('donation_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
            ])->sum('donation_amount');

         $donation['donationslastMonth'] = Donations::where('payment_status','=','1')->whereMonth(
         'donation_date', '=', Carbon::now()->subMonth()->month
          )->sum('donation_amount');

         $donation['donationsToday'] = Donations::where('payment_status','=','1')->whereDate(
         'donation_date', '=', Carbon::today()
          )->sum('donation_amount');
          $donation['todayDate'] = date("F j, Y"); 
          $day = Carbon::now()->format( 'l' ); 
        //donation
         //echo "<pre>"; print_r($donation); exit;
          $sales['pending'] = Orders::where('order_status','=','1')->count('id');
          $sales['awating'] = Orders::where('order_status','=','2')->count('id');
          $sales['shipped'] = Orders::where('order_status','=','3')->count('id');
          $sales['on_hold'] = Orders::where('order_status','=','4')->count('id');
          $sales['cancelled'] = Orders::where('order_status','=','5')->count('id');

          $sales['net_sales'] = Orders::where('order_status','!=','5')->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
            ])->sum('order_amount');
        
        $data['content'] = view('admin.dashboard',compact('donation','sales','day'));
        return view('admin.layout', $data);
      //  return view('admin.dashboard');
    }

    protected function validateLogin(Request $request) {

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request) {

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('manage/login');
    }

    public function authenticated(Request $request, $user) {
        
        return Redirect::to('manage/dashboard');
       
    }


}
