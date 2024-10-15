@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-100 profile_box rounded box-shadow-1  p-4 bg-success-subtle">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="w-100">
                                    <figure class="w-100 profile_box_image ">
                                        <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt=""
                                            class="img-fuid  rounded box-shadow-1 profile_box_image">
                                    </figure>
                                    <div class="w-100">
                                        <h4>
                                            {{ $expert['name'] }}
                                        </h4>
                                        <!--<p class="degtext">-->
                                        <!--    {{ $expert['designation'] == '1' ? 'Counseller' : 'Coach' }}-->
                                        <!--</p>-->
                                        <p class="mb-0">
                                            {{ $expert['post'] ? $expert['post']['post'] : $expert['custom_postname'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="w-100 h-100   overflow-hidden position-relative">


                                    <div class="">
                                        <div class="w-100">
                                            <table class="table table-sm table-borderless mb-0">


                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-hands-holding-diamond text-primary"></i>
                                                        Expertise
                                                    </td>
                                                    <td>
                                                        <div class="d-flex wrapper pb-2 expert__box flex-wrap align-items-center gap-1"
                                                            id="scrollbar">
                                                            @foreach ($expert['expertize'] as $i => $exp)
                                                                <span
                                                                    class="rounded-pill d-block expertize bg-primary text-white ">{{ $exp['sub_category'] }}</span>
                                                            @endforeach
                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-book-copy text-primary"></i> Education
                                                    </td>
                                                    <td>
                                                        {{ $expert['qualification'] == "1" ? "Graduate" : "Postgraduate" }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-book-copy text-primary"></i> Therapy
                                                    </td>
                                                    <td>
                                                        {{ $expert['therapy'] }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-hourglass-start text-primary"></i> Experience
                                                    </td>
                                                    <td>
                                                        {{ $expert['experience'] }} years
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-language text-primary"></i> Language
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




                                              
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-puzzle-alt text-primary"></i> Earliest Available
                                                    </td>
                                                    <td>
                                                        @foreach ($expert['slots'] as $j => $slot)
                                                            @if ($j == 0)
                                                                <p>
                                                                    {{ date('d-M-Y', strtotime($slot['slot'])) }},
                                                                    {{ date('h:i A', strtotime($slot['slot'])) }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                  <tr>
                                                    <td>
                                                        <i class="fi fi-ts-license text-primary"></i> Additional Information
                                                    </td>
                                                    <td>
                                                        <div class="w-100 addDetails  border-success">
                                                            {!! $expert['additional_details'] !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <p>
                                    <strong>
                                        Session Modes :
                                    </strong>
                                    @foreach (explode(',', $expert['modes']) as $mod)
                                        <span class="me-2">
                                            {{ $mod }} @if (!$loop->last)
                                                ,
                                            @endif
                                        </span>
                                    @endforeach
                                </p>
                            </div>
                            <!--<div class="col-md-12">-->
                            <!--    <p>-->
                            <!--        <strong>-->
                            <!--            Earliest Availability :-->
                            <!--        </strong>-->

                            <!--        @foreach ($expert['slots'] as $j => $slot)-->
                            <!--            @if ($j == 0)-->
                            <!--                <span>-->
                            <!--                    {{ date('d-M-Y', strtotime($slot['slot'])) }},-->
                            <!--                    {{ date('h:i A', strtotime($slot['slot'])) }}-->
                            <!--                </span>-->
                            <!--            @endif-->
                            <!--        @endforeach-->
                            <!--    </p>-->
                            <!--</div>-->
                            <div class="col-md-6">
                                @foreach ($expert['fee'] as $fe)
                                    <p>
                                        <strong>Session Duration : </strong>
                                        {{ (strtotime($fe['duration']) - strtotime(date('Y-m-d'))) / 60 }}
                                        Minutes @ {{ __('₹ ') . $fe['fee'] }}
                                    </p>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <div class="text-end">
                                     <a href="{{ url('counsellers') }}"
                                        class="btn btn-outline-success shadow rounded-pill px-md-5 me-2">
                                        Back
                                    </a>
                                    <a href="{{ url('book-now/' . $expert['url']) }}"
                                        class="btn btn-primary shadow rounded-pill px-md-5">
                                        Book Now
                                    </a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
