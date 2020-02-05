<?php

namespace App\Http\Controllers;

use App\Enrol;
use App\MyClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function view(MyClass $myClass, Enrol $enrol) {
        return view('students.view',[
            'myClass' => $myClass,
            'enrol' => $enrol
        ]);
    }

    public function remove(MyClass $myClass, Request $request) {

    }
}
