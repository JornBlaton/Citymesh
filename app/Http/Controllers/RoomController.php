<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Http\Requests\MeetingCheckRequest;

class RoomController extends Controller
{
    function checkRoomAvailability(MeetingCheckRequest $request){
        $meetingtimes = Meeting::select("start_date", "end_date", "room_id")->get();
        $data = array();
        $i = 0;
        $ini = carbon::today();
        $date = $ini->toDateString();
        foreach ($meetingtimes as $t) {
            $day = carbon::parse($meetingtimes[$i]->start_date)->format('Y-m-d');
            if ($day === $request->date/*"2025-01-01"*/) {
                $test = (object) [
                    'room' => $meetingtimes[$i]->room_id,
                    'timestamp_start' => carbon::parse($meetingtimes[$i]->start_date)->format('H:i:s'),
                    'timestamp_end' => carbon::parse($meetingtimes[$i]->end_date)->format('H:i:s'),
                ];
                $data[] = $test;
            }
            $i += 1;
        }
        return $data;
    }
}
