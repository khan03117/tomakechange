@extends('frontend.user.main')

@section('ucontent')
    <style>
        .btn-status-group .btn {
            font-size: 12px;
            font-weight: 300;
            text-transform: uppercase;

        }

        .statusDropdown a {
            font-size: 12px;
            border-radius: 0;
        }

        table tr th {
            font-weight: 600;
            text-transform: uppercase;
        }

        table tr th,
        table tr td {

            font-size: 12px;
            border-width: 1px !important;
        }
    </style>
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="w-100 table-responsive table-bordered bg-white box-shadow-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Points</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $balance = 0; // Initialize balance
                            @endphp

                            @foreach ($items as $index => $transaction)
                                @php
                                    // Add credit points to balance or subtract debit points
                                    if ($transaction->type == 'Credit') {
                                        $balance += $transaction->points;
                                    } else {
                                        $balance -= $transaction->points;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td> <!-- Format the date -->
                                    <td>{{ number_format($transaction->amount, 2) }}</td> <!-- Format the amount -->
                                    <td>{{ number_format($transaction->points, 2) }}</td> <!-- Points -->
                                    <td>
                                        @if ($transaction->type == 'Credit')
                                            {{ number_format($transaction->points, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaction->type == 'Debit')
                                            {{ number_format($transaction->points, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ number_format($balance, 2) }}</td> <!-- Running balance -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
