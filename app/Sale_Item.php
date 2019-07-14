<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_Item extends Model
{
    protected $table = 'sale_items';

    protected $fillable = ['quantity', 'unit_price', 'product_id', 'sales_id'];

    public function sale()
    {
        return $this->belongsTo('App\Sales');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
