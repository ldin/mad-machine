@extends('admin.layouts.default')

@section('content')

@section('sidebar')
    <h3>Страницы</h3>
    @include('admin.posts_menu')

@stop

<div>
{{ Form::open(array('url' => 'admin/page/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group')) }}

    <div class="tab-content">

            {{ Form::label('Название*') }}
            {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}

        <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
            {{ Form::label('Title', 'Title*', array('class'=>'control-label')) }}
            {{ Form::text('title', (isset($row->title)?$row->title:''), array('class' => 'form-control')); }}
            {{ ($errors->first('title')) ? Form::label('error', 'Некорректный Title', array('class'=>'control-label')) : '' }}
        </div>

        <div class="{{ ($errors->first('slug')) ? 'has-error' : '' }}">
            {{ Form::label('URL', 'URL', array('class'=>'control-label')) }}
            <small><p>Только латинские символы, цифры, дефис. <i>При незаполненом поле URL генерируется из названия</i></p></small>

            {{ Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control')); }}
            {{ ($errors->first('slug')) ? Form::label('error', 'Некорректный URL', array('class'=>'control-label')) : '' }}
        </div>

        {{ Form::label('Текст') }}
        {{Form::textarea('text', (isset($row->text)?$row->text:''), array('class' => 'form-control ', 'id'=>'wysiwyg_textarea')); }}

        <div class="form-group">
            <div class="col-xs-12 col-sm-8">
                {{ Form::label('Родительская категория') }}
                {{ Form::select('parent', $parent, (isset($row->parent)?$row->parent:''), array('class' => 'form-control '))}}
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('watch', '1', (isset($row->watch)&&($row->watch==1)?'true':'') ) }}
                       Выводить в меню
                        
                    </label>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <br />
        <p>Offer.<br /><small><i>По умолчанию, если не заполнено поле дочерней категории, выводится предложение родительской. Если родительское предложение пустое, ничего не выводится.</i></small></p>
        {{ Form::label('offer_name') }}
        {{ Form::text('offer_name', (isset($row->offer_name)?$row->offer_name:''), array('class' => 'form-control')); }}

        {{ Form::label('offer_text') }}
        {{ Form::textarea('offer_text', (isset($row->offer_text)?$row->offer_text:''), array('class' => 'form-control')); }}


        {{ Form::label('description') }}
        {{ Form::text('description', (isset($row->description)?$row->description:''), array('class' => 'form-control')); }}

        {{ Form::label('keywords') }}
        {{ Form::text('keywords', (isset($row->keywords)?$row->keywords:''), array('class' => 'form-control')); }}
        <br />
        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
        @if(isset($row['id']))
              {{ HTML::link('/admin/delete-any/page/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить статью?')")) }}
        @endif

    </div>
    {{ Form::close() }}
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


