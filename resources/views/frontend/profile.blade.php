@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('frontend.profilebox')
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
