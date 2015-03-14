@extends('admin.layouts.default')



@section('sidebar')
<br>
    @if( Authority::can('update', 'User') )  
        <ul class="nav">
            <li class=" dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-group"></i>
                        <span class="menu-title">Пользователи</span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                <ul class="my-dropdown-menu">
                @foreach($users as $post)
                    <li>{{ HTML::link('admin/user/'.$post->id, $post->name) }}</li>
                @endforeach
                </ul>
            </li>

        </ul> 
    @endif  
@stop
    
@section('content')

<div class="col-xs-12 col-md-8">
    
    @if($row) 
        @if( Authority::can('readUser', 'User') )  

        {{ Form::open(array('url' => 'admin/user/'.$row['id'], 'name'=>'userform', 'class' => 'form-group')) }}  

            <div class="tab-content">

                <br />
                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                {{ Form::label('Имя') }} 
                {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}
                {{ ($errors->first('name')) ? Form::label('error', $errors->first('name'), array('class'=>'control-label')) : '' }}

                </div>

                <br />
                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                {{ Form::label('Email', 'Email', array('class'=>'control-label')) }}  
                {{ Form::text('email', (isset($row->email)?$row->email:''), array('class' => 'form-control')); }}
                {{ ($errors->first('email')) ? Form::label('error', $errors->first('email'), array('class'=>'control-label')) : '' }}

                </div>

                <br />
                {{ Form::label('Phone', 'Телефон', array('class'=>'control-label')) }}  
                {{ Form::text('phone', (isset($row->email)?$row->phone:''), array('class' => 'form-control')); }}

                <br />
                {{ Form::label('Description', 'Description', array('class'=>'control-label')) }}  
                {{ Form::textarea('description', (isset($row->email)?$row->description:''), array('class' => 'form-control')); }}

                <br />
                {{ Form::label('Role', 'Role', array('class'=>'control-label')) }} 
                {{ Form::select('role', $role, ((isset($row['roles'][0]))?$row['roles'][0]->id:''), array('class' => 'form-control')); }}

                @if(isset($category) && count($category)>0)
                    Доступные категории admin:
                    @foreach($category as $cat)
                        <li>{{$cat->name}}</li>
                    @endforeach
                @endif
               
                
                        <br />
                {{ Form::label('status', 'Status', array('class'=>'control-label')) }} 
                {{ Form::select('status', array( '0' => 'Отключен', '1' => 'Включен'), (isset($row->status)?$row->status:''), array('class' => 'form-control')); }}


                <br />
                {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}

                @if( Authority::can('delete', 'User') )                         
                    {{ HTML::link('admin/delete-any/user/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить пользователя?')")) }}

                    {{'';// HTML::link('#', 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('В данный момент недоступно')")) }}
                @endif 

            </div>

        {{ Form::close() }}
        @else
            <p>У вас недостаточно прав</p>        
        @endif
    @else
            <p>Выберите пользователя</p> 
    @endif 
</div>  


@stop        

@section('scripts') 

    @if((!Authority::can('editUser', 'User')) || ((isset($row['roles'][0])) && ($row['roles'][0]->name == 'mainAdmin')&& Auth::user()->hasRole('admin')) )
        <script>
            if(typeof userform !== "undefined"){
                for (var i=0; i<userform.length; i++){
                        $(userform[i]).attr('disabled', true);
                }
            }
        </script>
    @endif 

@stop


