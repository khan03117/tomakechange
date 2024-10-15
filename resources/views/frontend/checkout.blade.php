@extends('frontend.main')
@section('content')
    <section class="space checkoutpage">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div
                        class="w-100 p-md-4 p-2 checkoutbox rounded box-shadow-1 overflow-hidden position-relative d-flex flex-column gap-2">
                        <svg class="mui-style-ltr-6du0xp-decoPrimary" id="muisvg">
                            <use xlink:href="{{ url('public') }}/images/deco-feature.svg#main"></use>
                        </svg>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    Session Summary
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Name
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ $user['name'] }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Session Date
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ date('d-M-Y', strtotime($item['apt_date'])) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Session Time
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ date('h:i A', strtotime($item['slot']['slot'])) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Session Mode
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ $item['mode'] }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Session Duration
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ abs(strtotime(date('Y-m-d')) - strtotime($item['fee']['duration'])) / 60 }} Minutes
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Session With
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class=" w-100 formValue ">

                                    {{ $item['expert']['name'] }}



                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Email
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ $user['email'] }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Mobile
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 formValue">
                                    {{ $user['mobile'] }}
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-md-4 position-relative">
                    {{-- <svg fill="#cccccc" class="mui-style-ltr-dqi2l4-parallaxDot">
                        <use xlink:href="{{ url('public') }}/images/dot-deco.svg#dot"></use>
                    </svg> --}}
                    <div class="w-100 bg-light box-shadow-2 rounded p-3 checkoutformbox">

                        <h4>
                            Booking Summary
                        </h4>


                        <table class="table table-borderless bg-light table-light">
                            <tr>
                                <td>
                                    No of Sessions
                                </td>
                                <td>
                                    {{ $qty = $item['package']['quantity'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fee Per Session
                                </td>
                                <td>
                                    {{ __('₹ ') . ($fee = $item['fee']['fee']) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Promo Code
                                </td>
                                <td>
                                    <input type="text" name="" id=""
                                        class="form-control rounded-0 shdow-none">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Discount 
                                </td>
                                <td>
                                    {{ __('₹ ') . ($d = $item['package']['discount'] * 0.01 * $fee * $item['package']['quantity']) }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Coordination Fee
                                </td>
                                <td>
                                    @php
                                        $total = $item['fee']['fee'] * $qty;
                                        $dis = $total * $item['package']['discount'] * 0.01;
                                        echo '₹ ';
                                         $conven_fee = ($total - $dis) * floatval($conven_fee['rate']) * 0.01 + floatval($conven_fee['fixed_fee']) * $qty;
                                        echo number_format($conven_fee, 2);
                                    @endphp
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Total Payable
                                </td>
                                <td>
                                    @php
                                        $sub_total = $total + $conven_fee - $dis;
                                    @endphp
                                    {{ __('₹') . ' ' . number_format($sub_total, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <form action="" id="checkoutFormfi" method="post">
                                        @csrf
                                        <input type="hidden" name="sid" value="{{ $item['session_id'] }}">
                                        <div class="w-100 py-2">
                                            <label for="acceptTerms">
                                                <span>
                                                    <input type="checkbox" class="custom-check" name=""
                                                        id="acceptTerms" required checked>
                                                </span>
                                                <span>
                                                     I have read edha’s <a target="_blank"
                                                        href="{{ url('policy/terms-conditions') }}"> Terms and conditions </a>,<a target="_blank" href="policy/privacy-policy"> Privacy Policy</a> & <a target="_blank"
                                                        href="{{ url('policy/cancellation-policy') }}"> rescheduling and cancellation policy</a>.
                                                </span>
                                            </label>
                                        </div>
                                        <!--<div class="w-100 py-2">-->
                                        <!--    <label for="acceptTerms1">-->
                                        <!--        <span>-->
                                        <!--            <input type="checkbox" class="custom-check" name=""-->
                                        <!--                id="acceptTerms1" required checked>-->
                                        <!--        </span>-->
                                        <!--        <span>-->
                                        <!--            I have read rescheduling of <a target="_blank"-->
                                        <!--                href="{{ url('policy/cancellation-policy') }}">session policyv</a>-->
                                        <!--        </span>-->
                                        <!--    </label>-->
                                        <!--</div>-->

                                    </form>
                                    <button id="checkoutFormfiBtn"
                                        class="btn mt-3  btn-success w-100 py-2  btn-all d-flex align-items-center justify-content-center   position-relative  rounded-pill">
                                        <span class="py-1">
                                            Confirm Session
                                        </span>

                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#checkoutFormfiBtn").on('click', function(e) {
            e.preventDefault();
            if($("#acceptTerms").is(':checked')){
                 $("#checkoutFormfiBtn").removeClass('d-flex');
            $("#checkoutFormfiBtn").addClass('d-none');
            $("#checkoutFormfiBtn").remove();
            $("#checkoutFormfi").submit();
            }else{
                alert('Please click on checkbox first');
            }
           
        });
    </script>
@endsection
