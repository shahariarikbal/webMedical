<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyPatient extends Model
{
    protected $guarded = [];
    protected $dateFormat = 'd.m.Y H:i';

    //****** Relationship ******//

        public function doctor()
        {
            return $this->belongsTo(Doctor::class);
        }

    //****** Relationship ******//

    protected $dates = [
        'created_at',
        'updated_at',
        'sl_date'
    ];
}
