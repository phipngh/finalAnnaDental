<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name','major','birthday','sex','email','phone','address','image','info','note'
    ];
}
