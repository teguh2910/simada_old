<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    protected $fillable = [
        'kinds_doc',
        'documents'
    ];

    protected $table = 'documents';
}
