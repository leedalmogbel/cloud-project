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
                <table id="user-listing" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Horses</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->username }}

                                </td>
                                <td>
                                    <div>{{ $user->firstname }}</div>
                                    <div><small class="text-secondary">{{ $user->lastname }}</small>
                                </td>
                                <td>
                                    {{ $user->stables_count }}
                                </td>

                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a href="/user/detail/{{ $user->user_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="View"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="/user/edit/{{ $user->user_id }}"
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



        <script type="text/javascript">
            $(document).ready(function() {
                let table = $('#user-listing').DataTable({
                    order: [
                        [4, 'asc']
                    ]
                });

                $('#user-listing').on('change', function() {
                    table.order([]);
                    table.search(this.value).draw();
                })

            });
        </script>

    </div>
@endsection
