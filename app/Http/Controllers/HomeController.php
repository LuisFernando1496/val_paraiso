<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance_Partner;
use App\Models\Partners;
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
        dd($request);
        $numSocio = explode(',', $request->num_socio);
        $history = new Attendance_Partner;
        $history->date = Carbon::now();
        $history->num_socio = $request->num_socio;
        $history->name = Partners::select('name')->where('num_socio', $request->num_socio)->get();
        $history->lastname = Partners::select('last_name')->where('num_socio', $request->num_socio)->get();
        $history->second_lastname = Partners::select('second_lastname')->where('num_socio', $request->num_socio)->get();
        $history->save();

        return back();
    }
}
