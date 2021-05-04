<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_confirmation extends Model
{
    protected $fillable = ['user_id','order_id','no_rekening','nama_account','tanggal_pembayaran'];


    public function User(){
        return $this->belongsTo('App\user');
    }

    public function Order(){
        return $this->belongsTo('App\Order');
    }
}
