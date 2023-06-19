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
                            <th>Stable</th>
                            <th>Owner</th>
                            <th>Foreman</th>
                            <th>Horses</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        {{-- <th>STATUS</th>
                    <th width="100" style="text-align:right">ACTIONS</th> --}}
                    </thead>
                    {{-- @foreach (${Str::plural($modelName)} as $horse) --}}
                    <tbody>
                        @foreach ($stables as $stable)
                            <tr>
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
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a href="/stable/detail/{{ $stable->stable_id }}"
                                                class="btn btn-outline-secondary btn-sm rounded-2" type="button"
                                                data-toggle="tooltip" data-placement="top" title="View"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </li>
                                        {{-- <li class="list-inline-item">
                                            <button class="btn btn-success btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></button>
                                        </li> --}}
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
                        [4, 'asc']
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

        {{--     <div class="row counts py-5">
            <div class="col-md-4">
                <div class="card image-container-horses">
                    <a href="/horse">
                        <div class="card-block p-3 text-center">
                            <h4 class="card-title">Horses</h4>
                            <h6 class="card-subtitle text-muted">{{ $dashcount->horses }}</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card image-container-riders">
                    <a href="/rider">
                        <div class="card-block p-3 text-center">
                            <h4 class="card-title">Riders</h4>
                            <h6 class="card-subtitle text-muted">{{ $dashcount->riders }}</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card image-container-trainers">
                    <a href="/trainer">
                        <div class="card-block p-3 text-center">
                            <h4 class="card-title">Trainers</h4>
                            <h6 class="card-subtitle text-muted">{{ $dashcount->trainers }}</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}

        {{-- START: UPCOMING LIST --}}
        {{-- <div class="row upcoming-list">
            <div class="col">
                <div class="upcoming-list__wrapper">
                    <h4>Upcoming Rides</h4> --}}
        {{-- START: UPCOMING LIST --}}
        {{-- @if ($events)
                        @foreach ($events as $event)
                            <div class="list-group">
                                <div class="col py-1">
                                    @php
                                        $racepath = '#';
                                        $opDate = substr($event->openingdate, 0, 10);
                                        $clDate = substr($event->closingdate, 0, 10);
                                        $copDate = $event->openingdate;
                                        $cclDate = $event->closingdate;
                                        $opening = strpos($opDate, '2022-08-31') !== false ? 'Coming soon' : date('d-m-Y H:i:s', strtotime($event->openingdate));
                                        $closing = strpos($clDate, '2022-08-31') !== false ? 'Coming soon' : date('d-m-Y H:i:s', strtotime($event->closingdate));
                                        if ($event->statusid == 11) {
                                            $racepath = '/entry/create?raceid=' . $event->raceid;
                                            if ($cclDate < now()) {
                                                $racepath = '#';
                                            }
                                        }
                                    @endphp
                                    <a href="{{ $racepath }}">
                                        <div class="card">
                                            <div class="card-block p-3">
                                                <div class="card-block-info d-flex justify-content-between">
                                                    <div class="event-title w-50">
                                                        <h4 class="card-title">{{ $event->racename }}
                                                            @php
                                                                $statusclass = '';
                                                                $statuslabel = '';
                                                                if ($event->statusid == 11) {
                                                                    $statusclass = 'text-success';
                                                                    $statuslabel = 'Open for Entries';
                                                                    if ($cclDate < now()) {
                                                                        $statusclass = 'text-danger';
                                                                        $statuslabel = 'Closed';
                                                                    }
                                                                } elseif ($event->statusid == 1) {
                                                                    $statusclass = 'text-pending';
                                                                    $statuslabel = 'Pending';
                                                                } else {
                                                                    $statusclass = 'text-danger';
                                                                    $statuslabel = 'Closed';
                                                                }
                                                            @endphp
                                                            <small class={{ $statusclass }}>
                                                                ({{ $statuslabel }})
                                                            </small>
                                                        </h4>
                                                    </div>
                                                    <div class="event-date">
                                                        <h6 class="card-title">
                                                            Opening: {{ $opening }}
                                                        </h6>
                                                        <h6 class="card-title">
                                                            Closing: {{ $closing }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="card-block-print">
                                                    <a
                                                        href="{{ action('DashboardController@entriesPDF', ['raceid' => $event->raceid]) }}">Download
                                                        PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No Event
                    @endif --}}
        {{-- END: END LIST --}}
        {{-- </div>
            </div>
        </div> --}}
        {{-- END: UPCOMING LIST --}}

        {{-- START: RECENT ENTRIES --}}
        {{-- <div class="row recent-entries">
            <div class="col">
                <div class="recent-entries__wrapper">
                    <div class="recent-entries__head">
                        <div class="recent-entries__title">
                            <h4>Recent Entries</h4>
                        </div>
                    </div> --}}
        {{-- START: RECENT ENTRIES --}}
        {{-- @if ($entries)
                        <table id="recentEntries" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Horse</th>
                                    <th>Rider</th>
                                    <th>Trainer</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entries as $entry)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{ $entry->horsename }}
                                            {{ $entry->horsenfid }}
                                            {{ $entry->horsefeiid }}
                                        </td>
                                        <td>
                                            {{ $entry->ridername }}
                                            {{ $entry->ridernfid }}
                                            {{ $entry->riderfeiid }}
                                        </td>
                                        <td>
                                            {{ $entry->trainername }}
                                            {{ $entry->trainernfid }}
                                            {{ $entry->trainerfeiid }}
                                        </td>
                                        <td>{{ $entry->status }}</td>
                                        <td>{{ $entry->remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No Entries
                    @endif --}}
        {{-- END: RECENT ENTRIES --}}
        {{-- </div>
            </div>
        </div> --}}
        {{-- END: RECENT ENTRIES --}}

        {{-- START: CALENDAR --}}
        {{-- <div class="row calendar">
            <div id="calendar"></div>
        </div> --}}
        {{-- END: CALENDAR --}}
    </div>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#recentEntries').DataTable();
            $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
        });
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script> --}}
@endsection
