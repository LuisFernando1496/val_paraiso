<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Http\Requests\StorePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;

class PartnersController extends Controller
{
   
    public function index()
    {
        return view('socios.index');
    }

    
    public function create()
    {
        return view('socios.create');
    }

   
    public function store(StorePartnersRequest $request)
    {
        //
    }

   
    public function show(Partners $partners)
    {
        //
    }

  
    public function edit(Partners $partners)
    {
        //
    }

    
    public function update(UpdatePartnersRequest $request, Partners $partners)
    {
        //
    }

   
    public function destroy(Partners $partners)
    {
        //
    }
}
