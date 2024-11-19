<?php

namespace App\Http\Controllers;

use App\Models\Javob;
use App\Models\Topshiriq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JavobController extends Controller
{
    public function ijro()
    {
        $region = Auth::user()->region;
        if(!$region || $region->topshiriqlar()->count() ==0)
        {
            return redirect()->back()->with('success',"Sizga hech qanday topshiriq kelib tushmagan");
        }
        
        $all = $region->topshiriqlar()->count();
        $twodays = $region->topshiriqlar()->whereDate('muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('muddat', now())->count();
        if ($region) {
            $topshiriqlar = $region->topshiriqlar()->paginate(5);

            return view('Ijro.ijro', ['topshiriqlar' => $topshiriqlar, 'all' => $all, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
        } else {
            return redirect()->back()->with('error', 'Hudud topilmadi.');
        }
    }
    public function usertopshiriq(int $day)
    {
        //dd($day);
        $region = Auth::user()->region;
        $all = $region->topshiriqlar()->count();
        $twodays = $region->topshiriqlar()->whereDate('muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('muddat', now())->count();
        $topshiriqlar = $region->topshiriqlar()->whereDate('muddat', now()->addDays($day))->paginate(5);
        return view('Ijro.ijro', ['topshiriqlar' => $topshiriqlar, 'all' => $all, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
    public function store(Request $request, Topshiriq $topshiriq)
    {
        $request->validate([
            'title' => 'required|string',
            'file' => 'nullable|file', 
            'status' => 'required|string',
            'region_id' => 'required|exists:regions,id', 
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('javoblar'); 
        }

        Javob::create([
            'topshiriq_id' => $topshiriq->id,
            'region_id' => $request->region_id,
            'title' => $request->title,
            'file' => $filePath,
            'status' => $request->status,
        ]);

        return redirect()->route('topshiriq.show', $topshiriq->id)->with('success', 'Javob muvaffaqiyatli saqlandi!');
    }
    public function begin(Topshiriq $topshiriq)
    {
        //dd($topshiriq);
        return view('Ijro.javob',['topshiriq'=>$topshiriq]);
    }
}
