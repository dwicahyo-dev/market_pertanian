<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only(['create']);
    }

    protected $redirectTo = '/addresses';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::with(['city'])->where('user_id', Auth::id())->get();

        return view('addresses.index', compact('addresses'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('addresses.create', compact('cities'));
    }

    protected function rulesCreate() {
        return [
            'name_of_recipient' => 'required|string',
            'phonenumber' => 'required|numeric',
            'city_id' => 'required',
            'full_address' => 'required',
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
        $this->validate($request, $this->rulesCreate());

        Address::create([
            'user_id' => Auth::id(),
            'name_of_recipient' => $request->input('name_of_recipient'),
            'phonenumber' => $request->input('phonenumber'),
            'city_id' => $request->input('city_id'),
            'full_address' => $request->input('full_address'),
        ]);

        $request->session()->flash('success', 'Data Berhasil Disimpan');

        return redirect($this->redirectTo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        // return $address;
        return [
            'address' => $address,
            'city' => $address->city,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $this->authorize('update', $address);
        
        $cities = City::all();

        return view('addresses.edit', compact('address', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $this->validate($request, $this->rulesCreate());

        $address->update($request->all());

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        $response = [
            'success' => TRUE, 
            'message' => 'Data Alamat Pengiriman Berhasil Dihapus'
        ];

        return json_encode($response);
    }
}
