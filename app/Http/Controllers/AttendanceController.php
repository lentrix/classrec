<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\MyClass;
use App\StudAttendance;
use Illuminate\Http\Request;
use mysqli;

class AttendanceController extends Controller
{
    public function index(MyClass $myClass) {
        $attns = $myClass->attendances;
        return view('attendances.index',
            ['myClass'=>$myClass,'attendances'=>$attns]);
    }

    public function create(MyClass $myClass) {
        return view('attendances.create',['myClass'=>$myClass]);
    }

    public function store(MyClass $myClass, Request $request) {
        $this->validate($request, ['date'=>'required']);
        $attn = Attendance::create([
            'my_class_id'=>$myClass->id,
            'date'=>$request['date'],
            'remarks'=>$request['remarks']
        ]);

        foreach($myClass->enrols as $enrol) {
            StudAttendance::create([
                'attendance_id' => $attn->id,
                'enrol_id' => $enrol->id,
                'attendance' => 'pr'
            ]);
        }

        return redirect("/myclass/$myClass->id/attendance/$attn->id");
    }

    public function view(MyClass $myClass, Attendance $attn) {
        $studAttns = StudAttendance::join('enrols', 'enrols.id','=','stud_attendances.enrol_id')
                ->join('users', 'enrols.user_id','=','users.id')
                ->where('attendance_id',$attn->id)
                ->orderByRaw('users.lname')
                ->select('stud_attendances.*')
                ->get();

        return view('attendances.view',[
            'myClass' => $myClass,
            'attn' => $attn,
            'studAttns' => $studAttns
        ]);
    }

    public function record(MyClass $myClass, Attendance $attn, Request $request) {
        foreach($request['attn'] as $id=>$attn) {
            $studAttn = StudAttendance::find($id);
            $studAttn->update([
                'attendance'=>$attn
            ]);
        }

        return redirect("/myclass/$myClass->id/attendance")->with('Info','Attendance have been saved');
    }
}
