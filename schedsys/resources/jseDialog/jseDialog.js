(function($) {

    $.fn.jseDialog = function(options ,successFunct) {
       $(this).css({'position':'absolute','z-index':'100','width':'100%','height':'278%','overflow':'auto','background':'#FFF','top':'0','left':'0','padding-top':'60px','padding-left':'3%','padding-right':'3%'});
       $(this).prepend("<div style='position:fixed;  z-index:9; right:1%; top:55px;'><span class='glyphicon glyphicon-remove'  style='cursor:pointer; color:rgba(0,0,0,0.7); font-size:55px;' onclick='jseDialogclose("+successFunct+");'></span></div>");
       $(this).attr('name','jseDdialog');
       $(this).attr('class','jseDdialogM');
        $(this).hide();
        if(options=='open')
        {
        $(this).fadeIn(1000);
        }
        else if(options=='close')
        {
        $('.jseDdialogM').fadeOut();
         $("#wrapper").toggleClass("toggled");
        //successFunct();

        }
        else{
        // Establish our default settings
        var settings = $.extend({
            title         : 'Hello, World!',
            autoOpen      : false
        }, options);

        return this.each( function() {


            if(settings.autoOpen)
            {
              $(this).fadeIn(1000);   
            }
            else{
             $(this).hide();   
            }
        });
        
         }
    }
jseDialogclose=function(successFunct){
$('.jseDdialogM').fadeOut();
 $("#wrapper").toggleClass("toggled");
  //successFunct();
}

}(jQuery));

