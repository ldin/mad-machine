<aside id="news">
    <div class="page-header">
        <h2>Новости</h2>
    </div>            
    <div class="list-group">
        @foreach($news as $new)
          <a href="{{$new->slug}}" class="list-group-item ">
            <p class="list-group-item-text">{{ date("d.m.y", strtotime($new->created_at)) }}</p>
            <h4 class="list-group-item-heading">{{ $new->name}}</h4>
            <p class="list-group-item-text">{{ $new->shortText}}</p>
          </a>
<!--                <div class="block_news">
                <p class="date">{{ date("d.m.y", strtotime($new->created_at)) }}</p>
                <h2>{{ HTML::link($new->slug, $new->name)}}</h2>
            </div>-->
        @endforeach                 
    </div>
</aside>


