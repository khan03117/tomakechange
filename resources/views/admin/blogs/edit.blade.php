@extends('layouts.main')
@section('content')
  <style>
        input,select{
            border:1px solid #b7b4b4 !important;
        }
        .label-info{
            background:green;
            color:#fff;
        }
    </style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-100 text-end">
                        <a href="{{ route('blog.index') }}" class="btn btn-success">
                            View All Blogs
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['url' => route('blog.update', $blog['id']), 'method' => 'PUT', 'files' => true]) !!}
                    <div class="row">
                         <div class="col-md-3">
                            <div class="w-100">
                                <label for="">Enter meta keywords</label>
                                <input type="text" value="{{ $blog['meta_key'] }}" class="form-control w-100 d-inline-block" maxlength="255" name="meta_key" id="meta_key" />
                                <small class="text-danger">Enter comma to separate (max 255 charactes)</small>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="w-100">
                                <label for="">Enter meta description</label>
                                <input type="text" value="{{ $blog['meta_desc'] }}" class="form-control" maxlength="300" name="meta_desc" />
                                <small class="text-danger">max 300 characters</small>
                            </div>
                        </div>
                         <div class="col-md-6 mb-4">
                            <label for="">
                                Banner Image
                            </label>
                            <input type="file"  name="image" id="image" accept=".jpg, .jpeg, .png"
                                class="form-control">
                            <img width="200" src="{{url('public/assets/img/'.$blog['image'])}}" class="img-fluid"/>
                                <input type="hidden" name="himage" value="{{ $blog['image'] }}"/>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="">
                                Enter Title
                            </label>
                            <input type="text" value="{{ $blog['title'] }}" name="title" id="title"
                                class="form-control">
                        </div>
                       
                        <div class="col-md-12 mb-4">
                            <label for="">
                                Enter Description
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $blog['description'] }}</textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Update Blog" class="btn btn-success px-md-4">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
