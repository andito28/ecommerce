<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_confirmation extends Model
{
    protected $fillable = ['user_id','no_rekening','nama_account','tanggal_pembayaran'];


    public function user(){
        return $this->belongsTo('App\user');
    }
}
