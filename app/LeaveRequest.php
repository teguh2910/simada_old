<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id',
        'leave_date',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'approval_notes'
    ];

    protected $casts = [
        'leave_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user who requested the leave
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who approved the leave
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope to get only pending leave requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get only approved leave requests
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get only rejected leave requests
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to get today's leave requests
     */
    public function scopeToday($query)
    {
        return $query->whereDate('leave_date', Carbon::today());
    }

    /**
     * Scope to get leave requests for a specific date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('leave_date', $date);
    }
}
