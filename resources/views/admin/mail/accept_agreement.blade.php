<!DOCTYPE html>
<html>

<head>
    <title>edha</title>
</head>

<body>
    
    <p>Dear {{ $mailData['name'] }},</p>
    <p>Welcome!</p>
    <p>We are pleased to have you as our esteemed Partner on the portal to offer your services.
        We hereby request you to kindly update your details on the portal, by clicking on the below link.</p>
    <p>
        <a href="{{ url('expert/create/' . $mailData['uuid']) }}">
            Click here to fill the details
        </a>
    </p>
    <p>
        In case you have any questions or need clarification, please feel free to reach out to us at +91-8920-88-00-11
        and we shall be glad to assist you.

    </p>
    <p>
        As soon as you fill in all the details, along with calendar, you shall be visible to the Client upon searching
        for their specifics.
    </p>
    <p>
        We wish you all the very best.
    </p>


    <p>Thank you</p>
    <p>
        Best regards,
    </p>
    Team  edha
</body>

</html>
