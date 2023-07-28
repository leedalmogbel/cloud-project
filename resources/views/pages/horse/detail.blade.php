@extends('partials.frame')
@section('content')
    <div class="content col col-md">
        <div class="container">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/dashboard" class="btn btn-secondary me-md-2" type="button">
                    < Back to Dashboard </a>
            </div>
            <br />
            <h2 class="text-danger">Horse</h2>
            <div class="stable">
                <form method="post" action="{{ $form_url ?? '' }}" enctype="multipart/form-data">
                    @csrf
                    {{-- start: horse info --}}
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'name',
                                'value' => $horse->name ? $horse->name : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Name',
                                'placeholder' => 'Enter Horse name',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'colour',
                                'value' => $horse->colour ? $horse->colour : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Colour',
                                'placeholder' => 'Enter Horse Colour',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'age',
                                'value' => $horse->age ? $horse->age : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Age',
                                'placeholder' => 'Enter Horse Age',
                            ])
                        </div>
                    </div>
                    {{-- end: horse info --}}

                    {{-- start: owner --}}
                    <br />
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'owner_name',
                                'value' => $horse->owner_name ? $horse->owner_name : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Owner Name',
                                'placeholder' => 'Enter Owner name',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'owner_mobile',
                                'value' => $horse->owner_mobile ? $horse->owner_mobile : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Owner Mobile',
                                'placeholder' => 'Enter Owner Mobile',
                            ])
                        </div>
                    </div>
                    {{-- end: owner --}}

                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.selectFormGroup', [
                                'label' => 'Is there a Microchip?',
                                'name' => 'is_microchip',
                                'required' => true,
                                'placeholder' => 'Select',
                                'className' => 'horse-select select-2-basic',
                                'keyValue' => true,
                                'options' => ['Yes', 'No'],
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'microchip_no',
                                'value' => $horse->microchip_no ? $horse->microchip_no : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Microchip No',
                                'placeholder' => 'Enter Microchip No',
                            ])
                        </div>
                    </div>

                    {{-- start: docs --}}
                    <div class="row entry align-items-center mb-2">
                        <div class="col">
                            @include('partials.formFields.selectFormGroup', [
                                'label' => 'Is there a Passport?',
                                'name' => 'is_passport',
                                'required' => true,
                                'placeholder' => 'Select',
                                'className' => 'horse-select select-2-basic',
                                'keyValue' => true,
                                'options' => ['Yes', 'No'],
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'passport_no',
                                'value' => $horse->passport_no ? $horse->passport_no : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'label' => 'Passport No',
                                'placeholder' => 'Enter Passport No',
                            ])
                        </div>
                    </div>
                    {{-- end: docs --}}

                    <br />
                    <div class="row entry align-items-center mb-2  mh-400 mw-400">
                        {{-- <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'file',
                                'required' => true,
                                'name' => 'passport_photo',
                                'label' => 'Passport Photo',
                            ])
                        </div> --}}
                        <div class="col">
                            <label for="">Passport Photo</label>
                            <img src="{{ url($horse->passport_photo) }}" class="img-fluid" alt="">
                        </div>


                    </div>

                    <div class="row entry align-items-center mb-2  mh-400 mw-400">
                        {{-- <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'file',
                                'required' => true,
                                'name' => 'horse_photo',
                                'label' => 'Horse Photo',
                            ])
                        </div> --}}
                        <div class="col">
                            <label for="">Horse Photo</label>
                            <img src="{{ url($horse->horse_photo) }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    {{-- <a href="#" class="btn btn-main" id="add-entry"><i class="fa-solid fa-plus"></i> Add Horse</a> --}}
            </div>

            <br />
            <br />

            </form>
        </div>
    </div>
@endsection
