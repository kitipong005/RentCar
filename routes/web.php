<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','IndexController@index');

//======================================
//=============== Login ================
//======================================

//---facebook--->
Route::get('login/facebook', 'LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'LoginController@handleFacebookProviderCallback');
//---google--->
Route::get('login/google', 'LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'LoginController@handleGoogleProviderCallback');
//---website--->
Route::post('login/web', 'LoginController@login');

//======================================
//=============== Register =============
//======================================
Route::post('register', 'RegisController@register');

//======================================
//=============== User =================
//======================================
Route::get('user/profile', 'UserController@view_profile');
Route::post('user/update/profile', 'UserController@update_profile');

//======================================
//=============== Car ==================
//======================================
Route::get('รถเช่าเชียงใหม่','CarController@carshowform');
Route::post('cars/check-rent', 'CarController@carcheckrent');


//======================================
//=============== paypal ===============
//======================================
Route::get('paypal/form', 'PaymentController@paypalForm');
Route::post('paypal/pay', 'PaymentController@paypalPay');
Route::get('paypal/status', 'PaymentController@getpaypalStatus');

//======================================
//=============== Mail ================
//======================================
Route::get('cars/sendmail', 'MailController@sendMail');
Route::get('cars/sendmail/confirm', 'MailController@confirm');
Route::get('cars/sendmail/update', 'MailController@sendUpdatePayment');

//=======================================
//============== How to =================
//=======================================
Route::get('รถเช่าเชียงใหม่/วิธีสั่งซื้อสินค้า','IndexController@howto');

//======================================
//================ Logout ==============
//======================================
Route::get('logout', 'LogoutController@logout');


//======================================
//================ Admin  ==============
//======================================
// Route::get('/admin', function () {
//     return view('admin.index');
// });
// Route::get('/admin', ['middleware' => 'admin', function () {
//     return view('admin.index');
// }]);
Route::get('/admin','Admin\IndexController@Index')->middleware('admin');

//---- select model in brand -----
Route::get('/list-model', 'Admin\CarController@list_model');

//=======================================
//================ Car ==================
//=======================================
Route::get('/admin-listcar', 'Admin\CarController@list_car');
Route::get('/admin-addcar', 'Admin\CarController@add_car');
Route::post('/admin-addcar', 'Admin\CarController@add_car_db');
Route::get('/admin-editcar', 'Admin\CarController@editListCarForm');
Route::post('/admin-editcar', 'Admin\CarController@editListCar');
Route::get('/admin-delcar', 'Admin\CarController@deleteCar');
//--------- landmark ----------
Route::get('/admin-landmark', 'Admin\LandmarkController@list_landmark');
Route::post('/admin-addlandmark', 'Admin\LandmarkController@add_landmark');
Route::delete('/admin-dellandmark/{id}', 'Admin\LandmarkController@del_landmark');
Route::get('/admin-editlandmarkForm', 'Admin\LandmarkController@edit_form_landmark');
Route::post('/admin-editlandmark', 'Admin\LandmarkController@edit_landmark');
//---------- confitm booking -----------
Route::get('/admin-confirm-book', 'Admin\ConfirmBookController@ConfirmBookForm');
Route::get('/admin-get-payment/{id}/{book}', 'Admin\ConfirmBookController@ConfirmBookDetail');
Route::post('/admin-confirm-update', 'Admin\ConfirmBookController@ConfirmBookUpdate');
Route::get('/admin-confirm-pdf', 'Admin\ConfirmBookController@ConfirmBookPdf');
Route::get('/admin-confirm-success', 'Admin\ConfirmBookController@ConfirmSuccess');
//--------- update book after send car ----------
Route::post('/admin-confirm-pdf-update', 'Admin\ConfirmBookController@sendCarSuccess');
//---------- delete booking -----------
Route::get('/admin-confirm-delete/{id}', 'Admin\ConfirmBookController@ConfirmBookDelete');

//=======================================
//=============== Brand =================
//=======================================
Route::get('/admin-brand', 'Admin\CarController@Brandlist');
Route::post('/admin-brand-add', 'Admin\CarController@Brandadd');
Route::get('/admin-brand-get', 'Admin\CarController@Brandget');
Route::post('/admin-brand-edit', 'Admin\CarController@Brandedit');
Route::post('/admin-brand-delete', 'Admin\CarController@Branddelete');

//=======================================
//================ Type =================
//=======================================
Route::get('/admin-type', 'Admin\CarController@Typelist');
Route::post('/admin-type-add', 'Admin\CarController@Typeadd');
Route::get('/admin-type-get', 'Admin\CarController@Typeget');
Route::post('/admin-type-edit', 'Admin\CarController@Typeedit');
Route::post('/admin-type-delete', 'Admin\CarController@Typedelete');

//=======================================
//================ Time =================
//=======================================
Route::get('/admin-time', 'Admin\TimeController@Timelist');
Route::post('/admin-timestart-add', 'Admin\TimeController@TimeStartadd');
Route::post('/admin-timeend-add', 'Admin\TimeController@TimeEndadd');
Route::get('/admin-timestart-get', 'Admin\TimeController@TimeStartget');
Route::get('/admin-timesend-get', 'Admin\TimeController@TimeEndget');
Route::post('/admin-timestart-edit', 'Admin\TimeController@TimeStartedit');
Route::post('/admin-timeend-edit', 'Admin\TimeController@TimeEndedit');
Route::post('/admin-timestart-delete', 'Admin\TimeController@TimeStartdelete');
Route::post('/admin-timeend-delete', 'Admin\TimeController@TimeEnddelete');

//======================================
//============= Attraction =============
//======================================
Route::get('/admin-attraction', 'Admin\AttractionController@list_attraction');
Route::get('/admin-formattraction', 'Admin\AttractionController@form_attraction');
Route::post('/admin-addattraction', 'Admin\AttractionController@add_attraction');
Route::get('/admin-addattraction', 'Admin\AttractionController@add_attraction');

//=======================================
//=============== Model =================
//=======================================
Route::get('/admin-model', 'Admin\CarController@Modellist');
Route::post('/admin-model-add', 'Admin\CarController@Modeladd');
Route::get('/admin-model-get', 'Admin\CarController@Modelget');
Route::post('/admin-model-edit', 'Admin\CarController@Modeledit');
Route::post('/admin-model-delete', 'Admin\CarController@Modeldelete');

//=======================================
//=============== Book ==================
//=======================================
Route::post('cars/book/save','BookController@saveBook');
Route::get('เช่ารถมอเตอร์ไซต์เชียงใหม่/{id}','BookController@cart');
Route::get('เช่ารถมอเตอร์ไซต์เชียงใหม่/ตรวจสอบ/{id}','BookController@checkcart');
Route::get('เช่ารถมอเตอร์ไซต์เชียงใหม่/จ่ายเงิน/{id}','BookController@paymentcart');
Route::get('cars/book/update','BookController@updateBook');
Route::post('cars/book/savepayment','BookController@savepayment');

//--- get pricr in landmark ---
Route::get('cars/book/price-landmark','BookController@getPriceLandmark');
//--- check code ---
Route::get('cars/book/checkcode','BookController@checkCode');

//----- delete ----
Route::get('cars/book/delete','BookController@deleteBook');

//=======================================
//============== Payment ================
//=======================================
// Route::get('cars/book/confirm','BookController@paymentConfirm');
Route::get('เช่ารถมอเตอร์ไซต์เชียงใหม่/เช่ารถมอเตอร์ไซต์/ยืนยัน/{book}','BookController@paymentConfirm');
Route::get('รถเช่าเชียงใหม่/แจ้งชำระเงิน','PaymentController@howtopayment');
//Route::get('cars/book/wait','BookController@paymentWait');
Route::get('cars/book/checkcodebook','PaymentController@checkCodeBook');
//=======================================
//=============== Search ================
//=======================================
Route::get('เช่ารถมอเตอร์ไซต์เชียงใหม่/ค้นหา/รถเช่า','SearchController@searchBook');

//=======================================
//=============== PDF ==================
//=======================================
Route::get('cars/pdf/bill/{payment}','PdfController@generate_pdf_rent_car');


//=======================================
//=========== Return Car ================
//=======================================
Route::get('/admin-returncar','Admin\ReturnCarController@returnCar');
Route::post('/admin-returncar-update','Admin\ReturnCarController@returnCarUpdate');
Route::get('cars/pdf/returncar/{payment}','PdfController@generate_pdf_return_car');
//=======================================================================
//============================   English   ==============================
//=======================================================================
Route::get('/en','IndexController@indexEN');
