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
//1111

//商品路由
Route::any('Admin/Goods/goods_type_list','Admin\Goods_typeController@goods_type_list');//商品类型
Route::any('Admin/Goods/goods_type_add','Admin\Goods_typeController@goods_type_add');//新增商品类型
Route::any('Admin/Goods/goods_type_edit','Admin\Goods_typeController@goods_type_edit');//修改商品类型
Route::any('Admin/Goods/goods_type_edit_do','Admin\Goods_typeController@goods_type_edit_do');//修改商品类型
Route::any('Admin/Goods/goods_type_delete','Admin\Goods_typeController@goods_type_delete');//修改商品类型
Route::any('Admin/Goods/goods_type_edit_status','Admin\Goods_typeController@goods_type_edit_status');//修改商品类型