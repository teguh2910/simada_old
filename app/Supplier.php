<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'pic',
        'no_hp',
        'email',
        'presdir',
        'alamat',
        'no_telp',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the RFQs for this supplier
     */
    public function rfqs()
    {
        return $this->hasMany(Rfq::class, 'id_supplier', 'name');
    }

    /**
     * Scope to get only active suppliers
     */
    public function scopeActive($query)
    {
        try {
            return $query->where('is_active', true);
        } catch (\Exception $e) {
            // If is_active column doesn't exist, return all records
            return $query;
        }
    }
}
