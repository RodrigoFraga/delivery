<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole:admin','as' => 'admin.'], function(){

	Route::get('categorias', ['as' => 'categorias.index', 'uses'=>'CategoriasController@index']);
	Route::get('categorias/create', ['as' => 'categorias.create', 'uses'=> 'CategoriasController@create'] );
	Route::get('categorias/edit/{id}', ['as' => 'categorias.edit', 'uses'=> 'CategoriasController@edit'] );
	Route::post('categorias/store', ['as' => 'categorias.store', 'uses'=> 'CategoriasController@store'] );
	Route::post('categorias/update/{id}', ['as' => 'categorias.update', 'uses'=> 'CategoriasController@update'] );

	Route::get('produtos', ['as' => 'produtos.index', 'uses'=>'ProdutosController@index']);
	Route::get('produtos/create', ['as' => 'produtos.create', 'uses'=> 'ProdutosController@create'] );
	Route::get('produtos/edit/{id}', ['as' => 'produtos.edit', 'uses'=> 'ProdutosController@edit'] );
	Route::post('produtos/store', ['as' => 'produtos.store', 'uses'=> 'ProdutosController@store'] );
	Route::post('produtos/update/{id}', ['as' => 'produtos.update', 'uses'=> 'ProdutosController@update'] );
	Route::get('produtos/destroy/{id}', ['as' => 'produtos.destroy', 'uses'=> 'ProdutosController@destroy'] );

	Route::get('clientes', ['as' => 'clientes.index', 'uses'=>'ClientesController@index']);
	Route::get('clientes/create', ['as' => 'clientes.create', 'uses'=> 'ClientesController@create'] );
	Route::get('clientes/edit/{id}', ['as' => 'clientes.edit', 'uses'=> 'ClientesController@edit'] );
	Route::post('clientes/store', ['as' => 'clientes.store', 'uses'=> 'ClientesController@store'] );
	Route::post('clientes/update/{id}', ['as' => 'clientes.update', 'uses'=> 'ClientesController@update'] );
	Route::get('clientes/destroy/{id}', ['as' => 'clientes.destroy', 'uses'=> 'ClientesController@destroy'] );
	
	Route::get('orders', ['as' => 'orders.index', 'uses'=>'OrdersController@index']);
	Route::get('orders/edit/{id}', ['as' => 'orders.edit', 'uses'=>'OrdersController@edit']);
	Route::post('orders/update/{id}', ['as' => 'orders.update', 'uses'=>'OrdersController@update']);

	Route::get('cupoms', ['as' => 'cupoms.index', 'uses'=>'CupomsController@index']);
	Route::get('cupoms/create', ['as' => 'cupoms.create', 'uses'=>'CupomsController@create']);
	Route::post('cupoms/store', ['as' => 'cupoms.store', 'uses'=>'CupomsController@store']);
	Route::get('cupoms/edit/{id}', ['as' => 'cupoms.edit', 'uses'=>'CupomsController@edit']);
	Route::post('cupoms/update/{id}', ['as' => 'cupoms.update', 'uses'=>'CupomsController@update']);
});

Route::group(['prefix' => 'consumidor','middleware' => 'auth.checkrole:cliente', 'as' => 'consumidor.'], function(){
	Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
	Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
	Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);
});

Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function(){

	Route::resource('authenticated', 'Api\Authenticated\AuthenticatedController', ['as' => 'authenticated.'], ['only' => ['index']]);

	Route::group(['prefix' => 'cliente', 'middleware' => 'oauth.checkrole:cliente', 'as' => 'cliente.'], function(){
		Route::resource('order', 'Api\Cliente\ClienteCheckoutController', ['except' => ['create', 'edit', 'destroy']]);
	});
	
	Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'], function(){
		Route::resource('order', 'Api\Deliveryman\DeliverymanCheckoutController', ['only' => ['index', 'show']]);
		Route::patch('order/{id}/update-status', [
			'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus', 
			'as' => 'order.update_status' ]);
	});
});