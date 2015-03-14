@extends('home.layouts.layout')

@section('title')
Вход
@stop

@section('content')

    <div class="container">
        <aside id="row-block">
            <div class="row">
                <h3 class="text-center head">Вход</h3>

                <div class="col-md-9 col-md-offset-3">

{{--                     @if (Session::has('alert'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('alert') }}</p>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @endif --}}

                  <!--{{ Form::open(array('url' => 'auth/login', 'class'=>'form-horizontal')) }}-->
                       {{ Form::open(array( action('AuthController@postLogin'), 'class'=>'form-horizontal')) }}
                        <div class="form-group">
                            {{ Form::label('username', 'username', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::text('username', '', array('class'=>' form-control') ) }}
                            </div>

                            {{ $errors->first('username') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Пароль', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::password('password', array('class'=>' form-control')) }}
                            </div>
                            {{ $errors->first('password') }}
                        </div>

                        <label class="checkbox  col-sm-offset-2">
                            <input type="checkbox" name="remember" value="remember-me"> Запомнить меня<br><br>
                        </label>

                        <div class="form-actions col-sm-offset-2">
                            {{ Form::submit('Войти', array('class' => 'btn btn-primary')) }}
                        </div>

                  {{ Form::close() }}
                  <p><a href="/password/remind">Забыли пароль?</a></p>
                  <p><a href="/auth/register">Регистрация</a></p>

                </div>
            </div>
        </aside>
    </div> <!-- container -->

</div>
@stop
