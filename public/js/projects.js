function projectsConnectedUser(user_id){
    $('.watch').click(function () {
        var id_project = $(this).data('project-id');
        var watch = $(this).data('watch');
        watch = ++watch&1;
        $(this).data('watch', watch);
        var that = this;
        $.ajax({
          url: "/project/watch",
          type: "POST",
          data: {project_id : id_project, user_id:user_id, watch:watch},
          success: function(){
              if(watch == 0){
                  $(that).removeClass('btn-success');
              }else{
                  $(that).addClass('btn-success');
              }
          }
        });
      });
    $('.connect').click( function () {
        var id_project = $(this).data('project-id');
        var connect = $(this).data('connect');
        if(connect != 1){
            if(connect == 10) {connect=1};
            connect = ++connect&1;
            $(this).data('connect', connect*10);
            var that = this;
            $.ajax({
              url: "/project/connect",
              type: "POST",
              data: {project_id : id_project, user_id:user_id, connect:connect*10},
              success: function(){
                  if(connect == 0){
                      $(that).removeClass('text-muted');
                      $(that).html('<span class="glyphicon glyphicon glyphicon-ok-sign"></span> подключиться');
                  }else{
                      $(that).addClass('text-muted');
                      $(that).html ('<span class="glyphicon glyphicon glyphicon-ok-sign"></span> ожидание подключения');
                  }
              }
            });
        }
    });
}

function projectsNoConnectedUser(){
    $('.watch').click(function () {
      tooltips();
      });
    $('.connect').click( function () {
      tooltips();
    });
}
function Alert(AlertTitle,AlertContent,afterFunction){
        $('<div class="overlay" id="alertOverlay"></div>').appendTo('body');
        $('<div id="alert"><a href="#" id="clouseAlert" onclick="clouseAlert('+afterFunction+'); return false" title="Закрыть" class="clousePopup"></a><div class="h1" id="alertH1">'+AlertTitle+'</div><div id="alertText">'+AlertContent+'</div><div class="otbivka"></div><div class="button" onclick="clouseAlert('+afterFunction+'); return false">OK</div></div>').appendTo('body');
        $("#alertOverlay").fadeIn("slow");
        $("#alert").fadeIn("slow");
        $('#alert').css('margin-top', (-1)*($('#alert').height())+'px');
    }
function clouseAlert(afterFunctionClouse){
        $("#alertOverlay").remove();
        $("#alert").remove();
        afterFunctionClouse;
    }
function tooltips(){
      Alert("Ошибка доступа","Для подключения к проекту <a href='/auth/register'>зарегистрируйтесь</a> или <a href='/auth/login'>войдите</a> в систему под своим логином")
    }

