<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'enrol_id',
        'column_id',
        'score',
        'remarks'
    ];

    public $timestamps = false;

    public function enrol() {
        return $this->belongsTo('App\Enrol');
    }

    public function column() {
        return $this->belongsTo('App\Column');
    }
}
