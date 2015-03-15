@extends('home.layouts.layout')

@section('title')
  {{ $post->title }}
@stop

@section('content')

    <article id="we_do">
      <div class="bg-block">

        <!-- <h2  class="head text-center color-light opacity">Что мы делаем для Вас</h2> -->
        <div class="container">            
            <div class="row row-block">   

                <div class="col-xs-6 col-sm-4 col-md-2 uslugi">
                    <a href="/okraska-detali-i-lokalnyiy-remont" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting.jpg" alt="">
                      </div> 
                    </a>                     
                    <h3>Локальная покраска</h3>
                </div><!-- /.col-lg-4 -->
                <div class="col-xs-6 col-sm-4 col-md-2 uslugi">
                    <a href="/polnaya-pokraska" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting2.jpg" alt="">
                      </div> 
                    </a>                 
                    <h3>Полная покраска</h3>
                </div><!-- /.col-lg-4 -->
                <div class="col-xs-6 col-sm-4 col-md-2 uslugi">
                    <a href="/" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting3.jpg" alt="">
                      </div>
                    </a>
                    <h3>Установка обвесов</h3>
                </div><!-- /.col-lg-4 -->
                <div class="col-xs-6 col-sm-4 col-md-2 uslugi">
                    <a href="/remont-bamperov" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting5.jpg" alt="">
                      </div>
                    </a>
                    <h3>Ремонт пластиковых бамперов</h3>
                </div><!-- /.col-lg-4 -->
                
                <div class="col-xs-6 col-sm-4 col-md-2 uslugi ">
                    <a href="/shumoizolyatsiya" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting4.jpg" alt="">
                      </div>
                    </a>
                  <h3>Шумоизоляция авто</h3>
                </div><!-- /.col-lg-4 -->
                <div class="col-xs-6 col-sm-4 col-md-2 uslugi">
                    <a href="/aerografiya" class="a_uslugi">
                      <div class="pic">
                          <img class="img-circle" src="/img/painting5.jpg" alt="">
                      </div>
                    </a>
                  <h3>Аэрография</h3>
                </div><!-- /.col-lg-4 -->

                <div class="clear"></div>
            </div>
        </div> <!-- /container -->
      </div> <!-- bg-block -->
    </article>


    <aside id="advantage" class="bg-light">
      <div class="bg-block">
        <h2 class="text-center color-dark head opacity">Наши преимущества</h2>

        <div class="container">
          <div class="row row-block text-center txt1">
              <div class="col-lg-4">
                <div class="block opacity">
                    <h3><span>Опыт</span></h3>
                    <p>Большой опыт в работах различной сложности</p>
                </div>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                <div class="block opacity ">
                    <h3><span>Скорость</span></h3>
                    <p>Выполнение работ в кратчайшие сроки</p>
                </div>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                <div class="block opacity">
                    <h3><span>Качество</span></h3>
                    <p>Используем проверенные эффективные технологии и фирменные материалы</p>
                </div>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                <div class="block opacity">
                    <h3><span>Гарантии</span></h3>
                    <p>Мы даем гарантии на все виды выполняемых работ</p>
                </div>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                <div class="block opacity">
                    <h3><span>Сервис</span></h3>
                    <p>Мы сделаем все что вы пожелаете. Даже если это не наш профиль.</p>
                </div>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                <div class="block opacity">
                    <h3><span>Цены</span></h3>
                    <p>Общедоступные цены при высоком качестве</p>
                </div>
              </div><!-- /.col-lg-4 -->
          </div> <!-- /row -->
        </div> <!-- /container -->
        <div class="clear"></div>
      </div> <!-- /bg-block -->
    </aside>



    <aside id="service">
      <h3 class="text-center head">Автосервис в Москве</h3>
      <div class="container">
        <div class="row row-block txt1">
          <p>
            Автосервис <big>Mad Mechanics</big>  - компания занимающаяся работами по окраске, полировке и нанесении аэрографии на автомобили. 
          </p>
          <li>Главной задачей сервиса является быстрое и качественное обслуживание наших клиентов, поэтому мы предоставляем гарантии на производимые в нашем сервисе работы.
          </li>
          <li>
У нас работают профессионалы с большим опытом работы. Так же обслуживание проводится с применениями современного оборудования.
          </li>
          <li>
Все работы выполняются в оговоренные сроки. Мы не навязываем лишних работ, чем экономим ваше время. Также никакие дополнительные работы не выполняются без вашего согласия.
          </li>
          <li>
Мы Вам предоставляем возможность выбирать будут ли заказаны и установлены оригинальные  или не оригинальные детали на ваш автомобиль.
          </li>
          <li>
Для постоянных клиентов мы предоставляем специальные предложения.
          </li>  


        </div> <!-- row -->
      </div> <!-- container -->
    </aside>

    <aside id="comment" class="bg-dark">
      <h3 class="text-center head opacity">Отзывы о нас</h3>
      <div class="row text-center txt1">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="col-md-4 center">
                        <img class="img-circle" src="/img/people1.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p class="name">Инна</p>
                        <p>
                            Отдала на  на полную перекраску машинку, всё прекрасно сделали. 
                            Краска ровно лежит, машина как новая. Спасибо ребята!!!
                        </p>
                    </div>
                    <div class="col-md-4 center">
                        <img class="img-circle" src="/img/people2.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p class="name">Степан Григорьевич</p>
                        <p>
                            Приехал на полировку, после покраски в другом сервисе,  остался виден переход, 
                            мастера отполировали все быстро и аккуратно. Ничего не заметно! Спасибо! В следующий раз сразу к вам поеду!
                        </p>
                    </div>
                    <div class="col-md-4 center">
                        <img class="img-circle" src="/img/people3.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p class="name">Антон Васильев</p>
                        <p>
                            Приехал на срочный ремонт, был не удачный удар в фару, помял капот крыло и бампер, 
                            сделали за 3 дня! Спасибо спасибо! Выглядит как новая.
                        </p>
                    </div>                    
                </div>
            </div>
            <div class="item">
                <div class="container">

                    <div class="col-md-4 center">
                        <img class="img-circle" src="/img/people4.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p class="name" >Владислава Петрова</p>
                        <p>
                            Приехала на покраску бампера, отлично сделали и в подарок отполировали фары! Огромное вам спасибо!
                        </p>
                    </div>
                    <div class="col-md-4 center">
                        <img class="img-circle" src="/img/people5.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p class="name">Марина</p>
                        <p>
                            Повредила бампер, большая трещина, сделали с покраской за один день! Выглядит как новый!
                        </p>
                    </div>
                    <div class="col-md-4 center">
                        <img class="img-circle" src="/image/people6.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <p  class="name">Анна</p>
                        <p>
                            На новой машине притерла бампер, отдала на работу в ночь, к утру забрала, как будто и ничего не было! Спасибо ребята!!!
                        </p>
                    </div>
                </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!-- /.carousel -->
      </div>
    </aside>

    <aside id="block_form">
    <div class="block-form-bg">
      <h3 class="text-center head opacity">Контакты</h3>
      <div class="container">
        <div class="row row-block">
          <div class="col-md-8 col-md-offset-2">

      @if(Session::has('successRequest'))
        <div class="alert alert-success text-center">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ Session::get('successRequest') }}
        </div>
      @endif

      @if(Session::has('errorRequest'))
        <div class="alert alert-danger text-center">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ Session::get('errorRequest') }}
        </div>
      @endif

            <div id="contact_form" class="row opacity border">
              <div class="">

                <div class="right-block col-md-6">
                  {{ Form::open( array('url'=>'form-request','class'=>'', 'role'=>'form')) }}
                    <div class="form-group">
                      {{ Form::label('name','Описание', array('for'=>'InputName', 'class'=>'sr-only' ) ) }}
                      {{Form::text('name', '', array('class' => 'form-control', 'placeholder'=>'Имя' )); }}
                    </div>
                    <div class="form-group">

                      {{ Form::label('phone','Описание', array('for'=>'InputPhone', 'class'=>'sr-only' ) ) }}
                      {{Form::text('phone', '', array('class' => 'form-control', 'placeholder'=>'Телефон' )); }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('email','Описание', array('for'=>'InputEmail', 'class'=>'sr-only' ) ) }}
                      {{Form::text('email', '', array('class' => 'form-control', 'placeholder'=>'Емайл' )); }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('text','Описание', array('for'=>'InputText', 'class'=>'sr-only' ) ) }}
                      {{Form::textarea('text', '', array('class' => 'form-control','rows'=>'3', 'placeholder'=>'Напишите ваш вопрос или укажите удобное время для звонка' )); }}
                    </div>

                    {{Form::submit('Отправить сообщение', array( 'class' => 'btn btn-default btn-submit')) }}

                  {{ Form::close() }}
                </div>
                <div class="left-block left-bg col-md-6">
                    <p><span class="big">Остались вопросы?</span></p>
                    <p><br>Звоните <b> +7 (965) 353-98-98 </b>
                    <br>
                    <p>Или просто оставьте свои контактные данные.</p>
                    <p>Мы обязательно с вами свяжемся в удобное для вас время.</p>
                  </p>
                </div>
                <div class="left-bg clearfix visible-md visible-lg"></div>
              </div>
            </div> <!-- /row -->

            <div id="contact_text" class="row txt2">
              <div class="row ">
                <div class="col-xs-2  col-lg-1 col-md-offset-3">
                  {{ HTML::image('/img/ico_kont_phone.png', 'people') }}
                </div>
                <div class="col-xs-10 col-md-6 ">
                  <p>
                    <span class="big"><a href="tel:+79653539898" class="tel">+7 (965) 353-98-98</a></span><br>                  
                  </p>
                </div>
              </div>

              <div  class="row">
                <div class="col-xs-2 col-lg-1 col-md-offset-3">
                  {{ HTML::image('/img/ico_kont_adress.png', 'people') }}
                </div>
                <div class="col-xs-10 col-md-6 ">
                    <p>Мы находимся по адресу:</p>
                    <p>Хорошовское шоссе 96с3. метро Полежаевская</p>
                </div>
              </div>
            </div><!-- /row -->

          </div>  <!-- /offset-3 -->
        </div>   <!-- /row -->
      </div> <!-- /container -->
    </div>
    </aside>

    <aside id="map">
      <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=ZXAglQ3dACXgNoErddT5gCW8E6lIhlTF&height=350"></script>
    </aside>

    <aside id="social">
      <h3 class="text-center head opacity">Мы в соцсетях</h3>
       <div class="container">
        <div class="row row-block">
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
        <div class="col-xs-12 col-sm-6">
            <!-- VK Widget -->
            <div id="vk_groups1" ></div>
            <script type="text/javascript">
            VK.Widgets.Group("vk_groups1", {mode: 2, wide: 1, width: "auto", height: "300"}, 76370545);
            </script>          
        </div>
        <div class="col-xs-12 col-sm-6">
          <!-- VK Widget -->
          <div id="vk_groups2"></div>
          <script type="text/javascript">
          VK.Widgets.Group("vk_groups2", {mode: 0, width: "auto", height: "300", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 76370545);
          </script>
        </div>





        </div>
      </div>
      
    </aside>

@stop

@section('scripts')
@stop

