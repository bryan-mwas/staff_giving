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

    // An application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
