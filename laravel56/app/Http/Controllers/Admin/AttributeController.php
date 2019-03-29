<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AttributeController extends Controller{
    public function attribute_list()
    {
        //查询数据库总条数
        $count = count(Db::table('attribute')->get());
       //设置每页显示的条数
        $rev = 3;
        //总页数
        $sum = ceil($count/$rev);
        //当前页
        $page = Input::get('page');
        if(empty($page))
        {
           $page = 1;
        }
       //上一页   下一页
        $prev = ($page-1)>0?$page-1:1;
        $next = ($page+1)<$sum ? $page+1:$sum;
        //偏移量
        $offset = ($page-1)*$rev;
        $data = DB::select("select * from attribute limit $offset,$rev");
        return view('attribute/attribute_list',['data'=>$data,'page'=>$page,'prev'=>$prev,'next'=>$next,'sum'=>$sum]);
    }
       public function attribute_add()
    {
        return view('attribute/attribute_add');
    }
    public function attribute_edit()
    {
        return view('attribute/attribute_edit');
    }
    public function arrtibute_del($id)
    {
       $res = DB::table('attribute')->where('attr_id',$id)->delete();
       if($res)
       {
            return redirect('Admin/Attribute/attribute_list');
       }
    }
    //属性添加
    public function attribute()
    {
        $attr_name = $_POST['attr_name'];
        $goods_type = $_POST['goods_type'];
        $attr_index = $_POST['attr_index'];
        $is_linked = $_POST['is_linked'];
        $attr_type = $_POST['attr_type'];
        $attr_input_type = $_POST['attr_input_type'];
        $res = DB::table('attribute')->insert(['attr_name'=>$attr_name,'goods_type'=>$goods_type,'attr_index'=>$attr_index,'is_linked'=>$is_linked,'attr_type'=>$attr_type,'attr_input_type'=>$attr_input_type]);
        if($res)
        {
            return redirect('Admin/Attribute/attribute_list');
        }
    }
}