<?php

use App\Http\Controllers\TaskController;
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
// TaskController
Route::get('app/get_tasks', [TaskController::class, 'show']);
Route::post('app/post_task', [TaskController::class, 'create']);
Route::post('app/edit_task', [TaskController::class, 'update']);
Route::post('app/delete_task', [TaskController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
});
