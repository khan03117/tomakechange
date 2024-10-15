@extends('frontend.main')
@section('content')
    <section class="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="w-100 p-4 border box-shadow-1 rounded loginform">
                        <h4 class="text-center text-primary mb-3">
                            Login
                        </h4>
                        <form action="{{ route('user.login') }}" method="post" class="" autocomplete="off">
                            @csrf
                            <div class="form-group mb-4">
                                {!! Form::label('email', 'Enter Email', ['class' => 'd-block']) !!}
                                {!! Form::text('email', old('email'), ['class' => 'form-control shadow-none', 'id' => 'email', 'oninput' => 'return this.value = this.value.toLowerCase()']) !!}
                            </div>
                            <div class="form-group mb-4">
                                {!! Form::label('password', 'Enter Password') !!}
                                {!! Form::password('password', ['class' => 'form-control shadow-none']) !!}
                            </div>
                            {{-- <div class="form-group mb-3">

                                <div class="row">
                                    <div class="col-2">
                                        <span class="input-group-text bg-white border-secondary">
                                            +91
                                        </span>
                                    </div>
                                    <div class="col-10 position-relative">

                                        <input type="text" name="mobile" placeholder="Enter Mobile" id="mobile" autocomplete="false"
                                            autofill="off" autofocus class="form-control border-secondary shadow-none">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group mb-3 d-none">
                                <div class="d-flex flex-wrap gap-3 align-items-center otpGroup">
                                    <input type="text" name="" id="" minlength="1" maxlength="1"
                                        class="form-control otp">
                                    <input type="text" name="" id="" minlength="1" maxlength="1"
                                        class="form-control otp">
                                    <input type="text" name="" id="" minlength="1" maxlength="1"
                                        class="form-control otp">
                                    <input type="text" name="" id="" minlength="1" maxlength="1"
                                        class="form-control otp">
                                </div>
                            </div> --}}
                            <div class="form-group mt-4">
                                <input type="submit" value="Login" class="btn btn-warning rounded-pill px-md-5 w-100">
                            </div>
                        </form>
                        <div class="mt-3">
                            <p>
                                <a href="{{ url('signup') }}" class="text-warning">
                                    Not an account ? Signup Now
                                </a>
                            </p>
                            <p>
                                <a href="{{ url('forgot-password') }}" class="text-warning">
                                    Forgot Password ?
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="w-100 text-end px-md-5 ">
                        <img src="https://img.freepik.com/premium-vector/counseling-depression-white-background-vector-illustration-flat_953432-972.jpg"
                            alt="" style="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(".otp").each(function() {
            $(this).on('keyup', function() {
                let dig = $(this).val();

                if (dig.length > 0) {
                    $(this).next().focus();
                }
            })
        })
    </script>
@endsection
