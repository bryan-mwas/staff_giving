<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    // An application type has many auxiliary applications associated with it.
    public function auxiliary_applications()
    {
        return $this->hasMany(AuxiliaryApplication::class);
    }
}
