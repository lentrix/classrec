@include('layouts._head')

<body>
    <div class="container">
        @include('layouts.msg')
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h1>User Registration</h1>

                {!!Form::open(['url'=>'/register']) !!}

                <div class="form-group">
                    {{Form::label('idnum',"ID Number")}}
                    {{Form::text('idnum',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('lname',"Last Name")}}
                    {{Form::text('lname',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('fname',"First Name")}}
                    {{Form::text('fname',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('username',"User Name")}}
                    {{Form::text('username',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('email',"Email")}}
                    {{Form::text('email',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label("role")}}
                    {{Form::select('role',['teacher'=>'Teacher', 'student'=>'Student'],null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('password',"Password")}}
                    {{Form::password('password',['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('password_confirmation',"Confirm Password")}}
                    {{Form::password('password_confirmation',['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Sign Up</button>
                    <a href="{{url('/')}}" class="btn btn-warning float-right">Cancel</a>
                </div>

                {!!Form::close() !!}
            </div>
        </div>
    </div>
</body>
