@extends('home.layouts.layout-page')

@section('title')
  {{ $post->title }}
@stop


@section('left_menu')
  @if( count($categories)>0 )
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
<h2 >{{ strlen($post->offer_name)>0?$post->offer_name:$parent->offer_name }}</h2>
{{ strlen($post->offer_name)>0?$post->offer_text:$parent->offer_text }}
@stop

@section('main_block')

  {{ $post->text }}


@stop

@section('scripts')

@stop
