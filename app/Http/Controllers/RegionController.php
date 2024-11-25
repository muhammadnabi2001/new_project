<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;
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
        $users=User::where('role','!=','admin')->get();
        return view('Region.regioncreate',['users'=>$users]);
    }
    public function regionstore(RegionStoreRequest $request)
    {
        //dd($request->all());
        $region=$request->validated();
        Region::create($region);
        return redirect('regions')->with('success',"Ma'lumot muvvafaqiyatli qo'shildi");
    }
    public function regionedit(Region $region)
    {
        //dd($region);
        $users=User::where('role','!=','admin')->get();
        return view('Region.regionupdate',['region'=>$region,'users'=>$users]);
    }
    public function regionupdate(RegionUpdateRequest $request, Region $region)
    {
        //dd($region);
        $data=$request->validated();
        $region->name=$data['name'];
        $region->user_id=$data['user_id'];
        $region->save();
        return redirect('regions')->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function regiondelete(Region $region)
    {
        $region->delete();
        return redirect('regions')->with('success',"Ma'lumot muvvaqiyatli o'chirildi");
    }
}
