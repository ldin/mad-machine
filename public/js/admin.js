/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

    var dropdowns = $('.dropdown');
    dropdowns.click(function() {
        //console.log($(this).hasClass('active'));
      if ( $(this).hasClass('active') ){
        $(this).toggleClass('active');
      } else {
        dropdowns.removeClass('active');
        $(this).toggleClass('active');
      }
    });

}); 



