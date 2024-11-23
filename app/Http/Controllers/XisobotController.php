<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Region;
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
    public function statistika()
    {
        //dd(123);
        $regions=Region::all();
        $categories=Category::all();
        $regiontopshiriqlar=RegionTopshiriq::all();
        return view('Statistika.statistika',['regiontopshiriqlar'=>$regiontopshiriqlar,'categories'=>$categories,'regions'=>$regions]);
    }
}
