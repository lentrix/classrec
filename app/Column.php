<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = [
        'my_class_id',
        'title',
        'component',
        'total'
    ];

    public $dates = ['create_at','updated_at'];

    public function myClass() {
        return $this->belongsTo('App\MyClass');
    }
}
