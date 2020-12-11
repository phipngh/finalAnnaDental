<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallmentPlan extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'money','note','case_record_id'
    ];

    public function caserecord(){
        return $this->belongsTo('App\CaseRecord','case_record_id');
    }
}
