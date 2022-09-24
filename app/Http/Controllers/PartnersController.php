<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartnersController extends Controller
{
   
    public function index()
    {
        $partners = Partners::paginate(10);
        return view('socios.index',compact("partners"));
    }

    
    public function create()
    {
        return view('socios.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'phone' => 'required|unique:partners,phone',
            'phone_emergency' => 'required|unique:partners,phone_emergency'
        ]);

        $rand = rand(10, 90);
        
        $partners = new Partners;
        $partner->num_socio = date('dmY').$rand;
        $partners->name = $request->name;
        $partners->last_name = $request->last_name;
        $partners->second_lastname = $request->second_lastname;
        $partners->email = $request->email;
        $partners->age = $request->age;
        $partners->phone = $request->phone;
        $partners->phone_emergency = $request->phone_emergency;
        if($request->certificate != null) {
            $partners->certification = PartnersController::saveCertificate($request->certificate);
        }
        if($request['image-tag'] != null) {
            $partners->photo = PartnersController::savePhoto($request['image-tag']);
        }
        if($request->image != null) {
            $partners->photo = PartnersController::saveImage($request->image);
        }
        if($request->signData != null) {
            $partners->sign = PartnersController::saveSign($request->signData);
        }
        $partners->date = Carbon::now();
        $partners->save();

        return redirect()->route('socios.index');
    }

   
    public function show(Partners $partners){}

  
    public function edit($id)
    {
        $partner = Partners::find($id);
        return view('socios.edit', compact("partner"));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'phone' => 'required|unique:partners,phone',
            'phone_emergency' => 'required|unique:partners,phone_emergency'
        ]);

        $partners = Partners::find($id);
        $partners->name = $request->name;
        $partners->last_name = $request->last_name;
        $partners->second_lastname = $request->second_lastname;
        $partners->email = $request->email;
        $partners->age = $request->age;
        $partners->phone = $request->phone;
        $partners->phone_emergency = $request->phone_emergency;
        if($request->certificate != null) {
            $partners->certification = PartnersController::saveCertificate($request->certificate);
        }
        if($request['image-tag'] != null) {
            $partners->photo = PartnersController::savePhoto($request['image-tag']);
        }
        if($request->image != null) {
            $partners->photo = PartnersController::saveImage($request->image);
        }
        if($request->signData != null) {
            $partners->sign = PartnersController::saveSign($request->signData);
        }
        $partners->date = Carbon::now();
        $partners->save();

        return redirect()->route('socios.index');
    }

   
    public function destroy(Partners $partners)
    {
        $partners = Partners::find($id);
        $partners->delete();

        return back();
    }

    private function saveCertificate($request)
    {
        $filename = 'certificate'.date('dmY_his').'.'.$request->getClientOriginalExtension();
        $path = public_path()."\certificados\\".$filename;
        
        return $filename;
    }

    private function saveSign($request)
    {
        $sign = str_replace('data:image/png;base64,', '', $request);
        $signData = base64_decode($sign);
        $signName = 'sign'.date('dmY').'.jpeg';
        $path = public_path()."\img\\".$signName;
        file_put_contents($path, $signData);
        
        return $signName;
    }

    private function savePhoto($request)
    {
        $photo = str_replace('data:image/jpeg;base64,', '', $request);
        $photoData = base64_decode($photo);
        $photoName = 'photo'.date('dmY').'.jpeg';
        $path = public_path()."\img\\".$photoName;
        file_put_contents($path, $photoData);

        return $photoName;
    }

    private function saveImage($request)
    {
        $filename = 'photo'.date('dmY_his').'.'.$request->getClientOriginalExtension();
        $path = public_path()."\img\\".$filename;
        
        return $filename;
    }
}
