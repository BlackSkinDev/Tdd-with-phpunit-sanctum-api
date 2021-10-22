<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('/job-categories',[\App\Http\Controllers\JobCategoryController::class,'store']);

Route::get('/job-categories',[\App\Http\Controllers\JobCategoryController::class,'index']);
