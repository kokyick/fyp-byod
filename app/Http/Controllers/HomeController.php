<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Api;

use Session;

class HomeController extends Controller
{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**public function __construct()
    *{
     *   $this->middleware('auth');
    *}
	*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	public function viewindex()
    {
        return view("app.index");
    }
	public function viewindex1()
    {
        return view("app.index-1");
    }
	public function viewcart()
    {
		$subtotal=0;
        $svscharge=0;
        $gstcharge=0;
		if(Session::has('cart')){
			foreach (Session::get('cart') as $food){
				$subtotal+=floatval($food['itemprice'])*floatval($food['quantity']);
			}
			if(Session::has('outlet')){
				$outlet=Session::get('outlet');
                if(floatval($outlet['gst'])>0){
				    $gstcharge=$subtotal*(floatval($outlet['gst'])/100);
                }
                if(floatval($outlet['servicecharge'])>0){
                    $svscharge=$subtotal*(floatval($outlet['servicecharge'])/100);
                }
                $subtotal=$subtotal+$gstcharge+$svscharge;
                //dd($subtotal);
				//$subtotal=round($subtotal+$gstcharge+$svscharge, 2);
                $subtotal=round($subtotal / 5,2) * 5;
			}
		}
        if(Session::has('promo')){
            $discounted=Session::get('promo')*$subtotal;
            $subtotal=$subtotal-$discounted;
            // dd($finalprice);
        }

        Session::forget('subtotal'); 
        Session::put('subtotal', $subtotal); 
		
        return view("app.cart");
    }
    public function vieworders()
    {
        //Menus
        $OList =Api::getRequest("UserClosedOrders");
        $OrderList = json_decode( $OList, true );
        
        $CList =Api::getRequest("UserOpenOrders");
        $COrderList = json_decode( $CList, true );
        return view("app.orders", compact('OrderList','COrderList'));
    }
	public function viewfeedback()
    {
        return view("app.feedback");
    }
	public function viewterms()
    {
        return view("app.terms");
    }
	public function viewregistration()
    {
        return view("app.registration");
    }
	public function viewlogin()
    {
        return view("app.login");
    }
	public function viewaddcard()
	{
		return view("app.addcard");
	}


}
