@include('layouts._head')

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <br><br>
        <h1>{{env('APP_NAME')}}</h1>
        <br>
        <div class="card">
          <div class="card-header bg-light text-dark">
              <h3>User Login</h3>
          </div>

          @include('layouts.msg')

          <div class="card-body">
              {!! Form::open(['route'=>'login']) !!}

              <div class="form-group">
                  {{Form::label('username','User Name')}}
                  {{Form::text('username',null,['class'=>'form-control'])}}
              </div>

              <div class="form-group">
                  {{Form::label('password')}}
                  {{Form::password('password',['class'=>'form-control'])}}
              </div>

              <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit">
                      Login
                  </button>
              </div>
              <div>
                  No account yet? <a href="{{url('/register')}}">Register</a>
              </div>

              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
