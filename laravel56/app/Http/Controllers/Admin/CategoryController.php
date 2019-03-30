<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
        public function cat_list()
        {
            $data= DB::select('select * from category ');

            return view('Category.cat_list',['data'=>$data]);
        }
}