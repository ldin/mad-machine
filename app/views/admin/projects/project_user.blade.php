@extends('admin.layouts.default')

@section('header')
@stop

@section('sidebar')
@stop

@section('content')
<br>
<p><label>Имя: </label> {{ $user->name }}</p>
<p><label>Статус: </label> {{ $user->status }}</p>
<p><label>Роль: </label> {{ $user->role }}</p>

<?// var_dump( $user->hasRole('mainAdmin') ); ?>

{{ Form::open(array('url' => 'admin/project/user/'. $user->project_id .'/'. $user->user_id, 'class' => 'form-group', 'files' => true)) }}  
                
<label>Подключен к проекту: </label>
{{ Form::select('connect', array('1' => 'Подключен', '0' => 'Отключен', '10'=>'Ожидание'), $user->connect, array('class' => 'form-control')); }}
<br>

@if($user->role == 'manager' || 'moderator')
<label>Роль в проекте: </label>
{{ Form::select('is_admin', array(''=>'', '1' => 'Пользователь', '2' => 'Манеджер', '3' => 'Модератор'), $user->is_admin, array('class' => 'form-control')); }}
<br>
@endif

<label>Комментарий</label>
{{Form::textarea('text', $user->comment, array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}

<p><label>Просматривает: </label> {{ ($user->watch == 0)?'нет':'да' }}</p>


{{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
<a href="/admin/project/{{$user->project_id}}#participant" class="btn btn-invers">Отменить</a>

{{ Form::close() }}

@stop

@section('scripts')
@stop