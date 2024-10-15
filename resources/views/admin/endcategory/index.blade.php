@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12 mt-4">
                    <div class="w-100 table-responsive">
                        <table class="table  bg-white shadow table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Subcategory
                                    </th>
                                    <th>
                                        End Category
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item['category'] }}
                                    </td>
                                    <td>
                                        {{ $item['sub_category'] }}
                                    </td>
                                    <td>
                                        {{$item['end_category']}}
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
