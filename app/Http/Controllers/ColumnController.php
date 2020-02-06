<?php

namespace App\Http\Controllers;

use App\Column;
use App\Enrol;
use App\MyClass;
use App\Score;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index(MyClass $myClass, $component) {
        $cols = Column::where('my_class_id',$myClass->id)
                ->where('component', $component)
                ->where('grading', $myClass->grading)
                ->get();

        $enrols = Enrol::join('users','enrols.user_id','=','users.id')
            ->where('my_class_id',$myClass->id)
            ->orderByRaw('lname')
            ->select('enrols.*')
            ->get();

        return view('columns.index',[
            'cols'=>$cols,
            'myClass'=>$myClass,
            'component'=>$component,
            'enrols' => $enrols
        ]);
    }

    public function create(MyClass $myClass, $component) {
        return view('columns.create',[
            'myClass'=>$myClass,
            'component'=>$component
        ]);
    }

    public function store(MyClass $myClass, $component, Request $request) {
        $this->validate($request,[
            'total'=>'required|numeric',
            'title'=>'required',
        ]);

        $col = Column::create([
            'my_class_id' => $myClass->id,
            'title'=>$request['title'],
            'component'=>$component,
            'total'=>$request['total'],
            'grading'=>$myClass->grading
        ]);

        foreach($myClass->enrols as $enrol) {
            Score::create([
                'column_id'=>$col->id,
                'enrol_id'=>$enrol->id
            ]);
        }

        return redirect("/myclass/$myClass->id/column/$col->id/view");
    }

    public function view(MyClass $myClass, Column $column) {
        $scores = Score::where('column_id', $column->id)
                ->join('enrols','enrols.id','=','scores.enrol_id')
                ->join('users','users.id','=','enrols.user_id')
                ->select('scores.*')
                ->orderBy('lname')
                ->get();

        return view('columns.view',[
            'myClass' => $myClass,
            'column' => $column,
            'scores' => $scores
        ]);
    }

    public function record(MyClass $myClass, Column $column, Request $request) {

        foreach($request['score'] as $id=>$score) {
            Score::find($id)->update(['score'=>$score]);
        }

        return redirect()->back()->with('Info','The scores have been updated!');
    }

    public function edit(MyClass $myClass, Column $column) {
        return view('columns.edit', [
            'myClass'=>$myClass,
            'column'=>$column
        ]);
    }

    public function update(MyClass $myClass, Column $column, Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'total' => 'required|numeric',
            'grading' => 'required|numeric'
        ]);

        $column->update([
            'title' => $request['title'],
            'total' => $request['total'],
            'grading' => $request['grading'],
        ]);

        return redirect("/myclass/$myClass->id/column/$column->id/view")->with('Info','The column has been updated.');
    }

    public function commonScore(MyClass $myClass, Column $column, Request $request) {
        $scores = $column->scores;
        $common_score = $request['common_score'];

        if($common_score>$column->total) {
            return redirect()->back()->with('Error','The common score cannot be greater than ' . $column->total);
        }

        foreach($scores as $score) {
            $score->update(['score'=>$request['common_score']]);
        }

        return redirect("/myclass/$myClass->id/column/$column->id/view");
    }

    public function rescan(MyClass $myClass, Column $column) {
        $column->rescan();
        return redirect("/myclass/{$myClass->id}/column/$column->id/view")->with('Info','Rescan complete.');
    }

    public function delete(MyClass $myClass, Column $column) {
        $component = $column->component;
        $column->delete();
        return redirect("/myclass/$myClass->id/column/$component")->with('Info',"The $component column has been deleted.");
    }
}
