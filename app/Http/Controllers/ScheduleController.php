<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function showScheduleAddForm()
    {
        $schedule = Schedule::all();
        return view('scheduleForm', compact('schedule'));
    }
    public function addSchedule(Request $request)
    {
        $class = $request->input("class");
        $subject = $request->input("subject");
        $from = $request->input("fromtime");
        $to = $request->input("totime");
        $teacher_id = $request->input("teachernameform");

        if ($from > $to) {
            return redirect()->back()->with('error', 'Please enter correct timings');
        } else {
            $to_time = strtotime($to);
            $from_time = strtotime($from);
            $duration = round(abs($to_time - $from_time) / 60, 2); //Minutes
        }

        $result = Schedule::whereRaw(
            "('from' >= ? AND 'to' <= ? AND teacher_id = ?)",
            [
                $from, $to, $teacher_id
            ],
        )->get();
        if ($result) {
            return redirect()->back()->with('error', 'Schedule Clashes For Teacher');
        }

        $teacher = new Schedule;
        $teacher->class = $class;
        $teacher->subject = $subject;
        $teacher->from = $from;
        $teacher->to = $to;
        $teacher->duration = $duration;
        $teacher->teacher_id = $teacher_id;

        if ($teacher->save()) {
            $schedule = Schedule::all();
            return redirect()->back()->with('success', 'Schedule Added succesfully', compact('schedule'));
        }
    }
}