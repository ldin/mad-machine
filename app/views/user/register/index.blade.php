@extends('home.layouts.layout')

@section('title')
Регистрация
@stop

@section('content')
    <div class="container">
        <aside id="row-block">
            <div class="row">
                <h3 class="text-center head">Регистрация</h3>

                <div class="col-md-10 col-md-offset-3">

                 @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                 @endif

                  {{ Form::open(array('url' => 'auth/register', 'class'=>'form-horizontal')) }}
                    <div class="form-group">
                        <div class="form-group">
                            {{ Form::label('email', 'Email', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::text('email', '', array('class'=>' form-control') ) }}
                            </div>

                            {{ $errors->first('email') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('name', 'Ваше имя', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::text('name', '', array('class'=>' form-control')) }}
                            </div>
                            {{ $errors->first('name') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Пароль', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::password('password', array('class'=>' form-control')) }}
                            </div>
                            {{ $errors->first('password') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Повторите пароль', array('class'=>'col-sm-2 control-label')) }}
                            <div class="col-sm-5">
                                {{ Form::password('password_confirmation', array('class'=>' form-control')) }}
                            </div>
                        </div>

                      <div class="form-actions col-sm-offset-2">
                        {{ Form::submit('Регистрация', array('class' => 'btn btn-primary')) }}
                      </div>
                    </div>
                  {{ Form::close() }}

                  <p><a href="/auth/login">Войти</a></p>

                </div>
            </div>
        </aside>
    </div> <!-- /.container -->
@stop

