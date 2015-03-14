<aside id="top">

    <div class="page-header">
        <h2>Топ проектов</h2>
    </div>
    <table class="table table-striped">
        @foreach($projects as $k=>$project)
            <tr><td>{{++$k.'. ' . HTML::link('/project/'.$project->slug, $project->name)}}</td></tr>
        @endforeach
    </table>
</aside> 
