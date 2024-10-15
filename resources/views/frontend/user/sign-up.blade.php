@extends('frontend.main')
@section('content')
    <style>
        #preview {
            width: 100%;
            height: 59px;
            border-radius: 7px;
            border: 1px dashed #077773;
            object-fit: contain;
        }
    </style>
    <section class="space joinSection">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="w-100 mb-2">
                        @if (session()->has('success'))
                            <div class="alert alert-success bg-success text-white -bottom-3box-shadow-2">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="w-100 join-form">
                        <h4 class="mb-4 fw-bold border-bottom pb-2 border-success">
                            User Registration
                        </h4>
                        <form action="{{ route('signup_user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-2 gx-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" placeholder="First Name"
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        <small class="text-danger">
                                            @error('name')
                                                {{ $errors->first('name') }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" placeholder="Enter Email"
                                            value="{{ old('email') }}"
                                            class="form-control  @error('email') is-invalid @enderror">
                                        <small class="text-danger">
                                            @error('email')
                                                {{ $errors->first('email') }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile"
                                            value="{{ old('mobile') }}"
                                            class="form-control  @error('mobile') is-invalid  @enderror">
                                        <small class="text-danger">
                                            @error('mobile')
                                                {{ $errors->first('mobile') }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="password" id="password" placeholder="Enter Password"
                                            value="{{ old('password') }}"
                                            class="form-control  @error('password') is-invalid  @enderror">
                                        <small class="text-danger">
                                            @error('password')
                                                {{ $errors->first('password') }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="w-100 text-center">
                                        <input type="submit" value="Submit"
                                            class="btn w-100 btn-warning px-md-5 rounded-pill ">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="mt-3">
                            <p>
                                <a class="text-warning" href="{{ url('login') }}">
                                    Already have an account ? Login Now.
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100 text-end">
                        <img src="https://img.freepik.com/free-vector/freelancer-working-laptop-her-house_1150-35048.jpg"
                            alt="" class="img-fluid" style="max-width: 400px">
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
