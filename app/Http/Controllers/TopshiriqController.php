<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopshiriqStoreRequest;
use App\Http\Requests\TopshiriqUpdateRequest;
use App\Models\Category;
use App\Models\Javob;
use App\Models\Region;
use App\Models\RegionTopshiriq;
use App\Models\Topshiriq;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TopshiriqController extends Controller
{
    public function topshiriqlar()
    {
        $regiontopshiriqlar = RegionTopshiriq::orderBy('id', 'desc')->paginate(5);
        $barchasi = RegionTopshiriq::count();
        $twodays = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(2));
        })->get();
        $tomorrow = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(1));
        })->get();
        $today = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(0));
        })->get();
        return view('Topshiriq.topshiriq', ['regiontopshiriqlar' => $regiontopshiriqlar, 'barchasi' => $barchasi, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
    public function topshiriqcreate()
    {
        $categories = Category::all();
        $regions = Region::all();
        return view('Topshiriq.topshiriqcreate', ['categories' => $categories, 'regions' => $regions]);
    }
    public function topshiriqstore(TopshiriqStoreRequest $request)
    {
        $topshiriqData = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;

            $file->move('files/', $filename);

            $topshiriqData['file'] = $filename;
        }

        $topshiriq = Topshiriq::create($topshiriqData);

       foreach ($request->regions as $regionId) {
        $topshiriq->regions()->attach($regionId, [
            'category_id' => $request->category_id,
            'muddat' => $request->muddat,
        ]);
    }
        return redirect('topshiriqlar')->with('success', "Ma'lumot muvvafaqiyatli qo'shildi");
    }

    public function topshiriqedit(Topshiriq $topshiriq)
    {
        $categories = Category::all();
        $regions = Region::all();
        return view('Topshiriq.topshiriqupdate', ['topshiriq' => $topshiriq, 'categories' => $categories, 'regions' => $regions]);
    }
    public function topshiriqupdate(TopshiriqUpdateRequest $request, Topshiriq $topshiriq)
    {
        $data=$request->validated();

        $topshiriq->category_id = $data['category_id'];
        $topshiriq->ijrochi = $data['ijrochi'];
        $topshiriq->title = $data['title'];
        $topshiriq->description = $data['description'];
        $topshiriq->muddat = $data['muddat'];
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;
    
            $file->move(public_path('files'), $filename);
    
            $topshiriq->file = $filename;
        }

        $topshiriq->save();
        $topshiriq->regions()->sync($request->regions);

        return redirect('topshiriqlar')->with('success', "Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function topshiriqdelete(RegionTopshiriq $regiontopshiriq)
    {
        //dd($regiontopshiriq->id);
        if (!$regiontopshiriq) {
            return redirect()->back()->with('success', "Topshiriq topilmadi!");
        }
        $regiontopshiriq->delete();
        return redirect('topshiriqlar')->with('success', "Ma'lumot muvvafaqatiyatli o'chirildi");
    }
    public function calculate(int $day)
    {
        //dd($day);
        $regiontopshiriqlar = RegionTopshiriq::whereHas('topshiriq', function ($query) use ($day) {
            $query->whereDate('muddat', now()->addDays($day));
        })
            ->paginate(5);
        $barchasi = RegionTopshiriq::count();
        $twodays = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(2));
        })
            ->get();
        $tomorrow = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(1));
        })
            ->get();
        $today = RegionTopshiriq::whereHas('topshiriq', function ($query) {
            $query->whereDate('muddat', now()->addDays(0));
        })
            ->get();

        return view('Topshiriq.topshiriq', ['regiontopshiriqlar' => $regiontopshiriqlar, 'barchasi' => $barchasi, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
    public function accept(Topshiriq $topshiriq, int $id)
    {
        $region = $topshiriq->regions()->where('regions.id', $id)->first();

        if ($region) {
            $region->pivot->status = 'ochilgan';
            $region->pivot->save();
        }

        return back()->with('success', "Sizning topshirig'ingiz muvvafaqiyatli qabul qilindi");

    }
    public function filtr(Request $request)
    {
        //dd($request->all());
        $start = $request->start;
        $end = $request->end;

       
        $regiontopshiriqlar = RegionTopshiriq::whereBetween('muddat',[$start,$end])->paginate(5);

        $barchasi = RegionTopshiriq::count();
        $twodays = RegionTopshiriq::where('muddat',now()->addDays(2))->where('status','!=','approwed')->get();
        $tomorrow = RegionTopshiriq::where('muddat',now()->addDays(1))->where('status','!=','approwed')->get();
        $today = RegionTopshiriq::where('muddat',now()->addDays(0))->where('status','!=','approwed')->get();

        return view('Topshiriq.topshiriq', ['regiontopshiriqlar' => $regiontopshiriqlar, 'barchasi' => $barchasi, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
    public function boshqaruv()
    {
        $categories=Category::all();
        $regions=Region::all();
        $twodays = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(2))->count();
        $tomorrow = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(1))->count();
        $today = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(0))->count();
        $expired = RegionTopshiriq::where('muddat','<',now())->where('status','!=','approwed')->count();
        $approved = RegionTopshiriq::where('status','=','approwed')->count();
       $barchasi = RegionTopshiriq::count();


        return view('Boshqaruv.boshqaruv',['categories'=>$categories,'regions'=>$regions,'barchasi'=>$barchasi,'twodays'=>$twodays,'tomorrow'=>$tomorrow,'today'=>$today,'expired'=>$expired,'approved'=>$approved]);
    }
    public function detail(int $regionId,int $categoryId,int $day)
    {
       // dd($regionId,$category_id);
       if($day == -1)
       {
            $regiontopshiriqlar=RegionTopshiriq::where('category_id',$categoryId)->where('region_id',$regionId)->where('region_topshiriqs.muddat','<',now())->get();
           
       }
        elseif($day == 1 || $day == 2 || $day == 0)
        {
            $regiontopshiriqlar=RegionTopshiriq::where('category_id',$categoryId)->where('region_id',$regionId)->whereDate('region_topshiriqs.muddat',now()->addDays($day))->get();

        }
        else{
            $regiontopshiriqlar=RegionTopshiriq::where('category_id',$categoryId)->where('region_id',$regionId)->get();
            
           
        }
        return view("Boshqaruv.detail",['regiontopshiriqlar'=>$regiontopshiriqlar]);

    }
    public function order($query,$ask)
    {
        //dd($query,$ask);
        $categories=Category::all();
        $regions=Region::all();
        $twodays = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(2))->count();
        $tomorrow = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(1))->count();
        $today = RegionTopshiriq::where('status','!=','approwed')->whereDate('muddat',now()->addDays(0))->count();
        $expired = RegionTopshiriq::where('muddat','<',now())->where('status','!=','approwed')->count();
        $approved = RegionTopshiriq::where('status','=','approwed')->count();
        $barchasi = RegionTopshiriq::count();

        return view('Boshqaruv.boshqaruv',['categories'=>$categories,'regions'=>$regions,'barchasi'=>$barchasi,'query'=>$query,'ask'=>$ask,'twodays'=>$twodays,'tomorrow'=>$tomorrow,'today'=>$today,'expired'=>$expired,'approved'=>$approved]);
    }
}
