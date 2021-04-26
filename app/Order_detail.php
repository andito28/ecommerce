<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['order_id','product_id','qty'];


    public function User(){
        return $this->belongsTo('App\User');
    }


    public function Order_detail(){
        return $this->belongsTo('App\Order_detail');
    }
}

