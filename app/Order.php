<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','recipient_name','recipient_address','number_tlp','status'];

    public function User(){
        return $this->belongsTo('App\User');
    }


    public function Order_detail(){
        return $this->hasMany('App\Order_detail');
    }
}

