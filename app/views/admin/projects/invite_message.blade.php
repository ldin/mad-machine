@extends('admin.layouts.default')

@section('header')
@stop

@section('sidebar')
@stop

@section('content')
    <div class="panel-heading">
        <a onClick="history.back()">
            <span class="glyphicon glyphicon-arrow-left"> назад</span>
        </a>
        <h3>
            Новое сообщение
        </n3> 
    </div>

    {{ Form::open(array('url' => '/admin/project/send-invite/'.$project->id, 'class' => 'form-group')) }}  
               
        <input name="email" type="addresse" list="listUsers" class="form-control" placeholder="Кому (начните вводить имя )">
        <br>
        <datalist id="listUsers">
             <!--[if IE]><select><!--<![endif]-->
            @foreach($users as $user)
                <option value="{{$user->email}}">{{$user->name}}</option>
            @endforeach
            <!--[if IE]><select><!--<![endif]-->
        </datalist>

        <textarea name="message" class="form-control" rows="10" >
            @include('emails.invite')
        </textarea>
        <br>
        <input type="checkbox" name="double_email">
        <label> продублировать на почту</label>

        <br>
        <button class="btn right">Отправить</button>
        <div class="clear"></div>
    
    {{ Form::close() }}
@stop

@section('scripts')
@stop