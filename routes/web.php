<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RollController;
use Illuminate\Http\Request;
use App\Models\Roll;

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

Route::get('/',[RollController::class,'index']);




Route::get('rolls',function(Request $request){
    
    $roll = new Roll;
    $roll->user_id = $request->user_id;
    $roll->value1 = $request->value1;
    $roll->value2 = $request->value2;

});