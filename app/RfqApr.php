<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqApr extends Model
{
    protected $fillable = [
        'spec_rm',
        'periode',
        'due_date',
        'id_supplier',
        'note',
        'pic_id',
        'status'
    ];

    protected $casts = [
        'pic_id' => 'integer',
        'due_date' => 'date',
    ];

    /**
     * Get the suppliers as an array
     */
    public function getSuppliersAttribute()
    {
        return $this->id_supplier ? json_decode($this->id_supplier, true) : [];
    }

    /**
     * Get the suppliers as a formatted string
     */
    public function getSuppliersFormattedAttribute()
    {
        $suppliers = $this->suppliers;
        return is_array($suppliers) ? implode(', ', $suppliers) : $this->id_supplier;
    }

    /**
     * Get the PIC (Person In Charge) for this RFQ APR
     */
    public function pic()
    {
        return $this->belongsTo(Pic::class, 'pic_id');
    }

    /**
     * Get the PIC name
     */
    public function getPicNameAttribute()
    {
        return $this->pic ? $this->pic->name : 'N/A';
    }

    /**
     * Get the PIC full information
     */
    public function getPicInfoAttribute()
    {
        return $this->pic ? $this->pic->full_info : 'N/A';
    }
}
