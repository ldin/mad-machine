<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" />

    <title>@yield('title') </title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/layout.css" rel="stylesheet">


    {{ HTML::script('/js/jquery-1.10.2.min.js') }}

    @yield('header')
  </head>

  <body role="document">
    <div class="wrapper">
      <header>

        <nav class="navbar navbar-top navbar-inverse ">
          <div class="container">
            <div class="col-xs-12 col-sm-6">
              
              <p class="header-text">
                <span class="violet">+7 (965) 353-98-98</span>
                <br /> Хорошовское шоссе 96, с. 3
              </p>

            </div><!--/.navbar-collapse -->
            <div class="col-xs-12 col-sm-6 text-right">
              <a href="/"><img src="/img/logo_w.png" class="header-logo"></a>
            </div>
          </div>
        </nav>

        <nav class="navbar navbar-menu navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav text-uppercase">
                @if(isset($pages_all))
                  @foreach($pages_all as $k=>$page)
                    <li {{ Request::is($page->slug)?'class="active"':''}}>{{HTML::link($page->slug, $page->name)}}</li>
                  @endforeach
                @endif
              </ul>
            </div><!--/.navbar-collapse -->
          </div>
        </nav>

      </header>

      @if(Session::has('success'))
        <div class="alert alert-success text-center">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ Session::get('success') }}
        </div>
      @endif

      @if(Session::has('error'))
        <div class="alert alert-danger text-center">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ Session::get('error') }}
        </div>
      @endif


      @yield('content')

    </div>

    <footer id="footer" class="white footer">
      <div class="container">

        <div class="col-xs-12 col-sm-6">
          <div itemscope itemtype="http://schema.org/Organization">
            <p><span itemprop="name">Mаd Mechanics</span></p>
            
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <p>Адрес:
              <span itemprop="streetAddress">Хорошовское шоссе, 96с3</span>
              <span itemprop="addressLocality">Москва</span>,</p>
            </div>
            <p>Телефон:<span itemprop="telephone"> +7 965 353-98-98</span>,<br>
            Электронная почта: <span itemprop="email">info@madmech.ru</span></p>
          </div>
          <!-- http://schema.org/AutoRepair -->
        </div>
        <div class="col-xs-12 col-sm-6 text-right">
        <br/><br/><br/>
            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=28155948&amp;from=informer"
            target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/28155948/3_0_D42020FF_B40000FF_1_pageviews"
            style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:28155948,lang:'ru'});return false}catch(e){}"/></a>
            <!-- /Yandex.Metrika informer -->    
        </div>


      </div>
    </footer>

   <script src="/js/bootstrap.min.js"></script>
    @yield('scripts')

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter28155948 = new Ya.Metrika({id:28155948,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/28155948" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

  </body>
</html>
