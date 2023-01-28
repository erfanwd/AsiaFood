<?php

use Illuminate\Support\Facades\Route;
Route::get('/',[App\Http\Controllers\Application\FoodController::class,'index'])->name('app.food.index');

Route::prefix('app')->group(function (){
    Route::get('food/{food}',[App\Http\Controllers\Application\FoodController::class,'show'])->name('app.food.show');
    Route::post('buy',[App\Http\Controllers\Application\FoodController::class,'buy'])->name('app.food.buy')->middleware('auth');
    Route::get('orders',[App\Http\Controllers\Application\UserController::class,'orders'])->name('user.orders')->middleware('auth');
});
Route::prefix('admin')->middleware('auth')->group(function (){
    Route::get('foods',[App\Http\Controllers\Admin\FoodController::class,'index'])->name('admin.food.index');

    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class,'index'])->name('admin.order.index');
    Route::get('order/accept/{order}',[App\Http\Controllers\Admin\OrderController::class,'accept'])->name('admin.order.accept');

    Route::get('categories',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('admin.category.index');
    Route::post('categories',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('admin.category.store');
    Route::get('categories/{category}',[App\Http\Controllers\Admin\CategoryController::class,'show'])->name('admin.category.show');
    Route::post('categories/{category}/update',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('admin.category.update');
    Route::get('categories/{category}/delete',[App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('admin.category.delete');

    Route::get('foods',[App\Http\Controllers\Admin\FoodController::class,'index'])->name('admin.food.index');
    Route::post('foods',[App\Http\Controllers\Admin\FoodController::class,'store'])->name('admin.food.store');
    Route::get('foods/{food}',[App\Http\Controllers\Admin\FoodController::class,'show'])->name('admin.food.show');
    Route::post('foods/{food}/update',[App\Http\Controllers\Admin\FoodController::class,'update'])->name('admin.food.update');
    Route::get('foods/{food}/delete',[App\Http\Controllers\Admin\FoodController::class,'delete'])->name('admin.food.delete');
});
Route::prefix('auth')->group(function (){
    Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'form'])->name('auth.register.form')->middleware('guest');
    Route::post('register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('auth.register')->middleware('guest');
    Route::get('login',[App\Http\Controllers\Auth\LoginController::class,'form'])->name('auth.login.form')->middleware('guest');
    Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('auth.login')->middleware('guest');
    Route::get('logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('auth.logout')->middleware('auth');
});
