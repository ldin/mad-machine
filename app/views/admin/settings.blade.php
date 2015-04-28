@extends('admin.layouts.default')

@section('content')

<? //var_dump($_GET); die(); ?>


<h1>Настройки</h1>

@if(isset($settings))
{{ Form::open(array('url' => 'admin/settings/', 'class' => 'form-group')) }}

    <div class="tab-content">
        <div class="tab-pane active" id="rus">
            @foreach ($settings as $setting)
                <br>
                <div class="col-xs-4 col-md-2">
                    {{ Form::label($setting->title) }}
                </div>
                <div class="col-xs-8  col-md-6">
                    {{  Form::textarea($setting->name, $setting->value, array('class' => 'form-control')) }}
                </div>
                <div class="clear"></div>
            @endforeach  
        </div>

        <br>
    </div>    
    
        
{{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}       
{{ Form::close(); }}
@endif

<h2>Дополнительно</h2>
 
    <div class="tab-content">
        <div>
                <br>
                <div class="col-xs-4 col-md-2">
                    Обновить карту сайта sitemap.xml
                </div>
                <div class="col-xs-8  col-md-6">
                    <a href="/admin/create-sitemap" class="btn btn-default">Обновить</a>
                </div>
                <div class="clear"></div>
        </div>

        <br>
    </div>   

@stop


