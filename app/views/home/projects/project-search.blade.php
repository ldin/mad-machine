<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Поиск</h3>
    </div>

    <div class="panel-body">

        {{ Form::open(array('url' => '/project/search/', 'method' => 'get', 'class' => 'form-group')) }}

          <label>Стадия</label>

          @foreach($stages as $k=>$stage)
          <br> {{ Form::checkbox('stage[]', $k, isset($old)&&in_array( $k, $old['stage'])?"array(1)":'')   . $stage . $k; }}

          @endforeach
          <br><br>
          <label>Сумма инвестиций</label>
            <div class=" row">
              <div class="form-group col-xs-5 col-md-5">
                <label for="exampleInputFrom" class="sr-only">от</label>
                {{ Form::text('from',  (isset($old)&&($old) ? $old['from'] : ''), array('class' => 'form-control', 'placeholder'=>'от')); }}
              </div>
               <div class="col-xs-1 col-md-1" style="margin:0;padding:0;width:5px;"><span>-</span></div>
              <div class="form-group col-xs-5 col-md-5">
                <label for="exampleInputTo" class="sr-only">до</label>
                {{ Form::text('to', (isset($old)&&($old) ? $old['to'] : ''), array('class' => 'form-control', 'placeholder'=>'до')); }}
              </div>
            </div>
            <br>

          {{  Form::submit('Показать', array( 'class' => 'btn btn-default')) }}

        {{Form::close()}}

  </div>
</div>
