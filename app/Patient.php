<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name','birthday','sex','email','phone','address','image','info','note'
    ];

    public function caserecords(){
        return $this->hasMany('App\CaseRecord');
    }

    
}
