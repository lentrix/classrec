<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass;
use App\Enrol;
use Faker\Factory;

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
            'quiz_weight' => $request['quiz_weight'],
            'exam_weight' => $request['exam_weight'],
            'part_weight' => $request['part_weight'],
            'user_id' => auth()->user()->id
        ]);

        return redirect('/');
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
            return redirect('/')->with('Info',
                "You have been enrolled to $myClass->name successfully!");
        }
    }

    public function students(MyClass $myClass) {

        $enrols = Enrol::join('users','users.id','=','enrols.user_id')
                ->orderBy('users.lname')->select('users.*')->select('enrols.*')
                ->where('my_class_id', $myClass->id)
                ->select('enrols.*')
                ->get();

        return view('my-classes.students',['enrols'=>$enrols,'myClass'=>$myClass]);
    }

    public function edit(MyClass $myClass) {
        return view('my-classes.edit', [
            'myClass' => $myClass
        ]);
    }

    public function update(MyClass $myClass, Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'code' => 'unique:my_classes'
        ]);

        $myClass->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'schedule' => $request['schedule'],
            'venue' => $request['venue'],
            'sem' => $request['sem'],
            'quiz_weight' => $request['quiz_weight'],
            'exam_weight' => $request['exam_weight'],
            'part_weight' => $request['part_weight'],
        ]);

        return redirect("/myclass/$myClass->id")->with('Info','Class details has been updated.');
    }

    public function recode(MyClass $myClass) {
        $faker = Factory::create();
        $str = $faker->bothify('??#?#?');
        $myClass->update(['code' => $str]);

        return redirect("/myclass/$myClass->id")->with('Info','Class code has been changed.');
    }

    public function changeGrading(MyClass $myClass, Request $request) {
        $myClass->grading = $request['grading'];
        $myClass->save();
        return redirect("/myclass/$myClass->id");
    }

    public function summary(MyClass $myClass) {
        $enrols = Enrol::join('users','users.id','=','enrols.user_id')
            ->orderBy('users.lname')->select('users.*')->select('enrols.*')
            ->where('my_class_id', $myClass->id)
            ->select('enrols.*')
            ->get();

        return view('my-classes.summary', [
            'myClass'=>$myClass,
            'enrols' => $enrols
        ]);
    }
}
