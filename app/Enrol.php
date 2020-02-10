<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function studAttendances() {
        return $this->hasMany('App\StudAttendance');
    }

    public function scores() {
        return $this->hasMany('App\Score');
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

    public function classComponentSummary($classId, $component, $grading) {
        $totals = Column::where('component', $component)
                ->where('my_class_id', $classId)
                ->where('grading', $grading)
                ->pluck('total');

        $total = 0;
        $totalObtained = 0;
        foreach($totals as $tot) {
            $total += $tot;
        }

        $totalScoreObtained = DB::table('scores')->where(
            'enrol_id',$this->id)->whereIn('column_id',
            DB::table('columns')->where('my_class_id',$classId)
                    ->where('grading',$grading)
                    ->where('component', $component)
                    ->pluck('id')
        )->sum('score');

        return [
            'total' => $total,
            'obtained' => $totalScoreObtained*1
        ];

    }

    public function performance($classId, $grading) {
        $summary = [];
        foreach(['quiz','participation','exam'] as $component) {
            $summary[$component] = Score::where('enrol_id', $this->id)
                    ->join('columns','columns.id','scores.column_id')
                    ->where('columns.component', $component)
                    ->where('columns.grading', $grading)
                    ->where('columns.my_class_id',$classId)
                    ->with('column')
                    ->get();
        }

        return $summary;
    }

    public function summary($classId, $grading) {
        $summary = [];

        foreach(['quiz', 'participation', 'exam'] as $component) {

            $cols = Column::where('my_class_id',$classId)
                    ->where('grading', $grading)
                    ->where('component', $component);

            $scores = Score::where('enrol_id', $this->id)
                    ->whereIn('column_id',$cols->pluck('id'));

            $summary[$component] = [
                'total' => $cols->sum('total'),
                'score' => $scores->sum('score')
            ];
        }

        return $summary;
    }

    public function grade($grading) {
        $weightedScore = 0;
        $totalWeights = 0;
        $weights =[
            'quiz' => $this->myClass->quiz_weight,
            'participation' => $this->myClass->part_weight,
            'exam' => $this->myClass->exam_weight
        ];

        foreach(['quiz','participation','exam'] as $comp) {
            $cols = Column::where('my_class_id',$this->myClass->id)
                ->where('grading', $grading)
                ->where('component', $comp);

            $scores = Score::where('enrol_id', $this->id)
                ->whereIn('column_id',$cols->pluck('id'))->sum('score');

            $totals = $cols->sum('total');

            if($totals>0) {
                $weightedScore += ($scores/$totals)*$weights[$comp];
            }else {
                return "-";
            }
        }

        return number_format($weightedScore,2) ;
    }

}
