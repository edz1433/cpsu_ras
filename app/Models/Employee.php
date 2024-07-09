<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'payroll';
    protected $table = 'employees';
    
    protected $fillable = [
        'fname', 'mname', 'lname', 'position', 'sg_step', 'qualification',
        'camp_id', 'emp_ID', 'emp_status', 'emp_dept', 'emp_salary', 'partime_rate',
        'username', 'password', 'role'
    ];


    protected $hidden = [
        'password', // Hide password from JSON output
    ];

    protected $casts = [
        'role' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->password = Hash::make($employee->password);
        });
    }
}
