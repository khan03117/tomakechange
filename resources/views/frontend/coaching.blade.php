@extends('frontend.main')
@section('content')
    <!--<section class="text-center vw-100">-->
    <!--    <figure class="w-100 text-center">-->
    <!--        <img src="{{ url('public/assets/img/coaching-bg.svg') }}" alt="" class="img-fluid">-->
    <!--    </figure>-->
    <!--</section>-->
 @section('meta')
    <?php
    echo "<title>Transform Your Life:Expert Life Coaching Services-Edha</title>";
    echo "<meta name='description' content='Unlock your potential with expert life coaching. Transform challenges into opportunities. Achieve your goals with best personalized guidance. Connect today with Edha!'>";
    ?>
@endsection
    @foreach ($items as $item)
        <section class="space coachingSection" id="{{ $item['url'] }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-start">
                            <h3 class="text-warning">
                                {{ $item['title'] }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="w-100">
                            {!! $item['description'] !!}
                        </div>
                    </div>
                </div>
                @if ($item['key_points'])
                    <div class="section-title my-4 mb-5 text-warning">
                        <h3>
                            Our Coaches facilitates
                        </h3>
                    </div>
                    <div class="row keypoint mt-4" id="">
                        <div class="col-md-12">
                            <div class="w-100">


                                {!! $item['key_points'] !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="w-100 imgbox">
                                <img src="{{ url('public/assets/img/' . $item['image']) }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row aos-init aos-animate" data-aos="fade-up">
                    <div class="col-md-12">
                        <div class="w-100 text-start">
                            <a href="{{url('find-expert')}}"
                                class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                                <span class="text-primary">
                                    Talk to Expert
                                </span>
                                <span class="btnicon text-white">
                                    ⟶
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
@section('meta')
    <meta name="title" content="Transform Your Life: Expert Life Coaching Services- Edha">
  
    <meta name="description" content="Unlock your potential with expert life coaching. Transform challenges into opportunities. Achieve your goals with best personalized guidance. Connect today with Edha!">
@endsection
