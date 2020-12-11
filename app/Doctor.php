<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name','major','birthday','sex','email','phone','address','image','info','note'
    ];


    public function caserecord(){
        return $this->hasMany('App\CaseRecord');
    }
}
