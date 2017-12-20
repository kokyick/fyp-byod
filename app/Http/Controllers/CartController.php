<?php

namespace App\Http\Controllers;

use App\Library\Api;

use Illuminate\Http\Request;

use Log;

use Session;

class CartController extends Controller
{
  public function AddOrderCash(Request $request)
  {
  	//Add Order
	$myBody['total_bill'] = $request->total_bill;
	$myBody['table_id']=(int)$request->table_id;
	$result =Api::postRequest("SendOrder",$myBody);
	$resultObj=json_decode($result);
	// add food items
	foreach (Session::get('cart') as $food){
		$addFood['outlet_product_id']=(int)$food['itemoutlet_productid'];
    	$addFood['order_id']=(int)$resultObj->order_id;
		$addFood['quantity']=(int)$food['quantity'];
		$addFood['quantity']=1;
		//dd($addFood);
		$result =Api::postRequest("addFoodOrder",$addFood);
	}

	//Session::flush();
	Session::forget('cart');
	Session::forget('subtotal');
	// //return redirect()->route('viewindex');
	// return view("app.index");
	$notification = array(
	'message' => 'Order sent successfully', 
	'alert-type' => 'success'
	);
	Session::put('message',$notification);

	// return Redirect::to('/');
	return redirect()->route('viewindex')->with($notification);

  }
  public function AddOrderCard(Request $request)
  {
  	//Add Order
	$myBody['total_bill'] = $request->amt;
	$myBody['table_id']=$request->tableId;
	$result =Api::postRequest("SendOrder",$myBody);
	//Session::flush();
	Session::forget('cart');
	Session::forget('subtotal');

	Session::put('message',$Outlet);
	//return redirect()->route('viewindex');
	return view("app.index");

  }
  public function AddCart(Request $request)
  {
	//Check if its the same outlet
	//Check if items is already added
    //Add product to session cart
	$quan=$request->foodQuantity;
	$outId=$request->outletid;
	$itemid=$request->itemid;
	$itemname=$request->itemname;
	$itemprice=$request->itemprice;
	$itemproduct_image=$request->itemproduct_image;
	$itemfood_type=$request->itemfood_type;	
	$itemmerchant_id=$request->itemmerchant_id;
	$itemoutlet_productid=$request->itemoutlet_productid;
	//delete all session data
	//Session::flush();
	//new product to be added
	$product=collect(['quantity' => $quan, 'outletid' => $outId, 'itemid' =>$itemid, 'itemname' =>$itemname, 'itemprice' =>$itemprice, 'itemproduct_image' =>$itemproduct_image,'itemoutlet_productid'=>$itemoutlet_productid, 'itemfood_type' =>$itemfood_type, 'itemmerchant_id' =>$itemmerchant_id]);
	//retrieve old cart
	//if(Session::has('cart')){
		//$oldcart=Session::get('cart');
		//append to oldcart with new items
		//$newcart=array_push($oldcart,$product);
		//store in session
		//Session::push('cart', $newcart); 
	//}
	//else{
	//Check if its the same outlet
	//Check if its the same food in cart
	$isin=false;
	
	if(Session::has('outlet')){
		$food=Session::get('outlet');
		if($food['outlet_id']==$product['outletid']){
			if(Session::has('cart')){
				foreach (Session::get('cart') as $food){
					if($food['itemid']==$product['itemid']){
						$food['quantity']+=$product['quantity'];
						$isin=true;
					}
				}
			}
			if($isin==false)
				Session::push('cart', $product); 
		}else{
			alert("Order not added, you have items from other outlet in your cart");
		}
	}else{
		$OList =Api::getRequest("Outlets?outlet_id=" . $product['outletid']);
		$Outlet = json_decode( $OList, true );
		Session::put('outlet',$Outlet);
		if(Session::has('cart')){
			foreach (Session::get('cart') as $food){
				if($food['itemid']==$product['itemid']){
					$food['quantity']+=$product['quantity'];
					$isin=true;
				}
			}
		}
		if($isin==false)
			Session::push('cart', $product); 
	}

	//}

    return redirect()->route('menus', ['id'=>$outId]);
  }

}