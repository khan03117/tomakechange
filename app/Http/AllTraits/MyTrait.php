<?php

 namespace App\Http\AllTraits;


 trait MyTrait{
    public function make_url($string){
        $find = [' ',':', ';', ',', '.', '?', '/', '"\"', '!', '@', '#', '$', '%', '^', '&', '&', '*', '(', ')', '_', '--', '+', '=', '}', '{' , '|'];
        $replace = ['-', '-', '-', '-','-', '-', '-', '-','-', '-', '-', '-','-', '-', '-', '-','-','-'];
        $u1 = str_replace($find, $replace, $string);
        $f2 = ['--', '---', '----'];
        $r2 = ['-', '-', '-'];
        $url = strtolower( str_replace('--', '-', str_replace($f2, $r2, $u1)));
        return  $url;
    }
    public function send_sms_ex($mobile){
        $apikey = env('SMS_KEY');
       
        $msg ="Hi Shahrukh, we have received your payment of 123. Your booking for the session is confirmed. - Team edha";
        $num = '917357653866'; // MULTIPLE NUMBER VARIABLES PUT HERE...!
        $ms = rawurlencode($msg); //This for encode your message content
         echo $url = 'https://push.smsc.co.in/api/mt/SendSMS?APIkey=w47mM3C5H0GQtydKv3pLBA&senderid=EDHALF&channel=Trans&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=47';
        #echo file_get_contents($url);
        
    }
    public function send_payment_sms($mobile, $name, $amount){
        $apikey = env('SMS_KEY');
        $apisender = "EDHALF";
        $msg ="Hi {$name}, we have received your payment of {$amount}. Your booking for the session is confirmed. - Team edha";
        $num = $mobile; // MULTIPLE NUMBER VARIABLES PUT HERE...!
        $ms = rawurlencode($msg); //This for encode your message content
        $url =
        'http://push.smsc.co.in/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.
        '&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=47';
        $response = file_get_contents($url);

      
    }
    public function send_reminder_sms($mobile, $msg){
        $apikey = env('SMS_KEY');
        $apisender = "EDHALF";
      
        #$msg ="Hi {$name}, we have received your payment of {$amount}. Your booking for the session is confirmed. - Team edha";
        $num = $mobile; // MULTIPLE NUMBER VARIABLES PUT HERE...!
        $ms = rawurlencode($msg); //This for encode your message content
        $url =
        'http://push.smsc.co.in/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.
        '&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=47';
        
        
        $response = file_get_contents($url);
    }
    public function sendsms ($mobile, $msg){
        $apikey = env('SMS_KEY');
        $apisender = "EDHALF";
      
        #$msg ="Hi {$name}, we have received your payment of {$amount}. Your booking for the session is confirmed. - Team edha";
        $num = $mobile; // MULTIPLE NUMBER VARIABLES PUT HERE...!
        $ms = rawurlencode($msg); //This for encode your message content
         $url =
        'http://push.smsc.co.in/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.
        '&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=47';
    
        
        $response = file_get_contents($url);
        
       
        // json_encode($response);
    }
    public function send_sms($mobile, $msg){
        $apikey = env('SMS_KEY');
        $ms = rawurlencode($msg);
        
        
        // $url = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey={$apikey}&senderid=SMSTST&channel=2&DCS=0&flashsms=0&number=91{$mobile}&text={$ms}&route=31";
        $url = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=KNzOOYpWnkyrVYc5qRlTOA&senderid=EDHALF&channel=2&DCS=0&flashsms=0&number=$mobile&text=$ms&route=1";
        $response = file_get_contents($url);
        // print_r($response);
        return response()->json($response);
    }
}
