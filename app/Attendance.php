<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['my_class_id', 'date', 'remarks','grading'];

    public $timestamps = false;

    protected $dates = ['date'];

    public function myClass() {
        return $this->belongsTo('App\MyClass');
    }

    public function studentAttendances() {
        return $this->hasMany('App\StudAttendance');
    }

    public function rescan() {
        foreach($this->myClass()->first()->enrols as $enrol) {
            $studAttn = StudAttendance::where('enrol_id', $enrol->id)
                        ->where('attendance_id', $this->id)
                        ->first();
            if(!$studAttn) {
                StudAttendance::create([
                    'enrol_id' => $enrol->id,
                    'attendance_id' => $this->id,
                    'attendance' => 'ab'
                ]);
            }
        }
    }
}
