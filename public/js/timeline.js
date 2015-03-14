/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//        <!-- Timelines -->


 
var tl;
function initTimeline() {
    
  id_project = $('#my-timeline').data('id');  
  lastdate =  $('#my-timeline').data('lastdate');
    
  var eventSource = new Timeline.DefaultEventSource();  
  var bandInfos = [
    Timeline.createBandInfo({
        eventSource:    eventSource,
        //date:           lastdate,
        date:           new Date(),
        width:          "80%", 
        intervalUnit:   Timeline.DateTime.MONTH, 
        intervalPixels: 200
    }),
    Timeline.createBandInfo({
        showEventText:  false,
        trackHeight:    0.5,
        trackGap:       0.2,
        eventSource:    eventSource,
        date:           new Date(),
        width:          "20%", 
        intervalUnit:   Timeline.DateTime.YEAR, 
        intervalPixels: 100
    })
  ];
  bandInfos[1].syncWith = 0;
  bandInfos[1].highlight = true;
  bandInfos[1].eventPainter.setLayout(bandInfos[0].eventPainter.getLayout());
  
    tl = Timeline.create(document.getElementById("my-timeline"), bandInfos);
 Timeline.loadXML("/admin/projecteventxml/"+id_project, function(xml, url) { eventSource.loadXML(xml, url); });
  
  }

var resizeTimerID = null;
function onResize() {
    if (resizeTimerID == null) {
        resizeTimerID = window.setTimeout(function() {
            resizeTimerID = null;
            tl.layout();
        }, 500);
    }
} 
                
 
        
//        <!-- /Timelines -->

