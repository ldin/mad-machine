@extends('home.layouts.layout')

@section('content')
    <div class="container">
        <div class="col-xs-12">
            @yield('top_block')
        </div>
        <div class="row-block">

            <div class="col-xs-12 col-sm-3">
                @yield('left_menu')
                @yield('offer')
            </div>

            <div class="col-xs-12 col-sm-9">
                @yield('main_block')
            </div>

            <div class="">
                @yield('small_block')
            </div>
        </div>
    </div>
@stop
