<style>
    .form_user_details .form-control {
        border: 1px solid #f67c33;
    }

    .form_user_details label {
        font-size: 14px;
        font-weight: 300;
        text-transform: uppercase;
        display: block;
        margin-bottom: 0.4rem;
        letter-spacing: 1px;
    }

    .form_user_details .form-group {
        margin-bottom: 1.2rem;
    }
</style>
<div class="w-100 findExpert overflow-hidden">

    <form action="{{ route('find_expert.store') }}" id="findExpertForm" method="post">
        @csrf
        <input type="hidden" name="category_id" id="category_id">
        <input type="hidden" name="sub_category_id" id="sub_category_id">
        <div class="w-100 h-100  position-relative" id="question1">
            <div class="row">
                <div class="col-md-12">
                    <div class="question-title text-warning">
                        <h3>
                            Are you looking out for?
                        </h3>
                    </div>
                </div>
                @foreach ($categories as $item)
                    <div class="col-md-4 mb-3">
                        <label for="label{{ $item['id'] }}" onclick="selectCategory('{{ $item['id'] }}')"
                            id="categorybox{{ $item['id'] }}"
                            class="w-100 h-100 categorybox  py-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                            <input type="checkbox" name="category_id" class="visually-hidden"
                                id="label{{ $item['id'] }}" value="{{ $item['id'] }}">
                            <div class="w-100 pointer-events-none text-center">
                                <h4 class="mb-0 text-center">
                                    {{ $item['category'] }}
                                </h4>
                            </div>

                        </label>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="w-100 h-100 hiddenrows position-relative" id="question2">
            <div class="row">
                <div class="col-md-12">
                    <div class="question-title text-warning">
                        <h3>
                            Are you looking out for?
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="row" id="question2-data"></div>
                </div>
                <div class="col-md-12">
                    <div class="stickty-bottom w-100 start-0 bottom-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <button type="button" onclick="previousQuestion('question1', 'question2')"
                                    class="btn btn-outline-warning rounded-pill w-100">
                                    Previous
                                </button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" onclick="nextQuestion('question2', 'question3')"
                                    class="btn w-100 rounded-pill btn-warning">
                                    Next
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 h-100 hiddenrows position-relative" id="question3">
            <div class="row ">
                <div class="col-md-12">
                    <div class="question-title text-warning">
                        <h3>
                            You need Consultation for Self or someone else?
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="w-100">
                        <div class="d-flex gap-2">
                            <label onchange="nextQuestion('question3', 'question5')" role="button" for="for_me"
                                class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                                <input type="radio" class="firstQuestionInput" name="is_for_me" id="for_me"
                                    value="1">
                                <span class="ms-1">Yes, for me</span>
                            </label>
                            <label onchange="nextQuestion('question3', 'question4')" role="button" for="for_other"
                                class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                                <input type="radio" class="firstQuestionInput" name="is_for_me" id="for_other"
                                    value="0">
                                <span class="ms-1">No, for someone else</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 h-100 hiddenrows position-relative" id="question4">
            <div class="row">
                <div class="col-md-12">
                    <div class="question-title text-warning">
                        <h3>
                            For whom do you wish to seek this service?
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <input type="text" name="for_whome" id="for_whome" class="form-control rounded-pill shadow-none">
                </div>
                <div class="sticky-bottom w-100 start-0 bottom-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <button type="button" onclick="previousQuestion('question4', 'question3')"
                                class="btn btn-outline-warning rounded-pill w-100">
                                Previous
                            </button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="button" onclick="nextQuestion('question4', 'question5')"
                                class="btn w-100 rounded-pill btn-warning">
                                Next
                            </button>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <div class="w-100 hiddenrows" id="question5">
            <div class="col-md-12 question-title text-warning">
                <h3>
                    Which region are for you from?
                </h3>
            </div>
            <div class="w-100 input-group-question mb-4">
                <div class="form-group mb-4">
                    <label for="">
                        Select State
                    </label>
                    <select name="state" onchange="getCityByState(event)" id="state" class="form-select"
                        required>
                        <option value="">---Select---</option>
                        @foreach ($states as $item)
                            <option value="{{ $item['id'] }}"> {{ $item['state'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="">
                        Select City/District
                    </label>
                    <select name="city" id="cities" class="form-select" required>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Enter Pincode
                    </label>
                    <input type="tel" name="pincode" id="pincode" minlength="6" maxlength="6"
                        oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');" class="form-control"
                        required>
                </div>
            </div>
            <div class="stickty-bottom w-100 start-0 bottom-0">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button type="button" onclick="previousQuestion('question5', 'question3')"
                            class="btn btn-outline-warning rounded-pill w-100">
                            Previous
                        </button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="button" onclick="nextQuestion('question5', 'question6')"
                            class="btn w-100 rounded-pill btn-warning">
                            Next
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <div class="w-100 hiddenrows" id="question6">
            <div class="col-md-12 question-title text-warning">
                <h3>
                    What is the age of the person requiring service?
                </h3>
            </div>
            <div class="w-100 input-group-question mb-4">
                @php
                    $ages = ['6-12', '12-18', '18-24', '24-40', '40-50', 'Above 50'];
                @endphp
                @foreach ($ages as $ag)
                    <div class="w-100 mb-4">
                        <label onchange="nextQuestion('question6', 'question7')" role="button"
                            for="for_other{{ $ag }}"
                            class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                            <input type="radio" class="firstQuestionInput" name="age_group"
                                id="for_other{{ $ag }}" value="{{ $ag }}">
                            <span class="ms-1">{{ $ag }}</span>
                        </label>
                    </div>
                @endforeach
            </div>


        </div>
        <div class="w-100 hiddenrows" id="question7">
            <div class="col-md-12 question-title text-warning">
                <h3>
                    Would you consider online consultation ?
                </h3>
            </div>
            <div class="w-100 input-group-question mb-4">
                @php
                    $ages = ['Yes', 'No', 'Both'];
                @endphp
                @foreach ($ages as $ag)
                    <div class="w-100 mb-4">
                        <label onchange="nextQuestion('question7', 'question8')" role="button"
                            for="contact_mode{{ $ag }}"
                            class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                            <input type="radio" class="firstQuestionInput" name="contact_mode"
                                id="contact_mode{{ $ag }}" value="{{ $ag }}">
                            <span class="ms-1">{{ $ag }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="w-100 hiddenrows" id="question8">
            <div class="col-md-12 question-title text-warning">
                <h3>
                    How soon would you like the service ?
                </h3>
            </div>
            <div class="w-100 input-group-question mb-4">
                @php
                    $joinarr = [
                        'Immediately',
                        'In this Week',
                        'Over Weekend',
                        'Not very sure',
                        'Would like to discuss with the Professional',
                    ];
                @endphp
                @foreach ($joinarr as $i => $ag)
                    <div class="w-100 mb-4">
                        <label onchange="nextQuestion('question8', 'question9')" role="button"
                            for="how_soon{{ $i }}"
                            class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                            <input type="radio" class="firstQuestionInput" name="how_soon"
                                id="how_soon{{ $i }}" value="{{ $ag }}">
                            <span class="ms-1">{{ $ag }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="w-100 hiddenrows" id="question9">
            <div class="col-md-12 question-title text-warning">
                <h3>
                    Any preference of Language for your session?
                </h3>
            </div>
            <div class="w-100 input-group-question mb-4">
                <div class="row">
                    @foreach ($langs as $item)
                        <div class="col-md-6 mb-3">
                            <label for="{{ $item['language'] }}" role="button"
                                class="w-100 d-block rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">
                                <input type="checkbox" name="langs[]" class="custom-check"
                                    value="{{ $item['language'] }}" id="{{ $item['language'] }}">
                                <h4 class="mb-0">
                                    {{ $item['language'] }}
                                </h4>
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="stickty-bottom w-100 start-0 bottom-0">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button type="button" onclick="previousQuestion('question9', 'question8')"
                            class="btn btn-outline-warning rounded-pill w-100">
                            Previous
                        </button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="button" onclick="nextQuestion('question9', 'question10')"
                            class="btn btn-outline-warning rounded-pill w-100">
                            Next
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="w-100 hiddenrows  form_user_details" id="question10">
            <div class="w-100">
                <div class="mb-4">
                    <div id="msg"></div>
                </div>
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input type="text" id="name" name="name" onkeydown="validateMobileEnter(event)"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Enter Email</label>
                    <input type="email" id="email" name="email" onkeydown="validateMobileEnter(event)"
                        class="form-control" required>
                </div>
                <div class="w-100" id="mobileBox" style="display: none;">


                    <div class="form-group">
                        <label for="">Enter Mobile</label>
                        <input type="text" onchange="enterMobile(event)" id="mymobile" minlength="10"
                            maxlength="10" name="mobile" class="form-control" required>
                    </div>
                    <div id="otpbox" class="form-group" style="display: none">
                        <label for="">Enter OTP</label>
                        <input type="text" id="myotp" minlength="4" maxlength="4" name="otp"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="button" id="sendOtpButton" onclick="sendOtp(event)" disabled="disabled"
                            class="btn w-100 rounded-pill btn-warning">
                            Submit
                        </button>
                        <button type="button" id="verifyButton" style="display: none" onclick="verifyOtp(event)"
                            class="btn w-100 rounded-pill btn-warning">
                            Verify OTP
                        </button>
                        <button type="submit" id="submitButton" style="display: none"
                            class="btn w-100 rounded-pill btn-warning">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    const validateMobileEnter = (e) => {
        const val = e.target.value;
        const name = $("#name").val();
        const email = $("#email").val();
        if (name && email) {
            $("#mobileBox").css('display', 'block')
        } else {
            $("#mobileBox").css('display', 'none')
        }
    }
    const enterMobile = (e) => {
        const val = e.target.value;
        $("#name").attr('readonly', 'readonly');
        $("#email").attr('readonly', 'readonly');
        if (val.length == 10) {
            $("#sendOtpButton").removeAttr('disabled');
        } else {
            $("#sendOtpButton").attr('disabled', 'disabled');
        }
    }
    const sendOtp = (e) => {
        e.preventDefault();
        const mobile = $("#mymobile").val();
        $.post("{{ route('send_otp') }}", {
            'mobile': mobile
        });
        toastr.success('Otp has been sent to your mobile', 'Success')
        e.target.html = "<strong>OTP sent successfully.</strong>";
        e.target.disabled = true;
        $("#otpbox").show();
        $("#sendOtpButton").css('display', 'none');
        $("#mymobile").attr('readonly', 'readonly');
        $("#verifyButton").css('display', 'block');

    }
    const verifyOtp = (e) => {
        e.preventDefault();
        const mobile = $("#mymobile").val();
        const otp = $("#myotp").val();
        const data = {
            mobile: mobile,
            otp: otp
        };
        $.post("{{ route('verify_otp') }}", data, function(res) {
            if (res.success == "1") {
                $("#verifyButton").css('display', 'none');
                $("#findExpertForm").submit();
            }
        })
    }

    let arr = [];
    let end_cats = [];
    let cmode = [];

    const selectCategory = (id) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(`${url}/ajax/get_sub_category_question`, {
            id: id
        }, function(res) {
            $("#question2-data").html(res);
            $("#question1").removeClass(
                'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
            )
            $("#question1").addClass('animate__animated animate__backOutLeft')
            $("#question1").fadeOut('1000')
            $("#question2").removeClass(
                'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
            )
            $("#question2").addClass('animate__animated animate__backInRight')
            $("#question2").fadeIn('1000');
            $("#category_id").val(id);
            arr = [];
            err = [];
            $("#sub_category_id").val('');
        })
    }

    const previousQuestion = (destination, current) => {

        $("#" + current).removeClass(
            ' animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
        );
        $("#" + current).addClass(' animate__animated animate__backOutRight');
        $("#" + current).fadeOut('2000');
        $("#" + destination).removeClass(
            'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
        );
        $("#" + destination).addClass('animate__animated animate__backInLeft');
        $("#" + destination).fadeIn('2000');

    }
    const nextQuestion = (current, destination) => {

        let go_forward = false;
        if (destination == 'question6') {
            let state = $("#state").val();
            let city = $("#cities").val();
            let pincode = $("#pincode").val();
            console.log(state + city + pincode);
            if (state != undefined && city != undefined && pincode.length == 6) {
                go_forward = true;
            } else {
                go_forward = false;
                toastr.error("Please Fill State, city & pincode", 'Error')
            }
        } else {
            go_forward = true;
        }
        if (go_forward) {


            $("#" + current).removeClass(
                ' animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
            );
            $("#" + current).addClass(' animate__animated animate__backOutLeft');
            $("#" + current).fadeOut('2000');
            $("#" + destination).removeClass(
                'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
            );
            $("#" + destination).addClass('animate__animated animate__backInRight');
            $("#" + destination).fadeIn('2000');
        }

    }

    toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-full-width",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 500,
        "timeOut": 500,
        "extendedTimeOut": 100
    };
</script>
