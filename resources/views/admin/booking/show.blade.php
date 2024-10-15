@extends('layouts.main')
@section('content')
    <section>
        <style>
            table{
            box-shadow:0 0 10px #ccc;
            background:#fefefe;
            }
        </style>
        <div class="container">

            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="w-100 text-end">
                        <a href="{{ url('admin/sessions/all/all') }}" class="btn btn-success">
                            Back
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="w-100">
                            <p class="mb-0">
                                <b>User Details :</b>
                            </p>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                @php
                                    $user = $item['user'];
                                    $cart = $item['cart'];
                                    $expert = $item['expert'];
                                    $slot = $item['slot'];
                                @endphp
                                
                                <tr>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        {{$user['name']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        {{$user['email']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mobile
                                    </td>
                                    <td>
                                        {{$user['mobile']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        State
                                    </td>
                                    <td>
                                        {{$user['state']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        City
                                    </td>
                                    <td>
                                        {{$user['city']}}
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td>
                                        Gender
                                    </td>
                                    <td>
                                        {{$user['gender']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Age
                                    </td>
                                    <td>
                                        {{$user['age']}}
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <p class="mb-0">
                            <b>Sessions Details :</b>
                        </p>
                    </div>
                      <table class="table table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Start
                                    </th>
                                    <th>
                                        End
                                    </th>
                                    <th>
                                        Duration
                                    </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $a => $tr )
                                
                                <tr>
                                    <td>
                                        {{$a + 1}}
                                    </td>
                                    @if($tr['slot'])
                                   <td>
                                       {{ date('d-M-Y h:i A', strtotime($tr['slot']['slot']))}}
                                   </td>
                                   <td>
                                       {{ date('h:i A', strtotime($tr['slot']['slot_end']))}}
                                   </td>
                                   <td>
                                       {{$tr['slot']['duration']}}
                                   </td>
                                   <td>
                                       {{$tr['slot']['booking_status']}}
                                   </td>
                                   @endif
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="col-md-6">
                     <div class="w-100">
                        <p class="mb-0">
                            <b>Payment Details :</b>
                        </p>
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>
                                        Amount Paid
                                    </th>
                                    <td>
                                        {{$cart_payment['total_pay']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Base Amount
                                    </th>
                                    <td>
                                        {{$cart_payment['base_amount']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Coordination Fee
                                    </th>
                                    <td>
                                        {{number_format($cart_payment['conven_fee'], 2)}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Discount Package
                                    </th>
                                    <td>
                                        {{$cart_payment['dis_package']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Discount Promo
                                    </th>
                                    <td>
                                        {{$cart_payment['dis_promo']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Sessions Count
                                    </th>
                                    <td>
                                        {{$cart_payment['quantity']}}
                                    </td>
                                </tr>
                                 @if($cart['cca_response'])
                                 @php
                                 $varr = [0,1,2,3,4,5,6,7,8,9,11];
                                 @endphp
                                @foreach( json_decode($cart['cca_response']) as $pay)
                                    @php
                                    $j = -1;
                                    @endphp
                                    @foreach($pay as $key => $p)
                                    @php
                                        $j++;
                                    @endphp
                                        @if(in_array($j, $varr))
                                        <tr>
                                            <th>
                                                {!!Form::label($key)!!}
                                            </th>
                                            <td>
                                               {{$p}}
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <p class="mb-0">
                            <b>Expert Details :</b>
                        </p>
                         <table class="table table-bordered">
                            <tbody>
                                @if($expert)
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach(json_decode(json_encode($expert)) as $key => $p)
                                    @php
                                    $i++;
                                    @endphp
                                    @if(in_array($i, [4,5,6,7,8,9,10,11,12,13,14]))
                                    <tr>
                                        <th>
                                            {!!Form::label($key)!!}
                                        </th>
                                        <td>
                                            {{$p}}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                 @if(isset($refunds['remark']))
                <div class="col-md-6">
                    <div class="w-100">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>
                                        Remark
                                    </th>
                                    <td>
                                        {{$refunds['remark']}} 
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
