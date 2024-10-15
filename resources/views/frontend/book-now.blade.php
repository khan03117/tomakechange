@extends('frontend.main')
@section('content')
    <section class="space ">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('cart.store') }}" id="checkoutForm" method="post">
                        <input type="hidden" name="expert_id" value="{{ $expert['id'] }}">
                        <input type="hidden" name="app_date" id="app_date" value="">
                        @csrf
                        <div class="accordion  bookingform  " id="accordionExample">
                            <div class="accordion-item border-0 mb-4">
                                <h2 class="accordion-header rounded-0 mb-0">
                                    <button class="accordion-button pb-0 rounded-0 bg-white shadow-none" type="button"
                                        data-bs-toggle="collapse" disabled="disabled" data-bs-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="mb-0">
                                            Book a Session
                                        </h4>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse mt-n2 collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-0 ">
                                        <div class="w-100">
                                            <div class="form-group mt-4 mb-0 ">
                                                <label for="" class="form-label">
                                                    Select Duration
                                                </label>
                                                <div class="row">
                                                    @foreach ($expert['fee'] as $i => $f)
                                                        <div class="col-md-auto col-6 mb-4">
                                                            <label for="duration{{ $i }}"
                                                                class="w-100 d-block durationlabel   categorybox d-flex align-items-center rounded-pill justify-content-center gap-2">
                                                                <input type="radio" class="duration"
                                                                    onclick="getPackages(event, {{ (strtotime($f['duration']) - strtotime(date('Y-m-d'))) / 60 }})"
                                                                    name="duration" id="duration{{ $i }}"
                                                                    value="{{ $f['id'] }}">
                                                                {{ (strtotime($f['duration']) - strtotime(date('Y-m-d'))) / 60 }}
                                                                Minutes
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <div class="w-100">
                                                    <div class="row">

                                                        <div class="col-md-9">
                                                            <label for="" class="form-label">
                                                                Select Appointment Date
                                                            </label>
                                                            <!--@include('frontend.calendar')-->
                                                            @include('frontend.calendar-slider')
                                                        </div>
                                                        <div class="col-md-3 mt-md-0 mt-4">
                                                            <label for="" class="form-label">
                                                                Select Slot
                                                            </label>
                                                            <div id="refesh" style="display: none;">
                                                                <img src="https://i.stack.imgur.com/NMgnW.gif"
                                                                    alt="" class="img-fluid">
                                                            </div>
                                                            <div id="slots">
                                                                {{-- <div class="alert alert-warning p-2 box-shadow-1 rounded-0">
                                                                    Please Select Date
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group visually-hidden">
                                                <label for="" class="form-label">
                                                    Select Mode of Contact
                                                </label>
                                                <div class="row">
                                                    @foreach (explode(',', $expert['modes']) as $i => $item)
                                                        @if ($i < 2)
                                                            <div class="col-md-auto col-6 mb-3">
                                                                <div class="w-100">
                                                                    <label role="button" for="mode{{ $i }}"
                                                                        class="d-block w-100 categorybox labelMode box-shadow-3 d-flex align-items-sm-center justify-content-center gap-2 rounded-pill">
                                                                        <input type="radio" class="modeinput"
                                                                            name="mode" id="mode{{ $i }}"
                                                                            value="{{ $item }}" @checked($dtls['contact_mode'] == $item) class="">
                                                                        {{ $item }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group" id="packages">
                                                    <div class="row d-none">
                                                        @foreach ($items as $i => $p)
                                                            <div class="col-md-6 mb-5">
                                                                <label for="quantity{{ $i }}"
                                                                    class="w-100 quantitylabel   d-block bx-package box-shadow-1">
                                                                    <input type="radio"
                                                                        class="visually-hidden position-absolute top-0 start-0"
                                                                        name="quantity" id="quantity{{ $i }}"
                                                                        value=" {{ $p['quantity'] }}">
                                                                    @if ($p['discount'] > 0)
                                                                        <span class="discount">
                                                                            {{ __('Discount ') . $p['discount'] . __('%') }}
                                                                        </span>
                                                                    @endif
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="w-100 p-3">
                                                                                <p>
                                                                                    No of Sessions
                                                                                </p>
                                                                                <p>
                                                                                    {{ $p['quantity'] }}
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-6 text-end">
                                                                            <div class="w-100 p-3">
                                                                                <p>
                                                                                    Net Pay
                                                                                </p>
                                                                                <p>
                                                                                    ₹
                                                                                    {{ $expert['fee'][0]['fee'] * $p['quantity'] - ($expert['fee'][0]['fee'] * $p['discount'] * $p['quantity']) / 100 }}
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="button" onclick="enterClientDetails()"
                                                    class="btn btn-primary rounded-pill px-md-5 py-md-2">
                                                    Save & Next
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-0 ">
                                <h2 class="accordion-header rounded-0  ">
                                    <button disabled="disabled" class="accordion-button collapsed bg-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        <h4>
                                            Client Details
                                        </h4>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-group ">
                                            <label for="" class="form-label">
                                                Enter Name
                                            </label>
                                            <input type="text" oninput="setPreviewValue(event, 'name')" name="name"
                                                id="name" value="{{ $user['name'] }}"
                                                class="form-control rounded-pill shadow-none">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">
                                                Enter Email
                                            </label>
                                            <input type="text" onkeydown="return this.value = this.value.toLowerCase()"  onfocusout="get_mobile_number(event)" oninput="setPreviewValue(event, 'email')"
                                                name="email" id="email" value="{{ $user['email'] }}"
                                                class="form-control rounded-pill shadow-none">
                                        </div>
                                        <div class="form-group ">
                                            <label for="" class="form-label">
                                                Enter Mobile
                                            </label>
                                            <input type="tel" minlength="10" maxlength="10"
                                                oninput="setPreviewValue(event, 'mobile')" name="mobile" id="mobile"
                                                value="{{ $user['mobile'] }}"
                                                class="form-control rounded-pill nospace shadow-none">
                                        </div>
                                        <div class="form-group ">
                                            <label for="" class="form-label">
                                                Select Gender
                                            </label>
                                            <div class="d-flex align-items-center gap-3">
                                                <label role="button" for="gender_male"
                                                    class="d-inline-flex align-items-center gap-2  box-shadow-2 rounded-pill p-2">
                                                    <input type="radio" onclick="setPreviewValue(event, 'gender')"
                                                        name="gender" id="gender_male" value="male">
                                                    <span class="ms-2">
                                                        Male
                                                    </span>
                                                </label>
                                                <label role="button" for="gender_female"
                                                    class="d-inline-flex align-items-center gap-2  box-shadow-2  rounded-pill p-2">
                                                    <input type="radio" onclick="setPreviewValue(event, 'gender')"
                                                        name="gender" id="gender_female" value="female">
                                                    <span class="ms-2">
                                                        Female
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">
                                                Age
                                            </label>
                                            <input type="number" name="age" oninput="setPreviewValue(event, 'age')"
                                                placeholder="Enter age in years" id="age"
                                                class="form-control rounded-pill">
                                        </div>
                                        <div class="form-group d-none">
                                            <label for="" class="form-label">
                                                State
                                            </label>
                                            <select name="state" id="state"
                                                onchange="setPreviewValue(event, 'state')"
                                                class="form-select rounded-pill">
                                                <option value="">---Select---</option>
                                                @foreach ($states as $st)
                                                    <option value="{{ $st['id'] }}" @selected($st['id'] == $dtls['state'])>
                                                        {{ $st['state'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-none">
                                            <label for="" class="form-label">
                                                City
                                            </label>
                                            <select name="city" id="city"
                                                onchange="setPreviewValue(event, 'city')"
                                                class="form-select rounded-pill">
                                                <option value="">---Select---</option>
                                                @foreach ($cities as $ct)
                                                    <option value="{{ $ct['id'] }}" @selected($ct['id'] == $dtls['city'])>
                                                        {{ $ct['city'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-none">
                                            <label for="" class="form-label">
                                                Pincode
                                            </label>
                                            <input type="tel" name="pincode"
                                                oninput="setPreviewValue(event, 'pincode')"
                                                placeholder="Six digit pincode" id="pincode"
                                                value="{{ $dtls['pincode'] }}" minlength="6" maxlength="6"
                                                class="form-control rounded-pill">
                                        </div>
                                        <div class="form-group">
                                            {{-- <button type="button"
                                                class="btn px-md-5 rounded-pill me-3 py-md-3 btn-warning"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Preview
                                            </button> --}}
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                                                <span>
                                                    Preview
                                                </span>
                                                <span class="btnicon text-white">
                                                    &#10230;
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="col-md-4">
                    <div class="w-100 p-md-4 expertProfileBox p-2  rounded box-shadow-2">
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-4">
                                <div class="w-100">
                                    <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt=""
                                        class="img-fluid" style="height:90px;object-fit:cover;overflow:hidden;">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="w-100 pt-3">
                                    <h4>
                                        {{ $expert['name'] }}
                                    </h4>
                                    <p class="mb-1">
                                        {{ $expert['post'] ? $expert['post']['post'] : $expert['custom_postname'] }}
                                    </p>
                                    <p class="mb-0">
                                        {{ $expert['city']['city'].' '.$expert['state']['state']  }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm tableProfile table-borderless">
                                    <tr>
                                        <td>
                                            Expertise
                                        </td>
                                        <td>
                                            @foreach ($expert['expertize'] as $c)
                                                <span
                                                    class="px-2 mb-1 me-1 py-1 border d-inline-block t-10 expertizeSpan border-success  text-primary rounded-pill">
                                                    {{ $c['sub_category'] }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Session Mode
                                        </td>
                                        <td>
                                            @foreach (explode(',', $expert['modes']) as $mod)
                                                <span class="me-2">
                                                    {{ $mod }} @if (!$loop->last)
                                                        ,
                                                    @endif
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Languages Speaks
                                        </td>
                                        <td>
                                            @foreach (explode(',', $expert['languages']) as $lan)
                                                <span class="me-2">
                                                    {{ $lan }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="w-100">
                                    <a href="{{ url($burl) }}" class="btn w-100 btn-primary">
                                        Choose Another
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title fs-5" id="staticBackdropLabel">Preview</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body previewForm">
                    <form action="" method="post">
                        @csrf
                        <div class="row">


                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Name
                                </label>
                                <input type="text" name="name" id="pname" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Appointment Date
                                </label>
                                <input type="text" name="date" id="pdate" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Gender
                                </label>
                                <input type="text" name="moble" id="pgender" readonly
                                    class="form-control text-capitalize">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Duration
                                </label>
                                <input type="text" name="duration" id="pduration" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Mobile
                                </label>
                                <input type="text" name="moble" id="pmobile" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Session Start Time
                                </label>
                                <input type="text" name="date" id="pslot" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Email
                                </label>
                                <input type="text" name="name"  id="pemail" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Session Mode
                                </label>
                                <input type="text" name="mode" id="pmode" value="{{$dtls['contact_mode']}}" readonly class="form-control">
                            </div>


                            <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Age
                                </label>
                                <input type="text" name="page" id="page" readonly class="form-control">
                            </div>

                            {{-- <div class="form-group col-md-6 mb-2">
                                <label for="" class="form-label">
                                    Pincode
                                </label>
                                <input type="text" name="ppincode" id="ppincode" value="{{ $dtls['pincode'] }}"
                                    readonly class="form-control">
                            </div> --}}




                            <div class="form-group col-md-6">
                                <label for="" class="form-label">
                                    No of Sessions
                                </label>
                                <input type="text" name="quantity" id="pquantity" readonly class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer bg-warning-subtle">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                        <span>
                            Edit
                        </span>
                        <span class="btnicon text-white">
                            &#10229;
                        </span>
                    </button>

                    <button type="button" onclick="submitForm()"
                        class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                        <span>
                            Confirm
                        </span>
                        <span class="btnicon text-white">
                            &#10230;
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script>
        let durt = "";
        const submitForm = () => {
            let arr = ['name', 'email', 'mobile', 'age'];
            console.log(arr);
            let err = [];
            arr.forEach((id, index) => {
                let mval = $("#" + id).val();
                if (mval == "" || mval == null || mval == undefined || mval.length == 0) {
                    err.push(id);
                } else {
                    console.log(mval);
                }
            });

            if (err.length == 0) {
                $("#checkoutForm").submit();
            } else {
                err.forEach((elm, index) => {
                    toastr.error(elm + ' Can not be empty', 'error');
                })
            }

        }
        const enterClientDetails = () => {
            let arr = ['pslot', 'pdate', 'pduration', 'pmode', 'pquantity'];
            let error = [];
            arr.forEach((id, index) => {
                let pval = $("#" + id).val();
                if (pval == '' && pval.length == 0) {
                    error.push(id);
                }
            })
            if (error.length == 0) {
                $('button[data-bs-target="#collapseOne"]').addClass('collapsed')
                $('button[data-bs-target="#collapseOne"]').removeAttr('disabled')
                $('button[data-bs-target="#collapseOne"]').attr('aria-expanded', 'false');
                $('button[data-bs-target="#collapseTwo"]').attr('aria-expanded', 'true');
                $('button[data-bs-target="#collapseTwo"]').removeAttr('disabled');
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                window.scrollTo(0, 0);
            } else {
                error.forEach((item, idx) => {
                    let arr = item.split('');
                    arr.shift();
                    toastr.error(arr.join('').toUpperCase() + ' can not be empty.', arr.join('').toUpperCase())

                })

            }
        }
        const getPackages = (event, duration) => {
            $("#slots").html('Please Select Date first !');
            $(".calendar-day-hove").removeClass('bg-warning text-white');
            const id = event.target.value;
            durt = id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(`${url}/ajax/get_packages`, {
                id: id,
                eid: {{ $expert['id'] }}
            }, function(res) {
                $("#packages").html(res);
                $("#pduration").val(duration + ' Minutes');
            });
        }
        $(document).on('click', '.labelslot', function() {
            $('.labelslot').removeClass('bg-primary text-white');
            $(this).addClass('bg-primary text-white');
        })
        $(document).on('click', '.labelMode', function() {
            $('.labelMode').removeClass('bg-primary text-white');
            $(this).addClass('bg-primary text-white');
        })
        $(document).on('click', '.durationlabel', function() {
            $(".calendar-day-hover").removeClass('bg-warning text-white');
            $('.durationlabel').removeClass('bg-primary text-white');
            $(this).addClass('bg-primary text-white');
        })
        $(document).on('click', '.quantitylabel', function() {
            $('.quantitylabel').removeClass(' bg-primary text-white');
            $(this).addClass('bg-primary text-white');
        });
        const setPreviewValue = (event, id) => {
            ['name', 'email', 'mobile'].forEach((idx, index) => {
                $("#p" + idx).val($("#" + idx).val());
            })
            $("#p" + id).val(event.target.value);
        }
        $(document).on('click', '.labelslotinput', function() {
            $("#pslot").val($(this).data('val'));

        });
        $(document).on('click', '.quantityInput', function() {
            $("#pquantity").val($(this).data('val'));
        });


        $(".modeinput").each(function() {
            $(this).on('click', function() {
                $("#pmode").val($(this).val());
            })
        })
    </script>
    <script>
        $(document).on('click', '.calendar-day-hover', function() {
            $("#slots").html('');
            $("#refesh").show();
            let duration = $(".duration:checked").val();

            let isrun = false;
            if (duration == null || duration == "") {
                alert('Select Duration First');
            } else {
                $(".calendar-day-hover").removeClass('bg-warning text-white rounded-3 ');
                $(this).addClass('bg-warning text-white rounded-3');
                let date = $(this).find('input[type="radio"]').val();
                $.post(`${url}/ajax/get_slot`, {
                    date: date,
                    eid: {{ $expert['id'] }},
                    duration: duration
                }, function(res) {
                    setTimeout(() => {
                        $("#refesh").hide();
                        $("#slots").html(res);
                    }, 1200);
                    $("#pdate").val(moment(date).format('DD-MMMM-YYYY'));
                    $("#app_date").val(date);
                })

            }

        });
        const get_mobile_number = (e) => {
            let key = e.target.value;
            $.post(`${url}/ajax/get_mobile_number`, {key : key}, function(res){
                $("#mobile").val(res);
            })
        }
    </script>
    
@endsection
