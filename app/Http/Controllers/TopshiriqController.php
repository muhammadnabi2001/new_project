<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Region;
use App\Models\Topshiriq;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TopshiriqController extends Controller
{
    public function topshiriqlar()
    {
        $topshiriqlar = Topshiriq::orderBy('id', 'desc')->paginate(5);
        $barchasi = Topshiriq::all()->count();
        $twodays = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays(2))
            ->get();
        $tomorrow = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays(1))
            ->get();
        $today = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays(0))
            ->get();

        return view('Topshiriq.topshiriq', ['topshiriqlar' => $topshiriqlar, 'barchasi' => $barchasi, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
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
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,xls,xlsx|max:2048',
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

        $topshiriq->regions()->sync($request->regions);

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
    public function topshiriqdelete(Topshiriq $topshiriq)
    {
        //dd($topshiriq);
        $topshiriq->delete();
        return redirect('topshiriqlar')->with('success', "Ma'lumot muvvafaqatiyatli o'chirildi");
    }
    public function calculate(int $day)
    {
        //dd($day);
        $barchasi = Topshiriq::all()->count();
        $twodays = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays(2))
            ->get();
        $tomorrow = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays(1))
            ->get();
        $today = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now())
            ->get();
        $topshiriqlar = Topshiriq::whereHas('regions', function ($query) {
            $query->where('status', 'topshirildi');
        })->whereDate('muddat', now()->addDays($day))
            ->paginate(5);
        return view('Topshiriq.topshiriq', ['topshiriqlar' => $topshiriqlar, 'barchasi' => $barchasi, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }
}
