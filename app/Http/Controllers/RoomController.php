<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Meeting;
use Carbon\Carbon;

class RoomController extends Controller
{
        public function checkRoomAvailability(){
        $meetingtimes = Meeting::select("start_date", "end_date")->get();
        $data = array();
        $i = 0;
        $ini = carbon::today();
        $date = $ini->toDateString();
        foreach ($meetingtimes as $t) {
            $day = carbon::parse($meetingtimes[$i]->start_date)->format('Y-m-d');
            if ($day === $date) {
                $interval = carbon::parse($meetingtimes[$i]->start_date)->format('H:i:s')."-".carbon::parse($meetingtimes[$i]->end_date)->format('H:i:s');
                $data[] = $interval;
            }
            $i += 1;
        }
        return $data;
        
    }
}
