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
Route::any('Admin/Goods_type/goods_type_list','Admin\Goods_typeController@goods_type_list');//商品类型
Route::any('Admin/Goods_type/goods_type_add','Admin\Goods_typeController@goods_type_add');//新增商品类型
Route::any('Admin/Goods_type/goods_type_edit','Admin\Goods_typeController@goods_type_edit');//修改商品类型
Route::any('Admin/Goods_type/goods_type_edit_do','Admin\Goods_typeController@goods_type_edit_do');//修改商品类型
Route::any('Admin/Goods_type/goods_type_delete','Admin\Goods_typeController@goods_type_delete');//删除商品类型
Route::any('Admin/Goods_type/goods_type_edit_status','Admin\Goods_typeController@goods_type_edit_status');//修改商品类型状态
Route::any('Admin/Goods_type/goods_category_list','Admin\Goods_typeController@goods_category_list');//商品分类列表。

/*
 *品牌start
 */
Route::any('Admin/Brand/brand_add','Admin\BrandController@brand_add');
Route::any('Admin/Brand/brand_list','Admin\BrandController@brand_list');
Route::any('Admin/Brand/brand_del','Admin\BrandController@brand_del');
Route::any('Admin/Brand/brand_upd','Admin\BrandController@brand_upd');
Route::any('Admin/Brand/add','Admin\BrandController@add');
/*
 *品牌end
 */



/*
 *订单start
 */
Route::any('Admin/Order/order_list','Admin\BrandController@order_list');

Route::any('Admin/Attribute/attribute_add','Admin\AttributeController@attribute_add');
Route::any('Admin/Attribute/attribute_list','Admin\AttributeController@attribute_list');
Route::any('Admin/Attribute/attribute_edit','Admin\AttributeController@attribute_edit');
Route::any('Admin/Attribute/arrtibute_del/{id}','Admin\AttributeController@arrtibute_del');
Route::any('Admin/Attribute/attribute','Admin\AttributeController@attribute');

Route::any('Admin/Goods/add','Admin\GoodsController@add');
Route::any('Admin/Goods/goods_list','Admin\GoodsController@goods_list');
