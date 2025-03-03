<?php

namespace App\Http\Controllers;

use App\Http\Requests\BajarishRequest;
use App\Http\Requests\JavobStoreRequest;
use App\Models\Javob;
use App\Models\Region;
use App\Models\RegionTopshiriq;
use App\Models\Topshiriq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JavobController extends Controller
{
    public function vazifa()
    {
        if(!Auth::user())
        {
            return redirect()->route('/');
        }
        $region = Auth::user()->region;
        if (!$region || $region->topshiriqlar()->count() == 0) {
            return redirect()->route('yourself')->with('success', "Sizga hech qanday topshiriq kelib tushmagan");
        }
        $all = $region->topshiriqlar()->count();
        $twodays = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now())->count();
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
        $twodays = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now())->count();
        $topshiriqlar = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays($day))->paginate(5);
        return view('Ijro.ijro', ['topshiriqlar' => $topshiriqlar, 'all' => $all, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
    public function store(JavobStoreRequest $request, Topshiriq $topshiriq)
    {
        $data=$request->validated();

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('javoblar');
        }

        Javob::create([
            'topshiriq_id' => $topshiriq->id,
            'region_id' => $data['region_id'],
            'title' => $data['title'],
            'file' => $filePath,
            'status' => $data['status'],
        ]);

        return redirect()->route('topshiriq.show', $topshiriq->id)->with('success', 'Javob muvaffaqiyatli saqlandi!');
    }
    public function view(Topshiriq $topshiriq)
    {
        //dd($topshiriq);
        $regiontopshiriq=RegionTopshiriq::where('topshiriq_id',$topshiriq->id)->first();
        return view('Ijro.view', ['regiontopshiriq' => $regiontopshiriq]);
    }
    public function bajarish(BajarishRequest $request, Topshiriq $topshiriq)
    {
        $regionTopshiriq = RegionTopshiriq::where('region_id', Auth::user()->region->id)
            ->where('topshiriq_id', $topshiriq->id)
            ->first();
        $regionTopshiriq->status = "bajarildi";
        $regionTopshiriq->save();
       $data= $request->validated();
        $javob = Javob::updateOrCreate(
            [
                'region_id' => Auth::user()->region->id,
                'topshiriq_id' => $topshiriq->id,
            ],
            [
                'title' => $data['title'],
                'status' => 'kutilmoqda',
            ]
        );
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;
    
            $file->move(public_path('files'), $filename);
            $javob->file = $filename;
        }
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
        $twodays = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(2))->count();
        $tomorrow = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now()->addDays(1))->count();
        $today = $region->topshiriqlar()->whereDate('topshiriqs.muddat', now())->count();
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
    public function qabul(Javob $javob)
    {
        //dd($javob);
        $topshiriq = RegionTopshiriq::where('region_id',$javob->region_id)->where('topshiriq_id',$javob->topshiriq_id)->first();
        $topshiriq->status='approwed';
        $javob->status='approwed';
        $topshiriq->save();
        $javob->save();
        return redirect()->back()->with('success',"Topshiriq muvvafaqiyatli qabul qilindi");
    }
    public function reject(Request $request,Javob $javob)
    {
        //dd($javob->status);
        //dd($request->all());
        $request->validate([
            'izoh'=>'required|max:255'
        ]);
        $topshiriq = RegionTopshiriq::where('region_id',$javob->region_id)->where('topshiriq_id',$javob->topshiriq_id)->first();
        $topshiriq->status='topshirildi';
        $javob->status='rejected';
        $javob->izoh=$request->izoh;
        $topshiriq->save();
        $javob->save();
       // dd($javob->izoh);
        return redirect()->back()->with('success',"Topshiriq muvvafaqiyatli qaytarilidi");
    }
}
