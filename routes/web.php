<?php
Auth::routes();
Route::get('/outstanding', 'HomeController@index');
Route::get('/', 'HomeController@dashboard');
Route::get('/create', 'HomeController@create');
Route::post('/create', 'HomeController@create_store');
Route::get('/upload/{id}', 'HomeController@upload');
Route::post('/upload/{id}', 'HomeController@upload_store');
Route::get('/feedback/{id}', 'HomeController@feedback');
Route::post('/feedback/{id}', 'HomeController@feedback_store');
Route::get('/viewfeedback/{id}', 'HomeController@viewfeedback');
Route::get('/revise/{id}', 'HomeController@revise');
Route::post('/revise/{id}', 'HomeController@revise_store');
Route::get('/draft', 'HomeController@draft');
Route::get('/final', 'HomeController@final_view');
Route::get('/final/{id}', 'HomeController@final');
Route::get('/overdue', 'HomeController@overdue');
Route::get('/del/{id}', 'HomeController@del');
Route::get('/noneed/{id}', 'HomeController@noneed');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


// SIMADA AI chatbox feature
Route::get('/simada-ai', function() {
	return view('simada_ai');
});

// List PCR feature
Route::get('/list-pcr', 'HomeController@listPcr')->name('pcr.index');

// Create PCR feature
Route::get('/create-pcr', 'HomeController@createPcr')->name('pcr.create');
Route::post('/create-pcr', 'HomeController@storePcr')->name('pcr.store');

// List Pending PCR feature
Route::get('/list-pending-pcr', 'HomeController@listPendingPcr')->name('pcr.pending');

// RFQ features
Route::get('/list-rfq', 'HomeController@listRfq')->name('rfq.index');
Route::get('/create-rfq', 'HomeController@createRfq')->name('rfq.create');
Route::post('/create-rfq', 'HomeController@storeRfq')->name('rfq.store');

// Price Controlled features
Route::get('/list-price-controlled', 'HomeController@listPriceControlled')->name('price-controlled.index');
Route::get('/create-price-controlled', 'HomeController@createPriceControlled')->name('price-controlled.create');
Route::post('/create-price-controlled', 'HomeController@storePriceControlled')->name('price-controlled.store');