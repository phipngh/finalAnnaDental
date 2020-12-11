<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','slug','manufacturer','dose','description','note','image','price',
    ];
}
