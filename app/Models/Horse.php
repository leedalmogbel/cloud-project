<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    public function stable() {
        return $this->belongsTo('App\Models\Stable', 'stable_id');
    }
}
