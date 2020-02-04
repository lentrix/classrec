<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass;
use App\Enrol;

class MyClassController extends Controller
{
    public function create() {
        return view('my-classes.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'code' => 'unique:my_classes'
        ]);

        MyClass::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'schedule' => $request['schedule'],
            'venue' => $request['venue'],
            'sem' => $request['sem'],
            'code' => $request['code'],
            'active' => 1,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/home');
    }

    public function show(MyClass $myClass) {
        return view('my-classes/view',['myClass'=>$myClass]);
    }

    public function enrol() {
        return view('my-classes.enrol');
    }

    public function enrolment(Request $request) {
        $this->validate($request, [
            'code' => 'required'
        ]);

        $myClass = MyClass::where(['code'=>$request['code']])->first();
        if(!$myClass) {
            return redirect()->back()->with('Error','Invalid Enrol Code!');
        }

        if(auth()->user()->isEnrolledTo($myClass)) {
            return redirect()->back()->with('Error','You are already enrolled to ' . $myClass->name . "!");
        }else {
            Enrol::create([
                'user_id' => auth()->user()->id,
                'my_class_id' => $myClass->id
            ]);
            return redirect('/home')->with('Info',
                "You have been enrolled to $myClass->name successfully!");
        }
    }

    public function students(MyClass $myClass) {
        // $enrols = Enrol::where(['my_class_id'=>$myClass->id])
        //     ->with('user')->get();

        $enrols = Enrol::join('users','users.id','=','enrols.user_id')
                ->orderBy('users.lname')->select('users.*')->select('enrols.*')
                ->where('my_class_id', $myClass->id)
                ->get();

        return view('my-classes.students',['enrols'=>$enrols,'myClass'=>$myClass]);
    }
}
