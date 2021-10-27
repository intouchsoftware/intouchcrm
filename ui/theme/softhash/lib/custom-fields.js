$(document).ready(function () {


    var $modal = $('#ajax-modal');
    var sysrender = $('#sysfrm_ajaxrender');
    sysrender.on('click', '.cdelete', function(e){
        e.preventDefault();
        var id = this.id;
        bootbox.confirm("Are you sure?", function(result) {
            if(result){
                var _url = $("#_url").val();
                window.location.href = _url + "delete/customfield/" + id + '/';
            }
        });
    });



    sysrender.on('click', '.sys_add', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var _url = $("#_url").val();
        setTimeout(function(){
            $modal.load(_url + 'settings/customfields-ajax-add/','', function(){
                $modal.modal(
                    {

                        width: '600'
                    }
                );
            });
        }, 1000);
    });


    $modal.on('click', '#add_submit', function(){
        $modal.modal('loading');
        setTimeout(function(){


            var _url = $("#_url").val();
            $.post(_url + 'settings/customfields-post/', $('#add_form').serialize(), function(data){

                setTimeout(function () {

                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        location.reload();
                    }
                    else {

                        $modal
                            .modal('loading')
                            .find('.modal-body')
                            .prepend('<div class="alert alert-danger fade in">' + data +

                            '</div>');

                    }
                }, 1000);
            });
        }, 1000);

    });


    sysrender.on('click', '.sys_edit', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var _url = $("#_url").val();
        var vid = this.id;
        var id = vid.replace("f", "");
        var id = vid.replace("d", "");
        setTimeout(function(){
            $modal.load(_url + 'settings/customfields-ajax-edit/' + id,'', function(){
                $modal.modal(
                    {

                        width: '600'
                    }
                );
            });
        }, 1000);
    });


    $modal.on('click', '#edit_submit', function(){
        $modal.modal('loading');
        setTimeout(function(){


            var _url = $("#_url").val();
            $.post(_url + 'settings/customfield-edit-post/', $('#edit_form').serialize(), function(data){

                setTimeout(function () {

                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        location.reload();
                    }
                    else {

                        $modal
                            .modal('loading')
                            .find('.modal-body')
                            .prepend('<div class="alert alert-danger fade in">' + data +

                            '</div>');

                    }
                }, 2000);
            });
        }, 1000);

    });





});