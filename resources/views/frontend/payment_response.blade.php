@extends('frontend.main')
@section('script')



<!-- Event snippet for [XT] | Booking Confirmation conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-11473539656/xI9wCMmjwI4ZEMikgd8q',
      'value': 500.0,
      'currency': 'INR',
      'transaction_id': ''
  });
</script>


@endsection
@section('content')
    
    <section class="space">
          <script src="https://printjs.crabbly.com/print.js"></script>
    <link rel="stylesheet" href="https://printjs.crabbly.com/print.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            .paymentResponse {
                padding: 2rem;
                box-shadow: 2px 1px 3px 0px #ccc, inset 14px 7px 17px 0px #e9e9e9, inset -10px -14px 9px 0px #efefef;

            }

            .paymentResponse::before {
                content: "";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 30px;
                height: 30px;
                background: #fff;
                border-radius: 50%;
                left: -18px;
            }

            .paymentResponse::after {
                content: "";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 30px;
                height: 30px;
                background: #fff;
                border-radius: 50%;
                right: -18px;
            }

            #divider {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                height: 1px;
                border: 1px dashed #ddd;



            }

            .paymentResponse img {
                width: 80px;
            }

            .paymentResponse .innerSection {
                margin-bottom: 7rem;
            }

            .paymentResponse .bottomSection {
                position: relative;
                top: -3rem;
                color: gray;
            }

            .paymentResponse .bottomSection .d-flex span:first-child {
                font-weight: 600;
                position: relative;
                width: 48%;
            }

            .paymentResponse .bottomSection .d-flex span:first-child::before {
                content: ":";
                position: absolute;
                right: 0;
                top: 0;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1" id="printJS-form">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="w-100 rounded-3 bg-light paymentResponse  position-relative">
                                <div class="position-relative">
                                   
                                    <div class="w-100 text-center mb-5 pb-4 position-relative innerSection">

                                        @if ($cart['payment_status'] == 'Success')
                                            <img src="https://www.balcalnutrefy.com/wp-content/uploads/2021/09/right-tick.png"
                                                class="img-fluid" />
                                            <h4 class="t-20 fw-bold text-primary">
                                                Payment Successful
                                            </h4>
                                        @endif

                                        @if ($cart['payment_status'] != 'Success')
                                            <span style="font-size:3.5rem">
                                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                                            </span>
                                            <h4 class="t-20 fw-bold text-danger">
                                                Payment Failed
                                            </h4>
                                        @endif





                                    </div>
                                    <div id="divider" class="mb-3 d-none"></div>
                                    <div class="w-100 mb-0  pb-0 position-relative bottomSection">
                                        @foreach(json_decode($cart['cca_response']) as  $resp)
                                            @php
                                                $i = 0;
                                            @endphp
                                        @foreach($resp as $key => $r)
                                        @php
                                        $i++;
                                        @endphp
                                        @if($i < 5)
                                        <div class="d-flex justify-content-between">
                                            <span>
                                               {!!Form::label($key)!!}
                                            </span>
                                            <span>
                                               {{ $r}}
                                            </span>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endforeach
                                        <p class="text-center text-warning mt-5">
                                          An email confirmation with your login credentials have been mailed to your email id.
Please use the same, to join your booked session.

                                        </p>
                                        <p class="text-center mb-0">
                                            <button type="button" class="btn btn-sm btn-success" onclick="printJS({ printable: 'printJS-form', type: 'html', css: ['{!!url('public/assets/css/style.css')!!}']  })"><i class="fi fi-ts-print-magnifying-glass"></i></button>
                                            <!--<button type="button" class="btn btn-sm btn-success" onclick="generateslip()"><i class="fi fi-ts-print-magnifying-glass"></i></button>-->
                                            <a href="{{url('login')}}" class="btn btn-primary btn-sm ms-2 rounded-1 t-12">Click to Dashboard</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <script>
        const generateslip = () => {
            window.jsPDF = window.jspdf.jsPDF;

var doc = new jsPDF();
	
// Source HTMLElement or a string containing HTML.
var elementHTML = document.querySelector("#printJS-form");

doc.html(elementHTML, {
    callback: function(doc) {
        // Save the PDF
        doc.save('payment-document.pdf');
    },
    x: 15,
    y: 15
   
});
        }
    </script>
@endsection
