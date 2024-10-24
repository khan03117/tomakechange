@extends('frontend.main')
@section('content')
    <section class="space teamSection">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center text-warning">
                                <h3>
                                    Talk to our Experts
                                </h3>
                                <p class="text-primary">
                                    Meet our expert Team, from all across Bharat.<br>
                                    Our experienced professionals conduct Counselling sessions, therapies via audio, video
                                    mode.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($items as $i => $item)
                            <div class="col-md-4 col-md-6 col-12 mb-4">
                                <div
                                    class="w-100 h-100 team__box rounded border border-success overflow-hidden position-relative">
                                    <div class="row w-100">
                                        <div class="col-md-2">
                                            <div class="image__team text-center w-100">
                                                <figure class="w-100 h-100">
                                                    <img src="{{ url('public/upload/' . $item['profile_image']) }}"
                                                        class="img-fluid w-100 rounded-0"
                                                        style="height:100%;object-position:top;object-fit:contain;" />
                                                </figure>


                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="desc__team ">
                                                <div class="w-100 px-2">

                                                    <table class="table table-sm table-borderless mb-0">


                                                        <tr>
                                                            <td style="width: 25%">
                                                                <i class="fi fi-ts-hands-holding-diamond text-primary"></i>
                                                                Expertise
                                                            </td>
                                                            <td style="width: 75%">



                                                                <div class="d-flex wrapper{{ $i }} pb-2 expert__box flex-wrap align-items-center gap-1"
                                                                    id="scrollbar">
                                                                    @foreach ($item['expertize'] as $i => $exp)
                                                                        <span
                                                                            class="">{{ $exp['sub_category'] }}</span>
                                                                    @endforeach
                                                                </div>



                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 25%">
                                                                <i class="fi fi-ts-language text-primary"></i> Language
                                                            </td>
                                                            <td style="width: 75%">
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
                                                                <i class="fi fi-ts-camera-movie text-primary"></i>
                                                                Availability Mode
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
                                                    {{ $item['post'] }}
                                                </p>
                                                <p class="mb-0">
                                                    {{ $item['experience'] }} years
                                                </p>
                                                <p>
                                                    {{ $item['city']['city'] . ', ' . $item['state']['state'] }}
                                                </p>

                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-md-0 mb-3">
                                            <div class="w-100 text-end">
                                                <a href="{{ url('profile/' . $item['url']) }}"
                                                    class="btn btn-outline-success rounded-pill">
                                                    View Profile
                                                </a>
                                                <button data-expert="{{ $item['id'] }}"
                                                    onclick="sendCallBackRequest(event)"
                                                    class="btn btn-primary rounded-pill bookingbtn">
                                                    Ask for a call back
                                                </button>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let count = 0;
        const sendCallBackRequest = (e) => {
            e.preventDefault();

            const eid = e.target.dataset.expert;
            const data = {
                expert_id: eid,
                "lead_id": "{{ $lead_id }}"
            }
            let resp = {};
            if (count < 4) {
                $.post("{{ route('send_callback_request') }}", data);
                event.target.innerHTML = "<strong>Please  Wait....</strong>";
                event.target.disabled = true;
                event.target.innerHTML = "<strong>Request sent.</strong>";
                count++
            } else {
                toastr.error("Only 4 request can be sent at one search", 'Error')
            }




        };
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
@endsection
