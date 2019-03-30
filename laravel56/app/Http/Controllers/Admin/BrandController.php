<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function brand_list()
    {
        $where = '1';
        $brand_name = Input::get('brand_name');
        if (!empty($brand_name)){
            $where = "brand_name like '%$brand_name%' ";
        }
        $count = count(DB::table('brand')->get());//总条数
        $limit = 4;//每页显示条数
        $page = Input::get('page');//当前页
        if(empty($page))
        {
            $page = 1;
        }
        $page_num = ceil($count/$limit);//总页数
        $py = ($page-1)*$limit;//偏移量
        $prev = ($page-1)>0?$page-1:1;//上一页
        $next = ($page+1)<$page_num?$page+1:$page_num;//下一页
        $data = DB::select("select * from brand where $where limit $py,$limit");
        return view('Brand/brand_list',['data'=>$data,'count'=>$count,'prev'=>$prev,'next'=>$next,'page_num'=>$page_num]);
    }
    public function brand_add()
    {
        return view('Brand/brand_add');
    }
    public function add(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $brand_logo = $request->file('brand_logo');
            if($brand_logo->isValid())
            {
                $ext = $brand_logo->getClientOriginalExtension();
                $path = $brand_logo->getRealPath();
                $filename = date('Y-m-d-H-i-s').'.'.$ext;
                Storage::disk('upload')->put($filename, file_get_contents($path));
            }
            $data['brand_logo'] = '/laravel56/public/brandpic/'.$filename;
            $res = DB::table('brand')->insert([
                'brand_name'=>$data['brand_name'],
                'brand_logo'=>$data['brand_logo'],
                'brand_desc'=>$data['brand_desc'],
                'site_url'=>$data['site_url'],
                'sort'=>$data['sort'],
                'is_show'=>$data['is_show']
            ]);
            if($res)
            {
                return redirect('Admin/Brand/brand_list');
            }
        }
    }
    public function brand_del()
    {
        $brand_id = Input::get('brand_id');
        $res = DB::delete("delete from brand where  brand_id = $brand_id");
        if ($res)
        {
            return $this->brand_list();
        }
    }
    public function brand_upd()
    {
        $brand_id = Input::get('brand_id');
        if (!empty($brand_id)){
            $where = "brand_id = $brand_id";
        }
        $res = DB::select("select * from brand where $where");
        /*print_r($res);die;
        $result = array_reduce($res, function ($result, $value) {
            return array_merge($result, array_values($value));
        }, array());

        print_r($result);die;*/
        return view('Brand/brand_upd',['res'=>$res]);
    }
}