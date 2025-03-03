<?php

namespace App\Http\Controllers;

use App\Models\ActionHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories=ActionHistory::orderBy('id','desc')->paginate(10);
        return view('History.history',['histories'=>$histories]);
    }
}
