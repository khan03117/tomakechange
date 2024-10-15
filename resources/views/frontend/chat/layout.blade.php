<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('script')
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Counselling for Mental Health | Therapist & Psychologist</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--<meta name="description"-->
    <!--    content="Edha is a mental health platform, designed to facilitate mental and emotional well-being. At Edha, we offer online Counselling and therapy for anxiety, stress, depression, ADHD, OCD, relationship concerns, marriage related, lifestyle, parenting, motherhood related and other concerns through Counsellors, Psychologists, Therapists and experts from the field.">-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/favicons') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/favicons') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/favicons') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ url('public/favicons') }}/site.webmanifest">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>


    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-straight/css/uicons-thin-straight.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Css -->
    <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/responsives.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>
    @yield('js-scripts')

    <style>
        .toast-success {
            background: green;
            opacity: 1;
        }

        .toast-error {
            background: #F67C33;
            opacity: 1 !important;
        }
    </style>
    <script>
        const url = "{{ url('') }}";
    </script>
    <style>
        #goTopButton {
            display: inline-block;
            background-color: #FF9800;
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 4px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            transition: background-color .3s,
                opacity .5s, visibility .5s;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        #goTopButton::after {
            content: "\f077";
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            font-size: 2em;
            line-height: 50px;
            color: #fff;
        }

        #goTopButton:hover {
            cursor: pointer;
            background-color: #077773;
        }

        #goTopButton:active {
            background-color: #077773;
        }

        #goTopButton.show {
            opacity: 1;
            visibility: visible;
        }

        .whatsapp-container {
            position: fixed;
            right: 30px;
            z-index: 1000;
            bottom: 90px;
        }

        .whatsapp-container a img {
            width: 50px;
        }
    </style>
</head>

<body>


    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}", 'Error')
        </script>
    @endif
    @php
        use App\Http\Controllers\StaticController;
        $links = StaticController::getAllLinks();
    @endphp
    <section class="top_header bg-primary py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <div class="w-100 d-flex justify-content-end gap-2">
                        <div id="google_translate_element"></div>
                        @foreach ($socials as $item)
                            <span>
                                <a target="_blank" href="{{ $item['c_val'] }}"
                                    class="text-warning social-icon rounded-circle bg-white d-block text-center">
                                    {!! $item['icon'] !!}
                                </a>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-0 bg-white sticky-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="w-100">
                        <nav class="navbar navbar-expand-lg ">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="{{ url('') }}">
                                    <img src="{{ url('public') }}/assets/img/logo.png" alt=""
                                        class="img-fluid">
                                </a>
                                <div class="d-inline d-lg-none">
                                    @if (Auth::user())
                                        <a href="{{ url('logout') }}"
                                            class="btn btn-sm d-inline btn-warning text-uppercase">
                                            <i class="fa-solid fa-power-off"></i>
                                        </a>
                                    @else
                                        <a href="{{ url('login') }}"
                                            class="btn btn-sm d-inline btn-primary text-uppercase">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </a>
                                    @endif

                                    <button class="navbar-toggler btn btn-primary ms-1  shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                                        aria-controls="navbarTogglerDemo03" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <i class="fa-solid fa-bars open"></i>
                                        <i class="fa-solid fa-xmark close"></i>
                                    </button>

                                </div>



                                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                    <ul class="navbar-nav mx-auto  mb-0 p-4 pb-0 p-md-0 ">

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                About Us
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('about') }}#aboutus">About
                                                        Us</a>

                                                <li><a class="dropdown-item"
                                                        href="{{ url('about') }}#founderMessage">Founder's
                                                        Message</a></li>
                                                <li><a class="dropdown-item" href="{{ url('about') }}#vission">Our
                                                        Vision</a></li>
                                                <li><a class="dropdown-item" href="{{ url('about') }}#mission">Our
                                                        Mission</a></li>

                                                <li><a class="dropdown-item"
                                                        href="{{ url('about') }}#how_it_works">How it
                                                        Works</a></li>
                                            </ul>
                                        </li>
                                        @foreach ($links as $item)
                                            <li class="nav-item position-relative">
                                                <a class="nav-link dropdown-toggle" href="{{ url($item['url']) }}"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $item['category'] }}
                                                </a>
                                                <ul class="dropdown-menu dropdown-submenu firstDropDownWidth">
                                                    @foreach ($item['subcategory'] as $s)
                                                        <li class="position-relative firstLi">
                                                            @if (count($s['endcategory']))
                                                                <a class="dropdown-item"
                                                                    href="{{ url($item['url']) . __($item['url'] == 'counselling' ? '/' : '#') . $s['url'] }}">
                                                                    {{ $s['sub_category'] }} &raquo;
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-submenu bg-warning">
                                                                    @foreach ($s['endcategory'] as $es)
                                                                        <li><a class="dropdown-item text-primary"
                                                                                href="{{ url($item['url']) . __($item['url'] == 'counselling' ? '/' : '#') . $s['url'] }}">{{ $es['end_category'] }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <a class="dropdown-item"
                                                                    href="{{ url($item['url']) }}">{{ $s['sub_category'] }}</a>
                                                            @endif

                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                        @endforeach

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Other Offerings
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ url('employee-engagement-programme') }}">Employee
                                                        Engagement Programme</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ url('mental-health-assessments') }}">Mental Health
                                                        Assessments</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ url('expert-talk') }}">Expert
                                                        Talk</a></li>
                                                <li class="position-relative">
                                                    <a class="dropdown-item" href="#">
                                                        Self Help &raquo;
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-submenu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ url('meditation') }}">Meditation</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ url('sprituality') }}">Sprituality</a></li>

                                                    </ul>
                                                </li>
                                            </ul>

                                        </li>
                                        <li class="nav-item dropdown">

                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Resources
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('blogs') }}">Articles</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ url('videos') }}">Videos</a>
                                                </li>

                                            </ul>

                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Contact Us
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('contact-us') }}">Ask</a>

                                                <li>
                                                    <a class="dropdown-item" href="{{ url('csr') }}">edha
                                                        Foundation
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ url('opening-position') }}">Open positions</a>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>




                                    <ul class="navbar-nav ms-auto mb-lg-0 mb-3 ps-4 p-md-0">
                                        <li class="nav-item mb-md-0 mb-3 d-none d-md-inline loginbtns">
                                            @if (Auth::user())
                                                <a href="{{ url('logout') }}" class="btn btn-warning text-uppercase">
                                                    <i class="fa-solid fa-power-off"></i> Logout
                                                </a>
                                            @else
                                                <a href="{{ url('login') }}" class="btn btn-primary text-uppercase">
                                                    <i class="fa-solid fa-user-tie"></i> Login
                                                </a>
                                            @endif

                                        </li>
                                        @if (!Auth::user())
                                            <li class="nav-item">
                                                <a href="{{ url('expert-join') }}"
                                                    class="btn btn-warning text-uppercase expertjoinbtn">
                                                    Expert Join Us
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user())
                                            @php
                                                $url = '';
                                                if (auth()->user()->designation == 'Expert') {
                                                    $url = url('expert/dashboard');
                                                }
                                                if (auth()->user()->designation == 'User') {
                                                    $url = url('user/dashboard');
                                                }
                                            @endphp
                                            <li class="nav-item">
                                                <a href="{{ $url }}" class="btn btn-warning text-uppercase">
                                                    <i class="fa-solid fa-gauge"></i> {{ Auth::user()->name }}
                                                </a>
                                            </li>
                                        @endif
                                    </ul>

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @yield('content')




    <script src="{{ url('public/js/js-bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ url('public/js/metismenu-metisMenu.min.js') }}"></script>
    <script src="{{ url('public/js/js-app.js') }}"></script> --}}
    <script src="{{ url('public/assets/js/app.js') }}"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <div class="whatsapp-container d-inline-flex flex-column gap-2">
        <a target="_blank" title="Call us" href="tel:+91-8368623753">
            <img src="{{ url('public/assets/img/phone.png') }}" width="30" alt="WhatsApp Icon">
        </a>
        <a href="https://wa.link/8biq9h" target="_blank" title="Chat with us on WhatsApp"
            onclick="window.open(this.href,'_blank'); return false;">
            <img src="{{ url('public/assets/img/whatsapp.png') }}" alt="WhatsApp Icon">
        </a>
    </div>
    <a id="goTopButton"></a>
    <script>
        var btn = $('#goTopButton');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>

</body>

</html>
