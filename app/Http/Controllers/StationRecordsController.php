<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StationRecordsTable;
use App\Models\StationRecordsTmpTable;
use DB;
class StationRecordsController extends Controller
{
    //
    public function index(Request $request) {

        $query = StationRecordsTable::query();
        if ($request->server_sn) {
            $query->where('server_sn', $request->server_sn);
        }

        if ($request->id_code) {
            $query->where('id_code', $request->id_code);
        }

        if ($request->loop_no) {
            $query->where('loop_no', $request->loop_no);
        }

        if ($request->start_code) {
            $query->where('start_code', $request->start_code);
        }

        if ($request->loop_order) {
            $query->orderBy('loop_no')->orderBy('start_no');
        }

        $data = $query->get();

        return response()->json(
            ['data' => $data]
        );
    }

    public function createTmpRecord(Request $request) {
        $message = 'creation success';

        $file = $request->file('file');
        $csvData = array_map(function ($row) {
            return str_getcsv($row, ';');
        }, file($file->getPathname()));
        try {
            $insertData = [];
            foreach ($csvData as $row) {
                $insertData[] = [
                    'server_ip' => isset($row[0]) ? (string)($row[0]) : '', // server_ip
                    'server_sn' => isset($row[1]) ? (string)($row[1]) : '', // server_sn
                    'id_code' => isset($row[2]) ? intval($row[2]) : '', // id_code
                    'start_no' => isset($row[3]) ? intval($row[3]) : '', // horse_no
                    'loop_no' => isset($row[4]) ? intval($row[4]) : '', // phase_no
                    'start_code' => isset($row[5]) ? (string)($row[5]) : '', // start_code
                    'station_status' => isset($row[6]) ? (string)($row[6]) : '', // station_status
                    'start_time' => isset($row[7]) ? (string)($row[7]) : '', // start_time
                    'arrival_time' => isset($row[8]) ? (string)($row[8]) : '', // arrival_time
                    'vet_1st_insp' => isset($row[9]) ? (string)($row[9]) : '', // vet_1st_insp
                    'vet_re_insp' => isset($row[10]) ? (string)($row[10]) : '', // vet_re_insp
                    'vet_re_exam' => isset($row[11]) ? (string)($row[11]) : '', // vet_re_exam
                    'departure_time' => isset($row[12]) ? (string)($row[12]) : '', // departure_time
                    'recovery_time' => isset($row[13]) ? (string)($row[13]) : '', // recovery
                    'loop_time' => isset($row[14]) ? (string)($row[14]) : '', // loop_time
                    'loop_speed' => isset($row[15]) ? (string)($row[15]) : '', // loop_speed
                    'vet_entries_1st_insp' => isset($row[16]) ? (string)($row[16]) : '',// vet_entries_1st_insp
                    'vet_entries_re_insp' => isset($row[17]) ? (string)($row[17]) : '', // vet_entries_re_insp
                    'vet_entries_re_exam' => isset($row[18]) ? (string)($row[18]) : '', // vet_entries_re_exam
                    'datetime_stamp' => isset($row[19]) ? (string)($row[19]) : '', // datetime_stamp
                    'date_stamp' => isset($row[20]) ? (string)($row[20]) : '', // date_stamp
                    'last_update_stamp' => now(), // last_update_stamp
                ];
                // dd($insertData);
            }
        } catch (\Exception $e) {
            //throw $th;
            $message = $e->getMessage();
        }

        $chunkedData = array_chunk($insertData, 25);
        // foreach ($chunkedData as $chunk) {
        //     StationRecordsTmpTable::insert($chunk);
        // }

        $uniqueColumns = ['server_ip', 'server_sn', 'loop_no', 'start_code', 'date_stamp'];

        foreach ($chunkedData as $key => $chunk) {
            DB::table('tbl_station_records')->upsert(
                $chunk,
                $uniqueColumns, // Unique columns for upsert
            );

            // $dbDateStamp = $chunk[$key]['date_stamp'];
            // $existingRecord = DB::table('tbl_station_records')
            //     ->where('server_ip', $chunk[$key]['server_ip'])
            //     ->where('server_sn', $chunk[$key]['server_sn'])
            //     ->where('loop_no', $chunk[$key]['loop_no'])
            //     ->where('start_code', $chunk[$key]['start_code'])
            //     ->where('date_stamp', '<', $dbDateStamp)
            //     ->first();

            // if (!$existingRecord) {
            //     DB::table('tbl_station_records')->upsert(
            //         [$chunk[$key]],
            //         $uniqueColumns,
            //     );
            // }
        }
        
        return response()->json(
            ['message' => $message]
        );
    }
}
