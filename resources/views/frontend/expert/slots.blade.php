@extends('frontend.user.main')

@section('ucontent')


    <style>
        .btn-status-group .btn {
            font-size: 12px;
            font-weight: 300;
            text-transform: uppercase;

        }

        .statusDropdown a {
            font-size: 12px;
            border-radius: 0;
        }

        table tr th {
            font-weight: 600;
            text-transform: uppercase;
        }

        table tr th,
        table tr td {

            font-size: 12px;
            border-width: 1px !important;
        }
    </style>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-inline-flex btn-status-group box-shadow-3 align-items-center">
                    <a data-bs-toggle="tooltip" title="Today All Schedule"
                        href="{{ route('schedules', ['url' => 'all', 'id' => 'all']) }}"
                        class="btn rounded-0  btn-sm {{ $time == 'all' ? 'btn-primary' : 'btn-outline-success' }} ">
                        All
                    </a>
                    <a data-bs-toggle="tooltip" title="Today All Schedule"
                        href="{{ route('schedules', ['url' => 'all', 'id' => 'today']) }}"
                        class="btn rounded-0  btn-sm {{ $time == 'today' ? 'btn-primary' : 'btn-outline-success' }} ">
                        Today
                    </a>
                    <a data-bs-toggle="tooltip" title=" All outdated schedule"
                        href="{{ route('schedules', ['url' => 'all', 'id' => 'outdated']) }}"
                        class="btn rounded-0 btn-sm  {{ $time == 'outdated' ? 'btn-primary' : 'btn-outline-success' }} ">
                        Outdated
                    </a>
                    <a data-bs-toggle="tooltip" title=" All Upcoming schedule"
                        href="{{ route('schedules', ['url' => 'all', 'id' => 'upcoming']) }}"
                        class="btn rounded-0 btn-sm  {{ $time == 'upcoming' ? 'btn-primary' : 'btn-outline-success' }}">
                        Upcoming
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="month" name="month" class="form-control form-control-sm shadow-none"
                            value="{{ $_GET['month'] ?? '' }}" />
                        <input type="submit" class="btn btn-sm btn-primary" value="Search">
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <div class="w-100 text-end">
                    <div class="d-flex gap-2 justify-content-end aling-items-center">

                        <a href="{{ route('export.sessions', ['url' => $url, 'id' => $time, 'month' => $month]) }}"
                            data-bs-toggle="tooltip" title="Download Excel" class="btn btn-sm btn-primary rounded-0">
                            <i class="fa-regular fa-file-excel"></i>
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-primary rounded-0 btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Status : {{ ucwords($url) }}
                            </button>
                            <ul class="dropdown-menu p-0 statusDropdown">
                                @if ($time != 'outdated')
                                    <li>
                                        <a class="dropdown-item rounded-0"
                                            href="{{ route('schedules', ['url' => 'pending', 'id' => $time]) }}">Open</a>
                                    </li>
                                @endif
                                @if ($time != 'upcoming')
                                    <li>
                                        <a class="dropdown-item rounded-0"
                                            href="{{ route('schedules', ['url' => 'done', 'id' => $time]) }}">Completed</a>
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item rounded-0"
                                        href="{{ route('schedules', ['url' => 'cancel', 'id' => $time]) }}">Cancelled</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="w-100 table-responsive table-bordered bg-white box-shadow-1">
                    <table class="table mb-0 table-sm table-bordered table-edits table-light table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    Sr.
                                </th>
                                <th>
                                    Client
                                </th>
                                <th>
                                    Session
                                </th>
                                <th>
                                    Appointment Date
                                </th>
                                <th>
                                    Start Time
                                </th>
                                <th>
                                    End Time
                                </th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slots as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li>
                                                <b>For Whom :</b> <span>
                                                    {{ $item['find_expert']['for_me'] == '1' ? 'For Myself' : $item['find_expert']['for_whome'] }}</span>
                                            </li>
                                            <li>
                                                <b>Name : </b> <span>{{ $item['user']['name'] }}</span>
                                            </li>
                                            <li>
                                                <b>Gender : </b> <span>{{ $item['user']['gender'] }}</span>
                                            </li>
                                            <li>
                                                <b>Age : </b> <span>{{ $item['user']['age'] }}</span>
                                            </li>
                                            <li>
                                                <b>State : </b> <span>{{ $item['user']['state'] }}</span>
                                            </li>
                                            <li>
                                                <b>City : </b> <span>{{ $item['user']['city'] }}</span>
                                            </li>
                                        </ul>

                                    </td>
                                    <td>
                                        @php
                                            $scat = json_decode($item['sub_cats']);
                                            $ecat = json_decode($item['end_cats']);
                                        @endphp
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <b> Cateogry : </b> {{ $item['category'] }}
                                            </li>
                                            <li>
                                                <b>Primary Concern : </b>
                                                <p class="d-block text-wrap" style="width:100px;">
                                                    @foreach ($scat as $s)
                                                        <span> {{ $s->sub_category }} </span>
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </li>
                                            @if (is_object($ecat) || is_array($ecat))
                                                <li class="text-wrap">
                                                    <b>Secondary Concern : </b>
                                                    <p class="d-block text-wrap" style="width:100px">
                                                        @foreach ($ecat as $e)
                                                            <span> {{ $e->end_category }} </span>
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                </li>
                                            @endif
                                        </ul>

                                    </td>
                                    <td>
                                        {{ date('d-M-Y', strtotime($item['slot'])) }}
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($item['slot'])) }}
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($item['slot_end'])) }}
                                    </td>
                                    <td>
                                        @php
                                            $s_arr = [
                                                'Done' => 'bg-success',
                                                'Pending' => 'bg-warning',
                                                'Cancelled' => 'bg-danger',
                                            ];
                                            $time = strtotime(date('Y:m:d H:i:s', strtotime($item['slot_end'])));
                                            $current = strtotime(date('Y-m-d H:i:s'));
                                            $diff = $time - $current;
                                            $start = strtotime($item['slot_end']) - $current;
                                            $now = date('Y-m-d H:i:s');
                                            $remain = strtotime($item['slot']) - strtotime($now);
                                            $endremain = strtotime($item['slot_end']) - strtotime($now);
                                            $minutes = $remain / 60;
                                            $duration = $item['duration'] / 2;
                                        @endphp

                                        @if ($diff < 0 && $item['meeting_status'] == 'Pending')
                                            <span class="badge bg-danger rounded-1 text-white">Time Out</span>
                                        @else
                                            <span
                                                class="badge px-md-4 rounded-1 shadow {{ $s_arr[$item['meeting_status']] }}">
                                                {{ $item['meeting_status'] == 'Done' ? 'Completed' : $item['meeting_status'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item['base_amount'] }}
                                    </td>
                                    <td>
                                        @if ($item['meeting_status'] != 'Cancelled')
                                            @if ($minutes < $duration && $endremain > 0)
                                                @if ($time - $current > 0 && $item['meeting_status'] == 'Pending')
                                                    {!! Form::open(['url' => 'expert/join-call', 'method' => 'POST']) !!}
                                                    {!! Form::hidden('user_id', $item['user_id']) !!}
                                                    {!! Form::hidden('id', $item['id']) !!}
                                                    {!! Form::hidden('mid', $item['meet_id']) !!}
                                                    <button class="btn btn-outline-success btn-sm">
                                                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Join
                                                    </button>
                                                    {!! Form::close() !!}
                                                @endif
                                            @elseif($minutes > -30 && $minutes > 11)
                                                <button
                                                    onclick="alert('Sessions starts at {{ date('d-M-Y h:i A', strtotime($item['slot'])) }}')"
                                                    class="btn btn-sm btn-primary">Join</button>
                                            @endif

                                            @if (floatval($time - $current) < 0 && $item['meeting_status'] == 'Pending')
                                                <form action="{{ route('mark_completed', $item['usid']) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success rounded-1">Mark Completed</button>
                                                </form>
                                            @endif
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
