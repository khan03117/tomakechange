@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">


                    <form action="" method="post" class="d-block card card-body shadow">
                        @csrf
                        <table class="table">
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ ucwords($item['title']) }}
                                    </td>
                                    <td>
                                        <input type="text" name="{{ $item['title'] }}" id=""
                                            value="{{ $item['c_val'] }}" class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <input type="submit" value="Update Details" class="btn btn-success shadow">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
