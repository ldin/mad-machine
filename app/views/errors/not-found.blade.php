@extends('home.layouts.layout-page')

@section('title')
Страница не найдена
@stop


@section('content')
<div class="container">

    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <h2>Страница не найдена</h2>
    <p><a href="/">На главную</a></p>


</div>
@stop
