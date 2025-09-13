<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the RFQs for this product
     */
    public function rfqs()
    {
        return $this->hasMany(Rfq::class, 'produk', 'name');
    }

    /**
     * Scope to get only active products
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
