@extends('frontend.main')
@section('content')
<style>
#bannerExp::before{
    content:"";
    position:absolute;
    top: 0;
    left: 0;
    width:100%;
    height:100%;
    background:linear-gradient(to right, #077773,  #077773ba, transparent);
}
#bannerExp{
    height:300px;
    position:relative;
}
#bannerExp h3{
    font-size:2rem;
    font-weight:500;
    position:absolute;
    top:50%;
    left:3rem;
    transform:translateY(-50%);
    color:#fff;
}
</style>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0" id="bannerExp">
                    <h3>
                        Expert Talk
                    </h3>
                    <img src="{{ url('public/assets/img/expert-talk.jpg') }}" alt="Expert Talks" style="height:300px;object-fit:cover;" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title">
                    <h3 class="text-warning">
                        Expert Talks – Inspirational Session
                    </h3>
                </div>
                <div class="col-md-12">
                    <div class="w-100 mb-4 text-primary">
                        <p>
                            Inspiration is change in thinking, is intrinsic. Motivation is change in action, what you
                            do, when inspired.
                            At times, one requires little timely inspiration, to keep going. That little nudge or push
                            and the magic begins.

                        </p>
                        <p>
                            If you as an Institution, Organization or any group feels we can add value.
                        </p>

                    </div>
                </div>
                <div class="col-md-12">

                    <div class="w-100">
                        <p class="text-primary">
                            Kindly drop in a mail at <a class="text-warning text-decoration-none fw-bold"
                                href="tel:ask@edha.life">ask@edha.life</a> and we shall be glad to revert.

                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('meta')
    <meta name="title" content="Expert Talks on online counselling | Engage with Top Thought Leaders">
    <meta name="description" content="Immerse yourself in a world of knowledge with our expert talks on online counselling. Explore profound insights and thought-provoking discussions led by top thought leaders. Stay ahead in online counselling through the wisdom shared in our exclusive expert conversations. ">
@endsection
