<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable =[
        'note','case_record_id'
    ];

    public function caserecord(){
        return $this->belongsTo('App\CaseRecord','case_record_id');
    }

    public function prescriptions(){
        return $this->hasMany('App\Prescription');
    }
}
