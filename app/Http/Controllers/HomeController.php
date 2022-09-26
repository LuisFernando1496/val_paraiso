<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance_Partner;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $registers = Attendance_Partner::paginate(10);
        return view('home', compact('registers'));
    }

    public function store(Request $request)
    {
        $history = new Attendance_Partner;
        $history->date = Carbon::now();
        $history->num_socio = $request->num_socio;
        $history->save();

        return back();
    }
}
