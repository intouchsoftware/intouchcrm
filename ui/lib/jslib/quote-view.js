$(document).ready(function () {



    var $modal = $('#ajax-modal');


    var sysrender = $('#sysfrm_ajaxrender');




    sysrender.on('click', '#mail_quote_created', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');

        setTimeout(function(){
            $modal.load('index.php?_route=quotes/mail_invoice_/' + iid + '/created', '', function(){
                $modal.modal();
                $('.sysedit').summernote({

                });
            });
        }, 1000);
    });




    $modal.on('click', '#send', function(){
        $modal.modal('loading');
        setTimeout(function(){


            var _url = $("#_url").val();
            $.post(_url + 'invoices/send_email', {


                message: $('.sysedit').code(),
                subject: $('#subject').val(),

                toname: $('#toname').val(),
                i_cid: $('#i_cid').val(),
                i_iid: $('#i_iid').val(),
                toemail: $('#toemail').val()

            }).done(function (data) {

                setTimeout(function () {

                    var _url = $("#_url").val();
                    $modal
                        .modal('loading')
                        .find('.modal-body')
                        .prepend(data);
                }, 2000);
            });
        }, 1000);

    });


    $("#convert_invoice").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                $('#ibox').block({ message: null });
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/convert_invoice/", { iid: iid })
                    .done(function( data ) {
                       // console.log(data);
                        $('#ibox').unblock();

                        //location.reload();
                        var _url = $("#_url").val();
                        window.location = _url + 'invoices/view/' + data + '/';

                    });
            }
        });

    });


    $("#mark_draft").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_draft/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });


    $("#mark_delivered").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_delivered/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_on_hold").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_on_hold/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_accepted").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_accepted/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_lost").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_lost/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });


    $("#mark_dead").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post( "index.php?_route=quotes/mark_dead/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $modal.on('hidden.bs.modal', function () {
        location.reload();
    })

});