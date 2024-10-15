@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="policy">
                    {!! $policy['content'] !!}
                </div>
            </div>
        </div>
    </section>
@endsection
