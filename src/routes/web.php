<?php
use Illuminate\Http\Request;

// Route::get('customer',function(){
//     return view("customer::customer");
// })->name('customer');

// Route::post('customer',function(Request $request){
//     return $request->all();
// });

Route::group(['namespace'=>'Ridwan\Customer\Http\Controllers'],function(){
    Route::get('customer','CustomerController@index')->name('customer');
    Route::post('customer','CustomerController@CustomerInsert');
    Route::post('GetCustomerById','CustomerController@GetCustomerById');
    Route::post('GetCustomerByField','CustomerController@GetCustomerByField');
    Route::get('GetOrdersID','CustomerController@GetOrdersID')->name('GetOrdersID');
    Route::get('GetCustomersApi','CustomerController@GetCustomersApi')->name('GetCustomersApi');
    Route::post('CustomersInsertApi','CustomerController@CustomersInsertApi');
    Route::post('CustomersUpdatetApi','CustomerController@CustomersUpdateApi');
    Route::post('CustomersDeleteApi','CustomerController@CustomersDeleteApi');
    Route::post('Orders','CustomerController@Orders');
    Route::post('ShowOrdersByOrderId','CustomerController@ShowOrdersByOrderId');
    Route::post('UpdateOrders','CustomerController@UpdateOrders');
    Route::post('deleteOrders','CustomerController@deleteOrders');
    Route::post('Payment','CustomerController@Payment');
    Route::post('ShowPayment','CustomerController@ShowPayment');
    Route::post('UpdateStatusPayment','CustomerController@UpdateStatusPayment');
    Route::get('GetAllTransaction','CustomerController@GetAllTransaction')->name('GetAllTransaction');
    Route::get('GetTransactionByQuery','CustomerController@GetTransactionByQuery')->name('GetTransactionByQuery');
    Route::get('CreateDataDummyOrders','CustomerController@CreateDataDummyOrders')->name('CreateDataDummyOrders');
    Route::get('sendEmail','CustomerController@sendEmail')->name('sendEmail');
    


});

