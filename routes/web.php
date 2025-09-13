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

// RFQ features - updated to use resource controller
Route::resource('rfq', 'RfqController');
Route::get('rfq/{id}/send-email', 'RfqController@sendEmail')->name('rfq.sendEmail');

// RFQ APR routes
Route::resource('rfq-apr', 'RfqAprController');

// RFQ GP routes
Route::resource('rfq-gp', 'RfqGpController');

// Master data routes
Route::resource('customers', 'CustomerController');
Route::resource('products', 'ProductController');
Route::resource('suppliers', 'SupplierController');
Route::resource('pics', 'PicController');

// Import routes
Route::get('/imports', 'ImportController@index')->name('imports.index');
Route::post('/imports/customers', 'ImportController@importCustomers')->name('imports.customers');
Route::post('/imports/products', 'ImportController@importProducts')->name('imports.products');
Route::post('/imports/suppliers', 'ImportController@importSuppliers')->name('imports.suppliers');

// Price Controlled features
Route::get('/list-price-controlled', 'HomeController@listPriceControlled')->name('price-controlled.index');
Route::get('/create-price-controlled', 'HomeController@createPriceControlled')->name('price-controlled.create');
Route::post('/create-price-controlled', 'HomeController@storePriceControlled')->name('price-controlled.store');

// Survey to Supplier features
Route::resource('survey-supplier', 'SurveySupplierController');

// Feasibility Study features
Route::get('/list-fs', 'HomeController@listFs')->name('fs.index');
Route::get('/create-fs', 'HomeController@createFs')->name('fs.create');
Route::post('/create-fs', 'HomeController@storeFs')->name('fs.store');

// Check Quotation features
Route::get('/list-quotation', 'HomeController@listQuotation')->name('quotation.index');
Route::get('/create-quotation', 'HomeController@createQuotation')->name('quotation.create');
Route::post('/create-quotation', 'HomeController@storeQuotation')->name('quotation.store');

// Test route for email functionality
Route::get('/test-email', 'TestController@testEmail')->name('test.email');