<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    protected $fillable = ['sales_date', 'discount', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
