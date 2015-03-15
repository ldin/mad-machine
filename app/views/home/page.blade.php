@extends('home.layouts.layout-page')

@section('title')
  {{ isset($post->title)&&($post->title)?$post->title:'Страница не найдена' }}
@stop


@section('left_menu')
  @if( isset($categories)&&count($categories)>0 )
      <div class="panel panel-default">
        <div class="panel-heading">
          <p class="panel-title">{{ $parent->name }}</p>
        </div>
        <div class="list-group">
            <ul class="nav nav-pills nav-stacked" role="tablist" id="myTab">
                @foreach ($categories as $key => $category)
                  <li>{{ HTML::link($category->slug, $category->name, array('class'=>'list-group-item')) }}</li>
                @endforeach
            </ul>
        </div>
      </div>
  @endif
@stop

@section('offer')
  @if(isset($post))
    <h2 >{{ strlen($post->offer_name)>0?$post->offer_name:$parent->offer_name }}</h2>
    {{ strlen($post->offer_text)>0?$post->offer_text:$parent->offer_text }}
  @endif
@stop

@section('main_block')

  @if(isset($post))
    {{ $post->text }}
  @else
    <h2>Страница не найдена</h2>
    <p><a href="/">На главную</a></p>
  @endif

@stop

@section('scripts')

@stop
