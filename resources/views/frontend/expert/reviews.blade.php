@extends('frontend.user.main')

@section('ucontent')
    <div class="container">
        <div class="row">
            @if (count($items) == 0)
                <div class="alert alert-warning">No Review Found</div>
            @endif
            @foreach ($items as $item)
                <div class="col-md-4">
                    <div class="w-100 reviewBox">
                        {!! $item->review !!}
                        <div class="w-100">
                            <p>{{ $item->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
