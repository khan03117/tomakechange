@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                <table class="table table-sm table-bordered table-hover table-rep-plugin">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item['category']}}
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
