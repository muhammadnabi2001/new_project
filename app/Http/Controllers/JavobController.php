<?php

namespace App\Http\Controllers;

use App\Models\Javob;
use App\Models\RegionTopshiriq;
use App\Models\Topshiriq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JavobController extends Controller
{
    public function vazifa()
    {
        $region = Auth::user()->region;
        if (!$region || $region->topshiriqlar()->count() == 0) {
            return redirect()->back()->with('success', "Sizga hech qanday topshiriq kelib tushmagan");
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
    public function view(Topshiriq $topshiriq)
    {
        //dd($topshiriq);
        return view('Ijro.view', ['topshiriq' => $topshiriq]);
    }
    public function bajarish(Request $request, Topshiriq $topshiriq)
    {
        $regionTopshiriq = RegionTopshiriq::where('region_id', Auth::user()->region->id)
            ->where('topshiriq_id', $topshiriq->id)
            ->first();
        $regionTopshiriq->status = "bajarildi";
        $regionTopshiriq->save();
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,xls,xlsx|max:2048',
        ]);
        $javob=new Javob();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;

            $file->move(public_path('files'), $filename);
            $javob->file=$filename;
        }
        $javob->region_id= Auth::user()->region->id;
        $javob->topshiriq_id=$topshiriq->id;
        $javob->title=$request->title;
        $javob->status='kutilmoqda';
        $javob->izoh='null';
        $javob->save();
        
        return redirect()->back()->with('success', "Sizning bajargan vazifangiz muvvafaqiyatli junatildi");
    }

    public function sort(Request $request)
    {
        //dd($request->all());
        $region = Auth::user()->region;
        if (!$region || $region->topshiriqlar()->count() == 0) {
            return redirect()->back()->with('success', "Sizga hech qanday topshiriq kelib tushmagan");
        }

        $all = $region->topshiriqlar()->count();
        $twodays = $region->topshiriqlar()->whereDate('muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('muddat', now())->count();
        if ($region) {
            $topshiriqlar = $region->topshiriqlar()
            ->whereBetween('topshiriqs.muddat', [$request->start, $request->end]) // 'topshiriqs.created_at' deb to'liq ko'rsating
            ->paginate(5);
        

            return view('Ijro.ijro', ['topshiriqlar' => $topshiriqlar, 'all' => $all, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
        } else {
            return redirect()->back()->with('error', 'Hudud topilmadi.');
        }
    }
    public function natija()
    {
        //dd(1233);
        $javoblar = Javob::orderBy('id','desc')->paginate(5);
        return view('Natija.natija',['javoblar'=>$javoblar]);
    }
    public function filtrnatija(Request $request)
    {
        //dd($request->all());
        $javoblar = Javob::orderBy('id','desc')->whereBetween('created_at',[$request->start,$request->end])->paginate(5);
        return view('Natija.natija',['javoblar'=>$javoblar]);
    }
}
