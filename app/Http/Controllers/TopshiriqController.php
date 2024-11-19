<?php

namespace App\Http\Controllers;

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
    public function topshiriqstore(Request $request)
    {
        $topshiriqData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'ijrochi' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,jpeg,pdf,docx,xls,xlsx|max:2048',
            'muddat' => 'required|date',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;

            $file->move('files/', $filename);

            $topshiriqData['file'] = $filename;
        }

        $topshiriq = Topshiriq::create($topshiriqData);

        $topshiriq->regions()->attach($request->regions);

        return redirect('topshiriqlar')->with('success', "Ma'lumot muvvafaqiyatli qo'shildi");
    }

    public function topshiriqedit(Topshiriq $topshiriq)
    {
        $categories = Category::all();
        $regions = Region::all();
        return view('Topshiriq.topshiriqupdate', ['topshiriq' => $topshiriq, 'categories' => $categories, 'regions' => $regions]);
    }
    public function topshiriqupdate(Request $request, Topshiriq $topshiriq)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'ijrochi' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,xls,xlsx|max:2048',
            'muddat' => 'required|date',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
        ]);

        $topshiriq->category_id = $request->category_id;
        $topshiriq->ijrochi = $request->ijrochi;
        $topshiriq->title = $request->title;
        $topshiriq->description = $request->description;
        $topshiriq->muddat = $request->muddat;

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
    public function topshiriqdelete(int $id)
    {
        //dd($topshiriq);
        $topshiriq=RegionTopshiriq::findOrFail($id);
        $topshiriq->delete();
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

        $regiontopshiriqlar = RegionTopshiriq::whereHas('topshiriq', function ($query) use ($start, $end) {
            $query->whereBetween('muddat', [$start, $end]);
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
}
