var scrollboxslideUp = 300;
var scrollboxslideDown = 300;

$(function() {

    $("#scrollbox .data1_title").click(function () {

        scrollboxDataClose();

        if ($("#scrollbox_data1").is(":hidden")) {

            scrollboxDataLoad("1", "1", "ok");

        } else {

            $("#scrollbox_data1").slideUp(scrollboxslideUp);

        }

    });

    $("#scrollbox .data2_title").click(function () {

        scrollboxDataClose();

        if ($("#scrollbox_data2").is(":hidden")) {

            scrollboxDataLoad("2", "1", "ok");

        } else {

            $("#scrollbox_data2").slideUp(scrollboxslideUp);

        }

    });

    $("#scrollbox .data3_title").click(function () {

        scrollboxDataClose();

        if ($("#scrollbox_data3").is(":hidden")) {

            scrollboxDataLoad("3", "1", "ok");

        } else {

            $("#scrollbox_data3").slideUp(scrollboxslideUp);

        }

    });

    $("#scrollbox .top").click(function () {

        $('html,body').animate({scrollTop: 0}, 700);

    });

    $(window).resize(function() {

        scrollbox();

    });

    $(document).ready(function() {

        var scrollbox_tab = $.cookie('scrollbox_tab');

        if (scrollbox_tab) {

            var scrollbox_page = $.cookie('scrollbox_page'+scrollbox_tab);

            if (scrollbox_page) {

                scrollboxDataLoad(scrollbox_tab, scrollbox_page, "load");

            } else {

                scrollboxDataLoad(scrollbox_tab, "1", "load");

            }

        } else {

            scrollboxDataLoad("1", "1", "load");

        }

        scrollbox();

    });

});

var scrollbox = function() {

    var layer = $(".layout_contents");
    var scrollbox = $("#scrollbox");

    var quickLeft = layer.width() + layer.offset().left + 18;
    //var quickTop = parseInt(layer.offset().top + scrollbox_top);
    var quickTop = parseInt(scrollbox_top);

    scrollbox.css( {'left': quickLeft+'px', 'top': quickTop+'px', 'display': 'inline'} );

};

var scrollboxDataLoad = function(id, page, slide) {

    if (page == '') {

        var page = 1;

    }

    $.cookie('scrollbox_tab', id, { expires: 7, path: '/' });
    $.cookie('scrollbox_page'+id, page, { expires: 7, path: '/' });

    $.post(dmshop_scrollbox_path+"/scrollbox_data"+id+".php", {"page" : page}, function(data) {

        $("#scrollbox_data"+id).html(data);

    });

    if (slide == 'load') {

        $("#scrollbox_data"+id).slideDown(0);

    }

    if (slide == 'ok') {

        $("#scrollbox_data"+id).slideDown(scrollboxslideDown);

    }

};

var scrollboxDataClose = function() {

    if ($("#scrollbox_data1").is(":hidden") == false) {

        $("#scrollbox_data1").slideUp(scrollboxslideUp);

    }

    if ($("#scrollbox_data2").is(":hidden") == false) {

        $("#scrollbox_data2").slideUp(scrollboxslideUp);

    }

    if ($("#scrollbox_data3").is(":hidden") == false) {

        $("#scrollbox_data3").slideUp(scrollboxslideUp);

    }

}

var scrollboxImageOver = function() {

    $("#scrollbox .image img").mouseover(function() {

        $(this).addClass("on");

    }).mouseout(function(){

        $(this).removeClass("on");

    });

}

var scrollboxItemViewDelete = function(item_view_id, page) {

    $.post(dmshop_scrollbox_path+"/item_view_delete.php", {"item_view_id" : item_view_id, "page" : page}, function(data) {

        $("#scrollbox_data").html(data);

    });

}