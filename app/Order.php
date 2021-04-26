<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','recipient_name','recipient_address','number_tlp','status'];
}
