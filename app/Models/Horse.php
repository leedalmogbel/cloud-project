<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    protected $primaryKey = 'horse_id';

    protected $fillable = [
        'name',
        'colour',
        'age',
        'owner_name',
        'owner_mobile',
        'is_microchip',
        'microchip_no',
        'is_passport',
        'passport_no',
        'horse_photo',
        'passport_photo',
    ];

    public function stable() {
        return $this->belongsTo('App\Models\Stable', 'stable_id');
    }
}
