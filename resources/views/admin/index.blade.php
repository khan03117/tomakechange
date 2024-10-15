<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>edha || Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css"
        integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content min-vh-100 d-flex p-sm-5 p-4 bg-light shadow">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 ">

                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue to edha</p>
                                    </div>
                                    <form class="mt-4 pt-2" method="POST" action="{{route('login.store')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="username"
                                                placeholder="Enter username" required>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Password</label>
                                                </div>
                                                {{-- <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="#" class="text-muted">Forgot
                                                            password?</a>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                                    aria-label="Password" aria-describedby="password-addon" required>
                                                {{-- <button class="btn btn-light shadow-none ms-0" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button> --}}
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <button class="btn btn-success w-100 waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                      
                                    </form>


                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">
                                        &copy;
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>   by edha
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
