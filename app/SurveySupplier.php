<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveySupplier extends Model
{
    protected $fillable = [
        'link_form',
        'file',
        'id_supplier',
        'due_date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
