<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'note', 'case_record_id'
    ];

    public function caserecord()
    {
        return $this->belongsTo('App\CaseRecord', 'case_record_id');
    }

    public function prescriptiondetail()
    {
        return $this->hasMany('App\PrescriptionDetail');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($pres) {
            $pres->prescriptiondetail()->delete();
        });
        static::restored(function ($pres) {
            $pres->prescriptiondetail()->restore();
        });
    }
}
