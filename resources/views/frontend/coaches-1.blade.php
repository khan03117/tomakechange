@extends('frontend.main')
@section('content')
    <section class="space teamSection bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center text-warning">
                        <h3>
                            {{ $title }}
                        </h3>
                        <p class="text-primary">
                            Meet our expert Team, from all across Bharat.<br>
                            {{-- Our experienced professionals conduct Counselling sessions, therapies via audio, video or on
                            physical one-on-one basis --}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($items as $i => $item)
                    <div class="col-md-4 col-md-6 col-12 mb-4">
                        <div class="w-100 h-100 team__box rounded border border-success overflow-hidden position-relative">
                            <div class="row w-100">
                                <div class="col-4 pe-md-0">
                                    <div class="image__team">
                                        <figure class="w-100">
                                            <img src="{{ url('public/upload/' . $item['profile_image']) }}"
                                                class="img-fluid w-100 cover" />
                                        </figure>


                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="desc__team pt-3">
                                        <div class="w-100">
                                            <table class="table table-sm table-borderless mb-0">


                                                {{-- <tr>
                                                    <td>
                                                        <i class="fi fi-ts-hands-holding-diamond text-primary"></i>
                                                        Expertise
                                                    </td>
                                                    <td>



                                                        <div class="d-flex wrapper{{ $i }} pb-2 expert__box flex-nowrap align-items-center gap-1"
                                                            id="scrollbar">
                                                            @foreach ($item['expertize'] as $i => $exp)
                                                                <span
                                                                    class="rounded-pill d-block expertize bg-primary text-white ">{{ $exp['sub_category'] }}</span>
                                                            @endforeach
                                                        </div>



                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-language text-primary"></i> Language
                                                    </td>
                                                    <td>
                                                        <p class="mb-0"
                                                            style="  white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">


                                                            @foreach (explode(',', $item['languages']) as $lan)
                                                                <span class="me-2">
                                                                    {{ $lan }}@if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-camera-movie text-primary"></i> Session Mode
                                                    </td>
                                                    <td>
                                                        <p>
                                                            @foreach (explode(',', $item['modes']) as $mod)
                                                                <span class="me-2">
                                                                    {{ $mod }} @if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        </p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <i class="fi text-success fi-ts-indian-rupee-sign"></i> Session Fee
                                                    </td>
                                                    <td>
                                                        @foreach ($item['fee'] as $fe)
                                                            <p>
                                                                {{ (strtotime($fe['duration']) - strtotime(date('Y-m-d'))) / 60 }}
                                                                Minutes @ {{ $fe['fee'] }}
                                                            </p>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fi fi-ts-puzzle-alt text-primary"></i> Earliest Available
                                                    </td>
                                                    <td>
                                                        @foreach ($item['slots'] as $j => $slot)
                                                            @if ($j == 0)
                                                                <p>
                                                                    {{ date('d-M-Y', strtotime($slot['slot'])) }},
                                                                    {{ date('h:i A', strtotime($slot['slot'])) }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 border-top  py-2 border-success"></div>
                                <div class="col-md-6">
                                    <div class="w-100 px-2">
                                        <h4>
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="mb-0">
                                            {{ $item['post'] ?? $item['custom_postname'] }}
                                        </p>
                                        {{-- <p class="mb-0">
                                            {{ $item['experience'] }} years of experience
                                        </p> --}}
                                        <p>
                                            {{ $item['city']['city'] . ', ' . $item['state']['state'] }}
                                        </p>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="w-100 text-end">
                                        {{-- <a href="{{ url('profile/' . $item['url']) }}"
                                            class="btn btn-outline-success rounded-pill">
                                            View Profile
                                        </a> --}}
                                        <button data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item['id'] }}"
                                            class="btn btn-primary rounded-pill bookingbtn">
                                            Book An Appointment
                                        </button>
                                        @include('frontend.bookingModel', [
                                            'expert_id' => $item['id'],
                                        ])
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
