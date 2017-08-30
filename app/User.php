<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function application() {
        return $this->hasOne(Application::class);
    }

    public function auxiliary_application() {
        return $this->hasMany(AuxiliaryApplication::class);
    }

    // A financial aid user makes many recommendations
    public function financial_aid_recommendation()
    {
        return $this->hasMany(FinancialAidRecommendation::class);
    }

    // A staff committee member makes many recommendations
    public function staff_committee_recommendation()
    {
        return $this->hasMany(StaffCommitteeRecommendation::class);
    }

    // A user has one role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }
}
