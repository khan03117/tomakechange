@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-100 section-title text-center">
                        <h3 class="text-warning">
                            Articles
                        </h3>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="w-100 mb-4 border rounded shadow bg-white">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="w-100 h-100">
                                    <img src="{{ url('public') }}/assets/img/blog-1.svg" alt=""
                                        class="img-fluid w-100 h-100 cover rounded">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="w-100 h-100 blogbox p-3">
                                    <div class="d-flex align-items-center gap-3 mb-2 w-100 blog-features">
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Published Date">
                                            <i class="fa-regular fa-calendar-days"></i> 24 Sept 2023
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Author">
                                            <i class="fa-solid fa-user"></i> Admin
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Views">
                                            <i class="fa-solid fa-eye"></i> 24
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Read">
                                            <i class="fa-solid fa-book-open-reader"></i> 1 Min
                                        </span>
                                        <span class="ms-auto" data-bs-toggle="tooltip" data-bs-original-title="Share">
                                            <div class="dropdown">
                                                <button class="btn shadow-none border-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-share-nodes"></i>
                                                </button>
                                                <ul class="dropdown-menu shadow bg-white" style="min-width: 10px;">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-facebook"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-x-twitter"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-instagram"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="w-100 mt-1">
                                        <h4 class="mb-2">
                                            Fresh content everyday
                                        </h4>
                                        <p class="text-secondary">
                                            West Bengal Congress president Adhir Ranjan Chowdhury has slammed Chief
                                            Minister Mamata Banerjee over her recent trip to Spain amid the spread of
                                            dengue cases in the state saying that she can go to Spain but is incapable
                                            of understanding people's pain.
                                        </p>
                                        <div class="tags d-flex flex-wrap gap-3 mt-4">
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Anexiety
                                            </span>
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Depression
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mb-4 border rounded shadow bg-white">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="w-100 h-100">
                                    <img src="{{ url('public') }}/assets/img/blog-2.svg" alt=""
                                        class="img-fluid w-100 h-100 cover rounded">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="w-100 h-100 blogbox p-3">
                                    <div class="d-flex align-items-center gap-3 mb-2 w-100 blog-features">
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Published Date">
                                            <i class="fa-regular fa-calendar-days"></i> 24 Sept 2023
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Author">
                                            <i class="fa-solid fa-user"></i> Admin
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Views">
                                            <i class="fa-solid fa-eye"></i> 24
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Read">
                                            <i class="fa-solid fa-book-open-reader"></i> 1 Min
                                        </span>
                                        <span class="ms-auto" data-bs-toggle="tooltip" data-bs-original-title="Share">
                                            <div class="dropdown">
                                                <button class="btn shadow-none border-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-share-nodes"></i>
                                                </button>
                                                <ul class="dropdown-menu shadow bg-white" style="min-width: 10px;">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-facebook"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-x-twitter"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-instagram"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="w-100 mt-1">
                                        <h4 class="mb-2">
                                            Fresh content everyday
                                        </h4>
                                        <p class="text-secondary">
                                            West Bengal Congress president Adhir Ranjan Chowdhury has slammed Chief
                                            Minister Mamata Banerjee over her recent trip to Spain amid the spread of
                                            dengue cases in the state saying that she can go to Spain but is incapable
                                            of understanding people's pain.
                                        </p>
                                        <div class="tags d-flex flex-wrap gap-3 mt-4">
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Anexiety
                                            </span>
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Depression
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mb-4 border rounded shadow bg-white">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="w-100 h-100">
                                    <img src="{{ url('public') }}/assets/img/blog-3.svg" alt=""
                                        class="img-fluid w-100 h-100 cover rounded">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="w-100 h-100 blogbox p-3">
                                    <div class="d-flex align-items-center gap-3 mb-2 w-100 blog-features">
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Published Date">
                                            <i class="fa-regular fa-calendar-days"></i> 24 Sept 2023
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Author">
                                            <i class="fa-solid fa-user"></i> Admin
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Views">
                                            <i class="fa-solid fa-eye"></i> 24
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-original-title="Read">
                                            <i class="fa-solid fa-book-open-reader"></i> 1 Min
                                        </span>
                                        <span class="ms-auto" data-bs-toggle="tooltip" data-bs-original-title="Share">
                                            <div class="dropdown">
                                                <button class="btn shadow-none border-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-share-nodes"></i>
                                                </button>
                                                <ul class="dropdown-menu shadow bg-white" style="min-width: 10px;">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-facebook"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-x-twitter"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-instagram"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fa-brands fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="w-100 mt-1">
                                        <h4 class="mb-2">
                                            Fresh content everyday
                                        </h4>
                                        <p class="text-secondary">
                                            West Bengal Congress president Adhir Ranjan Chowdhury has slammed Chief
                                            Minister Mamata Banerjee over her recent trip to Spain amid the spread of
                                            dengue cases in the state saying that she can go to Spain but is incapable
                                            of understanding people's pain.
                                        </p>
                                        <div class="tags d-flex flex-wrap gap-3 mt-4">
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Anexiety
                                            </span>
                                            <span class="rounded-pill badge fw-light bg-warning">
                                                Depression
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none">
                    <div class="w-100 sticky-md-top sidebarBlog">
                        <div class="form-group bg-white p-3 shadow rounded-2 mb-2">
                            <h4 for="">
                                Search Article
                            </h4>
                            <div class="input-group">
                                <input type="search" placeholder="Enter keyword" name="" id=""
                                    class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="recentCategories bg-white shadow p-3">
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
    <meta name="title" content="edha : Read new articles on life skills">
    <meta name="description" content="Our Team at edha keeps on writing and posting relevant articles on our portal for you to check out to build newer understanding and aspects of life. You may also subscribe to newsletters from the Home page of this portal. ">
@endsection
