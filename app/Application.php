<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    public function details()
    {
        return $this->hasOne(ApplicationDetail::class);
    }
}
