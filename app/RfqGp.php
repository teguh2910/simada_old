<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqGp extends Model
{
    protected $fillable = [
        'spec',
        'ex_rate',
        'qty_month',
        'satuan',
        'id_supplier'
    ];

    protected $casts = [
        'ex_rate' => 'decimal:4',
        'qty_month' => 'integer'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function getSuppliersAttribute()
    {
        if ($this->id_supplier) {
            $supplierIds = json_decode($this->id_supplier, true);
            if (is_array($supplierIds)) {
                return Supplier::whereIn('id', $supplierIds)->get();
            } elseif (is_numeric($supplierIds)) {
                return Supplier::where('id', $supplierIds)->get();
            }
        }
        return collect();
    }

    public function getSuppliersFormattedAttribute()
    {
        $suppliers = $this->suppliers;
        if ($suppliers->count() > 0) {
            return implode(', ', $suppliers->pluck('name')->toArray());
        }
        return '-';
    }
}
