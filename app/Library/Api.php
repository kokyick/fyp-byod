<?php
namespace App\Library;

use Illuminate\Http\Request;


class Api
{
	const server = "http://byod-server20171008041155.azurewebsites.net/api/";

	public static function getRequest($link)
	{

		$client = new \GuzzleHttp\Client();

		$url = self::server . $link;

		$request = $client->request('GET', $url);

		$response = $request->getBody()->getContents();
		//dd($response);

		return ($response);

	}
	public static function postRequest($link, $myBody )
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server + $link;

		//$myBody['name'] = "Demo";

		$request = $client->post($url,  ['body'=>$myBody]);

		$response = $request->send();


		dd($response);

	}
	public static function putRequest($link, $myBody)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server + $link;

		//$myBody['name'] = "Demo";

		$request = $client->put($url,  ['body'=>$myBody]);

		$response = $request->send();


		dd($response);

	}
	public static function deleteRequest($link)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server + $link;

		$request = $client->delete($url);

		$response = $request->send();


		dd($response);

	}
}
