<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Http\Requests\MeetingCheckRequest;

class RoomController extends Controller
{
    function index(){
        $rooms = Room::all();
        return response()->json($rooms);
    }

    function checkRoomAvailability(MeetingCheckRequest $request){
        $rooms = Room::select("id")->Where("capacity", '>=', $request->amount)->get();
        $roomids = array();
        $j = 0;
        foreach ($rooms as $r) {
            $roomids[] = $rooms[$j]->id;
            $j += 1;
        }

        $meetingtimes = Meeting::select("id", "start_date", "end_date", "room_id")->whereIn('room_id', $roomids)->get();
        $data = array();
        $i = 0;
        
        foreach ($meetingtimes as $t) {
            $day = carbon::parse($meetingtimes[$i]->start_date)->format('Y-m-d');
            if ($day === $request->date/*"2025-01-01"*/) {
                $test = (object) [
                    'id' => $meetingtimes[$i]->id,
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

    public function getRoom($id) {
        return Room::where('id', $id)->get();
    }
}
