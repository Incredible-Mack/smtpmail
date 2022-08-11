<?php

use App\Http\Controllers\SmtpController;
use App\Http\Controllers\TemplateController;
use App\Mail\sendmailsmtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('mail');
});

//Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/sendmail', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('sendmail');



Route::get('/sendm', function () {
    Mail::to('mackemma96@gmail.com')->send(new sendmailsmtp);
    return('Hello');
});


Route::post('/testing', function (Request $request) {
   
    $str = $request->email;
    $emails = explode(',',trim($str));

    foreach ($emails as $email){
        Mail::to($email)->send(new sendmailsmtp);
       
     
    }
    
    return('Hello');

})->name('testing');;


Route::get('/setting',[SmtpController::class,'index'])->name('setting');

Route::post('/store',[SmtpController::class,'store'])->name('store');

Route::get('/template', function (){ 
    return view('template');
});

Route::post('/templateaction', [TemplateController::class, 'index'])->name('templateaction');