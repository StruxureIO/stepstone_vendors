humhub.module('template', function(module, require, $) {

    var init = function() {
        console.log('template module activated');
    };

    var hello = function() {
        alert(module.text('hello')+' - '+module.config.username)
    };

    module.export({
        //uncomment the following line in order to call the init() function also for each pjax call
        //initOnPjaxLoad: true,
        init: init,
        hello: hello
    });
    
    $(document).on("click", ".step-vendor-area", function () {
      var vendor_areas = "";    
    
      $('.step-vendor-area').each(function() {   
        var area_id = $(this).attr('data-id');      
        var checked = $(this).is(':checked') 
        if(checked) {
          if(vendor_areas == '') 
            vendor_areas = area_id;
          else
            vendor_areas += ',' + area_id;
        }        
      });
      $('#vendor-areas').val(vendor_areas);              
    });
        
    
});