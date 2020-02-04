<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idnum', 'lname', 'fname', 'email', 'password','username', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myClasses() {
        return $this->hasMany('App\MyClass');
    }

    public function myEnrols() {
        return $this->hasMany('App\Enrol');
    }

    public function isEnrolledTo(MyClass $myClass) {
        $mc = Enrol::where(['user_id'=>$this->id, 'my_class_id'=>$myClass->id])->first();
        return $mc;
    }

    public function getFullNameAttribute() {
        return $this->lname . ", " . $this->fname;
    }
}
