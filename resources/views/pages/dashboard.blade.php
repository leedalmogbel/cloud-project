@extends('partials.frame')

@section('content')
    <div class="content container-fluid col col-md col-xl col-xxl align-items-center justify-content-center">
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
                                <th>Account</th>
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
                                        {{ $stable->user->username }}
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
                                        {{-- <li class="list-inline-item">
                                            <a href="/stable/edit/{{ $stable->stable_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                        </li> --}}
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



        <script type="text/javascript">
            $(document).ready(function() {
                let table = $('#stable-listing').DataTable({
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
@endsection
