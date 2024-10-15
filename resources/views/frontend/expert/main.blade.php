@extends('frontend.main')
@section('content')
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}", 'Error')
        </script>
    @endif
    @foreach ($errors->all() as $item)
        <script>
            toastr.error("{{ $item }}", 'Error')
        </script>
    @endforeach

    <section class="space">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.expert.sidebar')
                </div>
                <div class="col-md-9">
                    @yield('econtent')
                </div>
            </div>
        </div>
    </section>
@endsection
