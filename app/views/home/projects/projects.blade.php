@extends('home.layouts.layout-page')

@section('title')
  Проекты
@stop

@section('left_menu')
  @include('home.projects.project-search')
@stop

@section('main_block')
  <div class="panel-title">
    <p> Найдено проектов: {{count($projects)}}</p>
  </div>
  <div id="project_preview">
    @foreach($projects as $project)
      @include('home.projects.project-preview')
    @endforeach
    <?php echo $projects->links(); ?>
  </div> <!-- project_preview -->
@stop

@section('scripts')
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
@stop
