<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    public function review()
    {
        return $this->hasOne(ApplicationReview::class);
    }

    // An application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
