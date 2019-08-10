<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Address;
use Illuminate\Support\Facades\Auth;
use App\Store;
use App\User;

class SettingController extends Controller
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

    protected $redirectTo = '/settings/address';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    public function store()
    {
        $store = auth()->user()->store;

        return view('settings.stores.index', compact('store'));

    }

}
