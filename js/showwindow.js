(function ($) {
$.fn.showwindow = function(o) {

    var this_id = $(this).attr("id");

    o = $.extend({
        num: 1,
        time: 3000,
        end: 1,
        type: 'show',
        speed: 0,
        auto: null
    }, o);

    $("#"+this_id+" .rolling_"+o.num).show();

    if (o.end == '1') {

        return false;

    }

    var box = function() {

        if (o.num == o.end) { o.num = 1; } else { o.num = o.num + 1; }

        $("#"+this_id+" .box").hide();

        if (o.type == 'fadeIn') {

            $("#"+this_id+" .rolling_"+o.num).fadeIn(o.speed);

        } else {

            $("#"+this_id+" .rolling_"+o.num).show(o.speed);

        }

    };

    if (o.auto) {

        var interval;

        interval = setInterval(box, o.time);

        $(this).mouseover(function() { clearInterval(interval); }).mouseout(function(){ interval = setInterval(box, o.time); });

    }

};
})(jQuery);