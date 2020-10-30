<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseRecord extends Model
{
    protected $fillable = [
        'name','description','note','total_fee','is_active','is_paied','is_instalment_plant',
        'doctor_id','patient_id'
    ];

    protected $casts = [
        'is_instalment_plant' => 'boolean',
        'is_active' => 'boolean',
        'is_paied' => 'boolean',
    ];

    
    public function doctor(){
        return $this->belongsTo('App\Doctor','doctor_id');
    }

    public function patient(){
        return $this->belongsTo('App\Patient','patient_id');
    }

    public function caserecorddetails(){
        return $this->hasMany('App\CaseRecordDetail');
    }

    public function installmentplans(){
        return $this->hasMany('App\InstallmentPlan');
    }

    public function process(){
        return $this->hasMany('App\Process');
    }
}
