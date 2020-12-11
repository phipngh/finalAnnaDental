<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseRecord extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($cr) {
            $cr->caserecorddetails()->delete();
            $cr->installmentplans()->delete();
            $cr->process()->delete();
            $cr->prescription->each->delete();
        });

        static::restored(function ($cr) {
            $cr->caserecorddetails()->restore();
            $cr->installmentplans()->restore();
            $cr->process()->restore();
            $cr->prescription->each->restore();
        });
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

    public function prescription(){
        return $this->hasMany('App\Prescription');
    }
}
