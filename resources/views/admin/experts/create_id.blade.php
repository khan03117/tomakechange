@extends('layouts.main')
@section('content')
    <section>
        <style>
            .fine-uploader {
                border: 1px dashed #077773;
                height: 100px;
                width: 100px;
                display: block;
            }

            .fine-uploader img {
                object-fit: contain;
                max-width: 100px;
            }
        </style>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="card card-body  shadow-success">
                        <form action="{{ route('join_request.store', $item['id']) }}" enctype="multipart/form-data"
                            method="post" class="row gy-4">
                            @csrf
                            <div class="col-md-12">
                                <div class="w-100 p-2 bg-success-subtle">
                                    Personal Details
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="">
                                    Profile Photo <small class="text-danger">*Required</small>
                                </label>
                                <label for="file" role="button" class="fine-uploader">
                                    <img src="{{ url('public/upload/' . $item['profile_img']) }}" alt=""
                                        id="preview" class="img-fluid contain">
                                    <input type="file" onchange="previewImage(event)" name="file" id="file"
                                        class="visually-hidden">
                                    <input type="hidden" name="hfile" value="{{ $item['profile_img'] }}"
                                        class="visually-hidden">

                                </label>

                            </div>

                            <script type="text/javascript">
                                function previewImage(event) {
                                    var input = event.target;
                                    var image = document.getElementById('preview');
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            image.src = e.target.result;
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <div class="col-md-5 form-group">
                                <label for="">
                                    Enter Name <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="name" id="name"
                                    value="{{ $item['first_name'] . ' ' . $item['last_name'] }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="">
                                    Enter Email <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="email" id="email" value="{{ $item['email'] }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Enter Mobile <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="mobile" id="mobile" value="{{ $item['mobile'] }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Select State <small class="text-danger">*Required</small>
                                </label>
                                <select name="state_id" onchange="getCityByState(event)" id="state_id" class="form-select"
                                    required>
                                    <option value="">---Select---</option>
                                    @foreach ($states as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['state'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Select City <small class="text-danger">*Required</small>
                                </label>
                                <select name="city_id" id="cities" class="form-select" required>
                                    <option value="">---Select---</option>
                                    @foreach ($states as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['state'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Pincode <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="pincode" id="pincode" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <div class="w-100 p-2 bg-success-subtle">
                                    Professional Details
                                </div>
                            </div>
                            <div class=" col-md-4 form-group">
                                <label for="">
                                    Enter Role <small class="text-danger">*Required</small>
                                </label>
                                <select name="apply_for" onchange="get_sub_category(event)" id=""
                                    class="form-select" required>
                                    <option value="" selected disabled>--Select--</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">
                                    Expertise <small class="text-danger">*Required</small>
                                </label>
                                <select name="expertises[]" multiple id="sub_category" class="form-select" required>
                                    <option value="">--Select--</option>

                                </select>
                                <script>
                                    $("#sub_category").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true

                                    });
                                </script>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Languages <small class="text-danger">*Required</small>
                                </label>
                                <select name="language[]" multiple id="language" class="form-select" required>
                                    <option value="" disabled>---Select---</option>
                                    @foreach ($languages as $l)
                                        <option value="{{ $l['language'] }}">{{ $l['language'] }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $("#language").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    })
                                </script>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">
                                    Enter Password <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Mode of Contact <small class="text-danger">*Required</small>
                                </label>
                                <select name="mode[]" multiple id="mode" class="form-select" required>

                                    <option value="Online Video">Online Video</option>
                                    <option value="Online Audio">Online Audio</option>
                                    <option value="In Person">In Person</option>
                                </select>
                                <script>
                                    $("#mode").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    })
                                </script>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    30 Min Fee <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="fee[]" id="" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    60 Min Fee <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="fee[]" id="" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-5 form-group">
                                <input type="submit" value="Create Expert" class="btn px-md-5  btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
