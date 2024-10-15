@extends('layouts.main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <section>
        <div class="container">
            <div class="row">
                <form action="{{ route('services.store') }}" enctype="multipart/form-data" method="post"
                    class="col-md-12 p-2 shadow-primary">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Category</label>
                            <select class="form-select" name="category_id">
                                <option value="">---Select---</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat['id']}}">{{$cat['category']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">

                            @csrf
                            <div class="form-group mb-3">
                                <label for="">
                                    Upload Image
                                </label>
                                <input type="file" name="image" class="form-control">
                            </div>



                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Service Title
                                </label>
                                <input type="text" value="{{ old('title') }}" name="title" id="title"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">
                                Description
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-md-12">
                            <label for="">
                                Key Points
                            </label>
                            <textarea name="key_points" id="keypoints" cols="30" rows="10"></textarea>
                            <script>
                                CKEDITOR.replace('keypoints');
                            </script>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="form-label d-block">
                                    &nbsp;
                                </label>
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
