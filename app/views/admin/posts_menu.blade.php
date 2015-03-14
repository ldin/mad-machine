
@if(isset($posts) )
    
    <ul class="nav">
        
    @foreach($posts as $key=>$post)
            <li class="dropdown active" >
                {{ HTML::link('admin/'.$post->type.'/'.$post->id, $post->name) }}
                <ul  id='sortable-{{$key}}' class="my-dropdown-menu">
                    @if(isset($posts_child))
                        @foreach($posts_child as $post2)
                            @if($post2->parent == $post->id)

                                <li id='{{$post2->id}}'>
                                    {{ HTML::link('admin/'.$post2->type.'/'.$post2->id, $post2->name) }}
                                    <!--<i class="glyphicon glyphicon-resize-vertical order"></i>-->
                                    @if(isset($row['id']) &&( $post2->id == $row['id'] || $post2->id == $row['id']))

                                    @endif
                                </li>
                            @endif    
                        @endforeach
                    @endif
                 </ul>   
            </li>
    @endforeach
    <div class='res'></div> 
    </ul>

@endif
<p>
    <?php echo HTML::decode(HTML::link('/admin/'.$type, '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить', array('class'=>'addNews'))); ?>   
</p>



