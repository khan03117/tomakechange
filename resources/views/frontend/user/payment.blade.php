@extends('frontend.user.main')

@section('ucontent')
    <style>
        table tr th {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }

        table tr td {
            font-size: 12px;
            font-weight: 400;
        }
    </style>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-12 p-0">
                <div class="w-100 table-responsive">
                    <table class=" table table-sm table-bordered table-hover table-light">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Payment Date</th>
                                <th>Total No Of Sessions</th>
                                <th>Expert</th>
                                <th>Base Amount</th>
                                <th>Coordination Fee</th>
                                <th>Discount On Package</th>
                                <th>Discount Promo Code</th>
                                <th>Total Pay</th>
                                <th>Payment Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{date('d-M-Y', strtotime($item->created_at))}}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['expert']['name'] }}</td>
                                    <td>{{ $item['base_amount'] }}</td>
                                    <td>{{ number_format( $item['conven_fee'] , 2)}}</td>
                                    <td>{{ $item['dis_package'] }}</td>
                                    <td>{{ $item['dis_promo'] }}</td>
                                    <td>{{ $item['total_pay'] }}</td>
                                    <td>{{ $item['cca_status'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
