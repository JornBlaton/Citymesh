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
        return carbon::parse($meetingtimes[0]->start_date)->format('Y-m-d H:i:s');
    }
}
