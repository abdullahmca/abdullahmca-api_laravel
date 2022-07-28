<?php
use Illuminate\Support\Facades\Route; 
// use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\User__menu\User_menuController; 
use App\Http\Controllers\User_opdController\User_opdController;  
use App\Http\Controllers\SmartcityController; 
use Illuminate\Http\Request; 
use App\Http\Controllers\Users_Controller\UsersController;
use App\Http\Controllers\Grupss_Controller\GrupsController;
use App\Http\Controllers\Member_Controller\MemberController;
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

Route::get('/welcome', function () {
    return view('welcome');
}); 
Route::get('/',[UsersController::class,'dashbord']);

Route::resource('user_management/users', 'App\Http\Controllers\Users_Controller\UsersController'); 
Route::resource('modul_grup/grups', 'App\Http\Controllers\Grupss_Controller\GrupsController');
Route::resource('modul_member/member', 'App\Http\Controllers\Member_Controller\MemberController');
Route::resource('admin/master_menu', 'App\Http\Controllers\Master_menu\Master_menuController');
Route::resource('admin/users', 'App\Http\Controllers\Users\UsersController');
Route::post('member/simpan_menu',[MemberController::class,'simpan_menu'])->name('member/simpan_menu');
Route::get('/modul_member/memberr',[MemberController::class,'form_cari']); 
Route::get('file-upload',[MemberController::class,'file_upload']); 
Route::get('/modul_member/member/get_data/{id}',[MemberController::class,'get_by_id']); 
Route::post('/modul_member/member/login',[MemberController::class,'api_login'])->name('/modul_member/member/login'); 
Route::post('/modul_member/user/add',[MemberController::class,'add_member'])->name('/modul_member/user/add'); 
Route::post('file.upload',[MemberController::class,'excel_upload'])->name('file.upload'); 
Route::post('upload/member',[MemberController::class,'excel_upload_ajax'])->name('upload/member'); 
Route::get('/token', function () {
        return csrf_token(); 
    });