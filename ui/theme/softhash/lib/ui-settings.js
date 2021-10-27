$(document).ready(function () {

    var _url = $("#_url").val();
    $('#config_animate').change(function() {

        $('#ui_settings').block({ message: null });


      if($(this).prop('checked')){

          $.post( _url+'settings/update_option/', { opt: "animate", val: "1" })
              .done(function( data ) {
                $('#ui_settings').unblock();
                  location.reload();
              });

      }
        else{
          $.post( _url+'settings/update_option/', { opt: "animate", val: "0" })
              .done(function( data ) {
                  $('#ui_settings').unblock();
                  location.reload();
              });
      }
    });

    $('#config_rtl').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "rtl", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "rtl", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    })

});