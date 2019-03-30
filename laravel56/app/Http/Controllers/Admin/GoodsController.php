<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{
    public function goods_list()
    {
        return view('goods.goods_list');
    }
    public function add(Request $request)
    {
        //获取商品类型
        $data=DB::select(" select * from type");
        $type=$this->type($data,$pid=0);
        //获取商品的商标
        $brand=DB::select("select * from brand");
        //获取商品的供应商
        $provider=DB::select("select * from provider");
        if($request->isMethod('POST'))
        {
            $goodData=$_POST;
            //文件上传
            $file=$request->file('goods_img');
            if($file->isValid())
            {
               //获取文件扩展名
                $exe=$file->getClientOriginalExtension();
                //获取文件的绝对路径
                $path=$file->getRealPath();
                //定义文件名称
                $filename=date('Y-m-d-h-i-s').'.'.$exe;
                //存入storage中的public下面
                $res=Storage::disk('public')->put($filename,file_get_contents($path));
                if($res)
                {
                    //进行数据的入库
                    $addRes=DB::table('goods')->insert(['goods_name'=>$goodData['goods_name'],
                                        'goods_num'=>$goodData['goods_num'],'type_id'=>$goodData['type_id'],
                                        'brand_id'=>$goodData['brand_id'], 'provider_id'=>$goodData['provider_id'],
                                        'shop_price'=>$goodData['shop_price'],'market_price'=>$goodData['market_price'],
                                        'promote_price'=>$goodData['promote_price'],'promote_start_date'=>$goodData['promote_start_date'],
                                       'promote_end_date'=>$goodData['promote_end_date'],'goods_img'=>$filename,'is_promote'=>$goodData['is_promote']
                     ]);
                }
            }


        }
       return view('goods/add',['type'=>$type,'brand'=>$brand,'provider'=>$provider]);
    }
        //实现商品无限极分类
        public function type($data,$pid=0)
      {
        //建立一个存储所有数据的数组
        $tree=array();
        //循环遍历数组
        foreach($data as $key=>$val)
        {
            if($val->pid==$pid)
            {
                $val->children=$this->type($data,$val->type_id);
                if($val->children==null)
                {
                    unset($val->children);//如果子元素为空则unset
                }
                $tree[]=$val;
            }
        }
        return $tree;
    }
}