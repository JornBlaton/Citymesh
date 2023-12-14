<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Room;
use Carbon\Carbon;

class MeetingController extends Controller
{
    function index(){
        $meetings = Meeting::all();
        return response()->json($meetings);
    }

    function createMeeting(Request $request) {
        $startdate = $request->curdate. " ". $request->start_date;
        $enddate = $request->curdate. " ". $request->end_date;

        $newstartdate = carbon::parse($startdate)->ToIsoString();
        $newenddate = carbon::parse($enddate)->ToIsoString();
        return Meeting::create([
            "room_id" => $request->room_id,
            "booked_for" => $request->booked_for,
            "start_date" => $newstartdate,
            "end_date" => $newenddate
        ]);
    }
}