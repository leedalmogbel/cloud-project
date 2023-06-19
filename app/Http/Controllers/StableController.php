<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\Models\Stable as Stable;
use App\Models\Horse as Horse;

use Session;

class StableController extends Controller
{
    protected $model = 'stable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStableForm()
    {
        //

        if(Auth::check()) {
            Session::flash('message', __($this->getMessage()));
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        return view('pages.stable.form');
    }

    public function saveForm(Request $request)
    {
        //

        // if(Auth::check()) {
        //     Session::flash('message', __($this->getMessage()));
        //     Session::flash('message_type', 'error');

        //     return redirect('/');
        // }

        $validator = Validator::make($request->all(),[
            'stable_no' => 'required',
            'name' => 'required',
            'owner_name' => 'required',
            'owner_mobile' => 'required',
            'owner_eid' => 'required',
            'foreman_name' => 'required',
            'foreman_mobile' => 'required',
            'foreman_eid' => 'required',
            'total_horses' => 'required',
            'owner_eid_photo' => 'required|image',
            'foreman_eid_photo' => 'nullable|image',
        ]);

        if($validator->fails()){
            $this->flashMsg('Required Info must be filled out.', 'warning');
            return redirect(URL::current());
        }



        $user = json_decode(session()->get('user'));
        
        // dd($user);
        // dd($request->file('data')[0]['passport_photo']);
        //TODO:  insert into db (eloquent)
        try {

            $owner_eid_photo_path = "";
            if($request->hasFile('owner_eid_photo')) {
                $file = $request->file('owner_eid_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $request->stable_no;
                $file->move($destinationPath, $fileName);
                $owner_eid_photo_path = '/img/'.$user->user_id."/stable-" . $request->stable_no ."/".$fileName;
            }

            $foreman_eid_photo_path = "";
            if($request->hasFile('foreman_eid_photo')) {
                $file = $request->file('foreman_eid_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $request->stable_no;
                $file->move($destinationPath, $fileName);
                $foreman_eid_photo_path = '/img/'.$user->user_id."/stable-" . $request->stable_no ."/".$fileName;
            }
            

            $stable = new Stable;
            $stable->stable_no = $request->stable_no;
            $stable->name = $request->name;
            $stable->owner_name = $request->owner_name;
            $stable->owner_mobile = $request->owner_mobile;
            $stable->owner_eid = $request->owner_eid;
            $stable->owner_eid_photo =  $owner_eid_photo_path;
            $stable->foreman_name = $request->foreman_name;
            $stable->foreman_mobile = $request->foreman_mobile;
            $stable->foreman_eid = $request->foreman_eid;
            $stable->foreman_eid_photo = $foreman_eid_photo_path;
            $stable->total_horses = $request->total_horses;
            $stable->user_id = $user->user_id;

            $stable->save();

            $data = $request->data;
            foreach ($data as $key => $value) {

                $passport_photo_path = "";
                if($request->file('data')[$key]['passport_photo']) {
                    $file = $request->file('data')[$key]['passport_photo'];
                    $fileName = time().rand(100,999) . $file->getClientOriginalName();
                    $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_id ."/horse/";
                    $file->move($destinationPath, $fileName);
                    $passport_photo_path = '/img/'.$user->user_id."/stable-" . $stable->stable_id ."/horse/".$fileName;
                }

                $horse_photo_path = "";
                if($request->file('data')[$key]['horse_photo']) {
                    $file = $request->file('data')[$key]['horse_photo'];
                    $fileName = time().rand(100,999) . $file->getClientOriginalName();
                    $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_id ."/horse/";
                    $file->move($destinationPath, $fileName);
                    $horse_photo_path = '/img/'.$user->user_id."/stable-" . $stable->stable_id ."/horse/".$fileName;
                }

                $data[$key]['stable_id'] = $stable->stable_id;
                $data[$key]['passport_photo'] = $passport_photo_path;
                $data[$key]['horse_photo'] = $horse_photo_path;
            }

            Horse::insert($data);

            $this->flashMsg(sprintf('Data entered successfully.'), 'success');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        if(Auth::check()) {
            Session::flash('message', __($this->getMessage()));
            Session::flash('message_type', 'error');

            return redirect('/');
        }
        
        $stable = Stable::where('stable_id', $id)->with('horses')->first();
        return view('pages.stable.detail', ['stable' => $stable, 'page' => 'detail']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
