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
                    {!! Form::open(['url' => route('video.update', $video['id']), 'method' => 'PUT', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="">
                                Upload Thumbnail
                            </label>
                            <input type="file" name="image" id="image" class="form-control">
                            <img src="{{url('public/upload/'.$video['image'])}}" alt="" class="img-fluid">
                            <input type="hidden" name="hfile" value="{{$video['image']}}" />
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="">
                                Enter Youtube URL
                            </label>
                            <input type="text" name="url" id="url" value="{{$video['url']}}" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Update Video" class="btn btn-success px-md-4">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
