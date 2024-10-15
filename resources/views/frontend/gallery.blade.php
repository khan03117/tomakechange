@extends('frontend.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css"
        integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js"
        integrity="sha512-jEJ0OA9fwz5wUn6rVfGhAXiiCSGrjYCwtQRUwI/wRGEuWRZxrnxoeDoNc+Pnhx8qwKVHs2BRQrVR9RE6T4UHBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-transitions.min.css"
        integrity="sha512-lm04w74LemGhpRPg5018iANiFRlA4Dxhrh8jxH8LQtq/EAXG+MdkbVv7aEXPpN+d6D/72M5xNTjhCQ4lPxg7vA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .imgbox img {
            max-width: 33%;
            padding: 10px;
            float: right;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .gallery__item {
            margin: 0;
            max-width: 100%;
        }

        .ulimg li {
            max-width: 33%;
            padding: 10px;
            float: left;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="w-100">
                    <div class="section-title text-center text-white">
                        <h3>
                            Gallery
                        </h3>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="row">
            @foreach($items as $itm)
                <div class="col-md-4 mb-4">
                    <figure class="w-100 mb-0">
                        <img src="{{$itm->image}}" class="img-fluid" /> 
                    </figure>
                </div>
            @endforeach
        </div>

    </div>
@endsection
