@extends('frontend.main')
@section('content')
    <style>
        #preview,
        #paadhar {
            width: 100%;
            height: auto;
            min-height: 50px;
            border-radius: 7px;
            /* border: 1px dashed #077773; */
            max-height: 100px;
            object-fit: contain;
        }

        .fine-upload img {
            width: 100%;
            height: auto;
            min-height: 50px;
            border-radius: 7px;
            /* border: 1px dashed #077773; */
            max-height: 100px;
            object-fit: contain;
        }
    </style>
    <section class="space joinSection">
        <div class="container">
            <div class="row">

                <div class="col-md-10 offset-md-1">
                    <div class="w-100 mb-2">
                        @if (session()->has('success'))
                            <div class="alert alert-success bg-success text-white -bottom-3box-shadow-2">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="w-100 join-form">
                        <h4 data-bs-toggle="tooltip" class="mb-4 fw-bold border-bottom pb-2 border-success">
                            Create Expert Profile
                        </h4>
                        <div class="row" id="credbox">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Enter Mobile</label>
                                    <input type="tel" onchange="entervalues(event)" id="mobile"
                                        class="form-control border border-success">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Enter Email</label>
                                    <input type="email" onchange="entervalues(event)" id="email"
                                        class="form-control border border-success">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button id="sendOtpButton" disabled class="btn btn-primary d-block mt-4">Send
                                        OTP</button>
                                </div>
                            </div>
                        </div>
                        <div id="otpxbox" class="row" style="display: none;">
                            <div class="col-md-6">
                                <label for="">Enter Mobile OTP</label>
                                <div class="d-flex gap-3 mt-3">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Enter Email OTP</label>
                                <div class="d-flex gap-3 mt-3">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                    <input type="tel" name="" id="" class="otpbox">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-primary d-block mt-4 btn-sm">Verify OTP</button>
                                </div>
                            </div>
                        </div>


                        <div class="mt-3">
                            <p>
                                <a class="text-warning" href="{{ url('login') }}">
                                    Already have an account ? Login Now.
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        const entervalues = (e) => {
            const email = $("#email").val();
            const mobile = $("#mobile").val();
            if (email && mobile) {
                $("#sendOtpButton").removeAttr('disabled')
            }
            console.log(e.target.value)
        }
        $("#sendOtpButton").on('click', function(e) {
            e.preventDefault();
            const email = $("#email").val();
            const mobile = $("#mobile").val();
            $.post("{{ route('send_otps') }}", {
                mobile: mobile,
                'email': email
            }, function(res) {
                if (res.success == "0") {
                    if (res.errors?.email) {
                        toastr.error('Emails is already exists in our record', 'Error')
                    }
                    if (res.errors?.mobile) {
                        toastr.error('Mobile is already exists in our record', 'Error')
                    }
                }
                if (res.success == "1") {
                    $("#email").attr('readonly', 'readonly');
                    $("#mobile").attr('readonly', 'readonly');
                    $("#credbox").css({
                        'display': 'none'
                    })
                    $("#otpxbox").css({
                        'display': 'block'
                    })
                }
            })
        })
    </script>
@endsection
