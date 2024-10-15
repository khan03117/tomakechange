<!DOCTYPE html>
<html>

<head>
    <title>Feels Good</title>
</head>

<body>
   
    <p>{{ $mailData['body'] }}</p>
    <p>
        Your User Name is : {{ $mailData['userid'] }}
    </p>
    <p>
        Your Password id : {{ $mailData['password'] }}
    </p>

    <p>Thank you</p>
</body>

</html>
