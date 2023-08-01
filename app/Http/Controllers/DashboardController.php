<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Stable as Stable;
use App\Models\Horse as Horse;
use Session;

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
}
