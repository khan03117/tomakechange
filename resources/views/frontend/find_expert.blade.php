@extends('frontend.main')
@section('content')
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    @include('frontend.questions')
                </div>
                <div class="col-md-6 mb-3">
                    <div class="w-100 h-100">
                        <img src="{{ url('public/assets/img/index-image.jpg') }}" alt=""
                            class="img-fluid rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
