<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use DB;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function showTeacherAddForm()
    {
        $teachers = Teacher::all();
        return view('teacherForm', compact('teachers'));
    }
    public function getTeachers()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();
        return response($teachers);
    }
    public function getTeachersSchedule(Request $request)
    {
        $teacher_id = $request->input("teacherid");
        $getschedule = DB::table('schedule')
            ->select(
                'schedule.class as class',
                'schedule.subject as subject',
                'schedule.from as from',
                'schedule.to as to',
                'schedule.duration as duration',
            )
            ->where('teacher_id', $teacher_id)
            ->get()->toArray();
        if ($getschedule) {
            $html = "";
            foreach ($getschedule as $item) {
                $html .= '<tr>
                <td>' . $item->class . '</td>
                <td>' . $item->subject . '</td>
                <td>' . $item->from . '</td>
                <td>' . $item->to . '</td>
                <td>' . $item->duration . ' Minutes</td>
            </tr>';
            }
            return ['result' => $html, "status" => "success"];
        }
        return ['result' => "", "status" => "error"];
    }
    public function addTeacher(Request $request)
    {
        $name = $request->input("name");
        $qualification = $request->input("qualification");
        $from = $request->input("fromtime");
        $to = $request->input("totime");

        $teacher = new Teacher;
        $teacher->name = $name;
        $teacher->qualification = $qualification;
        $teacher->from = $from;
        $teacher->to = $to;

        if ($from > $to) {
            return redirect()->back()->with('error', 'Please enter correct timings');
        }
        if ($teacher->save()) {
            $teachers = Teacher::all();
            return redirect()->back()->with('success', 'Teacher Added succesfully', compact('teachers'));
        }
    }
}