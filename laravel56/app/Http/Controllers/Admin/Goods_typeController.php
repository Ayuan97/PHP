<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Goods_typeController extends Controller
{
    /*
     * 类型列表渲染展示
     * @param $page 当前页数
     * @param $limit 每页显示条数
     * @param $count 数据总数
     */
    public function goods_type_list(Request $request)
    {

        $page = $request->input('page') ?? 1;
        $limit = $request->input('limit') ?? 10;
        if(!empty($request->input('limit')))
        {
            return $limit;
        }
        $count = count(DB::select("select * from goods_type"));
        $sum = ceil($count/$limit);
        $offset = ($page - 1) * $limit;
        $data = DB::select('select * from goods_type limit ' . $offset . ',' . $limit);
        return view('Goods_type.goods_type_list',['data' => $data,'page'=>$page,'sum'=>$sum,'limit'=>$limit,'count'=>$count]);
    }
    /*
     * 商品类型添加
     * @param $cat_name 类型名称
     * @param $res 返回状态值
     */
    public function goods_type_add(Request $request)
    {
        if(!empty($request->input('cat_name')))
        {
            $cat_name = $request->input('cat_name');
            $res = DB::insert('insert into goods_type(`cat_name`) values(?)',[$cat_name]);
            if($res)
            {
                return view('Goods_type.jump')->with([
                    'message'=>'类型添加成功',
                    'url'=>'Admin/Goods_type/goods_type_list',
                    'jumpTime'=>2
                ]);
            }else{
                return view('Goods_type.jump')->with([
                    'message'=>'网路错误',
                    'url'=>'Admin/Goods_type/goods_type_list',
                    'jumpTime'=>2
                ]);
            }
        }

        return view('Goods_type.goods_type_add');
    }
    /*
     * 商品类型修改展示
     * @param $cat_id 修改类型id
     * @param $cat_name 类型名称
     */
    public function goods_type_edit(Request $request)
    {
        $cat_id = $request->input('cat_id');
        $cat_name = DB::table('goods_type')->where('cat_id',$cat_id)->value('cat_name');
        return view('Goods_type.goods_type_edit',['cat_id'=>$cat_id,'cat_name'=>$cat_name]);
    }
    /*
     * 商品类型修改操作
     * @param $cat_id 修改类型id
     * @param $cat_name 类型名称
     * @param $res 返回状态值 1 成功 0 失败
     */
    public function goods_type_edit_do(Request $request)
    {
            $cat_id = $request->input('cat_id');
            $cat_name = $request->input('cat_name');
            $res = DB::update('update `goods_type` set cat_name = ? where cat_id = ?',[$cat_name, $cat_id]);
            if($res)
            {
                return view('Goods_type.jump')->with([
                    'message'=>'类型修改成功',
                    'url'=>'Admin/Goods_type/goods_type_list',
                    'jumpTime'=>2
                ]);
            }else{
                return view('Goods_type.jump')->with([
                    'message'=>'网路错误',
                    'url'=>'Admin/Goods_type/goods_type_list',
                    'jumpTime'=>2
                ]);
            }
    }
    /*
     * 删除商品类型
     * @param $cat_id 商品类型id
     * @param $res 返回状态值
     */
    public function goods_type_delete(Request $request)
    {
        $cat_id = $request->input('cat_id');
        $res = DB::delete('delete from goods_type where cat_id = ?',[$cat_id]);
        if($res)
        {
            return json_encode(['code'=>200,'message'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'message'=>'删除失败']);
        }
    }
    /*
     * 状态值修改
     * @param $sataus 当前状态值
     * @param $cat_id
     */
    public function goods_type_edit_status(Request $request)
    {
        $status = $request->input('status');
        $cat_id = $request->input('cat_id');
        if($status == 1)
        {
            $status = 0;
        }else{
            $status = 1;
        }
        $res = DB::update('update `goods_type` set status = ? where cat_id = ?',[$status,$cat_id] );
        if($res)
        {
            return true;
        }else{
            return view('Goods_type.jump')->with([
                'message'=>'网路错误',
                'url'=>'Admin/Goods_type/goods_type_list',
                'jumpTime'=>2
            ]);
        }
    }
    /*
     * 商品分类列表
     */
    public function goods_category_list()
    {
        $data = DB::select("select * from `category`");
        $result = $this->getTree($data);
        foreach ($result as $key => $val) {
            $result[$key]->cat_name = str_repeat('—',$val->level).$val->cat_name;
        }
        return view('Goods_type/goods_category_list',['data'=>$result]);
    }
    /*
     * 无限极分类算法(递归)
     */
    public function getTree($array,$parent_id = 0,$level = 0)
    {
        static $list = [];
        foreach ($array as $key => $val)
        {
            if($val->parent_id == $parent_id)
            {
                $val->level = $level;
                $list[] = $val;
                unset($array[$key]);
                $this->getTree($array,$val->cat_id,$level+1);
            }
        }
        return $list;
    }
}