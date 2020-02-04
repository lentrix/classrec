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
        return $this->hasMany('App\Attendance')->orderBy('date','DESC');
    }

    public function columns($component="") {
        if($component) {
            return $this->hasMany('App\Column')->where('component', $component);
        }else{
            return $this->hasMany('App\Component');
        }
    }
}
