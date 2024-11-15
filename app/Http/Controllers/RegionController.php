<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function regions()
    {
        $regions=Region::orderBy('id','desc')->get();
        return view('Region.region',['regions'=>$regions]);
    }
    public function regioncreate()
    {
        $users=User::all();
        return view('Region.regioncreate',['users'=>$users]);
    }
    public function regionstore(Request $request)
    {
        //dd($request->all());
        $region=$request->validate([
            'user_id'=>'required',
            'name'=>'required|max:255'
        ]);
        Region::create($region);
        return redirect('regions')->with('success',"Ma'lumot muvvafaqiyatli qo'shildi");
    }
    public function regionedit(Region $region)
    {
        //dd($region);
        $users=User::all();
        return view('Region.regionupdate',['region'=>$region,'users'=>$users]);
    }
    public function regionupdate(Request $request, Region $region)
    {
        //dd($region);
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'name'=>'required|max:255'
        ]);
        $region->name=$request->name;
        $region->user_id=$request->user_id;
        $region->save();
        return redirect('regions')->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function regiondelete(Region $region)
    {
        $region->delete();
        return redirect('regions')->with('success',"Ma'lumot muvvaqiyatli o'chirildi");
    }
}
