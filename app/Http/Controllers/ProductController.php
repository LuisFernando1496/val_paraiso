<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorHasProduct;
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
        $this->validate($request,[
            'bar_code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'mark' => 'required',
            'vendor_id' => 'required',
            'category_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->bar_code = $request['bar_code'];
            $product->name = $request['name'];
            $product->description = $request['description'];
            $product->mark = $request['mark'];
            $product->category_id = $request['category_id'];
            $product->save();
            $request['product_id'] = $product->id;
            VendorHasProduct::create($request->all());
            DB::commit();
            return redirect()->route('productos.index');
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
        $producto = Product::find($id);
        $vendors = Vendor::join('offices','offices.id','=','vendors.office_id')
        ->select(DB::raw("CONCAT(vendors.name, ' - ',offices.name) AS name"),'vendors.id')->pluck('name','id');
        $categorias = Category::join('offices','offices.id','=','categories.office_id')->select(DB::raw(
            "CONCAT(categories.name, ' - ',offices.name) AS name"
        ),'categories.id')->pluck('name','id');
        return view('productos.editar',compact('producto','vendors','categorias'));
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
        $this->validate($request,[
            'bar_code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'mark' => 'required',
            'vendor_id' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Product::find($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function costosver($id)
    {

    }

    public function costoscrear()
    {

    }
}
