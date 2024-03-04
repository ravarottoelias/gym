<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'mst_shifts';

    protected $fillable = [
        'name',
        'slug',
        'start_at',
        'end_at',
    ];
}
