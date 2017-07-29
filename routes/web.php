<?php

//Route::get('/', function() {
//    return view('form_callback');
//});

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@send');

Route::get('bids_list', 'IndexController@show_bids');
Route::post('bids_list', 'IndexController@processing_bids');
