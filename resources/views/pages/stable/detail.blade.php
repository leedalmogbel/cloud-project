@extends('partials.frame')

@section('content')
    <div class="content col col-md my-5">
        <div class="container">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/dashboard" class="btn btn-secondary me-md-2" type="button">
                    < Back to Dashboard </a>
            </div>
            <br />
            <h2 class="text-danger">Stable</h2>
            <div class="row stable">
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
                        {{-- @include('partials.formFields.inputFormGroup', [
                            'type' => 'file',
                            'required' => true,
                            'name' => 'owner_eid_photo',
                            'label' => 'Owner EID Photo',
                            'value' => $stable->owner_eid_photo ? $stable->owner_eid_photo : '',
                            'disabled' => $page == 'detail' ? true : false,
                        ]) --}}
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
                        {{-- @include('partials.formFields.inputFormGroup', [
                            'type' => 'file',
                            'required' => true,
                            'name' => 'foreman_eid_photo',
                            'label' => 'FOreman EID Photo',
                            'value' => $stable->foreman_eid_photo ? $stable->foreman_eid_photo : '',
                            'disabled' => $page == 'detail' ? true : false,
                            // 'placeholder' => 'Enter Owner Contact No',
                        ]) --}}
                        <img src="{{ url($stable->foreman_eid_photo) }}" class="img-fluid" alt="">
                    </div>
                </div>
                {{-- end: foreman --}}


                <br />
                <hr class="my-3">
                {{-- <div class="col">
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
                </div> --}}
                {{-- <a href="#" class="btn btn-main" id="add-entry"><i class="fa-solid fa-plus"></i> Add Horse</a> --}}
            </div>

            <div class="row mb-3">
                <div class="col">
                    <h2 class="text-danger">Horses</h2>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="/horse/create/{{ $stable->stable_id }}" class="btn btn-main"><i class="fa-solid fa-plus"></i>
                        Add Horse</a>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive col col-md col-xl col-xxl align-items-center justify-content-center">
                    <table id="stable-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Horse</th>
                                <th>Owner</th>
                                <th>Microchip</th>
                                <th>Passport</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stable->horses as $key => $horse)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div>{{ $horse->name }}</div>
                                        <div><small class="text-secondary">{{ $horse->age }}</small>
                                            <div><small class="text-secondary">{{ $horse->colour }}</small>
                                    </td>
                                    <td>
                                        {{ $horse->owner_name }}
                                    </td>
                                    <td>
                                        {{ $horse->microchip_no }}
                                    </td>
                                    <td>
                                        {{ $horse->passport_no }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($horse->updated_at)) }}
                                    </td>

                                    <td>
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <a href="/horse/detail/{{ $horse->horse_id }}"
                                                    class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="View"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/horse/edit/{{ $horse->horse_id }}"
                                                    class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('#stable-listing').DataTable({
                pagingType: 'full_numbers',
                order: [
                    [0, 'asc']
                ]
            });
            // $('#stable-listing').DataTable({
            //     search: {
            //         return: true,
            //     },
            // });

            $('#stable-listing').on('change', function() {
                table.order([]);
                table.search(this.value).draw();
            })

        });
    </script>

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
