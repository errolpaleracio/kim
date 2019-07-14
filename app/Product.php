<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'unit_price', 'quantity', 'critical_lvl', 'branch_id', 'deleted'];
}
