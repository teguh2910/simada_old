<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $fillable = [
        'id_transactions',
        'pic_k',
        'npk_k',
        'dep_k',
        'komentar'
    ];

    protected $table = 'komentars';
    protected $primaryKey = 'id_komentar';
}
