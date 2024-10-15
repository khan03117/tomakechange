@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-100 text-end">
                        <a href="{{ route('video.index') }}" class="btn btn-success">
                            View All Videos
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['url' => route('video.store'), 'method' => 'POST', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">
                                Select Cateogry
                            </label>
                            <select name="category" id="category" class="form-select">
                                <option value="">---Select---</option>
                                @foreach ($cats as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['sub_category'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">
                                Upload Thumbnail
                            </label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">
                                Enter Youtube URL
                            </label>
                            <input type="text" name="url" id="url" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Add Video" class="btn btn-success px-md-4">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
