<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationDetail extends Model
{
    /**
    
    */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
