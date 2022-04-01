<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\RollController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Roll;

Route::apiResource('v1/rolls',RollController::class)
                  ->only(['index','store','show','destroy']);

Route::post('v1/userUpdate/{user}/{name}',[UserController::class,'update'])->middleware('auth:sanctum');

Route::apiResource('v1/users',UserController::class)
                     ->only(['index','store','show','destroy']); 

//Route::post('v1/users/{user}',[UserController::class,'update']); 

Route::get('v1/users/{user}',[UserController::class,'rolldice']);

Route::get('v1/users/rolldice/{user}',[UserController::class,'rolldice'])->middleware('auth:sanctum');

Route::get('v1/userAverage/{user}',[UserController::class,'userAverage']);

Route::get('v1/usersAverage',[UserController::class,'usersAverage']);

Route::get('v1/userLooser',[UserController::class,'userLooser']);

Route::get('v1/userWinner',[UserController::class,'userWinner']);

Route::get('v1/destroyUserRolls/{user}',[UserController::class,'destroyUserRolls'])->middleware('auth:sanctum');



Route::get('rolls',function(){
    return Roll::all();
});


Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::get('/userprofile',[UserController::class,'userprofile'])->middleware('auth:sanctum');