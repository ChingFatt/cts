<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $units = Unit::has('occupants')->pluck('unit_number', 'unit_number');
        return view('home')->with(compact('units'));
    }
}
