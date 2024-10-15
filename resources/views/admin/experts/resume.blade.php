@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <iframe src="{{ url('public/upload/' . $item['resume']) }}#toolbar=0"  loading="lazy"
            title="PDF-file" type="application/pdf" width="100%" height="100%"
                class="min-vh-100"></iframe>

        </div>

    </section>
@endsection
