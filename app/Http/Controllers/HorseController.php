<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Stable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Session;

class HorseController extends Controller
{
    protected $model = 'horse';

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
    public function createHorseForm()
    {
        if(empty(Session::has('role'))) {
            Session::flash('message', 'Session Expired!');
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        return view('pages.horse.form');
    }

    public function saveForm(Request $request, string $id)
    {
        if(empty(Session::has('role'))) {
            Session::flash('message', 'Session Expired!');
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        
        $stable = Stable::where('stable_id', $id)->first();

        if (!$stable) {
            $this->flashMsg('Stable id is required', 'danger');
            return redirect()->back()->withInput();
        }

        if($validator->fails()){
            $this->flashMsg('Required Info must be filled out.', 'warning');
            return redirect()->back()->withInput();
        }

        $user = json_decode(session()->get('user'));
        
        // dd($user);
        // dd($request->file('data')[0]['passport_photo']);
        //TODO:  insert into db (eloquent)
        try {
            if (is_null($request->name)) {
                $this->flashMsg('Horse Info must be filled out atleast Horse Name.', 'warning');
                redirect()->back()->withInput();
            }

            $passport_photo_path = "";
            if($request->hasFile('passport_photo')) {
                $file = $request->file('passport_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_uuid ."/horse/";
                $file->move($destinationPath, $fileName);
                $passport_photo_path = '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName;
            }

            $horse_photo_path = "";
            if($request->hasFile('horse_photo')) {
                $file = $request->file('horse_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_uuid ."/horse/";
                $file->move($destinationPath, $fileName);
                $horse_photo_path = '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName;
            }

            $horse = new Horse;
            $horse->name = $request->name ?? '';
            $horse->colour = $request->colour ?? '';
            $horse->age = $request->age ?? '';
            $horse->owner_name = $request->owner_name ?? '';
            $horse->owner_mobile = $request->owner_mobile ?? '';
            $horse->is_microchip = $request->is_microchip ?? '1';
            $horse->microchip_no = $request->microchip_no ?? '';
            $horse->is_passport = $request->is_passport ?? '1';
            $horse->passport_no = $request->passport_no ?? '';
            $horse->horse_photo = $horse_photo_path ?? '';
            $horse->passport_photo = $passport_photo_path ?? '';
            $horse->stable_id = $stable->stable_id;
            $horse->save();

            $this->flashMsg(sprintf('Data entered successfully.'), 'success');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back();
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
        if(empty(Session::has('role'))) {
            Session::flash('message', 'Session Expired!');
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        $horse = Horse::where('horse_id', $id)->first();
        return view('pages.horse.edit', ['horse' => $horse, 'page' => 'edit']);
    }

    public function horseDetail($id)
    {
        //
        if(empty(Session::has('role'))) {
            Session::flash('message', 'Session Expired!');
            Session::flash('message_type', 'error');

            return redirect('/');
        }

        $horse = Horse::where('horse_id', $id)->first();
        return view('pages.horse.detail', ['horse' => $horse, 'page' => 'detail']);
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
        try {
            $horse = Horse::where('horse_id', $id)->first();
            if (!$horse) {
                $this->flashMsg('Horse id must be available', 'warning');
                return redirect()->back()->withInput();
            }

            $stable = Horse::where('stable_id', $horse->stable_id)->first();
            $user = json_decode(session()->get('user'));

            $horse->update([
                'name' => $request->name ?? '',
                'colour' => $request->colour ?? '',
                'age' => $request->age ?? '',
                'owner_name' => $request->owner_name ?? '',
                'owner_mobile' => $request->owner_mobile ?? '',
                'is_microchip' => $request->is_microchip ?? '1',
                'microchip_no' => $request->microchip_no ?? '',
                'is_passport' => $request->is_passport ?? '1',
                'passport_no' => $request->passport_no ?? '',
            ]);
            

            if($request->hasFile('passport_photo')) {
                $file = $request->file('passport_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_uuid ."/horse/";
                $file->move($destinationPath, $fileName);
                // $horse->passport_photo = '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName;
                $horse->update([
                    'passport_photo' => '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName
                ]);
            }


            if($request->hasFile('horse_photo')) {
                $file = $request->file('horse_photo');
                $fileName = time().rand(100,999) . $file->getClientOriginalName();
                $destinationPath = public_path(). "/img/".$user->user_id . "/stable-" . $stable->stable_uuid ."/horse/";
                $file->move($destinationPath, $fileName);
                // $horse->horse_photo = '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName;
                $horse->update([
                    'horse_photo' => '/img/'.$user->user_id."/stable-" . $stable->stable_uuid ."/horse/".$fileName
                ]);
            }

            $this->flashMsg(sprintf('Data entered successfully.'), 'success');
        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
        
        return redirect('/dashboard');
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
