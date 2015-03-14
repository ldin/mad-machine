@extends('home.layouts.layout-page')

@section('title')
{{ isset($project->title)?$project->title:"Проект" }}
@stop

@section('header')
<!--<script src="http://simile.mit.edu/timeline/api/timeline-api.js" type="text/javascript"></script>-->
@stop

@section('top_block')
  <div class="panel-header">
      <p class="h1">{{ $project->name }}</p>
  </div> <!-- /.panel-header -->

  <div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-2 image-logo">
            @if($project->about['logo'])
                {{HTML::image($project->about['logo'], '', array('class'=>"img-logo"))}}
            @else
                {{HTML::image('/img/no-photo.jpg', '', array('class'=>"img-logo"))}}
            @endif
        </div>
        <div class="col-sm-10">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td><b>Текущая стадия: </b></td>
                <td><b>Необходимые инвестиции для выхода на рынок: </b></td>
                <td>IRR = {{$project->about['irr']}}%</td>
              </tr>
              <tr>
                <td>{{($project->about['stage_id'])?$stages[$project->about['stage_id']]:''}}</td>
                <td>{{$project->about['needInvest']}} млн.руб</td>
                <td>PI = {{$project->about['pi']}}</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>NPV = {{$project->about['npv']}} млн.руб.</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div> <!-- /.panel-body -->
  </div> <!-- /.panel panel-default -->
@stop


@section('left_menu')
      <div class="panel panel-default">
        <div class="panel-heading">
          <p class="panel-title">Меню</p>
        </div>
        <div class="list-group">
            <ul class="nav nav-pills nav-stacked" role="tablist" id="myTab">
                <li><a href="#info"  role="tab" data-toggle="tab" class="list-group-item ">Инфо</a></li>
                <li><a href="#event"  role="tab" data-toggle="tab" id="eventtab" class="list-group-item">События</a></li>
                @if( Authority::can('read', 'ProjectBudget') )
                  <li><a href="#budget"  role="tab" data-toggle="tab" class="list-group-item">Бюджет</a></li>
                @endif
                <li><a href="#news"  role="tab" data-toggle="tab" class="list-group-item ">Новости</a></li>
            </ul>
        </div>
      </div>
@stop

@section('main_block')

      <div class="tab-content">

        <div class="tab-pane   active" id="info">
          <div class="panel panel-default">
            <div class="panel-heading">Информация о проекте</div>
            <div class="panel-body">
              {{ $project->about['text'] }}

              <div class="connect-button">
                <div class="btn btn-default connect link {{($project->connect == 1)?'btn-success':(($project->connect == 10)?'text-muted':'')}} " data-connect="{{$project->connect}}"  data-project-id="{{$project->id}}">
                  <span class="glyphicon glyphicon glyphicon-ok-sign"></span>
                  {{($project->connect == 1)?'Подключен':(($project->connect == 10)?'ожидание подключения':'подключиться')}}
                </div>
                <div class="btn btn-default watch link {{(isset($project->watch) && $project->watch == 1)?'btn-success':''}}" data-watch="{{isset($project->watch)?$project->watch:0}}" data-project-id="{{$project->id}}">
                <span class="glyphicon glyphicon-eye-open"></span> наблюдать
                </div>
              </div>

              <br><br>
            </div>
          </div>
              <!-- comments -->
          <div class="panel-heading">Комментарии</div>

          <div id="comments_all">
              @if(count($project['comments'])>0)
                  @foreach($project['comments'] as $comment)
                      @if($comment->status == 1)
                          <div class="well well-sm">
                              @if($comment->user_id == Auth::user()->id)
                              <div class="right"><i class="glyphicon glyphicon-remove" onclick="RemoveComment({{$comment->id}},this); return false;" ></i></div>
                              @endif
                                <p><b>{{ $comment['user']['name'] }}</b> - <i>{{ date("d.m.Y", strtotime($comment->created_at)) }}</i></p>
                                <p>{{ $comment->text }}</p>
                          </div>
                      @endif
                  @endforeach
              @else
                  <p>Комментариев пока нет</p>
              @endif
          </div>
          @if(Auth::check() && Auth::user()->status==1)
            <a  id="addcomment" class="btn btn-default">Добавить комментарий</a>
            <br><br>
            <div id="blockcomment" class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Добавить комментарий</h3>
              </div>
              <div class="panel-body">
                {{Form::open(array('url' => '#', 'class' => 'form-group', 'id'=>'formcomment'))  }}
                  {{Form::textarea('comment','', array('class'=>'form-control', 'id'=>'comment'))}}
                  <br>
                  <a class="btn" id="cancelcomment">Oтменить</a>
                  {{ Form::submit('Добавить', array( 'class' => 'btn btn-default', 'onclick'=>"AddComment(".$project->id.",".Auth::user()->id.",'".Auth::user()->name."'); return false;")) }}
                {{ Form::close() }}
              </div>
            </div>
          @endif
            <!-- /comments -->
        </div><!-- /.info -->

        <div class="tab-pane fade  active" id="event">
          <div class="panel panel-default">
            <div class="panel-heading">События</div>
            <div class="panel-body">
              <div id="graph" style="height: 200px;"></div>
              <br>
              <div class="panel-group">
                @foreach($project['events'] as $event)
                  <div class="list-group">
                    <h4 class="list-group-item-heading">{{$event->name}}</h4>
                    <p class="list-group-item-text">{{$event->text}}</p>
                    <p class="list-group-item-text">{{$event->start.' - '.$event->end}}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div><!-- /.event -->

        @if( Authority::can('read', 'ProjectBudget') )
          <div class="tab-pane fade" id="budget">
            <div class="panel panel-default">
              <div class="panel-heading">Бюджет проекта</div>
              <div class="panel-body">
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
                  @if(count($budget)>0)
                    @for($line=0; $line<(count($budget[2])); $line++)
                        <tr>
                        <td>{{$line+1}}</td>
                            @foreach($budget as $key=>$cell)
                              <td>{{ $cell[$line] }}</td>
                            @endforeach
                        </tr>
                    @endfor
                  @endif
                </table>
              </div>
            </div>
          </div><!-- /.budget -->
        @endif

        <div class="tab-pane fade" id="news">
          <div class="panel panel-default">
            <div class="panel-heading">Новости проекта</div>
            <div class="panel-body">
              <div class="panel-group">
                  @if(count($project['news'])>0)
                      @foreach($project['news'] as $news)
                        <div class="list-group">
                          <h4 class="list-group-item-heading">{{$news->name}}</h4>
                          <p class="list-group-item-text">{{$news->text}}</p>
                        </div>
                      @endforeach
                  @endif
              </div>
            </div>
          </div>
        </div><!-- /.news -->
      </div>


@stop

@section('scripts')

<script src="https://www.google.com/jsapi"></script>
<script type='text/javascript'>

    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('#myTab a[href="' + window.location.hash + '"]').tab('show')

    $('#addcomment').click(function(){
       $('#addcomment').hide();
       $('#blockcomment').show('slow');
    });
    $('#cancelcomment').click(function(){
       $('#blockcomment').hide('slow');
       $('#addcomment').show('slow');
    });

    function AddComment(project_id, user_id, user_name) {
        var comment = $('#comment').val();
        jQuery.ajax({
               url:  "/project/add-comment/"+project_id,
               type: "POST",
               data: {user_id:user_id, project_id:project_id, comment:comment},
               success: function() {
                   $(':input','#formcomment').val('');
                    var html = "<div class='well well-sm'>";
                    html += "<p><b>"+user_name+"</b> - <i> только что </i></p>";
                    html += "<p>"+comment+"</p>";
                    html += "</div>";
                   $('#comments_all').append(html);
                   $('#blockcomment').hide('slow');
                   $('#addcomment').show('slow');
               }
            });
        }

       function RemoveComment(com_id, that) {
            if (confirm("Вы уверены что хотите удалить комментарий?")){
               var user_id = "<?=Auth::user()->id;?>"
               jQuery.ajax({
                   url:  "/project/comment-delete",
                   type: "POST",
                   data: {com_id:com_id, user_id:user_id},
                   success: function() {
                        $(that).parent().parent().hide();
                   }
                });
            }
       }

    //для построения графика событий
    var events = <?=(isset($json)?$json:'null');?>;
    var colors = '#ff8000';

</script>

<script src="/js/projects.js"></script>
@if(Auth::check())
  <script type="text/javascript">
    projectsConnectedUser(<?=Auth::user()->id;?>);
  </script>
@else
  <script type="text/javascript">
    projectsNoConnectedUser();
  </script>
@endif

<script type="text/javascript" src="/js/diagram.js"></script>

@stop
