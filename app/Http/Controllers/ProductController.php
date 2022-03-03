<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-productos|crear-productos|editar-productos|borrar-productos',['only'=>['index']]);
        $this->middleware('permission:crear-productos',['only'=>['create','store']]);
        $this->middleware('permission:editar-productos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-productos',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::paginate(5);
        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::join('offices','offices.id','=','vendors.office_id')
        ->select(DB::raw("CONCAT(vendors.name, ' - ',offices.name) AS name"),'vendors.id')->pluck('name','id');
        $categorias = Category::join('offices','offices.id','=','categories.office_id')->select(DB::raw(
            "CONCAT(categories.name, ' - ',offices.name) AS name"
        ),'categories.id')->pluck('name','id');
        return view('productos.crear',compact('vendors','categorias'));
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

    public function costosver($id)
    {

    }

    public function costoscrear()
    {

    }
}
