 <div class="w-100 profile_box rounded box-shadow-1  p-4 bg-success-subtle">
     <div class="row">
         <div class="col-md-4">
             <div class="w-100">
                 <figure class="w-100 profile_box_image ">
                     <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt=""
                         class="img-fuid  rounded box-shadow-1 profile_box_image">
                 </figure>
                 <div class="w-100">
                     <h4>
                         {{ $expert['name'] }}
                     </h4>
                     <!--<p class="degtext">-->
                     <!--    {{ $expert['designation'] == '1' ? 'Counseller' : 'Coach' }}-->
                     <!--</p>-->
                     <p class="mb-0">
                         {{ $expert['post'] ? $expert['post']['post'] : $expert['custom_postname'] }}
                     </p>

                 </div>
             </div>
         </div>
         <div class="col-md-8">
             <div class="w-100 h-100   overflow-hidden position-relative">

                 <div class="w-100">
                     <table class="table table-sm table-borderless mb-0">
                         <tr>
                             <td>
                                 <i class="fi fi-ts-hands-holding-diamond text-primary"></i>
                                 Expertise
                             </td>
                             <td>
                                 <div class="d-flex wrapper pb-2 expert__box flex-wrap align-items-center gap-1"
                                     id="scrollbar">
                                     @foreach ($expert['expertize'] as $i => $exp)
                                         <span
                                             class="rounded-pill d-block expertize bg-primary text-white ">{{ $exp['sub_category'] }}</span>
                                     @endforeach
                                 </div>

                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <i class="fi fi-ts-book-copy text-primary"></i> Education
                             </td>
                             <td>
                                 {{ $expert['qualification'] == '1' ? 'Graduate' : 'Postgraduate' }}
                             </td>
                         </tr>
                         @if ($expert['therapy'])
                             <tr>
                                 <td>
                                     <i class="fi fi-ts-book-copy text-primary"></i> Therapy
                                 </td>
                                 <td>
                                     {{ $expert['therapy'] }}
                                 </td>
                             </tr>
                         @endif
                         <tr>
                             <td>
                                 <i class="fi fi-ts-hourglass-start text-primary"></i> Experience
                             </td>
                             <td>
                                 {{ $expert['experience'] }} years
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <i class="fi fi-ts-language text-primary"></i> Language
                             </td>
                             <td>
                                 @foreach (explode(',', $expert['languages']) as $lan)
                                     <span class="me-2">
                                         {{ $lan }}@if (!$loop->last)
                                             ,
                                         @endif
                                     </span>
                                 @endforeach
                             </td>
                         </tr>
                         <tr>

                             <td>
                                 <i class="fi fi-ts-user-md-chat text-primary"></i> Availability :
                             </td>
                             <td>
                                 @foreach (explode(',', $expert['modes']) as $mod)
                                     <span class="me-2">
                                         {{ $mod }} @if (!$loop->last)
                                             ,
                                         @endif
                                     </span>
                                 @endforeach
                             </td>


                         </tr>

                     </table>
                 </div>
             </div>

         </div>
         <div class="col-md-12 mt-5">
             <nav class="mb-5">
                 <div id="nav-tab" role="tablist"
                     class="nav nav-tabs d-flex  gap-2 align-items-center  position-relative otherinfobuttongroup">
                     <button onclick="movetoLeft(event, 0)" class=" active" data-bs-toggle="tab"
                         data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                         aria-selected="true">
                         <span> Additional Info</span>
                     </button>
                     <button class="" onclick="movetoLeft(event, 1)" id="nav-profile-tab" data-bs-toggle="tab"
                         data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                         aria-selected="false">
                         <span>Reviews</span>
                     </button>
                     <button class="" onclick="movetoLeft(event,2)" id="nav-contact-tab" data-bs-toggle="tab"
                         data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                         aria-selected="false">
                         <span>
                             Photos
                         </span>
                     </button>
                     <span id="indicatorbutton" class="d-inline-block indicatorbutton"></span>

                 </div>
             </nav>
             <script>
                 const movetoLeft = (event, id) => {
                     const nval = 150 * id - id * 3;

                     $("#indicatorbutton").css({
                         left: nval
                     })
                     $(".otherinfobuttongroup button").removeClass('active')
                     event.target.classList.add('active');
                 };
             </script>
             <div class="tab-content" id="nav-tabContent">
                 <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                     tabindex="0">
                     <div class="w-100">
                         <div class="row">
                             @foreach ($expert['photos'] as $p)
                                 <div class="col-md-4 ">
                                     <div class="w-100">
                                         <figure class="w-100 rounded-1 overflow-hidden">
                                             <img src="{{ url($p->image) }}" class="img-fluid" alt="">
                                         </figure>
                                     </div>
                                 </div>
                             @endforeach
                         </div>

                     </div>

                 </div>
                 <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                     tabindex="0">

                     <div class="w-100">
                         <div class="row">
                             <div class="col-md-4">
                                 <div class="w-100 p-3 bg-white shadow reviewform">
                                     @if (session('success'))
                                         <div class="alert alert-success">{{ session('success') }}</div>
                                     @endif
                                     <form action="{{ route('review.store') }}" method="post">
                                         @csrf
                                         <input type="hidden" name="expert_id" value="{{ $expert['id'] }}">
                                         <div class="form-group">
                                             <label for="">Enter Name</label>
                                             <input type="text" name="name" id="" class="form-control">
                                         </div>
                                         <div class="form-group">
                                             <label for="">Enter Review</label>
                                             <textarea name="review" id="" cols="4" rows="3" class="form-control"></textarea>
                                         </div>
                                         <div class="form-group">
                                             <label for="">Enter Rating</label>
                                             <div class="rating-container">
                                                 <span class="star" data-value="1">&#9733;</span>
                                                 <span class="star" data-value="2">&#9733;</span>
                                                 <span class="star" data-value="3">&#9733;</span>
                                                 <span class="star" data-value="4">&#9733;</span>
                                                 <span class="star" data-value="5">&#9733;</span>
                                             </div>
                                             <input type="hidden" name="rating" id="rating">
                                         </div>
                                         <div class="form-group">
                                             <button class="w-100 btn btn-primary">Submit</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                             @foreach ($expert['reviews'] as $r)
                                 <div class="col-md-4">
                                     <div class="w-100 position-relative reviewBox">
                                         <h5>{{ $r->name }}</h5>
                                         @if ($r->rating > 0)
                                             <div>
                                                 @for ($a = 1; $a <= $r->rating; $a++)
                                                     <span class="text-warning">
                                                         &#9733;
                                                     </span>
                                                 @endfor
                                             </div>
                                         @endif
                                         <p> {!! $r->review !!}</p>

                                     </div>
                                 </div>
                             @endforeach

                         </div>
                     </div>


                 </div>
                 <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                     aria-labelledby="nav-home-tab" tabindex="0">
                     @if ($expert['additional_details'])
                         <table class="table table-borderless">
                             <tr>

                                 <td>

                                     <div class="w-100 addDetails  border-success">
                                         {!! $expert['additional_details'] !!}
                                     </div>
                                 </td>
                             </tr>
                         </table>
                     @endif
                 </div>

             </div>

         </div>
     </div>
     @if (!auth()->user() && $lead_id)
         <div class="row">

             <div class="col-md-6"></div>
             <div class="col-md-6">
                 <div class="text-end">
                     <a href="{{ url('counsellers') }}"
                         class="btn btn-outline-success shadow rounded-pill px-md-5 me-2">
                         Back
                     </a>

                     <button data-expert="{{ $expert['id'] }}" onclick="sendCallBackRequest(event)"
                         class="btn btn-primary rounded-pill bookingbtn">
                         Ask for a call back
                     </button>

                 </div>
             </div>
         </div>
     @endif
     <script>
         const stars = document.querySelectorAll('.star');

         const ratingValueDisplay = document.getElementById('rating');

         let rating = 0;


         stars.forEach(star => {
             star.addEventListener('click', () => {

                 rating = star.getAttribute('data-value');


                 updateStars(rating);


                 ratingValueDisplay.value = rating;
             });
             star.addEventListener('mouseover', () => {
                 updateStars(star.getAttribute('data-value'));
             });
             star.addEventListener('mouseout', () => {
                 updateStars(rating);
             });
         });


         function updateStars(rating) {
             stars.forEach(star => {
                 if (star.getAttribute('data-value') <= rating) {
                     star.classList.add('active');
                 } else {
                     star.classList.remove('active');
                 }
             });
         }
     </script>
 </div>
