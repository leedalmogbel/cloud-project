<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationRecordsTable extends Model
{
    use HasFactory;
    protected $table = 'tbl_station_records';
    protected $fillable = [
        'server_ip',
        'server_sn',
        'id_code',
        'start_no',
        'loop_no',
        'start_code',
        'station_status',
        'start_time',
        'arrival_time',
        'vet_1st_insp',
        'vet_re_insp',
        'vet_re_exam',
        'departure_time',
        'vet_entries_1st_insp',
        'vet_entries_re_insp',
        'vet_entries_re_exam',
        'date_stamp',
        'datetime_stamp',
    ];
    public $timestamps = false;
}
