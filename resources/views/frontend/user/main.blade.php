@extends('frontend.main')
@section('content')
    <section class="space">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mb-md-0 mb-4">
                    @if (auth()->user()->designation == 'User')
                        @include('frontend.user.sidebar')
                    @endif
                    @if (auth()->user()->designation == 'Expert')
                        @include('frontend.expert.sidebar')
                    @endif
                </div>
                <div class="col-md-9">
                    @yield('ucontent')
                </div>
            </div>
        </div>
    </section>
@endsection
