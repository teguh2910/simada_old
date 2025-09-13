<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'position',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the RFQs for this PIC
     */
    public function rfqs()
    {
        return $this->hasMany(Rfq::class, 'pic_id');
    }

    /**
     * Scope to get only active PICs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the PIC's full information
     */
    public function getFullInfoAttribute()
    {
        $info = $this->name;

        if ($this->position) {
            $info .= ' (' . $this->position . ')';
        }

        if ($this->department) {
            $info .= ' - ' . $this->department;
        }

        return $info;
    }
}
