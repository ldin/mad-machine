@extends('home.layouts.layout')

@section('title')
Диалоги
@stop

@section('content')

    <div class="container">
        <aside id="row-block">
            <div class="row">
                <h3 class="text-center head">Диалоги</h3>

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <span class="">Диалоги</span>
                            <a href="/user/send-msg"><span class="navbar-right">Написать сообщение</span></a>
                        </div>

                        <!-- Table -->
                        <table class="table">
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{($message->sender_id == Auth::user()->id) ? $message->addressee_name : $message->sender_name }}</td>
                                    <td class="a-block-td anchor" onClick="document.location='/user/user-msg/{{($message->sender_id == Auth::user()->id) ? $message->addressee_id : $message->sender_id}}'">
                                        <div>{{mb_substr(strip_tags($message->message), 0, 250, 'UTF-8')}}</div>
                                    </td>
                                    <td><span class="badge">{{($message->addressee_id == Auth::user()->id && $message->isread==0) ? 'новое' : ''}}</span></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </aside>
    </div>
@stop

