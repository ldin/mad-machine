<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-12 col-md-8">
        <p class="projects_name text-uppercase"> {{$project->name}}</p>
        <p><b>Рынок:</b> {{$project->about['mart']}}</p>
        <p><b>Краткое описание:</b>{{$project->about['shortText']}}
        </p>
        <p><b>Ключевые факторы заинтересованности:</b> </p>
        <div>
            @if(isset($project->about['keyFactors'])&&$project->about['keyFactors'])
                <? $keyFactors = json_decode($project->about['keyFactors'], true) ?>
                <ul>
                    @for($line=0; $line<count($keyFactors[2]); $line++)
                        <li>{{$keyFactors[2][$line]}}</li>
                    @endfor
                </ul>
            @endif
        </div>

<!--         <div class="connect-button">
        @if(Auth::check())
            <div class="btn btn-default  connect link {{($project->connect == 1)?'btn-success':(($project->connect == 10)?'text-muted':'')}} " data-connect="{{$project->connect}}"  data-project-id="{{$project->id}}">
              <span class="glyphicon glyphicon glyphicon-ok-sign"></span>
              {{($project->connect == 1)?'Подключен':(($project->connect == 10)?'ожидание подключения':'подключиться')}}
            </div>
            <div class="btn btn-default  watch link {{(isset($project->watch) && $project->watch == 1)?'btn-success':''}}" data-watch="{{($project->watch)?$project->watch:0}}" data-project-id="{{$project->id}}">
            <span class="glyphicon glyphicon-eye-open"></span> наблюдать
            </div>
        @endif
        </div> -->
        <br>
        <a href="/project/{{$project->slug}}" class="btn btn-default">Подробнее..</a>

      </div>
      <div class="col-xs-12 col-md-4">
        <div class="border-left">
        <!-- <div class="panel panel-default"> -->
            <div class="panel-body logo">
                @if(isset($project->about['logo']) && $project->about['logo'] )
                    {{HTML::image($project->about['logo'], '', array('class'=>"img-logo", 'width'=>'100%'))}}
                @else
                    <p>{{$project->name}}</p>
                @endif
            </div>
        <!-- </div> -->
        <!-- <div class="panel panel-default"> -->
            <div class="panel-body info">
                <p><b>Текущая стадия: </b></p>
                <p>{{($project->about['stage_id'])?$stages[$project->about['stage_id']]:''}}</p>
                <p>{{$project->about['stageComment']}}</p>
                <br>
                <p><b>Необходимые инвестиции для выхода на рынок:</b></p>
                <p>{{$project->about['needInvest']}} млн.руб</p>
                <p>IRR = {{$project->about['irr']}}%</p>
                <p>PI = {{$project->about['pi']}}</p>
                <p>NPV = {{$project->about['npv']}} млн.руб</p>
            </div>
        <!-- </div> -->
        </div> <!-- /.border-left -->
      </div>
    </div><!-- /.row -->
  </div> <!-- /.panel-body -->
</div> <!-- /.panel -->


