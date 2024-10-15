@extends('frontend.main')
@section('content')
<section class="space joinSection">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-warning">
                            Dear Reader
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <div class="w-100 mb-4 text-primary">

                            <p>
                                If you are not sure what support or services you need assistance with, then please
                                fill up the below and we shall reach out to you.



                            </p>
                            <p>
                                We wish you, all the very best.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-warning mb-0">
                            Thank You
                        </h5>

                        <div class="w-100">
                            <p class="text-primary">
                                Please send across your resume to

                            </p>
                            <p>
                                <a class="text-warning" href="mailto:ask@edha.life">ask@edha.life</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-100 px-md-5">
                    <img src="assets/img/ask.svg" alt="" class="img-fluid askimage">
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
                                <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile"
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
