<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/job-categories',[\App\Http\Controllers\JobCategoryController::class,'index']);
    Route::post('/job-categories',[\App\Http\Controllers\JobCategoryController::class,'store']);


});


