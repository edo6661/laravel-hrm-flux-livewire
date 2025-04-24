<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user', 'company_id', 'user_id');
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function designations()
    {
        return $this->throughDepartments()->hasDesignations();
    }
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-logo.jpg');
    }
    public function scopeForUser($query)
    {
        return $query->whereHas('users', function ($q) {
            $q->where('id', Auth::user()->id);
        });
    }
}
