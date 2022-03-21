<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Credit;
use App\Models\Payment;
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
        // $venta = SaleHasCredit::join('credits','sale_has_credits.credit_id','credits.id')
        //  ->join('sales','sale_has_credits.sale_id','sales.id')
        //  ->join('payments','sale_has_credits.id','=','payments.sale_has_credit_id')
        //  ->where('credits.client_id',$client->id)->orderByDesc('payments.id')->first();
        // $clientShop = SaleHasCredit::join('credits','sale_has_credits.credit_id','credits.id')
        //  ->join('sales','sale_has_credits.sale_id','sales.id')
        //  ->join('payments','sale_has_credits.id','=','payments.sale_has_credit_id')
        //  ->where('credits.client_id',$client->id)->paginate(5);
        $clientShop = Credit::where('client_id',$client->id)->with('sales')->get(); 
      return $clientShop;
        return view('creditos.comprasClientes',compact('clientShop','client'));
      
    }

    public function abonoCredit(Request $request, $id)
    {
        $payment = Payment::where('sale_has_credit_id',$id)->first();
        $newAmount = $payment->amount + $request->amount;
        if($newAmount > $payment->remaining){
            return 'es mucho';
        }
        else{
             $abono = Payment::create([
                 'amount' => $newAmount,
                 'remaining' => $payment->remaining - $newAmount,
                 'sale_has_credit_id' => $id
             ]);
        }
        
        return 'se abono';
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
