<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    protected $fillable = [
        'customer',
        'produk',
        'std_qty',
        'drawing_time',
        'OTS_Target',
        'OTOP_target',
        'SOP',
        'part_number',
        'part_name',
        'qty_month',
        'note',
        'due_date',
        'pic_id',
        'id_supplier',
        'drawing_file',
        'excel_term_file',
        'loading_capacity_file'
    ];

    protected $casts = [
        'pic_id' => 'integer',
        'drawing_time' => 'date',
        'OTS_Target' => 'date',
        'OTOP_target' => 'date',
        'SOP' => 'date',
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
     * Get the PIC (Person In Charge) for this RFQ
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
