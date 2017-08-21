<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    public function financial_aid_recommendation()
    {
        return $this->hasOne(FinancialAidRecommendation::class);
    }

    public function staff_committee_recommendation()
    {
        return $this->hasOne(StaffCommitteeRecommendation::class);
    }

    // An application belongs to a financial aid type
    public function financial_aid_type()
    {
        return $this->belongsTo(FinancialAidType::class);
    }

    // An application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
