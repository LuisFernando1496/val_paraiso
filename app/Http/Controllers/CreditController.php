<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Credit;
use App\Models\SaleHasCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-creditos|crear-creditos|editar-creditos|borrar-creditos',['only'=>['index']]);
        $this->middleware('permission:crear-creditos',['only'=>['create','store']]);
        $this->middleware('permission:editar-creditos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-creditos',['only'=>['destroy']]);
    }
    public function index()
    {
        $creditos = Credit::orderBy('id','DESC')->paginate(5);
        return view('creditos.index',compact('creditos'));
    }

    public function historialCompras(Client $client)
    {
        $clientShop = SaleHasCredit::join('credits','sale_has_credits.credit_id','credits.id')
        ->where('credits.client_id',$client->id)->get();
        return $clientShop[0]->credit;
    }

    public function create()
    {
        $user = auth()->user();
        $clientes = getClients($user);
        return view('creditos.crear', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required|numeric',
        ]);
        try {
            DB::beginTransaction();
            $request['available'] = $request->amount;
            Credit::create($request->all());
            DB::commit();
            return redirect()->route('creditos.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
       
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
        //
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
