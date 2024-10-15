@extends('frontend.user.main')

@section('ucontent')
    <style>
        .bxs-dashboard label {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            display: block;
            width: fit-content;

        }

        .bxs-dashboard .bg-light .w-100 {
            font-size: 14px;
            font-weight: 400;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="w-100 bxs-dashboard">
                    <div class="container">
                        <div class="row gy-2 gy-md-4">
                            <div class="col-md-12 ">
                                <div class="alert alert-warning">
                                    <p class="mb-0">
                                        Welcome! <span class="fw-bold">{{ Auth::user()->name }}</span> 
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 col-6">
                                <div class="w-100 bg-success-subtle box-shadow-1 p-2">
                                    <label for="">
                                        Name
                                    </label>
                                    <div class="w-100">{{ Auth::user()->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="w-100 bg-success-subtle box-shadow-1 p-2">
                                    <label for="">
                                        Email
                                    </label>
                                    <div class="w-100">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="w-100 bg-success-subtle box-shadow-1 p-2">
                                    <label for="">
                                        Mobile
                                    </label>
                                    <div class="w-100">{{ Auth::user()->mobile }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="w-100 bg-success-subtle box-shadow-1 p-2">
                                    <label for="">
                                        State
                                    </label>
                                    <div class="w-100">{{ $user['state'] }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="{{url('find-expert')}}" class="btn btn-primary btn-sm fw-light px-md-4 rounded-pill shadow">Schedule a new session</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
