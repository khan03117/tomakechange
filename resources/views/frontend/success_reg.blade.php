@extends('frontend.main')
@section('content')
    <section class="space joinSection min-vh-100">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-md-6 h-100">
                    <div class="card card-body border-warning box-shadow-2 bg-warning-subtle overflow-hidden text-center">
                        <div class="w-100">
                            <img width="100"
                                src="https://pcsupport.lenovo.com/in/en/~/media/bfa9b421669043368f52e0b22d5d3c94.ashx?h=42&la=en&w=42"
                                alt="" class="img-fluid">
                        </div>
                        <div class="w-100 p-2">
                            <h4 class="fw-bold text-primary">
                                Success
                            </h4>
                            <p>
                               Thank you!
You shall receive credentials in your registered email, shortly.
                            </p>
                            <p class="mt-3 pt-3 border-top border-warning">
                                <img width="200" src="{{ url('public/assets/img/logo.png') }}" alt=""
                                    class="img-fluid">
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
