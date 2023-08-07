@extends('partials.frame')

@section('content')
    <div class="content container-fluid col col-md col-xl col-xxl align-items-center justify-content-center my-5">
        @if ($role === 'superadmin')
            <div class="row my-3">
                <div class="card-wrapper d-flex justify-content-evenly">
                    <div class="card col-4">
                        <div class="card-header text-center">
                            Stables
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $allStables }}</h5>
                        </div>
                    </div>
                    <div class="card col-4">
                        <div class="card-header text-center">
                            Horses
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $allHorses }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row my-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/stable/create" class="btn btn-secondary btn-lg">Add Stable</a>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive col col-md col-xl col-xxl align-items-center justify-content-center">
                <table id="stable-listing" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Stable</th>
                            <th>Owner</th>
                            <th>Foreman</th>
                            <th>Horses</th>
                            <th>Date</th>
                            @if ($role === 'superadmin')
                                <th>Doctor</th>
                            @endif
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stables as $key => $stable)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div>{{ $stable->stable_no }}</div>
                                    <div><small class="text-secondary">{{ $stable->name }}</small>
                                </td>
                                <td>
                                    {{-- {{$horse->realBreed()}} --}}
                                    {{ $stable->owner_name }}

                                </td>
                                <td>
                                    {{ $stable->foreman_name }}
                                </td>
                                <td>
                                    {{ $stable->horses_count }}
                                </td>
                                <td>
                                    {{ date('d-m-Y', strtotime($stable->created_at)) }}
                                </td>
                                @if ($role === 'superadmin')
                                    <td>
                                        {{ $stable->user->firstname }}
                                    </td>
                                @endif

                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a href="/stable/detail/{{ $stable->stable_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="View"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="/stable/edit/{{ $stable->stable_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="/stable/delete/{{ $stable->stable_id }}" id="delete-stable"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete Horse"><i class="fa-solid fa-trash-can"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="/horse/create/{{ $stable->stable_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Add Horse"><i
                                                    class="fa-solid fa-circle-plus"></i></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/tpl" id="rules-content">
            <p>Are you sure you want to delete this Stable?</p>
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                let i = 0;
                let table = $('#stable-listing').DataTable({
                    pagingType: 'full_numbers',
                    order: [
                        [0, 'asc']
                    ],
                    // processing: true,
                    // serverSide: true,
                    // ajax: {
                    //     url: "{{ route('stables.horses') }}",
                    //     // data: function(d) {
                    //     //     d.search = $('input[type="search"]').val()
                    //     // }
                    // },
                    // columns: [{
                    //         "render": function() {
                    //             return i++;
                    //         }
                    //     },
                    //     {
                    //         data: 'stable_no',
                    //         name: 'stable_no'
                    //     },
                    //     {
                    //         data: 'stable_name',
                    //         name: 'stable_name'
                    //     },
                    //     {
                    //         data: 'owner_name',
                    //         name: 'owner_name'
                    //     },
                    //     {
                    //         data: 'foreman_name',
                    //         name: 'foreman_name'
                    //     },
                    //     {
                    //         data: 'doctor_name',
                    //         name: 'doctor_name'
                    //     },
                    //     {
                    //         data: 'action',
                    //         name: 'action',
                    //         orderable: false,
                    //         searchable: false
                    //     }
                    // ]
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

        <script>
            $(document).on('click', '#delete-stable', function(e) {
                console.log('test')
                e.preventDefault();
                let self = this;
                let href = $(self).attr('href');
                let urlParams = new URLSearchParams(window.location.search);
                $.confirm({
                    title: 'Delete Stable',
                    columnClass: 'col-md-6',
                    content: $('#rules-content').html(),
                    buttons: {
                        'Yes': {
                            btnClass: 'btn-main',
                            action: function() {
                                window.location.href = href
                            }
                        },
                        'No': {
                            btnClass: 'btn-danger',
                            action: function() {

                            }
                        }
                    }
                });
            });
        </script>

    </div>
@endsection
