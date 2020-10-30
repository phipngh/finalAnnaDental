<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    protected $fillable = [
        'money','note','case_record_id'
    ];

    public function caserecord(){
        return $this->belongsTo('App\CaseRecord','case_record_id');
    }
}
