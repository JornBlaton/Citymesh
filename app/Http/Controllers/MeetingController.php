<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Room;

class MeetingController extends Controller
{
    function index(){
        $meetings = Meeting::all();
        return response()->json($meetings);
    }

    function createMeeting(Request $request) {
        return Meeting::create([
            "room_id" => $request->room_id,
            "booked_for" => $request->booked_for,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date
        ]);
    }
}