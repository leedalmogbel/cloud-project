@extends('partials.frame')
@section('content')
    <div class="content col col-md">
        <div class="container">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/dashboard" class="btn btn-secondary me-md-2" type="button">
                    < Back to Dashboard </a>
            </div>
            <br />
            <h2 class="text-danger">Stable</h2>
            <div class="stable">
                <form method="post" action="{{ $form_url ?? '' }}" enctype="multipart/form-data">
                    @csrf
                    {{-- start: stable --}}
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'stable_no',
                                'label' => 'Stable No',
                                'value' => $stable->stable_no ? $stable->stable_no : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Stable no',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'name',
                                'label' => 'Stable Name',
                                'value' => $stable->name ? $stable->name : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Stable name',
                            ])
                        </div>
                    </div>
                    {{-- end: stable --}}

                    {{-- start: owner --}}
                    <br />
                    <h2 class="text-danger">Owner</h2>
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'owner_name',
                                'label' => 'Owner Name',
                                'value' => $stable->owner_name ? $stable->owner_name : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Owner name',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'owner_mobile',
                                'label' => 'Owner Contact No',
                                'value' => $stable->owner_mobile ? $stable->owner_mobile : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Owner Contact No',
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'owner_eid',
                                'label' => 'Owner Emirates ID',
                                'value' => $stable->owner_eid ? $stable->owner_eid : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Owner Emirates ID',
                            ])
                        </div>

                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'file',
                                'required' => true,
                                'name' => 'owner_eid_photo',
                                'label' => 'Owner EID Photo',
                                'value' => $stable->owner_eid_photo ? $stable->owner_eid_photo : '',
                                'disabled' => $page == 'detail' ? true : false,
                            ])
                            <img src="{{ url($stable->owner_eid_photo) }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    {{-- end: owner --}}

                    {{-- start: foreman --}}
                    <br />
                    <h2 class="text-danger">Foreman</h2>
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'foreman_name',
                                'label' => 'Foreman Name',
                                'value' => $stable->foreman_name ? $stable->foreman_name : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Foreman name',
                            ])
                        </div>
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'foreman_mobile',
                                'label' => 'Foreman Contact No',
                                'value' => $stable->foreman_mobile ? $stable->foreman_mobile : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Foreman Contact No',
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'text',
                                'required' => true,
                                'name' => 'foreman_eid',
                                'label' => 'Foreman Emirates ID',
                                'value' => $stable->foreman_eid ? $stable->foreman_eid : '',
                                'disabled' => $page == 'detail' ? true : false,
                                'placeholder' => 'Enter Foreman Emirates ID',
                            ])
                        </div>

                        <div class="col">
                            @include('partials.formFields.inputFormGroup', [
                                'type' => 'file',
                                'required' => true,
                                'name' => 'foreman_eid_photo',
                                'label' => 'FOreman EID Photo',
                                'value' => $stable->foreman_eid_photo ? $stable->foreman_eid_photo : '',
                                'disabled' => $page == 'detail' ? true : false,
                            ])
                            <img src="{{ url($stable->foreman_eid_photo) }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    {{-- end: foreman --}}


                    <br />
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'text',
                            'required' => true,
                            'name' => 'total_horses',
                            'label' => 'Total Horse',
                            'idName' => 'total_horse',
                            'value' => $stable->total_horses ? $stable->total_horses : '',
                            'disabled' => $page == 'detail' ? true : false,
                            'placeholder' => 'Enter Total Horse',
                        ])
                    </div>
                    {{-- <a href="#" class="btn btn-main" id="add-entry"><i class="fa-solid fa-plus"></i> Add Horse</a> --}}
            </div>

            @foreach ($stable->horses as $horse)
                <br />
                <h2 class="horse_title_count">Horse</h2>
                <div class="row entry align-items-center my-2">
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'text',
                            'required' => true,
                            'name' => "data[$loop->index][name]",
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
                            'name' => "data[$loop->index][colour]",
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
                            'name' => "data[$loop->index][age]",
                            'value' => $horse->age ? $horse->age : '',
                            'disabled' => $page == 'detail' ? true : false,
                            'label' => 'Age',
                            'placeholder' => 'Enter Horse Age',
                        ])
                    </div>
                </div>

                <div class="row entry align-items-center mb-2">
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'text',
                            'required' => true,
                            'name' => "data[$loop->index][owner_name]",
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
                            'name' => "data[$loop->index][owner_mobile]",
                            'value' => $horse->owner_mobile ? $horse->owner_mobile : '',
                            'disabled' => $page == 'detail' ? true : false,
                            'label' => 'Owner Mobile',
                            'placeholder' => 'Enter Owner Mobile',
                        ])
                    </div>
                </div>

                <div class="row entry align-items-center mb-2">
                    {{-- <div class="col">
                @include('partials.formFields.selectFormGroup', [
                    'label' => 'Is there a Microchip?',
                    'name' => 'data[{{$loop->index}}][is_microchip]',
                    'required' => true,
                    'placeholder' => 'Select',
                    'className' => 'horse-select select-2-basic',
                    'keyValue' => true,
                    'options' => ['Yes', 'No'],
                ])
            </div> --}}
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'text',
                            'required' => true,
                            'name' => "data[$loop->index][microchip_no]",
                            'value' => $horse->microchip_no ? $horse->microchip_no : '',
                            'disabled' => $page == 'detail' ? true : false,
                            'label' => 'Microchip No',
                            'placeholder' => 'Enter Microchip No',
                        ])
                    </div>
                </div>

                <div class="row entry align-items-center mb-2">
                    {{-- <div class="col">
                @include('partials.formFields.selectFormGroup', [
                    'label' => 'Is there a Passport?',
                    'name' => 'data[{{$loop->index}}][is_passport]',
                    'required' => true,
                    'placeholder' => 'Select',
                    'className' => 'horse-select select-2-basic',
                    'keyValue' => true,
                    'options' => ['Yes', 'No'],
                ])
            </div> --}}
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'text',
                            'required' => true,
                            'name' => "data[$loop->index][passport_no]",
                            'value' => $horse->passport_no ? $horse->passport_no : '',
                            'disabled' => $page == 'detail' ? true : false,
                            'label' => 'Passport No',
                            'placeholder' => 'Enter Passport No',
                        ])
                    </div>
                </div>

                <div class="row entry align-items-center mb-2  mh-400 mw-400">
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'file',
                            'required' => true,
                            'name' => "data[$loop->index][passport_photo]",
                            'label' => 'Passport Photo',
                        ])
                    </div>
                    <div class="col">
                        <label for="">Passport Photo</label>
                        <img src="{{ url($horse->passport_photo) }}" class="img-fluid" alt="">
                    </div>
                    {{-- <div class="col">
                        <label for="">Horse Photo</label>
                        <img src="{{ url($horse->horse_photo) }}" class="img-fluid" alt="">
                    </div> --}}


                </div>

                <div class="row entry align-items-center mb-2  mh-400 mw-400">
                    <div class="col">
                        @include('partials.formFields.inputFormGroup', [
                            'type' => 'file',
                            'required' => true,
                            'name' => "data[$loop->index][horse_photo]",
                            'label' => 'Horse Photo',
                        ])
                    </div>
                    <div class="col">
                        <label for="">Horse Photo</label>
                        <img src="{{ url($horse->horse_photo) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <hr>
            @endforeach
            <br />
            <br />
            <button type="submit" class="btn btn-secondary submit-btn">SUBMIT</button>
            </form>
        </div>
    </div>

    <script type="text/tpl" id="horse-info">
    <br />
    <h2 class="horse_title_count">Horse</h2>
	<div class="row entry align-items-center my-2">
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'text',
                'required' => true,
                'name' => 'data[__i__][name]',
                'label' => 'Name',
                'placeholder' => 'Enter Horse name',
            ])
        </div>
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'text',
                'required' => true,
                'name' => 'data[__i__][colour]',
                'label' => 'Colour',
                'placeholder' => 'Enter Horse Colour',
            ])
        </div>
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'text',
                'required' => true,
                'name' => 'data[__i__][age]',
                'label' => 'Age',
                'placeholder' => 'Enter Horse Age',
            ])
        </div>
	</div>

    <div class="row entry align-items-center mb-2">
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'text',
                'required' => true,
                'name' => 'data[__i__][owner_name]',
                'label' => 'Owner Name',
                'placeholder' => 'Enter Owner name',
            ])
        </div>
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'text',
                'required' => true,
                'name' => 'data[__i__][owner_mobile]',
                'label' => 'Owner Mobile',
                'placeholder' => 'Enter Owner Mobile',
            ])
        </div>
	</div>

    <div class="row entry align-items-center mb-2">
        <div class="col">
            @include('partials.formFields.selectFormGroup', [
                'label' => 'Is there a Microchip?',
                'name' => 'data[__i__][is_microchip]',
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
                'name' => 'data[__i__][microchip_no]',
                'label' => 'Microchip No',
                'placeholder' => 'Enter Microchip No',
            ])
        </div>
	</div>

    <div class="row entry align-items-center mb-2">
        <div class="col">
            @include('partials.formFields.selectFormGroup', [
                'label' => 'Is there a Passport?',
                'name' => 'data[__i__][is_passport]',
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
                'name' => 'data[__i__][passport_no]',
                'label' => 'Passport No',
                'placeholder' => 'Enter Passport No',
            ])
        </div>
	</div>

    <div class="row entry align-items-center mb-2">
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'file',
                'required' => true,
                'name' => 'data[__i__][passport_photo]',
                'label' => 'Passport Photo',
            ])
        </div>
	</div>

    <div class="row entry align-items-center mb-2">
        <div class="col">
            @include('partials.formFields.inputFormGroup', [
                'type' => 'file',
                'required' => true,
                'name' => 'data[__i__][horse_photo]',
                'label' => 'Horse Photo',
            ])
        </div>
	</div>
    <hr>
</script>
@endsection
@section('custom-script')
    <script>
        let horseCount = 0;

        const addEntry = function() {
            let tpl = $('#horse-info').html().replace(/__i__/g, horseCount);
            tpl = $(tpl);

            // $('h2.horse_title_count').text(`Horse ${horseCount}`);

            $('.stable').append(tpl);
            console.log(horseCount, 'entry coutn')
            console.log(tpl, 'entry tpl')
            horseCount++;

        };

        const recalculateIndex = function() {
            let c = $('.entries .entry').length;
            for (let i = 0; i < c; i++) {
                $($('.entries .entry')[i]).find('.horse-select').attr('name', 'data[' + i + '][horse]');
                $($('.entries .entry')[i]).find('.rider-select').attr('name', 'data[' + i + '][rider]');
            }

            horseCount = c;
        };

        $('#add-entry').click(function(e) {
            e.preventDefault();
            console.log(e, 'asdasd')
            addEntry();
        });

        $('#total_horse').on('change', function(e) {
            let tot_horse = $('#total_horse').val();
            console.log('here', tot_horse);
            for (let i = 0; i < tot_horse; i++) {
                addEntry();
            }
        });

        $(document).on('click', '.remove-this', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            recalculateIndex();
            selected.call(this, 'horse');
            selected.call(this, 'rider');
        });
    </script>
@endsection
