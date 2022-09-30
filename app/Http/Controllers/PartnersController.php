<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Ficha_Tecnica;
use App\Models\Answer_fTecnica;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as Pdf;
use File;
use Repsonse;
use Illuminate\Support\Facades\Storage;

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
            'phone' => 'required',
            'phone_emergency' => 'required'
        ]);

        $rand = rand(10, 90);
        
        $partners = new Partners;
        $partners->num_socio = $rand.date('dmY');
        $partners->name = $request->name;
        $partners->last_name = $request->last_name;
        $partners->second_lastname = $request->second_lastname;
        $partners->email = $request->email;
        $partners->age = $request->age;
        $partners->phone = $request->phone;
        $partners->phone_emergency = $request->phone_emergency;
        if($request->certificate != null) {
            $partners->certification = PartnersController::saveCertificate($request->certificate, $rand);
        }
        if($request['image-tag'] != null) {
            $partners->photo = PartnersController::savePhoto($request['image-tag'], $rand);
        }
        if($request->image != null) {
            $partners->photo = PartnersController::saveImage($request->image, $rand);
        }
        if($request->signData != null) {
            $partners->sign = PartnersController::saveSign($request->signData, $rand);
        }
        $partners->date = Carbon::now();
        $partners->save();

        $partner_num_socio = $partners->num_socio;
        $partner_name = $partners->name.' '.$partners->last_name.' '.$partners->second_lastname;
        $partner_sign = $partners->sign;

        $answers = $request->get('answers');

        PartnersController::saveFichaTecnica($answers, $partners->id);

        // $partner_num_socio = '8825092022';
        // $partner_name = 'Herman Toala Ballinas';
        // $partner_sign = 'sign25092022.jpeg';
        
        $pdf = Pdf::loadView('socios.reglamento', compact('partner_num_socio','partner_name','partner_sign'))->setPaper('a4')->setWarnings(false)->save('doc/Reglamento.pdf');
        
        $zip = new \ZipArchive();
        $fileName = 'valParaiso_Docs.zip';
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
            $files = File::files(public_path('doc'));
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName));

        // return redirect()->route('socios.index');
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
            'phone' => 'required',
            'phone_emergency' => 'required',
            'sign' => 'required'
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
            $partners->certification = PartnersController::saveCertificate($request->file('certificate'), $partners->num_socio);
        }
        if($request['image-tag'] != null) {
            $partners->photo = PartnersController::savePhoto($request['image-tag'], $partners->num_socio);
        }
        if($request->image != null) {
            $partners->photo = PartnersController::saveImage($request->file('image'), $partners->num_socio);
        }
        if($request->signData != null) {
            $partners->sign = PartnersController::saveSign($request->signData, $partners->num_socio);
        }
        $partners->date = Carbon::now();
        $partners->save();

        return redirect()->route('socios.index');
    }

    public function destroy($id)
    {
        $partners = Partners::find($id);
        $partners->delete();

        return back();
    }

    // public function makeQR(Request $request)
    // {
    //     $qr = QR::generate($request);
    //     SendMessage::message($phone)->attachText($qr);
    // }

    private function saveFichaTecnica($answers, $idPartner)
    {
        $count = 1;
        foreach($answers as $answer)
        {
            $resp = new Answer_fTecnica;
            $resp->answer = ($answer != null ? $answer : 'Ninguna');
            $resp->question_id = $count;
            $resp->partner_id = $idPartner;
            $resp->save();

            $count = $count + 1;
        }
    }

    private function saveCertificate($request, $num_socio)
    {
        $filename = 'certificate'.date('dmY_his').$num_socio.'.'.$request->getClientOriginalExtension();
        Storage::disk('public')->put($filename, $request);
        
        return $filename;
    }

    private function saveSign($request, $num_socio)
    {
        $sign = str_replace('data:image/png;base64,', '', $request);
        $signData = base64_decode($sign);
        $signName = 'sign'.date('dmY').$num_socio.'.jpeg';
        $path = public_path()."\img\\".$signName;
        file_put_contents($path, $signData);
        
        return $signName;
    }

    private function savePhoto($request, $num_socio)
    {
        $photo = str_replace('data:image/jpeg;base64,', '', $request);
        $photoData = base64_decode($photo);
        $photoName = 'photo'.date('dmY').$num_socio.'.jpeg';
        $path = public_path()."\img\\".$photoName;
        file_put_contents($path, $photoData);

        return $photoName;
    }

    private function saveImage($request, $num_socio)
    {
        $filename = 'photo'.date('dmY_his').$num_socio.'.'.$request->getClientOriginalExtension();
        $path = public_path()."\img\\".$filename;
        file_put_contents($path, $request);
        
        return $filename;
    }
}
