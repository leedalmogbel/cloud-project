<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Stable as Stable;
use Session;

class DashboardController extends Controller
{
    //
    public function index() {

        if(Auth::check()) {
            Session::flash('message', __($this->getMessage()));
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        $user = json_decode(session()->get('user'));
        $stables = Stable::withCount('horses')->get();
        
        if (session()->get('role')->role !== 'superadmin') {
            $stables = Stable::where('user_id', $user->user_id)->withCount('horses')->orderBy('stable_id', 'asc')->get();
        }

        return view('pages.dashboard', ['stables' => $stables ]);
    }
}
