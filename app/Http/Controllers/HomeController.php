<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agriculture;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $agricultures = Agriculture::with('commodity')->limit(10)->get();

        return view('home', compact('agricultures'));
    }
}
