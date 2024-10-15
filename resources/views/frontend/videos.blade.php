@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title w-100 text-center">
                        <h3 class="text-warning">
                            Videos
                        </h3>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-4 justify-content-center">
                        @foreach ($items as $item)
                            <div class="col-md-4 col-6 mb-4">
                                <a href="{{ $item['url'] }}" target="_blank">
                                    <div
                                        class="w-100 youtubevideo position-relative box-shadow-2 rounded-3 overflow-hidden h-100 ">
                                        <img src="{{ url('public/upload/' . $item['image']) }}" alt=""
                                            class="img-fuid w-100 h-100 cover">
                                        <div class="playBtn">
                                            <i class="fa-regular fa-circle-play"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-md-4 d-none">
                    <div class="w-100 sticky-md-top sidebarBlog">
                        <div class="form-group bg-white p-3 box-shadow-2 rounded-2 mb-2">
                            <h4 for="">
                                Search Video
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
    <meta name="title" content="edha : Videos on life skills">
   
    <meta name="description" content="Our Team at edha keeps on creating new videos as messages to build newer understanding and aspects of life. You may also subscribe to our YouTube channel to get to see new videos as and when uploaded">
@endsection
