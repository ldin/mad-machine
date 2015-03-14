@extends('admin.layouts.default')

@section('sidebar')
<br>
    @if( Authority::can('update', 'Category') )  
        <ul class="nav">
            <li class=" dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-group"></i>
                        <span class="menu-title">Категории</span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                <ul class="my-dropdown-menu">
                @foreach($categories as $post)
                    <li>{{ HTML::link('admin/category/'.$post->id, $post->name) }}</li>
                @endforeach
                </ul>
            </li>
            <li class=" dropdown active">
                <a href="/admin/category/" class="dropdown-toggle" >
                    + Добавить категорию
                </a>
            </li>

        </ul> 
    @endif  
@stop
    
@section('content')

<div class="col-xs-12 col-md-8">
    
    <!--@ if($row)--> 
        @if( Authority::can('update', 'Category') )  

        {{ Form::open(array('url' => 'admin/category/'.(isset($row['id'])?$row['id']:''), 'name'=>'userform', 'class' => 'form-group')) }}  

            <div class="tab-content">

                <br />
                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                {{ Form::label('Имя') }} 
                {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}
                {{ ($errors->first('name')) ? Form::label('error', $errors->first('name'), array('class'=>'control-label')) : '' }}

                </div>

                <br />
                {{ Form::label('slug', 'slug', array('class'=>'control-label')) }}  
                {{ Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control')); }}
                
                <br/>
                @if($row)
                <label>Админы</label>

                  <br>
                  <table id="example" class="table display"  width="100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Подключен</th>
                            <th>Ред.</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $k => $user)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>
                                    <a href="/admin/user/{{$user->id}}">
                                        <b class=" text-info">{{$user->name}}</b>
                                    </a>
                                </td>
                                <td>
                                    <b id="status-{{$user->id}}"> {{$user->status}} </b>
                                </td>
                                <td><a href="#" data-st="{{($user->status==1)?$user->status:0}}" onclick="editStatus({{$user->id}},{{$row['id']}}, this); return false;"><span class="badge">{{($user->status == 1)?'отключить':'подключить'}}</span></a></td>
                            </tr>
                        @endforeach
                    </tbody>    
                  </table>
                @endif
                
                <br /><br />
                {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}

                @if( Authority::can('delete', 'Category') ) 
                        {{ HTML::link('/admin/delete-any/category/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить раздел?')")) }}

                        {{'';// HTML::link('#', 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('В данный момент недоступно')")) }}
                @endif 

            </div>

        {{ Form::close() }}
        
        @endif
        
 
</div>  


@stop        

@section('scripts') 

    <script type="text/javascript">

        function editStatus(user_id, category_id, that) {
            status = $(that).data('st');
            status = ++status&1
            b_status=$("#status-"+user_id);
            console.log($(that).children().text('отключить'));

            jQuery.ajax({
                url:  "/admin/category-user",  
                type: "POST", 
                data: {user_id:user_id, category_id:category_id, status:status},
                success: function() { 
                     if(status == 1 ){
                         b_status.text(status);
                         $(that).data('st', status);
                         $(that).children().text('отключить');
                     }
                     else{
                         b_status.text(status);
                         $(that).data('st', status);
                         $(that).children().text('подключить');
                     }              
                }
            });
        }

     </script>

    @if((!Authority::can('editUser', 'User')) || ((isset($row['roles'][0])) && ($row['roles'][0]->name == 'mainAdmin')&& Auth::user()->hasRole('admin')) )
        <script>
            if(typeof userform !== "undefined"){
                for (var i=0; i<userform.length; i++){
                        $(userform[i]).attr('disabled', true);
                }
            }
        </script>
    @endif 

@stop


