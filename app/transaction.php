<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = ['user_id'];

    public function detail()
    {
        return $this->hasMany('App\transaction_detail');
    }

}


