<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffCommitteeRecommendation extends Model
{
    /**
    
    */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
