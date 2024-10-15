@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h4 class="text-warning">
                        Dear Reader,
                    </h4>
                </div>
            </div>
            <div class="row align-items-center">

                <div class="col-md-6">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="w-100 mb-4 text-primary">

                                <p>
                                    If you are not sure which service to choose, have questions, need further
                                    clarifications, session booking related concern, then please feel free to reach out
                                    to us using any of the methods below. Our Team shall get back to you.

                                </p>
                                <p>
                                    Any feedback or suggestions if you may have, then please drop in a mail and we shall
                                    be glad to look at it.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">


                            <div class="w-100">

                                <p>
                                    <a class="text-warning text-decoration-none fw-semibold" href="mailto:ask@edha.life">
                                        <span class="text-dark">E-mail :</span>
                                        ask@edha.life</a>
                                </p>
                                <p>
                                    <a class="text-warning text-decoration-none fw-semibold" href="tel:+91-8368-623-753">
                                        <span class="text-dark">Mobile :</span> +91-8368-623-753</a>
                                </p>
                                <p>
                                    <a class="text-warning text-decoration-none fw-semibold" href="tel:+91-8368-623-753">
                                        <span class="text-dark"> Business days, any time between :</span> 10:00 am – 06:00 pm (Week days)</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100 px-md-5">
                        <img src="{{ url('public/assets/img/contact.svg') }}" alt="Edha Foundation" class="img-fluid"
                            style="max-width: 400px;">
                    </div>
                </div>
            </div>


        </div>
    </section>
    <section class="space askform">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="w-100 askformbg">
                    <form action="" method="post">
                        @csrf
                        <div class="row justify-content-center g-4">
                            <div class="col-md-8 form-group">
                                <input type="text" name="name" id="name" placeholder="Enter Name"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" name="email" id="email" placeholder="Enter Email"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="tel" minlength="10" maxlength="10" name="mobile" id="mobile" placeholder="Enter Mobile"
                                    class="form-control">
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" name="time" id="time" placeholder="Enter Best time to call"
                                    class="form-control" >
                            </div>
                            <div class="col-md-8">
                                <textarea name="message" id="" placeholder="Enter Message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="col-md-8">
                                <input type="submit" value="Submit" class="btn btn-warning w-100 rounded-pill py-md-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('meta')
    <meta name="title" content="Edha Foundation - Empowering Communities for Positive Change">
    <meta name="description" content="Discover how Edha Foundation is making a difference by empowering communities through sustainable initiatives. Learn about our impactful projects and join us in creating positive change today. ">
@endsection

