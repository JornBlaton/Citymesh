<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Meeting;

class RoomController extends Controller
{
        public function checkRoomAvailability(){
        $meetingtimes = Meeting::select("start_date", "end_date")->get();
        return response()->json($meetingtimes);
    }
}
