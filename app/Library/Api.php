<?php
namespace App\Library;

use Illuminate\Http\Request;
use GuzzleHttp\Cookie\CookieJar;

use GuzzleHttp\Cookie\FileCookieJar;

class Api
{
	const server = "http://byod-server20171008041155.azurewebsites.net/";

	public static function postLogin($username, $password){
	
		//file to store cookie data
		$cookieFile = 'var/www/jar.txt';

		$client = new \GuzzleHttp\Client();
		$cookieJar = new CookieJar();
		$result=$client->request('POST', self::server . 'Token', [
			'form_params' => [
				'grant_type' => "password",
				'username' => $username,
				'password' => $password
			]
		]);
		$cookieJar = CookieJar::fromArray(['cookie_name' => 'cookie_value'], 'example.com');
		return $result;
	}

	public static function getRequest($link)
	{

		$client = new \GuzzleHttp\Client();

		$url = self::server . "api/" . $link;
		$jar = new \GuzzleHttp\Cookie\CookieJar();
		$request = $client->request('GET', $url, ['cookies' => $jar]);

		$response = $request->getBody()->getContents();

		return ($response);
	}
	public static function postRequest($link, $myBody )
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;

		//$myBody['name'] = "Demo";
		
		$jar = new \GuzzleHttp\Cookie\CookieJar();
		$request = $client->post($url,  ['form_params'=>$myBody], $url, ['cookies' => $jar]);

		$response = $request->getBody()->getContents();

		return ($response);
		//dd($response);

	}
	public static function putRequest($link, $myBody)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;

		//$myBody['name'] = "Demo";

		$request = $client->put($url,  ['body'=>$myBody]);

		$response = $request->send();


		dd($response);

	}
	public static function deleteRequest($link)
	{

		$client = new \GuzzleHttp\Client();
		
		$url = self::server . "api/" . $link;

		$request = $client->delete($url);

		$response = $request->send();


		dd($response);

	}
}
