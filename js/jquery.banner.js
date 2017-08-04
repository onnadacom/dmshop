(function ($) {
$.fn.banner = function(o) {

    var this_id = $(this).attr("id");

    o = $.extend({
        num: 1,
        time: 3000,
        end: 1,
        type: 'show',
        speed: 0,
        auto: null
    }, o);

    $("#"+this_id+" .bg").css( { 'opacity' : '0.5' } );
    $("#"+this_id+" .bg").show();
    $("#"+this_id+" .list").show();

    if (o.type == 'show' || o.type == 'fadeIn') {

        $("#"+this_id+" .rolling_"+o.num).show();

    }

    $("#"+this_id+" li[name='"+o.num+"'] img").css( {"border" : "1px solid #ffffff"} );

    if (o.end == '1') {

        return false;

    }

    $("#"+this_id+" .btn_left").click(function() {

        if (o.num == '1') {

            o.num = o.end;

        } else {

            o.num = parseInt(o.num - 1);

        }

        box(o.num);

    });

    $("#"+this_id+" .btn_right").click(function() {

        if (o.num == o.end) {

            o.num = 1;

        } else {

            o.num = parseInt(o.num + 1);

        }

        box(o.num);

    });

    $("#"+this_id+" .list img").mouseover(function() {

        o.num = parseInt($(this).parent().attr("name"));

        box(o.num);

    });

    $("#"+this_id+" .list ul li.btn").mouseover(function() {

        o.num = parseInt($(this).attr("name"));

        box(o.num);

    });

    var box = function(n) {

        if (o.type == 'move_left') {

            $("#"+this_id+" .image div").stop().animate({"left": "-"+eval(this_id+"_ba_width_"+o.num)+"px"}, o.speed);

        }

        else if (o.type == 'move_top') {

            $("#"+this_id+" .image div").stop().animate({"top": "-"+eval(this_id+"_ba_height_"+o.num)+"px"}, o.speed);

        }

        else if (o.type == 'fadeIn') {

            $("#"+this_id+" .image div").hide();
            $("#"+this_id+" .rolling_"+n).fadeIn(o.speed);

        } else {

            $("#"+this_id+" .image div").hide();
            $("#"+this_id+" .rolling_"+n).show(o.speed);

        }

        $("#"+this_id+" .list img").css( {"border" : "1px solid #000000"} );
        $("#"+this_id+" li[name='"+n+"'] img").css( {"border" : "1px solid #ffffff"} );

        for (var i=1; i<=$("#"+this_id+" li.btn").length; i++) {

            $("#"+this_id+" li[name='"+[i]+"']").removeClass("btn"+[i]+"_hover");

        }

        $("#"+this_id+" li[name='"+n+"']").addClass("btn"+n+"_hover");

    };

    var play = function() {

        if (o.num == o.end) { o.num = 1; } else { o.num = o.num + 1; }

        box(o.num);

    };

    if (o.auto) {

        var interval;
        interval = setInterval(play, o.time);

        $(this).mouseover(function() { clearInterval(interval); }).mouseout(function(){ interval = setInterval(play, o.time); });

    }

};
})(jQuery);