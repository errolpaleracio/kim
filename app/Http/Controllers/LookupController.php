<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Resources\SalesResource;
use App\Sales;
use Illuminate\Support\Carbon;

class LookupController extends Controller
{
    public function branch_id()
    {
        return response()->json(['branch_id' => session('branch_id')]);
    }

    public function get(Request $request)
    {
        $product = Product::where('id', $request->id)->get();
        return new ProductResource($product);
    }

    public function get_all()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function create_sale(Request $request)
    {
        $sale = new Sales();
        $sale->sales_date = Carbon::now();
        $sale->discount = $request->input('discount');
        $sale->branch_id = session('branch_id');
        $sale->save();

        return new SalesResource($sale);
    }
}
