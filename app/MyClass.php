<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyClass extends Model
{
    protected $fillable = [
        'name','description','schedule','sem','active','user_id',
        'venue','quiz_weight','part_weight','exam_weight','code'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function enrols() {
        return $this->hasMany('App\Enrol');
    }

    public function attendances() {
        return $this->hasMany('App\Attendance')->orderBy('date','ASC');
    }

    public function columns($component="") {
        if($component) {
            return $this->hasMany('App\Column')->where('component', $component);
        }else{
            return $this->hasMany('App\Component');
        }
    }

    public function getGradingPeriodAttribute() {
        return $this->grading==1?"Midterm":"Final";
    }

    public function getTotalWeightsAttribute() {
        return $this->quiz_weight+$this->part_weight+$this->exam_weight;
    }

    public function attendanceCount() {
        return Attendance::where('my_class_id', $this->id)
                ->where('grading', $this->grading)
                ->count();
    }

    public function countColumn($component) {
        return Column::where('my_class_id', $this->id)
                ->where('grading', $this->grading)
                ->where('component', $component)
                ->count();
    }

    public function countStud() {
        return Enrol::where('my_class_id', $this->id)
                ->count();
    }
}
