@extends('frontend.user.main')

@section('ucontent')
    @foreach ($errors->all() as $item)
        <script>
            toastr.error('{{ $item }}', 'Errpr Occured')
        </script>
    @endforeach
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}", 'Error')
        </script>
    @endif


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <section>
        <style>
            .fine-uploader {
                border: 1px dashed #077773;
                height: 100px;
                width: 100px;
                display: block;
                overflow: hidden;
            }

            .fine-uploader img {
                object-fit: contain;
                max-width: 100px;
                overflow: hidden;
            }

            #fill_details_form label {
                font-size: 12px;
                font-weight: 600;
            }

            #fill_details_form input,
            #fill_details_form select,
            #fill_details_form textarea,

            .select2-container--default .select2-selection--multiple {
                font-size: 13px;
                border-radius: 0;
                box-shadow: none;
                border-color: rgb(178, 178, 178);
                padding: 5px;
            }

            .select2-container {
                width: 100% !important;
            }

            .subtitle {
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
        </style>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="card card-body  shadow-success">
                        <form id="fill_details_form" action="{{ route('expert_update', $expert['id']) }}"
                            enctype="multipart/form-data" method="post" class="row gy-4">
                            @csrf
                            <div class="col-md-12">
                                <div class="w-100 p-2 bg-success-subtle subtitle">
                                    Personal Details
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="">
                                    Profile Photo <small class="text-danger">*Required</small>
                                </label>
                                <label for="file" role="button" class="fine-uploader">
                                    <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt=""
                                        id="preview" class="img-fluid contain">
                                    <input type="file" onchange="previewImage(event)" name="file" id="file"
                                        class="visually-hidden">
                                    <input type="hidden" name="hfile" value="{{ $expert['profile_image'] }}"
                                        class="visually-hidden">

                                </label>

                            </div>

                            <script type="text/javascript">
                                function previewImage(event) {
                                    var input = event.target;
                                    var image = document.getElementById('preview');
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            image.src = e.target.result;
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Enter Name <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="name" id="name" value="{{ $expert['name'] }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Enter Email <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="email" id="email" value="{{ $expert['email'] }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Enter Mobile <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="mobile"
                                    oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');" id="mobile"
                                    value="{{ $expert['mobile'] }}" class="form-control nospace" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Select State <small class="text-danger">*Required</small>
                                </label>
                                <select name="state_id" onchange="getCityByState(event)" id="state_id" class="form-select">
                                    <option value="">---Select---</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['id'] }}" @selected($state['id'] == $expert['state_id'])>
                                            {{ $state['state'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Select City <small class="text-danger">*Required</small>
                                </label>
                                <select name="city_id" id="cities" class="form-select">
                                    <option value="">---Select---</option>

                                    @foreach ($cities as $ct)
                                        <option value="{{ $ct['id'] }}" @selected($ct['id'] == $expert['city_id'])>
                                            {{ $ct['city'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Pincode <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');"
                                    minlength="6" value="{{ $expert['pincode'] }}" maxlength="6" name="pincode"
                                    id="pincode" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <div class="w-100 p-2 bg-success-subtle subtitle">
                                    Professional Details
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    Qualification
                                </label>
                                <select name="qualification" id="qualification" class="form-select">
                                    <option value="">---Select---</option>
                                    @foreach ($qualifications as $qalf)
                                        <option value="{{ $qalf['id'] }}" @selected($qalf['id'] == $expert['qualification'])>
                                            {{ $qalf['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    Education Stream
                                </label>
                                <input type="text" name="stream" id="stream" value="{{ $expert['stream'] }}"
                                    class="form-control">
                            </div>
                            <div class=" col-md-3 form-group">
                                <label for="">
                                    Enter Role <small class="text-danger">*Required</small>
                                </label>
                                <select name="apply_for[]" multiple id="apply_for" class="form-select">

                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat['id'] }}" @selected(in_array($cat['id'], $ecats))>
                                            {{ $cat['title'] }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $("#apply_for").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    });
                                </script>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    Enter Designation <small class="text-danger">*Required</small>
                                </label>
                                <select name="postname" id="postname" class="form-select">
                                    <option value="">---Select----</option>
                                    @foreach ($positions as $pos)
                                        <option value="{{ $pos['id'] }}" @selected($pos['id'] == $expert['post_id'])>
                                            {{ $pos['post'] }}</option>
                                    @endforeach
                                    <option value="0" @selected($expert['post_id'] == null)>Others</option>
                                </select>
                            </div>
                            <div class="col-md-3" @if (!$expert['custom_postname']) style="display: none;" @endif>
                                <label for="">
                                    Custom Post Name <small class="text-danger">*Required</small>
                                </label>
                                <input type="text" name="custom_post_name" id="custom_post_name"
                                    placeholder="Enter Custom Post Name" value="{{ $expert['custom_postname'] }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    Enter Experience in years<small class="text-danger">*Required</small>
                                </label>
                                <input type="text" value="{{ $expert['experience'] }}"
                                    oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');" name="experience"
                                    id="experience" placeholder="Enter experience" class="form-control nospace">
                            </div>


                            <div class="col-md-3 form-group"
                                @if ($mcat != '1') style="display: none;" @endif>
                                <label for="">
                                    Expertise <small class="text-danger"></small>
                                </label>

                                <select name="expertises[]" multiple id="sub_category" class="form-select">
                                    <option value="">--Select--</option>
                                    @foreach ($exps as $exp)
                                        <option value="{{ $exp['id'] }}" @selected(in_array($exp['id'], $expsz))>
                                            {{ $exp['sub_category'] }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $("#sub_category").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    });
                                </script>
                            </div>
                            <div class="col-md-3" @if ($mcat != '1') style="display: none;" @endif>
                                <label for="">
                                    Therapy
                                </label>
                                <input type="text" name="therapy" id="therapy" placeholder="Therapy you provide"
                                    class="form-control" maxlength="150" value="{{ $expert['therapy'] }}">
                            </div>

                            <script>
                                $("#postname").on('change', function() {
                                    let rl = $(this).val();
                                    if (rl == '0') {
                                        $("#custom_post_name").parent().show();
                                        $("#custom_post_name").attr('required', 'required');
                                    } else {
                                        $("#custom_post_name").parent().hide();
                                        $("#custom_post_name  ").removeAttr('required');
                                    }
                                })
                            </script>


                            <div class="col-md-3 form-group">
                                <label for="">
                                    Languages <small class="text-danger">*Required</small>
                                </label>
                                @php
                                    $langs = explode(',', $expert['languages']);
                                @endphp
                                <select name="language[]" multiple id="language" class="form-select">
                                    <option value="" disabled>---Select---</option>
                                    @foreach ($languages as $l)
                                        <option value="{{ $l['language'] }}" @selected(in_array($l['language'], $langs))>
                                            {{ $l['language'] }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $("#language").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    })
                                </script>
                            </div>


                            <div class="col-md-3 form-group">
                                <label for="">
                                    Mode of Contact <small class="text-danger">*Required</small>
                                </label>
                                @php
                                    $modes = explode(',', $expert['modes']);
                                @endphp
                                <select name="mode[]" multiple id="mode" class="form-select">

                                    <option value="Online" @selected(in_array('Online', $modes))>Online</option>
                                    <option value="Offline" @selected(in_array('Offline', $modes))>Offline</option>
                                </select>
                                <script>
                                    $("#mode").select2({
                                        closeOnSelect: false,
                                        multiple: true,
                                        search: true
                                    })
                                </script>
                            </div>
                            {{-- <div class="col-md-3 form-group ">
                                <label for="">
                                    30 Min Fee <small class="text-danger">*Required</small>
                                </label>
                                <input type="number" minlength="3" maxlength="4" placeholder="minimum {{$charges->for_30}}"
                                    oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');" min="{{$charges->for_30}}"
                                    max="1000" name="fee[]" value="{{ $fee_30 ? $fee_30['fee'] : 0 }}"
                                    id="" class="form-control nospace">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">
                                    60 Min Fee <small class="text-danger">*Required</small>
                                </label>
                                <input type="number" placeholder="minimum 1200"
                                    oninput="return this.value = this.value.replace(/[^0-9\.]/g,'');" min="{{$charges->for_60}}"
                                    max="1500" name="fee[]" value="{{ $fee_60 ? $fee_60['fee'] : 0 }}"
                                    id="" class="form-control nospace">
                            </div> --}}

                            <div class="col-md-12">
                                <label for="">
                                    Additional Details <small class="text-primary">(if any)</small>
                                </label>
                                <textarea name="additional_details" maxlength="200" id="additonal_details" cols="30" rows="10"
                                    class="form-control">{!! $expert['additional_details'] !!}</textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#additonal_details'), {
                                            toolbar: [
                                                'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                                                '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                                '|', 'codeBlock',
                                                '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                                            ]
                                        })
                                        .then(editor => {
                                            console.log(editor);
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                            </div>
                            <div class="col-md-12 mt-5 form-group">
                                <input type="submit" value="Save Changes"
                                    class="btn px-md-5 py-3 rounded-pill btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script src="{{ url('public/js/js-app.js') }}"></script>
    <script src="{{ url('public/assets/js/app.js') }}"></script> --}}
@endsection
