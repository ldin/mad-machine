@extends('home.layouts.layout')

@section('title')
Личный кабинет
@stop

@section('content')
    <div class="container">
      <aside id="row-block">
        <div class="row">
        <br>

            <div class="col-md-10 col-md-offset-1">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li class="active"><a href="#edit" role="tab" data-toggle="tab">Контактная информация</a></li>
                    <li><a href="#password" role="tab" data-toggle="tab">Пароль</a></li>
              </ul>
              <div class="tab-content ">
                  <div class="tab-pane active" id="edit">
                      <p class="head">Изменить контактную информацию</p>
                      <div class="col-xs-12 col-md-6 col-md-offset-2">
                      {{ Form::open(array('url' => '/user/account-edit' , 'class' => 'form-group')) }}
                       <br />
                        {{ Form::label('Имя') }}
                        {{ Form::text('name', Auth::user()->name, array('class' => 'form-control')) }}
                        <br />
                        {{ Form::label('E-mail') }}
                        {{ Form::text('email', Auth::user()->email, array('class' => 'form-control')) }}
                        <br />
                        {{ Form::label('Телефон') }}
                        {{ Form::text('phone', Auth::user()->phone, array('class' => 'form-control')) }}
                        <br />
                        {{ Form::label('Статус: ') }}
                        {{ ((Auth::user()->status)==1)?'Активирован':'Не активирован' }}

                        {{ Form::hidden('user_id', Auth::user()->id) }}
                        <br /><br />

                        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
                      {{ Form::close() }}
                      </div>
                  </div>
                  <div class="tab-pane" id="password">
                      <p class="head">Изменить пароль</p>
                      <div class="col-xs-12 col-md-6 col-md-offset-2">
                        {{ Form::open(array('url' => 'user/account-password' , 'class' => 'form-group')) }}
                            <br />
                            {{ Form::label('Новый пароль') }}
                            {{ Form::password('pass', array('class' => 'form-control')) }}
                            <br />
                            {{ Form::label('Повторите пароль') }}
                            {{ Form::password('pass_confirmation', array('class' => 'form-control')) }}

                            {{ Form::hidden('user_id', Auth::user()->id) }}
                            <br /><br />
                            {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
                        {{ Form::close() }}
                      </div>

                  </div>
              </div>

            </div>
        </div> <!-- row -->
      </aside>
    </div> <!-- container -->

@stop


