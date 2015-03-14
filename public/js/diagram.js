//      https://google-developers.appspot.com/chart/interactive/docs/gallery/columnchart
//      на входе events(значения) и colors(цвет) диагаммы
//      event имеет формат json, вида
//          var events =
//           '[{"name":"name1","part":0,"text":"text1","data":"2014-07-06 - 2014-07-13"},
//            {"name":"name2","part":0,"text":"text2","data":"2000-01-01 - 2000-01-31"}]'

    if(typeof colors === "undefined") {
        var colors='#0065BD';}
    if(typeof events !==  "undefined" && events !== null ){
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(function() { drawChart(events, colors); });

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'задача');
            data.addColumn('number', 'выполнено');
            data.addColumn({type: 'string', role: 'annotation'});
            data.addColumn({type:'string', role:'tooltip', 'p': {'html': true}}); // Tooltip with percentages
            data.addRows(events.length);
                for (var i = 0; i < events.length; i++) {
                    data.setValue(i, 0, events[i].name);
                    data.setValue(i, 1, events[i].part/100);
                    data.setValue(i, 2, ""+events[i].part+"%");
                    data.setValue(i, 3," <div> "+events[i].text +"</div><p>"+ events[i].data+" </p> ");
                }

         var options = {
             hAxis: {title: ''},
             vAxis: {
                 title: 'Выполнено',
                 format:'#%',
                 viewWindow:{
                    max:1.1,
                    min:0
                  }
             },
             colors: [colors],
             legend: { position: "none" },
             tooltip: { isHtml: true }
         };

         new google.visualization.ColumnChart(document.getElementById('graph')).draw(data, options);
        }
    }

