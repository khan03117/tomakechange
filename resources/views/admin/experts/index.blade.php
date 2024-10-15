@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="text-end">
                        <a data-bs-toggle="tooltip" title="Download Excel" class="btn btn-sm btn-success" href="{{route('expert.export')}}">
                            <i class="fi fi-rs-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                
                    <table class="table table-sm table-bordered text-nowrap  table-rep-plugin " id="example">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="bg-success text-white">Sr</th>
                                <th class="bg-success text-white">Profile</th>
                                <th class="bg-success text-white">Expert</th>
                               
                               
                                <th class="bg-success text-white">Languages</th>
                                <th class="bg-success text-white">Modes</th>
                                <th class="bg-success text-white">Fee</th>
                                

                                <th class="bg-success text-white">Address</th>
                                <th class="bg-success text-white">Expertizes</th>
                                <th class="bg-success text-white">Category</th>
                                <th class="bg-success text-white">Post</th>
                                <th class="bg-success text-white">Join Date</th>
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
                                        <img src="{{ url('public/upload/' . $item['profile_image']) }}" width="50"
                                            alt="" class="img-fluid">
                                    </td>
                                  
                                    <td>
                                        <ul class="mb-0 list-unstyled">
                                            <li>
                                                <b>Name : </b> {{ $item['name'] }}
                                            </li>
                                            <li>
                                                <b>Email : </b> {{ $item['email'] }}
                                            </li>
                                            <li>
                                                <b>Mobile : </b> {{ $item['mobile'] }}
                                            </li>
                                            <li>
                                                <div class="d-flex gap-1 align-items-center">
                                                     <a href="{{route('expert_edit.admin', ['expert_id' => base64_encode($item->id)])}}" class="btn btn-sm btn-warning">Edit Details</a>
                                                     <a href="{{route('calendar.admin', ['expert_id' =>  base64_encode($item->id)])}}" class="btn btn-sm btn-info">View Slots</a>
                                                </div>
                                               
                                            </li>
                                        </ul>
                                        
                                    </td>
                                   
                                    <td>
                                        {{ $item['languages'] }}
                                    </td>
                                    <td>
                                        {{$item['modes']}}
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($item['fee'] as $fe)
                                            <li>
                                       
                                            <b> {{ date('i:s', strtotime($fe['duration'])) == '30:00' ? '30 Min' : '60 Min' }}</b> : <span>{{$fe['fee']}}</span>
                                       
                                         </li>
                                          @endforeach
                                         </ul>
                                    </td>

                                    <td>
                                        {{ $item['city']['city'] . ' ' . $item['state']['state'].' '.$item['pincode'] }}
                                    </td>
                                    <td>
                                        <ul>


                                        @foreach ($item['expertize'] as $j => $ep)
                                        @if($j < 4)
                                        <li>
                                            {{$ep['sub_category']}}
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    </td>
                                    <td>
                                        {{$item['category'] ? $item['category']['category'] : ""}}
                                    </td>
                                    <td>
                                        {{$item['post'] ?? $item['custom_postname']}}
                                    </td>
                                   
                                    <td>
                                        {{date('d-M-Y', strtotime($item['created_at']))}}
                                    </td>
                                    <td>
                                        {!!Form::open(['route' => 'close_account_expert', 'method' => 'DELETE', 'id' => 'form'.$item['id']])!!}
                                            <input type="hidden" name="id" value="{{$item['id']}}" >
                                            <a href="#" onclick="submitForm('{{$item['id']}}')" class="btn btn-sm btn-danger">Close Account</a>
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!!$items->links()!!}
                </div>
            </div>
        </div>
    </section>
    <script>
        const submitForm = (id) => {
            if(confirm("Are you Sure ?")){
                $("#form"+id).submit();
            }
        }
    </script>
@endsection
