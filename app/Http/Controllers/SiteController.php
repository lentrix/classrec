<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass;
use App\User;
use App\Enrol;
use App\StudAttendance;

class SiteController extends Controller
{
    public function index() {
        if(!auth()->guest()) {
            return redirect('home');
        }
        return view('login');
    }

    public function login(Request $request) {

        if(!auth()->guest()) return redirect()->back();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = auth()->attempt([
            'username' => $request['username'],
            'password' => $request['password']
        ]);

        if($login) {
            return redirect('/');
        }else {
            return redirect()->back()->with('Error','Invalid username or password.');
        }
    }

    public function home() {

        if(auth()->guest()) return redirect('/login');

        if(auth()->user()->role=="teacher"){
            $classes = MyClass::where(['user_id'=>auth()->user()->id])
                ->orderBy('name')
                ->get();
            return view('home',['classes'=>$classes]);
        }else {
            $enrols = Enrol::where(['user_id'=>auth()->user()->id])
                    ->with('myClass')->get();
            $interactiveAttn = StudAttendance::interactive(auth()->user()->id);
            return view('home-student',['enrols'=>$enrols,'interactiveAttn'=>$interactiveAttn]);
        }
    }

    public function logout() {
        if(!auth()->guest()) {
            auth()->logout();
            return redirect('/');
        }else {
            return redirect()->back();
        }
    }

    public function register() {
        if(auth()->guest())
            return view('register');
        else
            return redirect()->back();
    }

    public function registration(Request $request) {
        $this->validate($request, [
            'lname' => 'required',
            'fname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' =>'required|confirmed',
            'role' =>'required',
        ]);

        User::create([
            'idnum' => $request['idnum'],
            'username' => $request['username'],
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect('/')->with('Info',
            'You have successfully signed up. You may now sign in.');
    }

    public function profile() {
        return view('profile', ['user'=>auth()->user()]);
    }

    public function editProfile() {
        return view('edit-profile',['user'=>auth()->user()]);
    }

    public function updateProfile(Request $request) {
        $user = auth()->user();
        $this->validate($request, [
            'lname' => 'required',
            'fname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ]);

        $user->update([
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'username' => $request['username'],
            'email' => $request['email'],
        ]);

        return redirect('/profile')->with('Info','Your profile has been updated.');
    }
}
