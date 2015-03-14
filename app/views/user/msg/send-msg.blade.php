@extends('home.layouts.layout')
@section('content')

    <div class="container">
        <aside id="row-block">
            <div class="row">
                <h3 class="text-center head">Вход</h3>

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel-heading">
                        <span class="">Новое сообщение</span>
                    </div>

                    {{ Form::open(array('url' => '/user/send-msg/', 'class' => 'form-group')) }}

                        <ul class="list-group">
                            <li class="list-group-item">
                                <input name="email" type="addresse" list="listUsers" class="form-control" placeholder="Кому (начните вводить имя )">
                                <datalist id="listUsers">
                                     <!--[if IE]><select><!--<![endif]-->
                                    @foreach($users as $user)
                                        <option value="{{$user->email}}">{{$user->name}}</option>
                                    @endforeach
                                    <!--[if IE]><select><!--<![endif]-->
                                </datalist>

                            </li>
                            <li class="list-group-item">
                                <textarea name="message" class="form-control" rows="5" placeholder="Введите сообщение"></textarea>
                                <br>
                                <button class="btn right">Отправить</button>
                                <div class="clear"></div>
                            </li>

                        </ul>

                    {{ Form::close() }}
                </div>
            </div>
        </aside>
    </div>


@stop

