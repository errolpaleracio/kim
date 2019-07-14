<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
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

        $products = null;
        if(isset($branch_id)){
            $products = Product::where([
                'branch_id' => $branch_id,
                'deleted' => '0'
            ])->paginate(10);
        }
        else
            $products = Product::where('deleted', '0')->paginate(10);
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.product_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => 'required',
                'unit_price' => 'required|numeric',
                'quantity' => 'integer|required_if:id,',
                'critical_lvl' => 'required|integer'
            ]
        );

        $product = null;
        if(isset($request->id)){
            $product = Product::find($request->id);
        }else{
            $product = new Product();
        }
        
        $data = $request->only($product->getFillable());
        $product->fill($data);
        $product->branch_id = Auth::user()->branch_id;

        $product->save();
        return redirect('/products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.product_form')->with('product', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $productToDelete = Product::find($id);
        $productToDelete->deleted = '1';
        $productToDelete->save();
        return redirect('/products');
    }

    public function show_restock(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        return view('product.restock')->with('product', $product);
    }

    public function restock(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $product->quantity += $request->restock_quantity;
        $product->save();

        return redirect(route('products.index'));
    }
}
