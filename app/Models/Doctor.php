<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];

    //****** Relationship ******//

    public function dailyPatients()
    {
        return $this->hasMany(DailyPatient::class, 'doctor_id', 'id');
    }

    //****** Relationship ******//
}
