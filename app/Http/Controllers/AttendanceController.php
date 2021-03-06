<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Enrol;
use App\MyClass;
use App\StudAttendance;
use Illuminate\Http\Request;
use mysqli;

class AttendanceController extends Controller
{
    public function index(MyClass $myClass) {
        $attns = $myClass->attendances->where('grading', $myClass->grading);

        $enrols = Enrol::where('my_class_id',$myClass->id)
                    ->join('users','users.id', '=', 'enrols.user_id')
                    ->orderBy('lname')
                    ->select('enrols.*')
                    ->get();
        return view('attendances.index',[
            'myClass'=>$myClass,
            'attendances'=>$attns,
            'enrols'=>$enrols
        ]);
    }

    public function create(MyClass $myClass) {
        return view('attendances.create',['myClass'=>$myClass]);
    }

    public function store(MyClass $myClass, Request $request) {
        $this->validate($request, ['date'=>'required']);
        $attn = Attendance::create([
            'my_class_id'=>$myClass->id,
            'date'=>$request['date'],
            'remarks'=>$request['remarks'],
            'grading' => $myClass->grading,
            'interactive' => $request['interactive']
        ]);

        $def = $request['interactive'] ? "ab" : "pr";

        foreach($myClass->enrols as $enrol) {
            StudAttendance::create([
                'attendance_id' => $attn->id,
                'enrol_id' => $enrol->id,
                'attendance' => $def,
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

    public function rescan(MyClass $myClass, Attendance $attn) {
        $attn->rescan();
        return redirect("/myclass/$myClass->id/attendance/$attn->id")->with('Info','Rescanning of attendance completed.');
    }

    public function delete(MyClass $myClass, Attendance $attn) {

        foreach($attn->studentAttendances as $studAttn) {
            $studAttn->delete();
        }

        $attn->delete();
        return redirect("/myclass/$myClass->id/attendance")->with('Info','Thie attendance record has been deleted.');
    }

    public function interactiveResponse(StudAttendance $studAttn) {
        $studAttn->update(['attendance'=>'pr']);
        return redirect('/')->with('Info','You have responded as present in the interactive attendance.');
    }

    public function makeInteractive(MyClass $myClass, Attendance $attn) {
        $attn->update(['interactive'=>1]);
        return redirect()->back()->with('Info','This attendace is now interactive.');
    }

    public function stopInteractive(MyClass $myClass, Attendance $attn) {
        $attn->update(['interactive'=>0]);
        return redirect()->back()->with('Info','This attendace is no longer interactive.');
    }
}
