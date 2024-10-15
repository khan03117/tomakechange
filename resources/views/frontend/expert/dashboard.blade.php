@extends('frontend.user.main')

@section('ucontent')
    <style>
        .widget-box h4 {
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .widget-box h2 {
            font-size: 18px;
            font-weight: 800;
        }
    </style>
    <div class="container mt-2">

        <div class="row">
            <div class="col-md-12">
                <div class="w-1000 mb-4 text-end">
                    <h4 class="text-primary"> {{ Auth::user()->name }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <a class="text-dark" href="{{ route('schedules', ['url' => 'Pending', 'id' => 'today']) }}">
                    <div class="w-100 h-100 rounded-3 p-3 widget-box bg-light box-shadow-1">
                        <h4>
                            Today's Open Sessions
                        </h4>
                        <h2>
                            {{ $todays_session }}
                        </h2>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-dark" href="{{ route('schedules', ['url' => 'Pending', 'id' => 'upcoming']) }}">


                    <div class="w-100 h-100 rounded-3 p-3 widget-box bg-light box-shadow-1">
                        <h4>
                            Upcoming Open Sessions
                        </h4>
                        <h2>
                            {{ $open_sessions }}
                        </h2>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-dark" href="{{ route('schedules', ['url' => 'Pending', 'id' => 'outdated']) }}">

                    <div class="w-100 h-100 rounded-3 p-3 widget-box bg-light box-shadow-1">
                        <h4>
                            TimeOut Sessions
                        </h4>
                        <h2>
                            {{ $outdated_open_sessions }}
                        </h2>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-dark" href="{{ route('schedules', ['url' => 'done', 'id' => 'all']) }}">

                    <div class="w-100 h-100 rounded-3 p-3 widget-box bg-light box-shadow-1">
                        <h4>
                            Completed Sessions
                        </h4>
                        <h2>
                            {{ $completed_sessions }}
                        </h2>
                        <small class="text-danger">*Till Date</small>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection
