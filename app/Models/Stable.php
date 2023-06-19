<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stable extends Model
{
    use HasFactory;

    const MODEL_VALIDATOR = 'App\Validators\Stable';

    protected $primaryKey = 'stable_id';

    protected $fillable = [
        'name',
        'owner_name',
        'owner_eid',
        'owner_eid_photo',
        'owner_mobile',
        'foreman_name',
        'foreman_eid',
        'foreman_eid_photo',
        'foreman_mobile',
        'total_horses',
        'user_id',
        'remarks'
    ];


    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function horses() {
        return $this->hasMany('App\Models\Horse', 'stable_id');
    }
}
