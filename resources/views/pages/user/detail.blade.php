@extends('partials.frame')
@section('content')
    <div class="content col col-md">
        <div class="container">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/users" class="btn btn-secondary me-md-2" type="button">
                    < Back to Users List </a>
            </div>
            <br />
            <h2 class="text-danger">User Detail</h2>
            <div class="user">
                <form method="post" action="{{ $form_url ?? '' }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'username',
                                'label' => 'Username',
                                'value' => $user->username ? $user->username : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter username',
                            ])
                        </div>
                        <div class="col">
                            {{-- @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'password',
                                'label' => 'Password',
                                'value' => '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter password',
                            ]) --}}
                        </div>
                    </div>

                    <br />
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'firstname',
                                'label' => 'Firstname',
                                'value' => $user->firstname ? $user->firstname : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Firstname',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'lastname',
                                'label' => 'Lastname',
                                'value' => $user->lastname ? $user->lastname : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Lastname',
                            ])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
