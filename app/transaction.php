<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'project',
        'due_date',
        'supplier',
        'part_number',
        'status',
        'id_document',
        'file',
        'revise',
        'pic',
        'npk',
        'is_need'
    ];

    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
}
