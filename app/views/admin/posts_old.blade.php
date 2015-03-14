@extends('admin.layouts.default')

@section('content')

<div class="col-xs-6 col-sm-4">
    <ul>
    @foreach($posts as $post)
        
        <li>{{ HTML::link('/admin/catalog/'.$post->type.'/'.$post->id, $post->name.' ('.$post->position.')') }}</li>
        
    @endforeach
    <p><i>{{ HTML::link('/admin/catalog/'.$post->type, ' + Добавить') }}</i></p>
   
    </ul>
</div>

<div class="col-xs-12 col-md-8">
   
    {{ Form::open(array('url' => '/admin/catalog/'.$type.'/'.(isset($row->id)?$row->id:'') , 'files' => true, 'class' => 'form-group')) }}
        <!-- Tab panes -->
    <div class="tab-content">
            
            
        <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
        <br />{{ Form::label('Название', 'Название', array('class'=>'control-label')) . Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}
        {{ ($errors->first('name')) ? Form::label('error', 'Некорректное название', array('class'=>'control-label')) : '' }}
        </div>

        <br />{{ Form::label('URL', 'URL', array('class'=>'control-label')) . Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control')); }}

        <br />{{ Form::label('Текст') . Form::textarea('text', (isset($row->text)?$row->text:''), array('class' => 'form-control', 'rows'=>'3')); }}
        
        <div class="col-xs-2 ">
            <br />{{ Form::label('Цена') . Form::text('price', (isset($row->price)?$row->price:''), array('class' => 'form-control')); }}
        </div>
        <div class="col-xs-2 ">
            <br />{{ Form::label('Вес') . Form::text('weight', (isset($row->weight)?$row->weight:''), array('class' => 'form-control')); }}
        </div>
        @if($post->type == 'pizza')
         <div class="col-xs-3 ">
            <br />{{ Form::label('Позиция') . Form::select('position',  $position , (isset($row->position)?$row->position:'0'), array('class' => 'form-control')); }}
            
            <small>Куски нумеруются по часовой стрелке с 0 по 9 <a href="#" onclick="document.getElementById('helpPizz').style.display='block';">( ? )</a></small>
            {{ HTML::image('img/PizzAll_num.png','',array('id'=>'helpPizz', 'style'=>'display:none', 'onclick'=>"document.getElementById('helpPizz').style.display='none';")) }}
        </div>
        <div class=" img-pizz">            
            {{ HTML::image(((isset($row->image)&&$row->image)?$row->image:'/upload/tmp.jpg'),'') }}            
        </div>
       
        <div class="col-xs-7 ">
            <br />{{ Form::label('Фото') . Form::file('image',  array('class' => 'form-control'))   }}
        </div>
        @endif
        <div class="clear"></div>
        <br />{{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
        @if(isset($row->post_id))
              {{ HTML::link('admin/delete/category/'.$row->post_id, 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
        @endif      
    
</div>

{{ Form::close() }}
    
</div>  


@stop


