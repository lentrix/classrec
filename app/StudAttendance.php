<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudAttendance extends Model
{
    protected $fillable = ['attendance_id', 'enrol_id', 'attendance'];

    public function attendance() {
        return $this->belongsTo('App\Attendance');
    }

    public function enrol() {
        return $this->belongsTo('App\Enrol');
    }

    public static function interactive($userId) {
        return StudAttendance::join('attendances','attendances.id','stud_attendances.attendance_id')
                ->join('enrols','enrols.id','stud_attendances.enrol_id')
                ->join('users','users.id','enrols.user_id')
                ->where('users.id',$userId)
                ->where('attendances.interactive', true)
                ->where('attendance','ab')
                ->select('stud_attendances.*')
                ->with('enrol.myClass')->get();

    }
}
