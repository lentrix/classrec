<?php

namespace App\Http\Controllers;

use App\Enrol;
use App\MyClass;
use Illuminate\Http\Request;

class EnrolController extends Controller
{
    public function view(Enrol $enrol) {
        return view('enrols.view',[
            'enrol' => $enrol,
            'myClass' => $enrol->myClass,
            'Midterm' => $enrol->performance($enrol->myClass->id, 1),
            'Final' => $enrol->performance($enrol->myClass->id, 2)
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

    public function changePasswordForm(MyClass $myClass, Enrol $enrol) {
        return view('enrols.change-password',[
            'myClass' => $myClass,
            'enrol' => $enrol
        ]);
    }

    public function changePassword(MyClass $myClass, Enrol $enrol, Request $request) {
        $this->validate($request, [
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);

        $enrol->user->password = bcrypt($request['password']);
        $enrol->user->save();

        return redirect("/myclass/$myClass->id/students/$enrol->id")
                ->with('Info','Student password has been changed.');
    }
}
