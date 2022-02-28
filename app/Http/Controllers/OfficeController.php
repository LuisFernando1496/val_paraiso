<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Business;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission: ver-oficina | crear-oficina | editar-oficina | borrar-oficina',['only' => ['index']]);
        $this->middleware('permission: crear-oficina',['only' => ['create','store']]);
        $this->middleware('permission: editar-oficina',['only' => ['edit','update']]);
        $this->middleware('permission: borrar-oficina',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Office::paginate(5);
        return view('office.index',compact('oficinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $negocios = Business::all();
        return view('office.crear',compact('negocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'phone' => 'required|unique:offices,phone',
            'responsable' => 'required',
            'address_id' => 'required',
            'bussiness_id' => 'required',
            'street' => 'required',
            'exterior' => 'required',
            'suburb' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        $address = new Address();
        $address->street = $request->street;
        $address->number = $request->exterior;
        $address->suburb = $request->suburb;
        $address->postal_code = $request->postal_code;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->save();

        $request['address_id'] = $address->id;
        Office::create($request->all());
        return redirect()->route('sucursales.index');

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
    public function edit(Office $oficina)
    {
        return view('office.editar',compact('oficina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        request()->validate([
            'name' => 'required',
            'phone' => 'unique:offices,phone'.$office->id,
            'responsable' => 'required',
            'address_id' => 'required',
            'bussiness_id' => 'required'
        ]);

        $office->update($request->all());
        return redirect()->route('sucursales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('sucursales.index');
    }
}
