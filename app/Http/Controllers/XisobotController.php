<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RegionTopshiriq;
use Illuminate\Http\Request;

class XisobotController extends Controller
{
    public function xisobot()
    {
        $regiontopshiriqlar=RegionTopshiriq::all();
        $categories = Category::with('topshiriqlar')->get();
        return view('Xisobot.xisobot',['categories'=>$categories,'regiontopshiriqlar'=>$regiontopshiriqlar]);
    }
}
