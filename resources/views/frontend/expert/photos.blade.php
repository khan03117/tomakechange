@extends('frontend.user.main')

@section('ucontent')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="w-100">
                    <form action="{{ route('expert_photos.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="d-block">&nbsp;</label>
                                <button class="btn btn-primary d-block">Save Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($photos as $item)
                <div class="col-md-4 g-1 gy-1">
                    <div class="w-100">
                        <figure class="w-100 rounded-1 overflow-hidden">
                            <img src="{{ url($item->image) }}" class="img-fluid" alt="">
                        </figure>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
