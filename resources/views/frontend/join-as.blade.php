@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="w-100 loginform border p-4  box-shadow-2">
                        <h4 class="text-start text-primary mb-3 pb-3 border-bottom">
                            Register
                        </h4>
                        <div class="row gy-4 mb-3 pt-3">
                            <div class="col-md-6">
                                <a href="{{ url('signup-user') }}" class="btn w-100 text-uppercase btn-warning">
                                    User
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('signup') }}" class="btn w-100 text-uppercase btn-primary">
                                    Expert
                                </a>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <a class="text-primary" href="{{ url('login') }}">
                                    Already have an account ? Login Now.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100 text-end">
                        <img src="https://img.freepik.com/free-vector/placeholder-concept-illustration_114360-4727.jpg"
                            alt="" style="max-width: 500px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
