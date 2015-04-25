<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'Member\SilsilahController@getIndex');




Route::group(
	array(
		'prefix'=>'',
		'namespace' => 'Guest',
	),
	function(){
		Route::get('login', 'UserController@getLogin');
		Route::get('logout', 'UserController@getLogout');
		Route::post('login', 'UserController@postLogin');
	}
);


Route::group(
	array(
		'prefix'=>'member',
		'namespace' => 'Member',
		// 'before' => 'auth',
	),
	function(){
		Route::controller('silsilah', 'SilsilahController');
		
		// Route::get('affiliate/product/add/{product_id}', 'AffiliateController@getProductAdd');
	}
);