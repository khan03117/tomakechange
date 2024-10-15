@extends('frontend.main')
@section('content')
    <style>
        .questionDesc ul li,
        .questionDesc p {
            font-size: 14px;
        }

        .questionDesc ul {
            padding: 0;
            margin: 0;
            list-style: none
        }

        .questionDesc ul li {
            padding: 5px 0;
        }

        .questionDesc ul li:not(:last-of-type) {
            border-bottom: 1px solid #4d4c4c;
        }
    </style>
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id">
                        <input type="hidden" name="sub_category_id" id="sub_category_id">
                        <input type="hidden" name="end_category_id" id="end_category_id">
                        <div class="w-100  h-100 findExpert rounded-3  overflow-hidden">
                            <div class="w-100 h-100 position-relative" id="question10">
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
                                                <label role="button" for="for_me"
                                                    class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                                                    <input type="radio" class="firstQuestionInput" name="is_for_me"
                                                        id="for_me" value="1">
                                                    <span class="ms-1">Yes, for me</span>
                                                </label>
                                                <label role="button" for="for_other"
                                                    class="w-100 h-100 d-flex align-items-center  p-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                                                    <input type="radio" class="firstQuestionInput" name="is_for_me"
                                                        id="for_other" value="0">
                                                    <span class="ms-1">No, for someone else</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 h-100 hiddenrows position-relative" id="question11">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="question-title text-warning">
                                            <h3>
                                                For whom do you wish to seek this service?
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <input type="text" name="for_whome" id="for_whome"
                                            class="form-control rounded-pill shadow-none">
                                    </div>
                                    <div class="sticky-bottom w-100 start-0 bottom-0">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <button type="button"
                                                    onclick="previousQuestion('question10', 'question11')"
                                                    class="btn btn-outline-warning rounded-pill w-100">
                                                    Previous
                                                </button>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <button type="button" onclick="nextQuestion('question11', 'question1')"
                                                    class="btn w-100 rounded-pill btn-warning">
                                                    Next
                                                </button>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="w-100 h-100 hiddenrows position-relative" id="question1">
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
                                            <label for="label{{ $item['id'] }}"
                                                onclick="selectCategory('{{ $item['id'] }}')"
                                                id="categorybox{{ $item['id'] }}"
                                                class="w-100 h-100 categorybox  py-2 rounded-pill bg-white text-primary box-shadow-2 text-center">
                                                <input type="checkbox" name="cats" class="visually-hidden"
                                                    id="label{{ $item['id'] }}" value="{{ $item['id'] }}"
                                                    @checked($qcat1['id'] == $item['id'])>
                                                <div class="w-100 pointer-events-none text-center">
                                                    <h4 class="mb-0 text-center">
                                                        {{ $item['category'] }}
                                                    </h4>
                                                </div>

                                            </label>
                                        </div>
                                    @endforeach

                                    <div class="sticky-bottom w-100 start-0 bottom-0">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <button type="button" onclick="previousQuestion('question10', 'question1')"
                                                    class="btn btn-outline-warning rounded-pill w-100">
                                                    Previous
                                                </button>
                                            </div>
                                            {{-- <div class="col-md-6 mb-3">
                                                <button type="button" onclick="getEndCategories()"
                                                    class="btn w-100 rounded-pill btn-warning">
                                                    Next
                                                </button>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100 hiddenrows h-100 position-relative" id="question2">
                                <div id="question2-data" class="row"></div>
                                <div class="row">
                                    <!--<div class="col-md-6 mb-3">-->

                                    <!--    <label for="subcategoryother" id="otherSubCategoryLabel" role="button"-->
                                    <!--        class="w-100  rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">-->
                                    <!--        <input type="checkbox" name="subcats[]" class="custom-check"-->
                                    <!--            onclick="selectSubCategory(event)" value="other" id="subcategoryother">-->
                                    <!--        <h4 class="mb-0">-->
                                    <!--            Other-->
                                    <!--        </h4>-->
                                    <!--    </label>-->

                                    <!--</div>-->
                                </div>
                                <div class="sticky-bottom w-100 start-0 bottom-0">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="button" onclick="previousQuestion('question1', 'question2')"
                                                class="btn btn-outline-warning rounded-pill w-100">
                                                Previous
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button type="button" onclick="getEndCategories()"
                                                class="btn w-100 rounded-pill btn-warning">
                                                Next
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="w-100 hiddenrows" id="question3">
                                <div id="question3-data" class="row mb-4"></div>

                                <div class="stickty-bottom w-100 start-0 bottom-0">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="button" onclick="previousQuestion('question2', 'question3')"
                                                class="btn btn-outline-warning rounded-pill w-100">
                                                Previous
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button type="button" onclick="nextQuestion('question3', 'question4')"
                                                class="btn w-100 rounded-pill btn-warning">
                                                Next
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="w-100 hiddenrows" id="question4">
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
                                        <select name="state" onchange="getCityByState(event)" id="state"
                                            class="form-select">
                                            <option value="">---Select---</option>
                                            @foreach ($states as $item)
                                                <option value="{{ $item['id'] }}"
                                                    @if (Auth::user()) @selected(Auth::user()->state_id == $item['id']) @endif>
                                                    {{ $item['state'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="">
                                            Select City/District
                                        </label>
                                        <select name="city" id="cities" class="form-select">
                                            @if (Auth::user())
                                                @foreach ($cities as $c)
                                                    <option value="{{ $c['id'] }}">{{ $c['city'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Enter Pincode
                                        </label>
                                        <input type="tel" name="pincode" id="pincode" minlength="6"
                                            maxlength="6"
                                            oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');"
                                            class="form-control"
                                            @if (Auth::user()) value="{{ Auth::user()->pincode }}" @endif>
                                    </div>
                                </div>
                                <div class="stickty-bottom w-100 start-0 bottom-0">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="button" onclick="previousQuestion('question3', 'question4')"
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
                            <div class="w-100 hiddenrows">
                                <div class="col-md-12 question-title text-warning">
                                    <h3>
                                        Which mode of discussion with our Experts, would you be comfortable with?
                                    </h3>
                                </div>
                                <input type="hidden" class="contact_mode" name="contact_mode" value="Audio"
                                    id="onlineaudio" />



                            </div>
                            <div class="w-100 hiddenrows" id="question5">
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
                                                        onclick="selectLanguage(event)" value="{{ $item['language'] }}"
                                                        id="{{ $item['language'] }}" @checked(in_array($item['language'], explode(',', $lang_arr)))>
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
                                            <button type="button" onclick="previousQuestion('question5', 'question6')"
                                                class="btn btn-outline-warning rounded-pill w-100">
                                                Previous
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button class="btn w-100 rounded-pill btn-warning">
                                                Submit
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="w-100 h-100">
                        <img src="{{ url('public/assets/img/index-image.jpg') }}" alt=""
                            class="img-fluid rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let arr = [];
        let end_cats = [];
        let cmode = [];


        $(".firstQuestionInput").each(function() {
            $(this).on('click', function() {
                let isyes = $(this).val();
                //current
                $("#question10").removeClass(
                    'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
                )
                $("#question10").addClass('animate__animated animate__backOutLeft')
                $("#question10").fadeOut('1000')
                if (isyes == '1') {
                    //next
                    $("#question1").removeClass(
                        'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
                    )
                    $("#question1").addClass('animate__animated animate__backInRight')
                    $("#question1").fadeIn('1000');
                } else {
                    //next
                    $("#question11").removeClass(
                        'animate__animated animate__backInRight  animate__backInLeft animate__backOutRight animate__backOutLeft'
                    )
                    $("#question11").addClass('animate__animated animate__backInRight')
                    $("#question11").fadeIn('1000');
                }
            })
        })
        const selectCategory = (id) => {

            if (id == '3') {
                $("#otherSubCategoryLabel").removeClass('d-block d-flex');
                $("#otherSubCategoryLabel").addClass('d-none');
            } else {
                $("#otherSubCategoryLabel").removeClass('d-none');
                $("#otherSubCategoryLabel").addClass('d-flex');
            }
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

        $(window).on('load', function() {
            if ({!! json_encode($qcat1) !!}.id != null && {!! json_encode($qcat1) !!}.id != undefined) {
                selectCategory({{ $qcat1['id'] }});
            }
        })

        const selectSubCategory = (event) => {
            let id = event.target.value;

            if (event.target.checked == true) {
                if (id == 'other') {
                    $('input.subcatinput').attr('disabled', 'disabled')
                    $('input.subcatinput').prop('checked', false);
                    arr = [];
                }
                arr.push(id);
            } else {
                if (id == 'other') {
                    $('input[type="checked"]').removeAttr('disabled')
                    $('input.subcatinput').removeAttr('disabled', 'disabled')

                }

                let index = arr.indexOf(id);
                if (index > -1) {
                    arr.splice(index, 1);
                }

            }
            $("#sub_category_id").val(arr.toString());
        }

        const previousQuestion = (destination, current) => {
            if (destination == 'question2' && current == 'question3') {
                end_cats = [];
                $("#end_category_id").val('');
            }
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
            let category_id = $("#category_id").val();
            if (current == 'question11' && destination == 'question1') {
                let for_whome = $("#for_whome").val();
                if (for_whome == "" || for_whome == ' ' || for_whome == undefined || for_whome == null) {
                    go_forward = false;
                } else {
                    go_forward = true;
                }
                console.log(for_whome);
            }
            if (destination == 'question5') {
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
            }
            if (current == 'question2' && category_id == '3') {
                destination = 'question4';
                go_forward = true;
            }
            if (current == 'question3' && destination == 'question4') {
                if (end_cats.length == 0) {
                    go_forward = false;
                } else {
                    go_forward = true;
                }
            }




            if (go_forward == true) {
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
            } else {
                toastr.error("Please fill all details", 'Error')
            }
        }
        const getEndCategories = () => {
            let cid = $("#category_id").val();
            let ids = $("#sub_category_id").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(`${url}/ajax/get_end_category_question`, {
                ids: ids,
                cid: cid
            }, function(res) {
                let cid = $("#category_id").val();
                $("#question3-data").html(res);
                if (cid == 3) {
                    nextQuestion('question2', 'question4');
                } else {
                    $("#question2").removeClass('animate__backInLeft')
                    $("#question2").addClass('animate__animated animate__backOutLeft')
                    $("#question2").fadeOut('500')
                    $("#question3").removeClass('animate__backOutRight')
                    $("#question3").addClass('animate__animated animate__backInRight')
                    $("#question3").fadeIn('500');
                }


            })
        }
        const selectEndCategory = (e) => {
            let id = e.target.value;

            if (e.target.checked == true) {
                end_cats.push(id);
            } else {
                if (e.target.type == 'text') {
                    end_cats = [];
                    end_cats.push(end_cats.toString() + id);
                }
                let index = err.indexOf(id);
                if (index > -1) {
                    end_cats.splice(index, 1);
                }
            }
            $("#end_category_id").val(end_cats.toString());
        }
        $(".contact_mode").on('click', function() {
            cmode.push($(this).val());
        })
        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-full-width",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 500,
            "timeOut": 500,
            "extendedTimeOut": 100
        }
    </script>
@endsection
