<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['order_id','product_id','qty'];


    public function User(){
        return $this->belongsTo('App\User');
    }


    public function Order(){
        return $this->belongsTo('App\Order');
    }

    public function Product(){
        return $this->belongsTo('App\product');
    }
}

