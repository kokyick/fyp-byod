<?php

namespace App\Http\Controllers;

use App\Library\Api;

use Illuminate\Http\Request;

use Log;

class RestaurantController extends Controller
{
  public function getRestaurant()
  {
    $RList =Api::getRequest("Outlets");
	$MList =Api::getRequest("Merchant/getMerchant");
	//dd(compact('$RestaurantList'));
	$RestaurantList = json_decode( $RList, true );
	$MerchantList =json_decode( $MList, true );
    return view("app.restaurant", compact('RestaurantList','MerchantList'));
  }
  public function viewmenus($id)
  {
	//Menus
	$MList =Api::getRequest("Products?outlet_id=" . $id);
	$MenuList = json_decode( $MList, true );
	//Food types
	$FTList =Api::getRequest("FoodTypes");
	$FoodTypeList = json_decode( $FTList, true );
	//Outlet data
	$OutList =Api::getRequest("Outlets/" . $id);
	$OutData = json_decode( $OutList, true );
	//Return
    return view("app.menu", compact('MenuList','FoodTypeList','OutData'));
  }
  public function viewfooditem($id)
  {
	//Single Menus
	$Food =Api::getRequest("Products?product_id=" . $id);
	$FoodItem = json_decode( $Food, true );
	//dd($FoodItem);
	//Return
	return $FoodItem;
  }
}