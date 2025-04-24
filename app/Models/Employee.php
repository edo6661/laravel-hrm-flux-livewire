<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'designation_id'
    ];
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function department()
    {
        return $this->designation->department;
    }
    public function company()
    {
        return $this->throughDestination()->department->company;
    }
    public function scopeInCompany($query)
    {
        return $query->whereHas('designation', function ($q) {
            $q->inCompany();
        });
    }
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
    public function getActiveContract($start_date = null, $end_date = null, $exclude_id = null)
    {
        $start_date = $start_date ?? now();
        $end_date = $end_date ?? now();
        return $this->contracts()
            ->when($exclude_id, function ($query) use ($exclude_id) {
                return $query->where('id', '!=', $exclude_id);
            })
            ->where(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $end_date)
                    ->where('end_date', '>=', $start_date);
            })
            ->first();
    }
}
