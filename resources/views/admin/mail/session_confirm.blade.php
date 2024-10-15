<!DOCTYPE html>
<html>

<head>
    <title>edha</title>
</head>

<body>
    <p>
        Dear {!! $mailData['name'] !!},
    </p>
    <p>
    Your next session details are as follows : </p>
    
    You have an Appointment with : {!! $mailData['expert'] !!}<br>
    Area of Expertise : {!! $mailData['exps'] !!},<br>
    Session date : {!! date('d-M-Y', strtotime($mailData['slot'])) !!},<br>
    Session Time : {!! $mailData['s_time'] !!},<br>
    Session duration : {!! $mailData['duration'] !!}minutes,<br>
    Session Mode : {!! $mailData['mode'] !!},<br>
    <p>
        Session Link : https://edha.life/login,
    </p>
    
    Please login to your dashboard with the below credentials.<br>
    Your User Name is : {!! $mailData['email'] !!},<br>
    Your Password id : {!! $mailData['password'] !!},<br>
    <p>
    Please be available on time, for the session and the session window opens exactly at the time of commencement of the session.
    </p>
    <p> Thank you </p>
    <p>
    In case you come across any concerns, then please feel free to reach out to us at 8368-623-753. <br> You session detail is also available in your Account page.
    </p>
   

    
</body>

</html>
