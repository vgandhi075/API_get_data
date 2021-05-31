<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Http;

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

// Route::get('/home', [ApiController::class, 'index']);

//used
Route::get('/view_users', [ApiController::class, 'getUsers'])->name('view');
Route::get('/insert_users', [ApiController::class, 'insertUsers'])->name('insert');

//huawei dev mbca
Route::get('/get_huawei', [ApiController::class, 'getHuawei']);
Route::get('/get_session', [ApiController::class, 'getSession']);
Route::get('/get_huawei_data', [ApiController::class, 'getHuaweiCapacity'])->name('getHuaweiData');

//tested
Route::get('/get_all_data', [ApiController::class, 'getAllData'])->name('post.all');
Route::get('/get_single_data/{id}', [ApiController::class, 'getSingleData'])->name(('post.single'));
Route::get('/post_single_data', [ApiController::class, 'postData'])->name('add.single');
Route::get('/update_single_data', [ApiController::class, 'updateData'])->name('update.single');
Route::get('/delete_single_data/{id}', [ApiController::class, 'deleteData'])->name('delete.single');

Route::get('/test', function () {
    $response = Http::get("http://jsonplaceholder.typicode.com/posts");
    dd($response);
});


