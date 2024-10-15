@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="w-100 text-center">
                        <h3 class="text-warning">
                            Articles
                        </h3>
                    </div>
                </div>

            </div>
            <div class="row">
                @php
                      $find = ['<p>', '</p>', '<strong>', '</strong>', '<b>', '</b>', '<h1>', '</h1>', '<h2>', '</h2>', '<h3>', '</h3>', '<h4>', '</h4>'] ;
                      $rep = ['', '','', '','', '','', '', '', '','','', '',''];
                                        
                    @endphp
                    @foreach ($blogs as $item)
                    <div class="col-md-6 mb-4">
                        <a href="{{url('article/'.$item['url'])}}" class="text-decoration-none d-block h-100 text-dark">
                           <div class="w-100 mb-4 border h-100 rounded box-shadow-2 bg-white">
                            <div class="row w-100 h-100">
                                <div class="col-md-5">
                                    <div class="w-100 h-100">
                                        <img src="{{ url('public') }}/assets/img/{{ $item['image'] }}" alt=""
                                            class="img-fluid w-100 h-100 cover rounded">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100 h-100 blogbox py-2">
                                        <div class="d-flex align-items-center gap-3 mb-2 w-100 blog-features">
                                            <span data-bs-toggle="tooltip" data-bs-original-title="Published Date">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ date('d-M-Y', strtotime($item['created_at'])) }}
                                            </span>
                                            <span data-bs-toggle="tooltip" data-bs-original-title="Author">
                                                <i class="fa-solid fa-user"></i> Admin
                                            </span>

                                            <span data-bs-toggle="tooltip" data-bs-original-title="Read">
                                                <i class="fa-solid fa-book-open-reader"></i> 2 Min
                                            </span>
                                            <!--<span class="ms-auto" data-bs-toggle="tooltip" data-bs-original-title="Share">-->
                                            <!--    <div class="dropdown">-->
                                            <!--        <button class="btn box-shadow-2-none border-0" type="button"-->
                                            <!--            data-bs-toggle="dropdown" aria-expanded="false">-->
                                            <!--            <i class="fa-solid fa-share-nodes"></i>-->
                                            <!--        </button>-->
                                            <!--        <ul class="dropdown-menu box-shadow-2 bg-white"-->
                                            <!--            style="min-width: 10px;">-->
                                            <!--            <li><a class="dropdown-item" href="#"><i-->
                                            <!--                        class="fa-brands fa-facebook"></i></a></li>-->
                                            <!--            <li><a class="dropdown-item" href="#"><i-->
                                            <!--                        class="fa-brands fa-x-twitter"></i></a></li>-->
                                            <!--            <li><a class="dropdown-item" href="#"><i-->
                                            <!--                        class="fa-brands fa-instagram"></i></a></li>-->
                                            <!--            <li><a class="dropdown-item" href="#"><i-->
                                            <!--                        class="fa-brands fa-linkedin"></i></a></li>-->
                                            <!--        </ul>-->
                                            <!--    </div>-->
                                            <!--</span>-->
                                        </div>
                                        <div class="w-100 mt-1">
                                            <h4 class="mb-2">
                                                {{ $item['title'] }}
                                            </h4>
                                            <div class="text-secondary">
                                                {{ str_replace($find , $rep, Str::substr($item['description'], 0, 100)) }}
                                            </div>
                                            <div class="tags d-flex flex-wrap gap-3 mt-4">
                                                <span class="rounded-pill badge fw-light bg-warning">
                                                    {{ $item['subcategory']['sub_category'] }}
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                          </a>
                    </div>
                    @endforeach

               
                <div class="col-md-4 d-none">
                    <div class="w-100 sticky-md-top sidebarBlog">
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
