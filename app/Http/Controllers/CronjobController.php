<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Expert;
use App\Models\UserSession;
use App\Http\AllTraits\MyTrait;
use Illuminate\Http\Request;


class CronjobController extends Controller
{
     use MyTrait;
    public function reminder(){
        date_default_timezone_set('Asia/kolkata');
        $date = date('Y-m-d');
        $experts = UserSession::where('apt_date', '>=',$date)
        ->join('slots', 'slots.id', '=', 'user_sessions.slot_id')
        ->join('experts', 'experts.id', '=', 'user_sessions.expert_id')
        ->select(['experts.name', 'experts.mobile', 'slots.slot', 'experts.designation as type'])->get();
        foreach($experts as $x){
            if($x['type'] == '1'){
                $type = 'Counselling';
            }
            if($x['type'] == '2'){
                $type = 'Coaching';
            }
            if($x['type'] == '3'){
                $type = 'Self Help';
            }
            $time = date('h:i A', strtotime($x['slot']));
           $message = "Hi {$x['name']}, your next booked session starts at : {$time} Link to join session : https://edha.life/login -Team edha";
        //   $this->send_reminder_sms('91'.$x['mobile'], $message);
        }
    }
}
