<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    protected $fillable = ['transaction_id','product_id','qty'];


    public function transaction()
    {
        return $this->belongsTo('App\transaction');
    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
}


