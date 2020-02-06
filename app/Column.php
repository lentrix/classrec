<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = [
        'my_class_id',
        'title',
        'component',
        'total',
        'grading'
    ];

    public $dates = ['create_at','updated_at'];

    public function myClass() {
        return $this->belongsTo('App\MyClass');
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }

    public function rescan() {
        foreach($this->myClass->enrols as $enrol) {
            $scoreObj = Score::where('enrol_id',$enrol->id)
                        ->where('column_id', $this->id)
                        ->first();
            if(!$scoreObj) {
                Score::create([
                    'enrol_id' => $enrol->id,
                    'column_id' => $this->id
                ]);
            }
        }
    }
}
