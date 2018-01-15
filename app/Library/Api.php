<?php
namespace App\Library;

use Illuminate\Http\Request;

use Session;

class Api
{
	const server = "http://byod-server20171008041155.azurewebsites.net/";

	public static function postLogin($username, $password){
	
		$client = new \GuzzleHttp\Client();
		$headers = [
		    'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$result=$client->request('POST', self::server . 'Token', [
			'headers' => $headers,
			'form_params' => [
				'grant_type' => "password",
				'username' => $username,
				'password' => $password
			]
		]);
		$response = $result->getBody()->getContents();
		$resultauth=substr($response,17,491);
		return $resultauth;
	}

	public static function getRequest($link)
	{

		$client = new \GuzzleHttp\Client();

		$url = self::server . "api/" . $link;
		$headers = [];
		if(Session::has('token')){
			$headers = [
				'Authorization' => 'Bearer ' . Session::get('token'),        
				'Accept'        => 'application/json',
			];
		}
		$request = $client->request('GET', $url,[
		        'headers' => $headers
		    ]);

		$response = $request->getBody()->getContents();

		return ($response);
	}
	public static function postRequest($link, $myBody )
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;
		$headers = [];
		if(Session::has('token')){
			$headers = [
				'Authorization' => 'Bearer ' . Session::get('token'),        
				'Accept'        => 'application/json',
			];
		}
		//$myBody['name'] = "Demo";
		$request = $client->post($url,  ['headers' => $headers, 'form_params'=>$myBody]);

		$response = $request->getBody()->getContents();

		return ($response);
		//dd($response);

	}
	public static function putRequest($link, $myBody)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;
		$headers = [];
		if(Session::has('token')){
			$headers = [
				'Authorization' => 'Bearer ' . Session::get('token'),        
				'Accept'        => 'application/json',
			];
		}
		//$myBody['name'] = "Demo";

		$request = $client->put($url,  ['headers' => $headers, 'body'=>$myBody]);

		$response = $request->send();


		dd($response);

	}
	public static function deleteRequest($link)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;
		$headers = [];
		if(Session::has('token')){
			$headers = [
				'Authorization' => 'Bearer ' . Session::get('token'),        
				'Accept'        => 'application/json',
			];
		}
		$request = $client->delete($url,[
		        'headers' => $headers
		    ]);

		$response = $request->send();


		dd($response);

	}
}
