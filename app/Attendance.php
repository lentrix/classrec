<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['my_class_id', 'date', 'remarks'];

    public $timestamps = false;

    protected $dates = ['date'];

    public function myClass() {
        return $this->belongsTo('App\MyClass');
    }

    public function studentAttendances() {
        return $this->hasMany('App\StudAttendance');
    }
}
