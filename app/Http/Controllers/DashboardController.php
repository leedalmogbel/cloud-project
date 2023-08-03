<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Stable as Stable;
use App\Models\Horse as Horse;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    public function index() {

        if(empty(Session::has('role'))) {
            Session::flash('message', 'Session Expired!');
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        $user = json_decode(session()->get('user'));
        $stables = Stable::withCount('horses')->with('user')->get();

        if (session()->get('role')->role !== 'superadmin') {
            $stables = Stable::where('user_id', $user->user_id)->withCount('horses')->orderBy('stable_id', 'asc')->get();
        }

        $allStables = Stable::all()->count();
        $allHorses = Horse::all()->count();

        return view('pages.dashboard', [
            'stables' => $stables,
            'role' => session()->get('role')->role,
            'allStables' => $allStables,
            'allHorses' => $allHorses
        ]);
    }


    // public function getStablesHorses(Request $request) {

    //     ## Read value
    //     $draw = $request->get('draw');
    //     $start = $request->get("start");
    //     $rowperpage = $request->get("length"); // Rows display per page

    //     $columnIndex_arr = $request->get('order');
    //     $columnName_arr = $request->get('columns');
    //     $order_arr = $request->get('order');
    //     $search_arr = $request->get('search');

    //     $columnIndex = $columnIndex_arr[0]['column']; // Column index
    //     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
    //     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
    //     $searchValue = $search_arr['value']; // Search value

    //     // Total records
    //     $totalRecords = Stable::select('count(*) as allcount')->count();
    //     $totalRecordswithFilter = Stable::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

    //     // Fetch records
    //     $records = Stable::orderBy($columnName,$columnSortOrder)
    //     ->where('stables.name', 'like', '%' . $searchValue . '%')
    //     ->orWhere('stables.owner_name', 'like', '%' . $searchValue . '%')
    //     ->orWhere('stables.foreman_name', 'like', '%' . $searchValue . '%')
    //     ->orWhereHas('horses', function ($query) use ($searchValue) {
    //             return $query
    //                 ->where('name', 'like', '%' . $searchValue . '%')
    //                 ->where('microchip_no', 'like', '%' . $searchValue . '%');
    //     })
    //     ->select('stables.*')
    //     ->skip($start)
    //     ->take($rowperpage)
    //     ->get();

    //     $data_arr = array();

    //     foreach($records as $record){
    //         $stable_no = $record->stable_no;
    //         $stable_name = $record->stable_name;
    //         $owner_name = $record->owner_name;
    //         $foreman_name = $record->foreman_name;
    //         $doctor_name = $record->user->firstname;

    //         $data_arr[] = array(
    //             "stable_no" => $stable_no,
    //             "stable_name" => $stable_name,
    //             "owner_name" => $owner_name,
    //             "foreman_name" => $foreman_name,
    //             "doctor_name" => $doctor_name,
    //         );
    //     }

    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordswithFilter,
    //         "aaData" => $data_arr
    //     );

    //     return $response;

    // }

    public function getFiles() {
        $directoryPath = public_path('c://'); //public_path("/home/eiev/eiev-app.ae/bouthib/Bouthib/");
        // $directoryPath = 'timing_files';

        
        $files = File::files(public_path('/home/eiev/eiev-app.ae/bouthib/Bouthib/'));
        
        // $directories = Storage::disk('timing_files')->files('C:\\sandbox\\'); //File::directories($directoryPath);

        // $filesPath = array();
        // foreach ($files as $file) {
        //     $filesPath[] = $file->getFilename();
        // }
        
        // Loop through directories
        // foreach ($directories as $directory) {
        //     echo basename($directory) . "\n"; // Use basename() to get the directory name
        // }
        dd($files);


    }
}
