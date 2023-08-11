<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'image',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'national_id',
        'department',
    ];

    // Relationship with leave requests
    public function leaveRequests()
    {
        return $this->hasMany(EmployeesLeaveRequests::class);
    }
}
