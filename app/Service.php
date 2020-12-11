<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name', 'price','description','note','slug'
    ];


    public function caserecorddetail(){
        return $this->hasOne('App\CaseRecordDetail');
    }
}
