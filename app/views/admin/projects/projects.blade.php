@extends('admin.layouts.default')

@section('header')
    <link href="/css/jquery.dataTables.css" rel="stylesheet">
@stop

@section('sidebar')

@if(Authority::can('right_to_all', 'User')||(Authority::can('update', 'Project')) )

    <div id="sidebarpr" class="sidebar">
        <h3>Проекты</h3>
        <ul class="nav">
            @foreach($category as $cat)
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-group"></i>
                        <span class="menu-title">{{$cat->name}}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="my-dropdown-menu">
                      @foreach($cat['projects'] as $post)
                          <li>{{ HTML::link('admin/project/'.$post->id, $post->name) }}</li>
                      @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        @if(Authority::can('editProject', 'all') )
        <p>
            <?php echo HTML::decode(HTML::link('/admin/project', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить', array('class'=>'addNews'))); ?>
        </p>
        @endif

        <!--<p id="test">Test</p>-->

    </div>

@endif

@stop

@section('content')
@if(Authority::can('right_to_all', 'User')||(Authority::can('update', 'Project')) )
    <div id="tabs" class="container-main">
        <div class="container-header">{{isset($row->name)?$row->name:'Новый проект'}}</div>

        <ul class="nav nav-tabs" role="tablist" id="myTab">

                    <li class="active"><a href="#home" role="tab" data-toggle="tab">Описание</a></li>
            @if(isset($row['id']))
                @if(Authority::can('editProject', 'ProjectNews') )
                    <li><a href="#news" role="tab" data-toggle="tab">Новости</a></li>
                    <li><a href="#comments" role="tab" data-toggle="tab">Комментарии</a></li>
                @endif
                @if(Authority::can('editProject', 'all') )
                    <li><a href="#event" role="tab" data-toggle="tab" id="eventtab">События</a></li>
                    <li><a href="#budget" role="tab" data-toggle="tab">Бюджет</a></li>
                    <li><a href="#participant" role="tab" data-toggle="tab">Участники</a></li>
                @endif
            @endif
        </ul>

        <div class="tab-content">
        <?// var_dump($row['about']); ?>

            <div class="tab-pane active" id="home">
                {{ Form::open(array('url' => 'admin/project/description/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group', 'files' => true)) }}

                <br />
                    {{ Form::label('Название*') }}
                    {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}

                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">

                    {{ Form::label('Title', 'Title*', array('class'=>'control-label')) }}
                    {{ Form::text('title', (isset($row->title)?$row->title:''), array('class' => 'form-control')); }}
                    {{ ($errors->first('title')) ? Form::label('error', 'Некорректный Title', array('class'=>'control-label')) : '' }}
                </div>

                <div class="{{ ($errors->first('slug')) ? 'has-error' : '' }}">

                    {{ Form::label('URL', 'URL', array('class'=>'control-label')) }}
                    {{ Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control')); }}
                    {{ ($errors->first('slug')) ? Form::label('error', 'Некорректный URL', array('class'=>'control-label')) : '' }}
                </div>


                {{ Form::label('text','Описание') }}
                {{Form::textarea('text', (isset($row['about']->text)?$row['about']->text:''), array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}

                {{ Form::label('shortText', 'Краткое описание') }}
                {{Form::textarea('shortText', (isset($row['about']->shortText)?$row['about']->shortText:''), array('class' => 'form-control', 'id'=>'textarea_short', 'rows'=>'3')); }}

                {{ Form::label('mart', 'Рынок') }}
                {{ Form::text('market', (isset($row['about']->mart)?$row['about']->mart:''), array('class' => 'form-control')); }}

                {{Form::label('stage', 'Стадия')}}
                {{Form::select('stage_id', $stages, ((isset($row['about']->stage_id))?$row['about']->stage_id:''), array('class' => 'form-control')); }}

                {{ Form::label('stageComment', 'Примечание к стадии') }}
                {{Form::textarea('stageComment', (isset($row['about']->stageComment)?$row['about']->stageComment:''), array('class' => 'form-control', 'id'=>'textarea_short', 'rows'=>'3')); }}

                <div class="col-sm-6">
                    {{ Form::label('needInvest', 'Необходимые инвестиции для выхода на рынок') }}
                    {{ Form::text('needInvest', (isset($row['about']->needInvest)?$row['about']->needInvest:''), array('class' => 'form-control')); }}
                    <div class="col-sm-6">
                        {{ Form::label('image', 'Логотип') }}
                        {{ Form::file('image') }}
                    </div>
                    <div class="col-sm-6">
                        {{(isset($row['about']->logo) && $row['about']->logo)?(HTML::image($row['about']->logo, '', array('width' => '100', 'class'=>'logo_img'))):''}}
                    </div>
                </div>

                <div class="col-sm-6">
                    {{ Form::label('irr', 'IRR') }}
                    {{ Form::text('irr', (isset($row['about']->irr)?$row['about']->irr:''), array('class' => 'form-control ')); }}

                    {{ Form::label('pi', 'PI') }}
                    {{ Form::text('pi', (isset($row['about']->pi)?$row['about']->pi:''), array('class' => 'form-control')); }}

                    {{ Form::label('npv', 'NPV') }}
                    {{ Form::text('npv', (isset($row['about']->npv)?$row['about']->npv:''), array('class' => 'form-control')); }}
                </div>

                <br class="clear">
                {{Form::label('Категория')}}
                {{Form::select('category', $groupcat, ((isset($row->category_id))?$row->category_id:''), array('class' => 'form-control')); }}

                {{Form::label('keyFactors', 'Ключевые факторы заинтересованности')}}
                <div>
                  <br>
                  <table class="table table-striped" id="keyFactors">
                    <thead>
                      <tr>
                        <th>№</th>
                        <th>Фактор</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    @if(isset($row['about']->keyFactors)&&$row['about']->keyFactors)
                    <? $keyFactors = json_decode($row['about']->keyFactors, true) ?>
                      @for($line=0; $line<count($keyFactors[2]); $line++)
                        @if($keyFactors[2][$line])
                          <tr>
                            <td>{{$line+1}}</td>
                            <td>{{$keyFactors[2][$line]}}</td>
                            <td>&nbsp;</td>
                          </tr>
                        @endif
                      @endfor
                    @else
                      <tr><td>1</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    @endif
                  </table>
                </div>


                {{ Form::label('description') }}
                {{ Form::text('description', (isset($row->description)?$row->description:''), array('class' => 'form-control')); }}

                {{ Form::label('keywords') }}
                {{ Form::text('keywords', (isset($row->keywords)?$row->keywords:''), array('class' => 'form-control')); }}


                {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
                @if(isset($row['id']))
                      {{ HTML::link('/admin/delete-any/project/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
                @endif

                {{ Form::close() }}

            </div> <!-- tab-pane active id=home  -->

            @if(isset($row['id']))
            @if(Authority::can('editProject', 'all') )
                <div class="tab-pane" id="event" >
                    <br>

                    <div id='graph'></div>
                    <!--<? var_dump(json_encode($row['events'])); ?>-->
                    <br>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#addevent">
                                  + добавить
                              </a>
                            </h4>
                          </div>
                          <div id="addevent" class="panel-collapse collapse ">
                            <div class="panel-body">
                                {{ Form::open(array('url' => 'admin/project/event/'.$row['id'], 'class' => 'form-group')) }}
                                    <br />
                                    {{ Form::label('Название') }}
                                    {{ Form::text('name', '', array('class' => 'form-control')); }}
                                    <br />
                                    {{ Form::label('Текст') }}
                                    {{Form::textarea('text', '', array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}
                                    <br />
                                    <div class="col-xs-3">
                                        <label>Начало</label>
                                        <input type="date" name="start" class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Конец</label>
                                        <input type="date" name="end" class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>выполнено, %</label>
                                        <input type="text" name="part" class="form-control ">
                                    </div>
                                    <div class="clear"></div>
                                    <br /><br />
                                    {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}

                                          {{ HTML::link('admin/delete/project/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
                                    <br><br>
                                {{ Form::close() }}
                            </div>
                          </div>
                        </div>
                        @foreach($row['events'] as $event)
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#{{$event->slug}}">
                                      {{$event->name}}
                                  </a>
                                </h4>
                              </div>
                              <div id="{{$event->slug}}" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    {{ Form::open(array('url' => 'admin/project/event/'.$row['id'].'/'.$event->id, 'class' => 'form-group')) }}
                                       <br />
                                       {{ Form::label('Название') }}
                                       {{ Form::text('name', $event->name, array('class' => 'form-control')); }}
                                       <br />
                                       {{ Form::label('Текст') }}
                                       {{Form::textarea('text', $event->text, array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}
                                       <br />
                                       <div class="col-xs-3">
                                           <label>Начало</label>
                                           <input type="date" name="start" value="{{$event->start}}" class="form-control">
                                       </div>
                                       <div class="col-xs-3">
                                           <label>Конец</label>
                                           <input type="date" name="end" value="{{$event->end}}" class="form-control">
                                       </div>
                                       <div class="col-xs-3">
                                            <label>выполнено, %</label>
                                            <input type="text" name="part" value="{{$event->part}}" class="form-control ">
                                        </div>
                                       <div class="clear"></div>
                                       <br /><br />
                                       {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}

                                             {{ HTML::link('admin/delete/project/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
                                       <br><br>
                                    {{ Form::close() }}
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>

                </div><!-- tab-pane active id=event  -->
                <!------------------------------------------------------------------------------------------------>
                <div class="tab-pane" id="news">
                    <br>
                    <div class="panel-group" id="accordionNew">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#addnew">
                                  + добавить
                              </a>
                            </h4>
                          </div>
                          <div id="addnew" class="panel-collapse collapse ">
                            <div class="panel-body">
                                {{ Form::open(array('url' => 'admin/project/news/'.$row['id'], 'class' => 'form-group')) }}
                                    <br />
                                    {{ Form::label('Название') }}
                                    {{ Form::text('name', '', array('class' => 'form-control')); }}
                                    <br />
                                    {{ Form::label('Текст') }}
                                    {{Form::textarea('text', '', array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}
                                    <br /><br />
                                    {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
                                    {{ HTML::link('admin/delete/project/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
                                    <br><br>
                                {{ Form::close() }}
                            </div>
                          </div>
                        </div>

                        @foreach($row['news'] as $news)
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#{{$news->slug}}">
                                      {{$news->name}}
                                  </a>
                                </h4>
                              </div>
                              <div id="{{$news->slug}}" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    {{ Form::open(array('url' => 'admin/project/news/'.$row['id'].'/'.$news->id, 'class' => 'form-group')) }}
                                       <br />
                                       {{ Form::label('Название') }}
                                       {{ Form::text('name', $news->name, array('class' => 'form-control')); }}
                                       <br />
                                       {{ Form::label('Текст') }}
                                       {{Form::textarea('text', $news->text, array('class' => 'form-control', 'id'=>'wysiwyg_textarea')); }}
                                       <br /><br />
                                       {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
                                       {{ HTML::link('admin/delete/project/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}
                                       <br><br>
                                    {{ Form::close() }}
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>
                </div><!-- tab-pane active id=news  -->
                <!------------------------------------------------------------------------------------------------>
                <div class="tab-pane"  id="comments">
                  <br>
                    @foreach($row['comments'] as $comment)
                        <div class="well well-sm {{($comment->status!=1)?'noact':''}} comm{{$comment->id}}">
                              <p><b>{{ $comment['user']['name'] }}</b> - <i>{{ date("d.m.Y", strtotime($comment->created_at)) }}</i></p>
                              <p>{{ $comment->text }}</p>
                              <div class="col-sm-8">
                              {{ Form::open(array('action=' => '', 'class' => 'form-group', 'id'=>'form_comment')) }}
                              <p>
                                  вкл <input type="radio" name='act{{$comment->id}}' id='act{{$comment->id}}' {{ ($comment->status==1)?'checked="checked"':''}}  > /
                                  <input type="radio" name='act{{$comment->id}}' {{ ($comment->status!=1)?'checked="checked"':''}} > выкл
                                  {{ Form::submit('Сохранить',  array( 'class' => 'btn btn-inverse', 'id'=>'radio', 'onclick'=>"HideComment(".$comment->id.",".$row['id']."); return false;" )) }}
                              </p>
                              {{ Form::close(); }}
                              </div>
                              <div class="col-sm-2">
                                  <a href="#"  id="removecomment" onclick="RemoveComment({{$comment->id.','.$row['id']}}); return false;"  class="n-default">Удалить</a>
                              </div>
                              <div class="clear"></div>
                        </div>
                    @endforeach
                </div><!-- tab-pane active id=comments  -->
                <!------------------------------------------------------------------------------------------------>
                <div class="tab-pane" id="participant">
                  <br>
                  <a href="/admin/project/invite-message/{{$row['id']}}" class="btn btn-default right">Пригласить пользователя</a>
                  <br><br><br>
                  <table id="example" class="table display"  width="100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Подключен</th>
                            <th>Наблюдает</th>
                            <th>Комментарий</th>
                            <th>Ред.</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $k => $user)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>
                                    <a href="/admin/project/{{$user->id}}">
                                    @if($user->connect == 10)
                                        <b class=" text-info">{{$user->name}}</b>
                                    @else
                                        {{$user->name}}
                                    @endif
                                    </a>
                                </td>
                                <td>
                                    @if($user->connect == 10)
                                        <i class="text-warring"> запрос</i>
                                    @elseif($user->connect == 1)
                                        <b class="text-warring"> + </b>
                                    @endif
                                </td>
                                <td>{{($user->watch == 1)?' + ':' - '}}</td>
                                <td>{{ $user->comment }}</td>
                                <td><a href="/admin/project/user/{{$row['id']}}/{{$user->id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div><!-- tab-pane active id=participant  -->
                <!------------------------------------------------------------------------------------------------>
                <div class="tab-pane"  id="budget">
                    <br>
                    {{ Form::open(array('url' => 'admin/project/budget/'.$row['id'], 'class' => 'form-group')) }}
                    <table class="table table-striped" id="dynamic">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Название</th>
                              <th>Сумма</th>
                              <th>Сроки</th>
                              <th>Примечание</th>
                              <th>Источник</th>
                              <th>&nbsp;</th>
                          </tr>
                      </thead>
                      @for($line=0; $line<(count($budget[2])); $line++)
                          <tr>
                          <td>{{$line+1}}</td>
                              @foreach($budget as $key=>$cell)
                                      <td>{{ $cell[$line] }}&nbsp;</td>
                                  @endforeach
                              <td>&nbsp;</td>
                          </tr>
                      @endfor
                    </table>
                    {{ Form::submit('Сохранить',  array( 'class' => 'btn btn-inverse')) }}
                    {{ Form::close() }}
                </div><!-- tab-pane active id=budget  -->
            @endif
            @endif
        </div>
    </div>
@else
    <p>У вас недостаточно прав</p>
@endif
@stop

@section('scripts')

    <script src="/js/dinamictable.js"></script>
    <script src="/js/jquery.dataTables.js"></script>

    <script src="https://www.google.com/jsapi"></script>


    <script type='text/javascript'>

        $('#test').click(function(){

        });


        $('#myTab a[href="' + window.location.hash + '"]').tab('show')

        $(document).ready(function() {
            var ckeditor = CKEDITOR.replace( 'wysiwyg_textarea' );
            AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor});

            $('#example').dataTable();

    //        $('#eventtab').on('shown.bs.tab', function() {
    //            if (!tl) {
    //                initTimeline();
    //            }
    //        });

            new DynamicTable( window,
              document.getElementById("dynamic"),
              {1:"budget[1]", 2:"budget[2]", 3:"budget[3]", 4:"budget[4]", 5:"budget[5]", 6:"budget[6]"} );

            new DynamicTable( window,
              document.getElementById("keyFactors"),
              {1:"keyFactors[1]", 2:"keyFactors[2]", 3:"keyFactors[3]"} );




        });

        function HideComment(com_id, project_id) {
            t=$("#act"+com_id).prop("checked");
            status=((t)?'1':'0');

            jQuery.ajax({
                url:  "/admin/project/comment",
                type: "POST",
                data: {com_id:com_id, project_id:project_id, status:status},
                success: function() {
                     if(status != 1 ){
                         $('.comm'+com_id).addClass('noact');
                     }
                     else{
                        $('.comm'+com_id).removeClass('noact');
                     }
                }
            });
       }

       function RemoveComment(com_id, project_id) {
            if (confirm("Вы уверены что хотите удалить комментарий?")){
               jQuery.ajax({
                   url:  "/admin/project/delete",
                   type: "POST",
                   data: {com_id:com_id, project_id:project_id, type:'comment'},
                   success: function() {
                        $('.comm'+com_id).hide();
                   }
                });
            }
       }

    //для построения графика событий
    var events = <?=(isset($json)?$json:'null');?>;

    </script>

     @if(!Authority::can('editProject', 'Project') )
        <script>
            console.log('!Authority');
            if(typeof userform !== "undefined"){
                for (var i=0; i<userform.length; i++){
                        $(userform[i]).attr('disabled', true);
                }
            }
        </script>
    @endif

    <script type="text/javascript" src="/js/diagram.js"></script>
@stop


