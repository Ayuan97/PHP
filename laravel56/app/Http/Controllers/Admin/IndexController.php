<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('Index/index');
    }
    public function menu()
    {
        return view('index/menu');
    }
    public function main()
    {
        return view('index/main');
    }
    public function top()
    {
        return view('index/top');
    }
    public function drag()
    {
        return view('index/drag');
    }
}