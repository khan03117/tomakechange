@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="w-100">
                        <h2 class="blog-title mb-4">
                             {!! $blog['title'] !!}
                        </h2>
                        <figure class="w-100">
                            <img src="{{ url('public') }}/assets/img/{{ $blog['image'] }}" alt=""
                                class="img-fluid w-100 h-100 cover rounded">
                        </figure>
                        <div class="blog-content">
                             {!! $blog['description'] !!}
                        </div>
                       
                    </div>

                </div>
                <div class="col-md-4 d-none">
                    <div class="w-100 sidebarBlog">
                        <div class="form-group bg-white p-3 box-shadow-2 rounded-2 mb-2">
                            <h4 for="">
                                Search Article
                            </h4>
                            <div class="input-group">
                                <input type="search" placeholder="Enter keyword" name="" id=""
                                    class="form-control box-shadow-2-none">
                            </div>
                        </div>
                        <div class="recentCategories bg-white box-shadow-2 p-3 rounded-2">
                            <div class="w-100">
                                <h4 for="">
                                    Category
                                </h4>
                                <ul>
                                    <li>
                                        <label for="Anexity">
                                            <input type="checkbox" name="" id="Anexity" class="custom-check">
                                            Anexity
                                        </label>
                                    </li>
                                    <li>
                                        <label for="depression">
                                            <input type="checkbox" name="" id="depression" class="custom-check">
                                            Depression
                                        </label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('meta')
    <meta name="title" content="{{ $blog['title'] }}">
    <meta name="keywords" content="{{ $blog['meta_key'] }}">
    <meta name="description" content="{{ $blog['meta_desc'] }}">
@endsection
