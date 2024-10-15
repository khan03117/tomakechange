@extends('layouts.main')
@section('content')
    <div class="container-fluid">
       <div class="row">
           <div class="col-md-12">
               <div class="w-100 table-responsive">
                   <table class="table table-sm table-bordered">
                       <thead>
                           <tr>
                               <th>Sr No</th>
                               <th>Email</th>
                               <th>Created At</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{ date('d-M-Y', strtotime($item['created_at']))}}</td>
                            </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
    </div>
@endsection
