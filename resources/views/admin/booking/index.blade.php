@extends('layouts.main')
@section('content')
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="w-100">
                        <table class="table table-sm table-bordered table-success">
                            <thead>
                                <tr>
                                    <th class="bg-success text-white">Sr No</th>
                                    <th class="bg-success text-white">User</th>
                                    <th class="bg-success text-white">Package</th>
                                    <th class="bg-success text-white">Expert</th>
                                    <th class="bg-success text-white">Created At</th>

                                    <th class="bg-success text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <ul class="mb-0">
                                                <li>
                                                    <strong>Name</strong> : <span>{{ $item['user']['name'] }}</span>
                                                </li>
                                                <li>
                                                    <strong>Email</strong> : <span>{{ $item['user']['email'] }}</span>
                                                </li>
                                                <li>
                                                    <strong>Mobile</strong> : <span>{{ $item['user']['mobile'] }}</span>
                                                </li>
                                                <li>
                                                    <strong>Gender</strong> : <span>{{ $item['gender'] }}</span>
                                                </li>
                                                <li>
                                                    <strong>Age</strong> : <span>{{ $item['age'] }}</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="mb-0">
                                                <li>
                                                    <strong>No of Sessions</strong> :
                                                    <span>{{ $item['package']['quantity'] }}</span>
                                                </li>
                                                <li>
                                                    <strong>Duration</strong> :
                                                    <span>{{ abs(strtotime(date('Y-m-d')) - strtotime($item['package']['duration'])) / 60 }}
                                                        Minutes</span>
                                                </li>
                                                <li>
                                                    <strong>Price/Session</strong> :
                                                    @if($item['fee'])
                                                    <span>{{ $item['fee']['fee'] }}</span>
                                                    @endif
                                                </li>
                                                <li>
                                                    <strong>Total Paid</strong> :
                                                    {{-- <span>{{ $item['fee']['fee'] }}</span> --}}
                                                </li>
                                                <li>
                                                    <strong>Mode</strong> :
                                                    <span>
                                                        {{ $item['mode'] }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="mb-0">
                                                <li>
                                                    <strong>Name</strong> :
                                                    <span>
                                                        {{ $item['expert']['name'] }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Email</strong> :
                                                    <span>
                                                        {{ $item['expert']['email'] }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Mobile</strong> :
                                                    <span>
                                                        {{ $item['expert']['mobile'] }}
                                                    </span>
                                                </li>

                                            </ul>
                                        </td>
                                        <td>{{ date('d-M-Y H:i A', strtotime($item['created_at'])) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ route('usersessions.show', $item['id']) }}"
                                                    data-bs-toggle="tooltip" data-bs-title="View All Details"
                                                    class="btn  btn-success">

                                                    <i class="fi fi-rs-info"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
