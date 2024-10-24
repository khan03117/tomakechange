@extends('frontend.main')
@section('content')
    <style>
        .joinSection label {
            font-size: 12px;
            font-weight: 600px;
            color: #077773;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 1rem;
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
                                    <input type="tel" autocomplete="off" maxlength="10" minlength="10"
                                        onkeydown="entervalues(event)" id="mobile"
                                        class="form-control border border-success">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Enter Email</label>
                                    <input type="email" autocomplete="off" onkeydown="entervalues(event)" id="email"
                                        class="form-control border border-success">
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label for="termsconditions" role="button">
                                    <input type="checkbox" onclick="entervalues(event)" name="" id="termsconditions">
                                    <small>
                                        I am filling up this information for myself and all
                                        the information provided by me is correct. I am solely
                                        responsible for my interactions with my Clients and I do
                                        not hold the Company responsible for anything, whatsoever.
                                        I understand, Edha is a platform to connect me to prospective
                                        Clients, seeking professional assistance.

                                    </small>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button id="sendOtpButton" disabled class="btn btn-primary d-block mt-4">Send
                                        OTP</button>
                                </div>
                            </div>
                        </div>

                        <div id="otpxbox" style="display: none;">


                            <div class="row  py-3">
                                <div class="col-md-6">
                                    <label for="">Enter Mobile OTP</label>
                                    <div class="d-flex gap-3">
                                        <div class="d-flex gap-3 mt-3">
                                            <input type="tel" class="otpbox mobile-otp" maxlength="1"
                                                oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                            <input type="tel" class="otpbox mobile-otp" maxlength="1"
                                                oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                            <input type="tel" class="otpbox mobile-otp" maxlength="1"
                                                oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                            <input type="tel" class="otpbox mobile-otp" maxlength="1"
                                                oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Enter Email OTP</label>
                                    <div class="d-flex gap-3">
                                        <input type="tel" class="otpbox email-otp" maxlength="1"
                                            oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                        <input type="tel" class="otpbox email-otp" maxlength="1"
                                            oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                        <input type="tel" class="otpbox email-otp" maxlength="1"
                                            oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                        <input type="tel" class="otpbox email-otp" maxlength="1"
                                            oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button onclick="verifyOtp(event)"
                                            class="btn btn-primary d-block mt-4 btn-sm">Verify OTP</button>
                                    </div>
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
            const ischecked = document.getElementById("termsconditions").checked;
            console.log(ischecked)
            if (ischecked) {
                $("#sendOtpButton").removeAttr('disabled')
            } else {
                $("#sendOtpButton").attr('disabled', 'disabled')
            }

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
                        toastr.error('Please enter a valid email id', 'Error')
                    }
                    if (res.errors?.mobile) {
                        toastr.error('Please enter a  valid mobile number', 'Error')
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
        });
        const verifyOtp = (e) => {
            e.preventDefault();
            const email = $("#email").val();
            const mobile = $("#mobile").val();
            let mobileOtp = '';
            document.querySelectorAll('.mobile-otp').forEach(input => {
                mobileOtp += input.value;
            });

            // Get the email OTP
            let emailOtp = '';
            document.querySelectorAll('.email-otp').forEach(input => {
                emailOtp += input.value;
            });
            const data = {
                email: email,
                mobile: mobile,
                emailotp: emailOtp,
                mobileotp: mobileOtp
            }
            $.post("{{ route('verify_otps') }}", data, function(res) {
                // if (res.success == "1") {
                //     const router = "{{ route('expert.register') }}" + `?email=${email}&mobile=${mobile}`;
                //     window.location.href = router;
                // }
                if (res.success == "1") {
                    const ev = res.data.email;
                    const mv = res.data.mobile;
                    // Create a form element
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('expert.register') }}"; // Your route here

                    // CSRF token input (if required by Laravel)
                    const csrfToken = '{{ csrf_token() }}';
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Add email input
                    const emailInput = document.createElement('input');
                    emailInput.type = 'hidden';
                    emailInput.name = 'email';
                    emailInput.value = ev;
                    form.appendChild(emailInput);

                    // Add mobile input
                    const mobileInput = document.createElement('input');
                    mobileInput.type = 'hidden';
                    mobileInput.name = 'mobile';
                    mobileInput.value = mv;
                    form.appendChild(mobileInput);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }

                if (res.success == "0") {
                    if (res.errors?.emailotp) {
                        toastr.error('Email otp is incorrect', 'Error')
                    }
                    if (res.errors?.mobileotp) {
                        toastr.error('Mobile otp is incorrect', 'Error')
                    }
                }
            })
        }

        function moveToNext(current) {
            const inputs = document.querySelectorAll('.otpbox');
            const index = Array.prototype.indexOf.call(inputs, current);

            if (current.value.length === current.maxLength && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        }

        function moveToPrevious(event, current) {
            const inputs = document.querySelectorAll('.otpbox');
            const index = Array.prototype.indexOf.call(inputs, current);

            if (event.key === 'Backspace' && current.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        };
    </script>
@endsection
