<?php

namespace App\Http\Controllers;

use App\Enrol;
use App\MyClass;
use Illuminate\Http\Request;

class EnrolController extends Controller
{
    public function view(Enrol $enrol) {
        return view('enrols.view',[
            'enrol' => $enrol
        ]);
    }

    public function remove(MyClass $myClass, Enrol $enrol) {
        //remove associated attendances
        foreach($enrol->studAttendances as $studAttn) {
            $studAttn->delete();
        }

        //remove associated scores
        foreach($enrol->scores as $score) {
            $score->delete();
        }

        $enrol->delete();

        return redirect("/myclass/$myClass->id/students")->with('Info','The student has been removed from the class.');
    }
}
