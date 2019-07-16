<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    protected $table = 'sales';

    protected $fillable = ['sales_date', 'discount', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function sales_items()
    {
        return $this->hasMany('App\Sale_Item');
    }

    public function get_total()
    {
        return $this->sales_items()->sum(DB::raw('unit_price * quantity - discount'));
    }

    public function get_discount()
    {
        return $this->sales_items()->sum(DB::raw('discount'));
    }
}
