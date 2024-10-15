<!DOCTYPE html>
<html>

<head>
    <title>Edha</title>
</head>

<body>
    <table class="table" style="width:600px;">
        <tr>
            <td>
                Name
            </td>
            <td>
                {{ $maildata['user']['first_name'] . ' ' . $maildata['user']['last_name'] }}
            </td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td>
                {{ $maildata['user']['email'] }}
            </td>
        </tr>
        <tr>
            <td>
                Mobile
            </td>
            <td>
                {{ $maildata['user']['mobile'] }}
            </td>
        </tr>

        <tr>
            <td>
                Experience
            </td>
            <td>
                {{ $maildata['user']['experience'] }} years
            </td>
        </tr>
        <tr>
            <td>
                Notice Period
            </td>
            <td>
                {{ $maildata['user']['notice_period'] }}
            </td>
        </tr>
        <tr>
            <td>
               Aadhar Front
            </td>
            <td>
                <img src="{{url('public/upload/'.$maildata['user']['aadhar_image'])}}" width="100" class="img-fluid" />
                <a download href="{{url('public/upload/'.$maildata['user']['aadhar_image'])}}">Download</a>
            </td>
        </tr>
        <tr>
            <td>
                Aadhar Back
            </td>
            <td>
                 <img src="{{url('public/upload/'.$maildata['user']['aadhar_back_img'])}}" width="100" class="img-fluid" />
                  <a download href="{{url('public/upload/'.$maildata['user']['aadhar_back_img'])}}">Download</a>
            </td>
        </tr>
    </table>
</body>

</html>
