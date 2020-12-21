<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'birthday', 'sex', 'email', 'phone', 'address', 'image', 'info', 'note'
    ];

    public function caserecords()
    {
        return $this->hasMany('App\CaseRecord');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($patient) {
            $patient->caserecords->each->delete(); 
        });

        static::restored(function ($patient) {
            $patient->caserecords->restore(); 
        });

        // static::restoring(function($patient) {
        //     $patient->caserecords()->withTrashed()->first()->restore();
        // });
    }
}
