<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonor extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
