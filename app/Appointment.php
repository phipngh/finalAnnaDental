<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    

    protected $fillable = ['name', 'email', 'phonenumber', 'date', 'note', 'is_accepted'];

    protected $casts = [
        'is_accepted' => 'boolean'
    ];

    public function calendar()
    {
        return $this->hasOne('App\Calendar');
    }
}
