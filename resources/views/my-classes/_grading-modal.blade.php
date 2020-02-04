<!-- Modal -->
<div class="modal fade" id="gradingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Grading Period</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(['url'=>"/myclass/$myClass->id/grading"])!!}
        <div class="modal-body">
          <div class="form-group">
              {{Form::radio('grading','1',$myClass->grading==1,['id'=>'midterm'])}}
              {{Form::label('midterm', 'Midterm')}}
              &nbsp; &nbsp; &nbsp;
              {{Form::radio('grading','2',$myClass->grading==2,['id'=>'final'])}}
              {{Form::label('final', 'Final')}}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Change Grading</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
