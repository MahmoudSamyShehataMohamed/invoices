<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

############################# Start invoices routes #################################
Route::resource('invoices', 'App\Http\Controllers\InvoiceController');
Route::get('invoicespaid', 'App\Http\Controllers\InvoiceController@invoicesPaid')->name('invoicespaid');
Route::get('invoicesunpaid', 'App\Http\Controllers\InvoiceController@invoicesUnpaid')->name('invoicesunpaid');
Route::get('invoicespartial', 'App\Http\Controllers\InvoiceController@invoicesPartial')->name('invoicespartial');
//لاحظ هذا الراوت خارجى لاننا لانه ليس له شئ داخل راوت انفويسز يعنى هو حاجه هنحاتج وانا بعمل ادد للنفزيس فهعمله خارجى من نوع جيت
Route::get('section/{id}', 'App\Http\Controllers\InvoiceController@getproducts'); //get products in the form ajax select field//id of section//when you click on the select field section hairoh on code ajax and get and get all products and put it in the product field select

Route::resource('invoicedetails', 'App\Http\Controllers\InvoicedetailController');
Route::get('viewfile/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicedetailController@openFile');//when you click on the عرض للفايل
Route::get('downloadfile/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicedetailController@downloadFile')->name('downloadfile'); //when you click on the تحميل للفايل
Route::get('formdelete/{id}', 'App\Http\Controllers\InvoicedetailController@formDelete')->name('formdelete'); //when you click on the حذف للفايل

Route::resource('invoiceattachments', 'App\Http\Controllers\InvoiceattachmentController');
Route::get('formdeleteinvoice/{id}', 'App\Http\Controllers\InvoiceController@deleteInvoice')->name('formdeleteinvoice'); //when you click on the حذف الفاتوره
Route::get('change_status/{id}', 'App\Http\Controllers\InvoiceController@changeStatus')->name('change_status');
Route::post('status_update/{id}', 'App\Http\Controllers\InvoiceController@statusUpdate')->name('status_update');

Route::get('invoiceprint/{id}', 'App\Http\Controllers\InvoiceController@invoicePrint')->name('invoiceprint');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', 'App\Http\Controllers\RoleController');

    Route::resource('users', 'App\Http\Controllers\UserController');
});

############################ End invoices routes ####################################

############################ Start invoicesarchive routes #################################
Route::resource('invoicesarchive', 'App\Http\Controllers\InvoicearchiveController');
Route::get('archiveinvoice/{id}', 'App\Http\Controllers\InvoicearchiveController@archiveInvoice')->name('archiveinvoice');
Route::get('transfertoinvoices/{id}', 'App\Http\Controllers\InvoicearchiveController@transferToInvoices')->name('transfertoinvoices');
Route::get('formdeletearchiveinvoices/{id}', 'App\Http\Controllers\InvoicearchiveController@formDeleteArchiveInvoices')->name('formdeletearchiveinvoices');


############################ End invoicesarchive routes   ##################################

############################# Start sections routes #################################
Route::resource('sections', 'App\Http\Controllers\SectionController');
############################ End sections routes ####################################

############################# Start products routes  ################################
Route::resource('products', 'App\Http\Controllers\ProductController');
############################ End products routes ####################################

############################# Start reports routes  ################################
Route::get('reports', 'App\Http\Controllers\ReportController@index')->name('reports');
Route::post('searchforinvoices', 'App\Http\Controllers\ReportController@searchForInvoices')->name('searchforinvoices');
Route::get('customersreport', 'App\Http\Controllers\CustomerreportController@customersReport')->name('customersreport');
Route::post('searchforcustomers', 'App\Http\Controllers\CustomerreportController@searchForCustomers')->name('searchforcustomers');

############################ End reports routes ####################################



############################# Start test routes #####################################
// Route::resource('test', 'App\Http\Controllers\TestController');
// // Route::get('destroy/{id}', 'App\Http\Controllers\TestController@destroy')->name('test.destroy');//هذا الراوت لحذف التيست + مع  ملاحظة انه راوت خارجى + فى نفس الوقت استغللنا فنكشن ديستروى عادى جدا ومفيش مشكله
// Route::get('formdelete/{id}', 'App\Http\Controllers\TestController@formDelete')->name('formdeletetest');//راوات خارجى
############################# End test routes #######################################

############################# Start shark routes test ################################
// Route::resource('sharks', 'App\Http\Controllers\sharkController');
// Route::get('test', 'App\Http\Controllers\sharkController@test');//راوات خارجى
#############################e nd shark routes test ##################################

Route::get('markasreadall','App\Http\Controllers\invoiceController@markasreadall')->name('markasreadall');











Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
