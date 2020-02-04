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
}
