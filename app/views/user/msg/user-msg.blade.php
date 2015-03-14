@extends('home.layouts.layout')
@section('content')
    <div class="container">
        <aside id="row-block">
            <div class="row">
                <h3 class="text-center head">Диалоги</h3>

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <a href="/user/messages">Диалоги</a>
                            <a href="/user/send-msg"><span class="navbar-right">Написать сообщение</span></a>
                        </div>

                        <!-- Table -->
                        {{ Form::open(array('url' => '/user/send-msg/'.$addressee['id'], 'class' => 'form-group')) }}

                            <ul class="list-group">

                                <li class="list-group-item">
                                    <textarea name="message" class="form-control" rows="5" placeholder="Введите сообщение"></textarea>
                                    <br>
                                    <button class="btn right">Отправить</button>
                                    <div class="clear"></div>
                                </li>

                            </ul>

                        {{ Form::close() }}

                        <table class="table">
                            @foreach($messages as $message)
                                <tr>
                                    <!--<? //var_dump($addressee['name']); die(); ?>-->
                                    <td>{{ ($message->sender_id == Auth::user()->id) ? Auth::user()->name : $addressee['name'] }}</td>
                                    <td>{{$message->message}}</td>
                                    <td class="">{{$message->created_at}}</span></td>
                                </tr>
                            @endforeach
                        </table>


                    </div>
                    {{ $messages->appends(array('sort' => 'votes'))->links(); }}
            </div>
        </aside>
    </div>
@stop

