<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sales;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_id = Auth::user()->branch_id;
        $sales = null;
        if(isset($branch_id))
            $sales = Sales::where('branch_id', $branch_id)->paginate(10);
        else
            $sales = Sales::paginate(10);
            
        return view('sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_id = Auth::user()->branch_id;
        if(isset($branch_id)){
            $products = Product::where([
                'branch_id' => $branch_id,
                'deleted' => '0'
            ])->get();
        }else{
            $products = Product::where('deleted', '0')->get();
        }
        return view('sales.sales_form')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = new Sales();
        $sale->sales_date = Carbon::now();
        $sale->discount = $request->input('discount');
        $sale->branch_id = Auth::user()->branch_id;
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


}
