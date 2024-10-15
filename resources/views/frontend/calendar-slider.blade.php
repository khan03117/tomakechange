<style>
    .owl-prev,
.owl-next {
  position: absolute;
  top: 40%;
  transform: translateY(-50%);
}

.owl-prev {
  left: -1rem;
}

.owl-next {
  right: -1rem;
}
button[role="presentation"]{
    width:30px;
    height:30px;
    border-radius:50%;
    background:#ccc !important;
    font-size:18px !important;
}
</style>
<div class="owl-carousel dateowl">
    
    @for($x = 0; $x < 10; $x++)
    <div class="item box-shadow-2 rounded-3 my-4">
        <label role="button" for="datelabel{{$x}}" class="w-100 text-center   p-3 calendar-day-hover">
            <div class="datebox " >
                @php
                    $today = date('Y-m-d');
                    $fulld = date('Y-m-d', strtotime($today.' + '.$x.' Days'));
                    $date = date('d-M', strtotime($today.' + '.$x.' Days'));
                    $day = date('D', strtotime($date));
                @endphp
                <input type="radio" id="datelabel{{$x}}" class="visually-hidden" name="date" value="{{$fulld}}"/>
                <div>{{$day}}</div>
                <div>{{$date}}</div>
            </div>
        </label>
    </div>
    @endfor
  
</div>
<script>
    $('.dateowl').owlCarousel({
    loop:false,
    margin:20,
    nav:true,
    navText: ["‹", "›"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>