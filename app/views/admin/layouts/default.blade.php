<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="/css/bootstrap.css" rel="stylesheet">
  <link href="/css/admin-style.css" rel="stylesheet">
  {{ HTML::script('/js/jquery-1.10.2.min.js') }}
  @yield('header')

 </head>

<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">madmech.ru</a>
    </div>
    @section('navbar')

        @if(Auth::check() && Authority::can('update', 'all'))
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav">

             <li {{ (Request::is('admin')) ? 'class="active"' : '' }}> {{ HTML::link('admin', 'Главная'); }} </li>
             <li {{ (Request::is('admin/page*')) ? 'class="active"' : '' }}> {{ HTML::link('admin/page', 'Статьи'); }} </li>

             <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <b class="caret"></b></a>
               <ul class="dropdown-menu">
                <li> {{ HTML::link('admin/user', 'Пользователи'); }} </li>
                <!-- <li> {{ HTML::link('admin/category', 'Категории проектов'); }} </li> -->

               </ul>
             </li>

             <!-- <li {{ (Request::is('admin/project*')) ? 'class="active"' : '' }}> {{ HTML::link('admin/project', 'Проекты'); }} </li> -->
             <li> {{ HTML::link('#', ''); }} </li>
           </ul>
           <!--
           <form class="navbar-form navbar-left" role="search">
             <div class="form-group">
               <input type="text" class="form-control" placeholder="Search">
             </div>
             <button type="submit" class="btn btn-default">Найти</button>
           </form>
           -->
           <ul class="nav navbar-nav navbar-right">
             <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки <b class="caret"></b></a>
               <ul class="dropdown-menu">
                 <li> {{ HTML::link('admin/settings', 'Настройки'); }} </li>
                 <li> {{ HTML::link('/', 'Перейти на сайт', array('target' => '_blank')); }} </li>
                 <li> {{ HTML::link('auth/logout', 'Выйти'); }} </li>
                 <li> {{ HTML::link('#', ''); }} </li>
               </ul>
             </li>
           </ul>
         </div><!-- /.navbar-collapse -->
         @endif

    @show
  </div><!-- /.container-fluid -->
</nav>


@if(Auth::check() && Authority::can('update', 'all'))
    <!--@ if( Authority::can('create', 'User'))-->

        <div id="sidebar" class="sidebar col-xs-4 col-sm-3">

            @yield('sidebar')

        </div>

        <div id="container" class="col-xs-14 col-sm-9 ">

            @if(Session::has('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{ Session::get('error') }}
            </div>
            @endif

            @yield('content')

        </div> <!-- /container -->
<!--    @ else
    <p class="center">У вас недостаточно прав.</p>
    <a href="/" class="center">Главная</a>
    @ endif-->
@else
    <div id="login">
        @yield('content')
    </div>
@endif

    <div id="other">
        @yield('other')
    </div>

  <!-- Le javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!--<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>-->


  <script src="/js/libs/bootstrap.min.js"></script>
  <script src="/js/admin.js"></script>


   <script src="/ckeditor/ckeditor.js"></script>
    {{ HTML::script('js/ajexFileManager/ajex.js') }}


  <!--<script src="/ckeditor/adapters/jquery.js"></script>-->

    @yield('scripts')


 </body>
</html>
