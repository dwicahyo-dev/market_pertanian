<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only(['update', 'updatePassword']);
    }

    protected $redirectTo = '/user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('profiles.index', compact('user'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    protected function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'phonenumber' => 'required|numeric',
        ];
    }

    protected function rulesPassword() {
        return [
            'password' =>  'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        
        User::find($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phonenumber' => $request->input('phonenumber'),
            'gender' => $request->input('gender'),
        ]);

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo); 
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, $this->rulesPassword());
        
        User::find(Auth::id())->update([
            'password' => Hash::make($request->input('password')),
        ]);

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
