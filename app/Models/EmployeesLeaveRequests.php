<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesLeaveRequests extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_type',
        'duration',
        'duration_unit',
        'start_date',
        'end_date',
        'leave_reason',
        'status',
        'deny_reason',
        'employee_id',
    ];

    // Relationship with employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForEmployee(Builder $query, $email)
    {
        return $query->whereHas('employee', function ($query) use ($email) {
            $query->where('email', $email);
        });
    }


    // Relationship with leave type
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type', 'name');
    }
}
