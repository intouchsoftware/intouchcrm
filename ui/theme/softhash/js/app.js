$(document).ready(function () {

    $('#side-menu').metisMenu();

    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    })

    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();


    $(window).bind("load resize click scroll", function() {
        if(!$("body").hasClass('body-small')) {
            fix_height();
        }
    })

    $("[data-toggle=popover]")
        .popover();

    // Menu

    $('.navbar-minimalize').on('click', function() {
         $('.navbar-header i').toggleClass('fa-indent');
    });


});


$(function() {
    $(window).bind("load resize", function() {
        if ($(this).width() < 769) {
            $('body').addClass('body-small')
        } else {
            $('body').removeClass('body-small')
        }
    })
})


function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')){
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        $('#side-menu').removeAttr('style');
    }
}

var $loader = $('#preloader');

if(config_animate == "Yes"){
    $(window).load(function() {
        "use strict";
        setTimeout(function() {
            $('.loader-overlay').addClass('loaded');
            $('body > section').animate({
                opacity: 1
            }, 400);
        }, 500);
    });
}

/**** Sortable Portlets ****/
function sortablePortlets(){
    if ($('.ibox').length && $.fn.sortable) {
        $( ".ibox" ).sortable({
            connectWith: ".ibox",
            handle: ".ibox-title",
            items:'div.ibox',
            placeholder: "panel-placeholder",
            opacity: 0.5,
            dropOnEmpty: true,
            forcePlaceholderSize: true,
            receive: function(event, ui) {
                $("body").trigger("resize");
            }
        });
    }
}

var oldIndex;
if ($('.sortable').length && $.fn.sortable) {
    $(".sortable").sortable({
        handle: ".ibox-title",
        start: function(event, ui) {
            oldIndex = ui.item.index();
            ui.placeholder.height(ui.item.height() - 20);
        },
        stop: function(event, ui) {
            var newIndex = ui.item.index();

            var movingForward = newIndex > oldIndex;
            var nextIndex = newIndex + (movingForward ? -1 : 1);

            var items = $('.sortable > div');

            // Find the element to move
            var itemToMove = items.get(nextIndex);
            if (itemToMove) {

                // Find the element at the index where we want to move the itemToMove
                var newLocation = $(items.get(oldIndex));

                // Decide if it goes before or after
                if (movingForward) {
                    $(itemToMove).insertBefore(newLocation);
                } else {
                    $(itemToMove).insertAfter(newLocation);
                }
            }
        },
        update: function( event, ui ) {
            var sorted = $( this ).sortable( "serialize", { key: "sort" } );
            //update to database

        }
    });
}

$(document).ready(function () {

    sortablePortlets();


    $("#get_activity").click(function (e) {
        var _url = $("#_url").val();
        $.post(_url + 'util/activity-ajax/', {



        })
            .done(function (data) {

                setTimeout(function () {

                    $("#activity_loaded").html(data);

                }, 2000);
            });
    });


    //var doc = document;
    //var docEl = document.documentElement;
    //var $body = $('body');
    //
    //function toggleFullScreen() {
    //    if (!doc.fullscreenElement && !doc.msFullscreenElement && !doc.webkitIsFullScreen && !doc.mozFullScreenElement) {
    //        if (docEl.requestFullscreen) {
    //            docEl.requestFullscreen();
    //        } else if (docEl.webkitRequestFullScreen) {
    //            docEl.webkitRequestFullscreen();
    //        } else if (docEl.webkitRequestFullScreen) {
    //            docEl.webkitRequestFullScreen();
    //        } else if (docEl.msRequestFullscreen) {
    //            docEl.msRequestFullscreen();
    //        } else if (docEl.mozRequestFullScreen) {
    //            docEl.mozRequestFullScreen();
    //        }
    //    } else {
    //        if (doc.exitFullscreen) {
    //            doc.exitFullscreen();
    //        } else if (doc.webkitExitFullscreen) {
    //            doc.webkitExitFullscreen();
    //        } else if (doc.webkitCancelFullScreen) {
    //            doc.webkitCancelFullScreen();
    //        } else if (doc.msExitFullscreen) {
    //            doc.msExitFullscreen();
    //        } else if (doc.mozCancelFullScreen) {
    //            doc.mozCancelFullScreen();
    //        }
    //    }
    //}
    //$('.toggle_fullscreen').click(function() {
    //    toggleFullScreen();
    //});



});






