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
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="w-100">
                    <figure class="w-100">
                        <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt="" class="img-fluid">
                    </figure>
                    <div class="w-100  text-center">
                        <h4 class="mb-0"> {{ $expert->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="w-100 mb-4">
                                <h5>Services</h5>
                                <div class="w-100 expertises_span">
                                    @foreach ($expert['expertize'] as $et)
                                        <span
                                            class="d-inline-block text-nowrap px-2 py-1 text-white mb-1 t-12 bg-primary rounded-pill me-2 font-weight-light">{{ $et->sub_category }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-100 mb-4">
                                <h5>Availability Modes</h5>
                                <div class="w-100 expertises_span">
                                    @foreach (explode(',', $expert['modes']) as $mod)
                                        {{ $mod }} @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="w-100 mb-4">
                                <h5>Current Balance</h5>
                                <div class="w-100 expertises_span">
                                    <p> {{ number_format($points['balance'], 2) }}</p>
                                </div>
                            </div>
                            <div class="w-100 mb-4">
                                <h5>Total Leads</h5>
                                <div class="w-100 expertises_span">
                                    <p> {{ $expert['leads_count'] }}</p>
                                </div>
                            </div>
                            <div class="w-100 mb-4">
                                <h5>Purchased Leads</h5>
                                <div class="w-100 expertises_span">
                                    <p>{{ $expert['confirmed_leads_count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
