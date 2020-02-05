<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrol extends Model
{
    protected $fillable = [
        'user_id','my_class_id','remarks'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function myClass() {
        return $this->belongsTo('App\MyClass');
    }

    public function attendances() {
        return $this->hasMany('App\Attendance')->orderBy('date','DESC');
    }

    public function scores($component) {
        return Score::where('enrol_id', $this->id)
                ->get();
    }

    public function score($colId) {
        return Score::where('column_id', $colId)
                ->where('enrol_id', $this->id)
                ->first();
    }

    public function attendance($attnId) {
        return StudAttendance::where('attendance_id', $attnId)
                    ->where('enrol_id', $this->id)
                    ->first();
    }
}
