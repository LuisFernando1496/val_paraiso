<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteCostService;
use App\Models\UserHasCashRegister;
use App\Models\UserHasCashRegisterHasCostPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-cotizaciones|crear-cotizaciones|editar-cotizaciones|borrar-cotizaciones',['only'=>['index']]);
        $this->middleware('permission:crear-cotizaciones',['only'=>['create','store']]);
        $this->middleware('permission:editar-cotizaciones',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-cotizaciones',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_cash_id' => 'required',
            'client_id' => 'required',
            'total' => 'required',
            'method' => 'required',
        ]);

        $cajauser = UserHasCashRegister::find($request->user_cash_id);
        $today = date('Y-m-d');
        $re = '/\b(\w)[^\s]*\s*/m';
        $str = $cajauser->cashregister->office->business->name;
        $subst = '$1';
        $negocio = preg_replace($re, $subst, $str);
        $re2 = '/\b(\w)[^\s]*\s*/m';
        $str2 = $cajauser->cashregister->office->name;
        $subst2 = '$1';
        $oficina = preg_replace($re2, $subst2, $str2);
        $cotis = Quote::join('user_has_cash_registers','user_has_cash_registers.id','=','quotes.user_cash_id')
        ->join('cash_registers','cash_registers.id','=','user_has_cash_registers.cash_register_id')
        ->join('offices','offices.id','=','cash_registers.office_id')->select('quotes.*')->where('offices.id','=',$cajauser->cashregister->office->id)->get();
        $numcoti = sizeof($cotis) + 1;
        $folio = "C-" . $negocio . "/" . $oficina . "-" . $numcoti;

        try {
            DB::beginTransaction();
            $cotizacion = new Quote();
            $cotizacion->folio = $folio;
            $cotizacion->date = $today;
            $cotizacion->total = $request->total;
            $cotizacion->discount = $request->discount;
            $cotizacion->percent = $request->percent;
            $cotizacion->method = 'Cotizacion';
            $cotizacion->user_cash_id = $request->user_cash_id;
            switch ($request->client_id) {
                case 'nuevo':
                    $cotizacion->cliente = $request->cliente;
                    break;
                case 'general':
                    $cotizacion->cliente = "Cliente en general";
                    break;
                default:
                    $cotizacion->client_id = $request->client_id;
                    break;
            }
            $cotizacion->save();
            $carrito = UserHasCashRegisterHasCostPrice::where('user_cash_id','=',$request->user_cash_id)->get();
            foreach ($carrito as $item) {
                $cotitem = new QuoteCostService();
                $cotitem->quote_id = $cotizacion->id;
                $cotitem->quantity = $item->quantity;
                $cotitem->discount = $item->discount;
                $cotitem->percent = $item->percent;
                if ($item->cost_price_id != null) {
                    $cotitem->cost_price_id = $item->cost_price_id;
                } else {
                    $cotitem->service_id = $item->service_id;
                }
                $cotitem->save();
                $item->delete();
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'mensaje' => 'Todo bien'
            ]);
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
