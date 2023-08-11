<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Relationship with leave requests
    public function leaveRequests()
    {
        return $this->hasMany(EmployeesLeaveRequests::class);
    }
}
