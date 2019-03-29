<?php

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
Route::any('Admin/Index/index','Admin\IndexController@index');
Route::any('Admin/Index/menu','Admin\IndexController@menu');
Route::any('Admin/Index/main','Admin\IndexController@main');
Route::any('Admin/Index/top','Admin\IndexController@top');
Route::any('Admin/Index/drag','Admin\IndexController@drag');

Route::any('Admin/Brand/brand_add','Admin\BrandController@brand_add');
Route::any('Admin/Brand/brand_list','Admin\BrandController@brand_list');
Route::any('Admin/Brand/brand_del','Admin\BrandController@brand_del');
Route::any('Admin/Brand/brand_upd','Admin\BrandController@brand_upd');
Route::any('Admin/Brand/add','Admin\BrandController@add');
