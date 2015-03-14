@extends('admin.layouts.default')

@section('content')

@section('sidebar')
    <h3>Партнеры</h3>
    @include('admin.posts_menu')

@stop

<div>
    
@if(Authority::can('editUser', 'User') )    
    
    {{ Form::open(array('url' => 'admin/partner/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group', 'files' => true)) }}  

        <div class="tab-content">

            <br />
                {{ Form::label('Название*') }} 
                {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}

            <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                <br />
                {{ Form::label('Title', 'Title*', array('class'=>'control-label')) }}  
                {{ Form::text('title', (isset($row->title)?$row->title:''), array('class' => 'form-control')); }}
                {{ ($errors->first('title')) ? Form::label('error', 'Некорректный Title', array('class'=>'control-label')) : '' }}
            </div>

            <div class="{{ ($errors->first('slug')) ? 'has-error' : '' }}">
                <br />
                {{ Form::label('URL', 'URL', array('class'=>'control-label')) }}  
                {{ Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control')); }}
                {{ ($errors->first('slug')) ? Form::label('error', 'Некорректный URL', array('class'=>'control-label')) : '' }}
            </div>

            <br />    
            {{ Form::label('Текст') }} 
            {{Form::textarea('text', (isset($row->text)?$row->text:''), array('class' => 'form-control ', 'id'=>'wysiwyg_textarea')); }}

             <br />
            {{ Form::label('Фотография') }}
            {{ Form::file('image') }}
            <div>
                {{(isset($row->logo) && $row->logo)?(HTML::image($row->logo, '', array('width' => '100'))):''}}
            </div>
            <br />

            <br />
            {{ Form::label('description') }} 
            {{ Form::text('description', (isset($row->description)?$row->description:''), array('class' => 'form-control')); }}
            <br />
            {{ Form::label('keywords') }}
            {{ Form::text('keywords', (isset($row->keywords)?$row->keywords:''), array('class' => 'form-control')); }}

            <br />
            {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
            @if(isset($row['id']))
                  {{ HTML::link('/admin/delete/partner/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить статью?')")) }}
            @endif      

        </div>
    {{ Form::close() }}

@endif
</div> 

<script type="text/javascript" >
    $(document).ready(function() {
        var ckeditor = CKEDITOR.replace( 'wysiwyg_textarea' );
        AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor});
    });
        
 
//    var editor = CKEDITOR.replace( 'editor1' );
//        AjexFileManager.init({
//        returnTo: 'ckeditor', // [ckeditor, tinymce, function] default=ckeditor
//        editor: editor, // Объект CKEDitor'a, нужен только для него
//        skin: 'light', // [dark, light], default=dark
//        lang: 'ru' // Язык, сейчас есть [ru, en], default=ru
//    });
</script>
    
@stop


