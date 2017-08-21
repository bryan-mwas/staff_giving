<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuxiliaryApplication extends Model
{
    //
    public function application_type()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    // An auxiliary application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
