<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Squire\Models\Country;

class Contact extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'orgnatization_id');
    }

    public function countryName()
    {
        return $this->belongsTo(Country::class, 'country');
    }
}
