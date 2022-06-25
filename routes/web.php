<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\auth\authcontroller;
use App\Http\Controllers\admin\safecontroller;
use Illuminate\Database\Schema\IndexDefinition;
use App\Http\Controllers\admin\weightcontroller;
use App\Http\Controllers\admin\bartypecontroller;
use App\Http\Controllers\admin\countrycontroller;
use App\Http\Controllers\admin\goldbarcontroller;
use App\Http\Controllers\admin\safetybecontroller;

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
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {

Route::get('/login',[authcontroller::class,'login'])->name('login'); 
Route::post('/hadlelogin',[authcontroller::class,'hadlelogin'])->name('hadlelogin'); 


    /////////////////////////end auth//////////////////
    Route::middleware('adminauth:admins')->group(function(){

        Route::get('/logout',[authcontroller::class,'logout'])->name('logout'); 
        ////////////////////////////////////////////end log out////////////////////
        Route::get('/home',[homecontroller::class,'home'])->name('home'); 

        ///////////////////////// end home///////////////////////
        Route::get('/fetchcountry',[countrycontroller::class,'FetchCountry'])->name('country.fetch'); 
        Route::get('/country',[countrycontroller::class,'create'])->name('country.create');
        Route::post('/country/store',[countrycontroller::class,'store'])->name('country.store');
        Route::get('/country/edit/{id}',[countrycontroller::class,'edit'])->name('country.edit');
        Route::post('/country/update/{id}',[countrycontroller::class,'update'])->name('country.update');
        Route::get('/country/delete/{id}',[countrycontroller::class,'delete'])->name('country.delete');
        Route::get('/country/search',[countrycontroller::class,'search'])->name('country.search');
        
        ////////////////////////////////end country//////////////////////
        Route::get('/safetype',[safetybecontroller::class,'create'])->name('safetybe.create');
        Route::post('/safetype/store',[safetybecontroller::class,'store'])->name('safetybe.store');
        Route::get('/safetype/edit/{id}',[safetybecontroller::class,'edit'])->name('safetybe.edit');
        Route::post('/safetype/update/{id}',[safetybecontroller::class,'update'])->name('safetybe.update');
        Route::get('/safetype/delete/{id}',[safetybecontroller::class,'delete'])->name('safetybe.delete');
        Route::get('/fetch-safetype',[safetybecontroller::class,'fetchsafetype'])->name('safetybe.fetchsafetype'); 
        Route::get('/safetype/search',[safetybecontroller::class,'search'])->name('safetybe.search');
        
        //////////////////////////////end safe type//////////////////////////////////////
        Route::get('/safes',[safecontroller::class,'create'])->name('safes.create');
        Route::post('/safes/store',[safecontroller::class,'store'])->name('safes.store');
        Route::get('/safes/edit/{id}',[safecontroller::class,'edit'])->name('safes.edit');
        Route::POST('/safes/update/{id}',[safecontroller::class,'update'])->name('safes.update');
        Route::get('/safes/delete/{id}',[safecontroller::class,'delete'])->name('safes.delete');
        Route::get('/fetch-safe',[safecontroller::class,'fetchsafe'])->name('safes.fetchsafe'); 
        Route::get('/safes/search',[safecontroller::class,'search'])->name('safes.search');

        /////////////////////////end safe//////////////////////////////////////
        Route::get('/weight',[weightcontroller::class,'create'])->name('weight.create');
        Route::post('/weight/store',[weightcontroller::class,'store'])->name('weight.store');
        Route::get('/weight/edit/{id}',[weightcontroller::class,'edit'])->name('weight.edit');
        Route::post('/weight/update/{id}',[weightcontroller::class,'update'])->name('weight.update');
        Route::get('/weight/delete/{id}',[weightcontroller::class,'delete'])->name('weight.delete');
        Route::get('/fetch-weight',[weightcontroller::class,'fetchweight'])->name('weight.fetchweight');
        Route::get('/weight/search',[weightcontroller::class,'search'])->name('weight.search');
 
        ///////////////////////////////end weight///////////////////////////////
        Route::get('/goldbar',[goldbarcontroller::class,'create'])->name('goldbar.create');
        Route::post('/goldbar/store',[goldbarcontroller::class,'store'])->name('goldbar.store');
        Route::get('/fetch-goldbar',[goldbarcontroller::class,'fetchgoldbar'])->name('goldbar.fetchgoldbar');
        Route::get('/goldbar/edit/{id}',[goldbarcontroller::class,'edit'])->name('goldbar.edit');
        Route::post('/goldbar/update/{id}',[goldbarcontroller::class,'update'])->name('goldbar.update'); 
        Route::get('/goldbar/delete/{id}',[goldbarcontroller::class,'delete'])->name('goldbar.delete');
        Route::get('/catchsafe',[goldbarcontroller::class,'catchsafe'])->name('goldbar.catchsafe');
        Route::get('/goldbar/search',[goldbarcontroller::class,'search'])->name('goldbar.search');

        ////////////////////////////////////end gold bar////////////////////
    });


});

