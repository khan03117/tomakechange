<html>

<head>
    <title>Payment Gateway</title>
</head>

<body>
    <center>

        <form method="post" name="redirect"
            action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            
            ?>
            <input type="hidden" name="billName" value="{{$user['name']}}">
            <input type="hidden" name="billAddress" value="{{$user['city'].' '.$user['state']}}">
            <input type="hidden" name="billZip" value="{{$find['pincode']}}">
            <input type="hidden" name="billTel" value="{{$user['mobile']}}">
            <input type="hidden" name="billEmail" value="{{$user['email']}}">
        </form>
    </center>
    <script language='javascript'>
        document.redirect.submit();
    </script>
</body>

</html>
