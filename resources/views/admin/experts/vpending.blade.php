@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-responsive text-nowrap table-sm table-bordered  table-rep-plugin " id='example'>
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="bg-success text-white">Sr</th>
                                <th class="bg-success text-white">Profile</th>
                                <th class="bg-success text-white">User</th>
                                <th class="bg-success text-white">Qualification</th>
                                <th class="bg-success text-white">Skills</th>
                                <th class="bg-success text-white">Modes</th>

                                <th class="bg-success text-white">Address</th>
                                <th class="bg-success text-white">Expertizes</th>
                                <th class="bg-success text-white">Created At</th>

                                <th class="bg-success text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                          <img src="{{ url('public/upload/' . $item['profile_image']) }}"
                                                    width="50" alt="" class="img-fluid">
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                                <li class="mb-0">
                                                    {{ $item['name'] }}
                                                </li>
                                                <li class="mb-0">
                                                    {{ $item['email'] }}
                                                </li>
                                                <li class="mb-0">
                                                    {{ $item['mobile'] }}
                                                </li>
                                           
                                        </ul>

                                    </td>
                                    <td>
                                        <ul class="mb-0">
                                            <li>
                                                <strong>Qualification : </strong>
                                                {{ $item['qualification'] == 1 ? 'Graduation' : 'Post Graduation' }}
                                            </li>
                                            <li>
                                                <strong>Stream : </strong> {{ $item['stream'] }}
                                            </li>


                                        </ul>

                                    </td>
                                    <td>
                                        <ul class="mb-0 p-0 list-unstyled">
                                            <li>
                                                <strong>
                                                    Apply For
                                                </strong>
                                                : <span>
                                                    {{ $item['category']['title'] }}
                                                </span>
                                            </li>
                                            <li>
                                                <strong>
                                                    Role
                                                </strong>
                                                : {{ $item['post'] ? $item['post']['post'] : $item['custom_postname'] }}
                                            </li>
                                            <li>
                                                <strong>
                                                    Therapy
                                                </strong>
                                                : {{ $item['therapy'] }}
                                            </li>
                                            <li>
                                                <strong>
                                                    Experience :
                                                </strong>
                                                {{ $item['experience'] }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <strong>
                                                    Modes
                                                </strong>
                                                : {{ $item['modes'] }}
                                            </li>
                                            <li>
                                                <strong>
                                                    Languages
                                                </strong>
                                                : {{ $item['languages'] }}
                                            </li>
                                        </ul>
                                    </td>

                                    <td>
                                        {{ $item['city']['city'] . ' ' . $item['state']['state'] . ' ' . $item['pincode'] }}
                                    </td>
                                    <td>
                                        <ul>

                                            @foreach ($item['expertize'] as $ep)
                                                <li>
                                                    {{ $ep['sub_category'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    {{-- <td>
                                        {!! $item['additional_details'] !!}
                                    </td> --}}
                                    <td>
                                        {{ date('d-M-Y', strtotime($item['created_at'])) }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <a href="{{ route('expert.edit', $item['id']) }}"
                                                class="btn btn-sm btn-danger">
                                                Reject
                                            </a>
                                            <a href="{{ route('expert.verify', $item['id']) }}"
                                                class="btn btn-sm btn-primary">
                                                Verify
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
    </section>
@endsection
