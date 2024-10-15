@extends('frontend.main')
@section('content')
    <section class="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="w-100 p-4 border box-shadow-1 rounded loginform position-relative">
                        <h4 class="text-start  text-primary mb-5">
                            Reset Password
                        </h4>
                        <div class="position-absolute w-100 h-100 top-0 start-0 p-5" id="refreshbox" style="z-index:9;display:none;">
                            
                       
                        <img src="https://app.prodevs.io/images/ajax-loader.gif"  class="img-fluid d-block mx-auto" style="width:150px;"> 
                        </div>
                        <div class="w-100 mb-4">
                            <div id="msg"></div>
                            <div id="smsg"></div>
                            <div class="form-group" id="emailbox">
                                <label for="">
                                    Enter Email
                                </label>
                                <div class="input-group">
                                  <input type="email" class="form-control" name="email" id="email" />
                                  <button type="button" class="btn btn-primary shadow" id="otpButton" onclick="sendOtp(event)" >Send OTP</button>
                                </div>
                            </div>
                           
                        </div>
                        <div class="w-100 mt-2 mb-4" id="otpbox" style="display:none;">
                            <div class="form-group">
                                <label for="">
                                    Enter OTP
                                </label>
                                <div class="input-group">
                                    <input type="tel" minlength="4" maxlength="4" class="form-control" name="otp" id="otp" />
                                   <button type="button" onclick="validate_otp(event)" id="validateButton" class="btn btn-primary shadow" >Validate OTP</button>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 mt-2 mb-4" style="display:none;" id="passwordbox">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Password
                                </label>
                                <input type="text" minlength="6" class="form-control" name="password" id="password" />
                            </div>
                            <div class="form-group mt-3">
                                <button type="button" onclick="set_password(event)" class="btn btn-primary shadow" >Save Password</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="w-100 text-end px-md-5 ">
                        <img src="https://img.freepik.com/premium-vector/counseling-depression-white-background-vector-illustration-flat_953432-972.jpg"
                            alt="" style="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(".otp").each(function() {
            $(this).on('keyup', function() {
                let dig = $(this).val();

                if (dig.length > 0) {
                    $(this).next().focus();
                }
            })
        });
        const sendOtp = () => {
             $("#refreshbox").show();
            let email = $("#email").val();
            
            $.post(`${url}/ajax/send_otp`, {email : email}, function(res){
                 $("#refreshbox").hide();
              if(res.status == 500){
                  $("#msg").show();
                  $("#smsg").hide();
                  $("#msg").html(res.error.email);
                  $("#msg").addClass('alert alert-danger');
                  $("#otpButton").removeAttr('disabled');
                  
              }else{
                 
                   $("#smsg").show();
                  $("#msg").hide();
                  $("#smsg").html(res.message);
                   $("#smsg").addClass('alert alert-success');
                   $("#otpButton").attr('disabled', 'disabled');
                   setTimeout(function(){
                        $("#otpButton").removeAttr('disabled');
                        $("#otpButton").html('Resend OTP');
                   }, 5000);
                   $("#otpbox").show();
              }
            })
        }
        const validate_otp = () => {
             $("#refreshbox").show();
            let email = $("#email").val();
            let otp = $("#otp").val();
            
            $.post(`${url}/ajax/validate_otp`, {email : email, otp : otp}, function(res){
                 $("#refreshbox").hide();
              if(res.status == 500){
                  $("#msg").show();
                  $("#smsg").hide();
                  $("#msg").html(res.error.otp);
                  $("#msg").addClass('alert alert-danger');
                  $("#otpButton").removeAttr('disabled');
              }else{
                   $("#otp").removeAttr('readonly');
                   $("#smsg").show();
                  $("#msg").hide();
                  $("#smsg").html(res.message);
                   $("#smsg").addClass('alert alert-success');
                   $("#otpButton").attr('disabled', 'disabled');
                   $("#validateButton").attr('disabled', 'disabled');
                  
                   $("#otp").attr('readonly', 'readonly');
                   $("#passwordbox").show();
              }
            })
        }
        const set_password = (event) => {
             $("#refreshbox").show();
            let email = $("#email").val();
            let otp = $("#otp").val();
            let password = $("#password").val();
            
            $.post(`${url}/ajax/set_password`, {email : email, otp : otp, password : password}, function(res){
                 $("#refreshbox").hide();
              if(res.status == 500){
                  $("#msg").show();
                  $("#smsg").hide();
                  $("#msg").html(res.error.otp);
                  $("#msg").addClass('alert alert-danger');
                 
              }else{
                   $("#smsg").show();
                  $("#msg").hide();
                  $("#smsg").html('Password reset successfully');
                   $("#smsg").addClass('alert alert-success');
                    $("#passwordbox").hide();
                    $("#otpbox").hide();
                    $("#emailbox").hide();
              }
            })
        }
    </script>
@endsection
