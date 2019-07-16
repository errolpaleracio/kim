<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Resources\SalesResource;
use App\Sales;
use App\Sale_Item;
use Illuminate\Support\Carbon;

class LookupController extends Controller
{
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
        
        $sale->branch_id = $request->input('branch_id');
        $sale->save();

        return new SalesResource($sale);
    }

    public function create_sale_item(Request $request)
    {
        $sale_item = new Sale_Item();
        $sale_item->unit_price = $request->input('unit_price');
        $sale_item->quantity = $request->input('quantity');
        $sale_item->product_id = $request->input('product_id');
        $sale_item->discount = $request->input('discount');
        $sale_item->sales_id = $request->input('sales_id');
        $sale_item->save();

        $product = Product::find($sale_item->product_id);
        $product->quantity -= $sale_item->quantity;
        $product->save();
    }

    public function get_sale_items(Request $request){
        $id = $request->id;
        $sales_items = Sale_Item::where('sales_id', $id)->with('product')->get();
        return response()->json($sales_items);
    }
}
