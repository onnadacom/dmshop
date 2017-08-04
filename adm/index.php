<?php
include_once("./_dmshop.php");
include_once("{$shop['path']}/lib/serial.lib.php");
$top_id = "2";
$left_id = "1";
$menu_id = "100";
$shop['title'] = "관리자 홈";
include_once("./_top.php");

// file load check
shop_file_load_check();

// 미결제 기간만료 삭제
shop_order_delete_day();

// 자동수령확인
shop_order_receive_ok();

// 자동구매확정
shop_order_ok("", 1); // 수취확인일
shop_order_ok("", 2); // 교환승인일

$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .speed {line-height:39px; font-size:11px; color:#959595; font-family:dotum,돋움;}

.work .date {line-height:12px; font-size:10px; color:#b0b1b2; font-family:Tahoma,dotum,돋움;}
.work .title {text-align:center; line-height:13px; font-size:11px; color:#6f858d; font-family:dotum,돋움;}
.work .text {text-align:center; line-height:13px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.work p {height:24px; text-align:right; margin:0px; padding:0px;}
.work p a {display:block; text-decoration:none;}
.work .count1 {padding-right:7px; line-height:24px; font-size:11px; color:#656a78; font-family:dotum,돋움;}
.work .count0 {padding-right:7px; line-height:24px; font-size:11px; color:#b6b6b7; font-family:dotum,돋움;}
.count_bg {cursor:pointer;}
.count_bg div {clear:both;}
.count_bg a {display:block; height:95px;}

.work_count div.count1 {margin:0 7px 0 12px; text-align:center;}
.work_count div.count2 {margin:0 7px 0 7px; text-align:center;}
.work_count div.count3 {margin:0 12px 0 7px; text-align:center;}
.work_count div.number {margin-bottom:15px;}
.work_count div.number span {display:block; width:18px; height:25px; float:left;}
.work_count .number0 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px 0px;}
.work_count .number1 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -25px;}
.work_count .number2 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -50px;}
.work_count .number3 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -75px;}
.work_count .number4 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -100px;}
.work_count .number5 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -125px;}
.work_count .number6 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -150px;}
.work_count .number7 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -175px;}
.work_count .number8 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -200px;}
.work_count .number9 {background:url('<?=$shop['image_path']?>/adm/work_number.png') no-repeat 0px -225px;}

.support .tab_on {background:url('<?=$shop['image_path']?>/adm/support_on.gif') repeat-x;}
.support .tab_on_text {text-decoration:none; display:block; text-align:center; height:25px; font-weight:bold; line-height:25px; font-size:11px; color:#3a3d48; font-family:dotum,돋움;}
.support .tab_off {background:url('<?=$shop['image_path']?>/adm/support_off.gif') repeat-x;}
.support .tab_off_text {text-decoration:none; display:block; text-align:center; height:25px; font-weight:bold; line-height:25px; font-size:11px; color:#b0b1b2; font-family:dotum,돋움;}
.support .layer {display:none;}
#support1 a {width:80px;}
#support2 a {width:80px;}
#support3 a {width:80px;}
.support .layer a {line-height:24px; font-size:12px; color:#2f3743; font-family:dotum,돋움;}
.support .layer a .no {line-height:24px; font-size:11px; color:#ae6c6c; font-family:dotum,돋움;}
.support .layer a .category {line-height:24px; font-size:11px; color:#6ca6ae; font-family:dotum,돋움;}
.support .layer .date {line-height:24px; font-size:12px; color:#6e7384; font-family:dotum,돋움;}
.support_not {height:120px; text-align:center; font-size:11px; color:#a0a0a0; font-family:dotum,돋움;}

.calendar {height:161px; text-align:left;}
.calendar .today {font-weight:bold; line-height:14px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,돋움;}
.calendar .sun {font-weight:bold; line-height:14px; font-size:11px; color:#ed1c24; font-family:Tahoma,dotum,돋움;}
.calendar .day {font-weight:bold; line-height:14px; font-size:11px; color:#6e7384; font-family:Tahoma,dotum,돋움;}
.calendar .sat {font-weight:bold; line-height:14px; font-size:11px; color:#448ccb; font-family:Tahoma,dotum,돋움;}
.calendar .sun2 {font-weight:bold; line-height:14px; font-size:11px; color:#c3c8cd; font-family:Tahoma,dotum,돋움;}
.calendar .day2 {font-weight:bold; line-height:14px; font-size:11px; color:#c3c8cd; font-family:Tahoma,dotum,돋움;}
.calendar .sat2 {font-weight:bold; line-height:14px; font-size:11px; color:#c3c8cd; font-family:Tahoma,dotum,돋움;}
.calendar .regist {text-decoration:underline;}
.calendar .todaybg {background-color:#4b4d5c;}

.calendar_year p {width:8px; height:10px; float:left;}
.calendar_year0 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px 0px;}
.calendar_year1 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -10px;}
.calendar_year2 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -20px;}
.calendar_year3 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -30px;}
.calendar_year4 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -40px;}
.calendar_year5 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -50px;}
.calendar_year6 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -60px;}
.calendar_year7 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -70px;}
.calendar_year8 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -80px;}
.calendar_year9 {background:url('<?=$shop['image_path']?>/adm/calendar_mini_n.gif') no-repeat 0px -90px;}

.calendar_btn {margin-top:5px;}
.calendar_preg {display:block; text-decoration:none; width:13px; height:20px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_preg.gif') no-repeat 0px 0px;}
.calendar_preg:hover {display:block; text-decoration:none; width:13px; height:20px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_preg.gif') no-repeat 0px -20px;}
.calendar_next {display:block; text-decoration:none; width:13px; height:20px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_next.gif') no-repeat 0px 0px;}
.calendar_next:hover {display:block; text-decoration:none; width:13px; height:20px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_next.gif') no-repeat 0px -20px;}

.calendar_month01 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px 0px;}
.calendar_month02 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -30px;}
.calendar_month03 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -60px;}
.calendar_month04 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -90px;}
.calendar_month05 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -120px;}
.calendar_month06 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -150px;}
.calendar_month07 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -180px;}
.calendar_month08 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -210px;}
.calendar_month09 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -240px;}
.calendar_month10 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -270px;}
.calendar_month11 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -300px;}
.calendar_month12 {width:55px; height:30px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_month.gif') no-repeat 0px -330px;}

.calendar_write {display:block; text-decoration:none; width:59px; height:26px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_write.gif') no-repeat 0px 0px;}
.calendar_write:hover {display:block; text-decoration:none; width:59px; height:26px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_write.gif') no-repeat 0px -26px;}

#calendar_write .calendar_title {font-weight:bold; line-height:16px; font-size:14px; color:#ffffff; font-family:gulim,굴림;}
#calendar_write .calendar_title_bg {height:40px; background:url('<?=$shop['image_path']?>/adm/calendar_title_bg.gif') repeat-x;}
#calendar_write .calendar_list {clear:both; display:block; cursor:pointer; padding-bottom:5px; text-align:left;}
#calendar_write .calendar_list div {margin:0 5px;}
#calendar_write .calendar_list .calendar_time {font-weight:bold; line-height:13px; font-size:11px; color:#a3a3a3; font-family:dotum,돋움;}
#calendar_write .calendar_list .calendar_memo {line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}
#calendar_write .calendar_on {background-color:#d9fcff;}

#calendar_write .calendar_line {background:url('<?=$shop['image_path']?>/adm/calendar_line.gif') repeat-y 150px 0;}
#calendar_write .calendar_table .calendar_time {font-weight:bold; line-height:13px; font-size:11px; color:#474747; font-family:dotum,돋움;}
#calendar_write .calendar_table .calendar_memo {margin-left:20px; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}

#calendar_write {position:absolute; z-index:2; left:0px; top:0px; width:0px; height:0px; display:none;}
#calendar_write .calendar_box {width:500px; height:275px;}
#calendar_write .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
#calendar_write .select1 .selectBox-dropdown {width:17px; height:19px; border:1px solid #cbcbcb;}
#calendar_write .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.calendar_all {display:block; text-decoration:none; width:65px; height:36px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_all_list.gif') no-repeat 0px 0px;}
.calendar_all:hover {display:block; text-decoration:none; width:65px; height:36px; background:url('<?=$shop['image_path']?>/adm/calendar_mini_all_list.gif') no-repeat 0px -36px;}

.calendar_scroll {overflow:auto; width:224px; height:90px;}
.calendar_scroll .date {font-weight:bold; line-height:14px; font-size:11px; color:#f7d98a; font-family:dotum,돋움;}
.calendar_scroll .title {line-height:16px; font-size:11px; color:#b3b4b4; font-family:dotum,돋움;}

.calendar_scroll .jspHorizontalBar {background-color:#45474e;}
.calendar_scroll .jspTrack {background-color:#45474e;}
.calendar_scroll .jspDrag {border:1px solid #575a63; background-color:#3a3d48;}
.calendar_scroll .jspCorner {background-color:#45474e;}
.calendar_scroll .jspVerticalBar .jspArrowUp {background:url('<?=$shop['image_path']?>/adm/calendar_scroll-arrow-up.gif') no-repeat center center;}
.calendar_scroll .jspVerticalBar .jspArrowDown {background:url('<?=$shop['image_path']?>/adm/calendar_scroll-arrow-down.gif') no-repeat center center;}
/*
.calendar_scroll .jspHorizontalBar .jspArrowLeft {background:url('<?=$shop['image_path']?>/adm/calendar_scroll-arrow-left.gif') no-repeat center center;}
.calendar_scroll .jspHorizontalBar .jspArrowRight {background:url('<?=$shop['image_path']?>/adm/calendar_scroll-arrow-right.gif') no-repeat center center;}
*/

.board_scroll {overflow:auto; width:323px; height:83px;}
.board_scroll .title {text-align:center; line-height:24px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.board_scroll a {display:block; text-decoration:none; text-align:center; line-height:24px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.board_scroll .count {text-align:center;}
.board_scroll .on {text-decoration:underline; text-align:center; font-weight:bold; line-height:24px; font-size:11px; color:#3a3d48; font-family:dotum,돋움;}

.salebest .tab_off_text {cursor:pointer; padding-top:1px; text-align:center; line-height:13px; font-size:11px; color:#b0b1b2; font-family:dotum,돋움;}
.salebest .tab_on_text {cursor:pointer; padding-top:1px; text-align:center; font-weight:bold; line-height:13px; font-size:11px; color:#3a3d48; font-family:dotum,돋움;}
.salebest p {margin:0px; padding:0px;}
.salebest p nobr {display:block; overflow:hidden; width:100%; text-align:left; text-overflow:ellipsis;}
.salebest p nobr a {line-height:17px; font-size:11px; color:#2f3743; font-family:dotum,돋움;}
.salebest p.sale_count {text-align:left; line-height:16px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.salebest p.sale_count b {text-align:left; line-height:16px; font-size:11px; color:#1883e4; font-family:dotum,돋움;}
.salebest p.sale_hit {text-align:left; line-height:16px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.salebest p.sale_hit b {text-align:left; line-height:16px; font-size:11px; color:#027a8f; font-family:dotum,돋움;}

.ordertab {width:770px; height:35px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat;}
.ordertab a {display:block; height:35px;}
.ordertab1 {width:81px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -9px 0px;}
.ordertab1_on {width:81px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -9px -35px;}
.ordertab2 {width:65px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -90px 0px;}
.ordertab2_on {width:65px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -90px -35px;}
.ordertab3 {width:67px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -155px 0px;}
.ordertab3_on {width:67px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -155px -35px;}
.ordertab4 {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -222px 0px;}
.ordertab4_on {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -222px -35px;}
.ordertab5 {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -288px 0px;}
.ordertab5_on {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -288px -35px;}
.ordertab6 {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -354px 0px;}
.ordertab6_on {width:66px; background:url('<?=$shop['image_path']?>/adm/orderbox_tab.gif') no-repeat -354px -35px;}

.ordertab_layer .layer {display:none;}

.ordertab_layer .title {text-align:center; line-height:30px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.ordertab_not {height:240px; text-align:center; font-size:11px; color:#a0a0a0; font-family:dotum,돋움;}

.setting .text a {display:block; text-align:center; line-height:22px; font-size:11px; color:#777777; font-family:dotum,돋움;}
.setting .text a:hover {text-decoration:underline;}

.member_bg {width:236px; height:186px; background:url('<?=$shop['image_path']?>/adm/member_bg.gif') no-repeat;}
.member_bg p.count1 a, .member_bg p.count2 a, .member_bg p.count3 a
{
    display:block; text-decoration:none; text-align:right; font-weight:bold; font-size:18px; color:#000000; font-family:sans-serif;,gulim,굴림;
}
.member_bg p {margin:0px; padding:0px;}
.member_bg p.count1 a {padding:0 15px 0 0; line-height:39px; height:39px;}
.member_bg p.count2 a {padding:0 15px 0 0; line-height:34px; height:34px;}
.member_bg p.count3 a {padding:0 15px 0 0; line-height:34px; height:34px;}

#timer p {display:block; padding:0px; margin:0px;}
#timer .timer {width:24px; height:30px; background:url('<?=$shop['image_path']?>/adm/time_number.gif') no-repeat 0px 0px;}

.report .rtitle {line-height:26px; font-size:11px; color:#6e7384; font-family:dotum,돋움;}
.report .rmoney {text-align:right; font-weight:bold; line-height:26px; font-size:11px; color:#4b4d58; font-family:Tahoma,dotum,돋움;}
.report .line4 {height:1px; background:url('<?=$shop['image_path']?>/adm/line4.gif') repeat-x;}

.order_list .line5 {height:2px; background:url('<?=$shop['image_path']?>/adm/line5.gif') repeat-x;}
.order_list .title {line-height:25px; font-size:12px; color:#4b4d58; font-family:dotum,돋움;}
.order_list .count {text-align:right; font-weight:bold; line-height:26px; font-size:11px; color:#4b4d58; font-family:dotum,돋움;}
.order_list .type {cursor:pointer;}
.order_list .on {background-color:#eef5ff;}


.solutionby {text-align:center; font-weight:bold; font-size:11px; color:#b0b1b2; font-family:dotum,돋움;}
</style>

<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<script type="text/javascript">
<?
$user_name = "회원명";
$order_code = "주문번호";
$item_title = "상품명";
$item_code = "상품코드";
?>
var user_name = "<?=$user_name?>";
var order_code = "<?=$order_code?>";
var item_title = "<?=$item_title?>";
var item_code = "<?=$item_code?>";

function elementReset(eln, mode)
{

    var obj = eval("document.formSearch."+eln);

    if (mode == 'reset') {

        if (eln == 'user_name' && obj.value == user_name) { obj.value = ""; }
        if (eln == 'order_code' && obj.value == order_code) { obj.value = ""; }
        if (eln == 'item_title' && obj.value == item_title) { obj.value = ""; }
        if (eln == 'item_code' && obj.value == item_code) { obj.value = ""; }

    } else {

        if (eln == 'user_name' && obj.value == '') { obj.value = user_name; }
        if (eln == 'order_code' && obj.value == '') { obj.value = order_code; }
        if (eln == 'item_title' && obj.value == '') { obj.value = item_title; }
        if (eln == 'item_code' && obj.value == '') { obj.value = item_code; }

    }

}

function speedSearch()
{

    var thisF = document.formSearch;

    if (thisF.user_name.value && thisF.user_name.value != user_name) {

        thisF.f.value = "user_name";
        thisF.q.value = thisF.user_name.value;

        thisF.user_name.value = "";
        thisF.order_code.value = "";
        thisF.item_title.value = "";
        thisF.item_code.value = "";

        thisF.action = "./user_list.php";
        thisF.submit();
        return false;

    }

    if (thisF.order_code.value && thisF.order_code.value != order_code) {

        thisF.f.value = "order_code";
        thisF.q.value = thisF.order_code.value;

        thisF.user_name.value = "";
        thisF.order_code.value = "";
        thisF.item_title.value = "";
        thisF.item_code.value = "";

        thisF.action = "./order_all_list.php";
        thisF.submit();
        return false;

    }

    if (thisF.item_title.value && thisF.item_title.value != item_title) {

        thisF.f.value = "item_title";
        thisF.q.value = thisF.item_title.value;

        thisF.user_name.value = "";
        thisF.order_code.value = "";
        thisF.item_title.value = "";
        thisF.item_code.value = "";

        thisF.action = "./item_list.php";
        thisF.submit();
        return false;

    }

    if (thisF.item_code.value && thisF.item_code.value != item_code) {

        thisF.f.value = "item_code";
        thisF.q.value = thisF.item_code.value;

        thisF.user_name.value = "";
        thisF.order_code.value = "";
        thisF.item_title.value = "";
        thisF.item_code.value = "";

        thisF.action = "./item_list.php";
        thisF.submit();
        return false;

    }

    alert("검색어를 입력하세요.");
    return false;

}
</script>

<script type="text/javascript">
function submitCalender()
{

    var f = document.formCalender;

    if (f.date1.value == '') {

        alert("기간을 입력하세요.");
        f.date1.focus();
        return false;

    }

    if (f.date2.value == '') {

        alert("기간을 입력하세요.");
        f.date2.focus();
        return false;

    }

    $.post("./calendar_update.php", {"calendarView" : "<?=text($calendarView)?>", "m" : f.m.value, "id" : f.id.value, "date_etc1" : f.date_etc1.value, "date_etc2" : f.date_etc2.value, "viewDate" : f.viewDate.value, "date1" : f.date1.value, "h1" : f.h1.value, "i1" : f.i1.value, "date2" : f.date2.value, "h2" : f.h2.value, "i2" : f.i2.value, "title" : f.title.value}, function(data) {

        calendarLoad(f.date1.value);
        calendarClose();

    });

}
</script>

<script type="text/javascript">
function calendarView(day)
{

    $("#write_msg").html("등록");

    $("#m").val("");
    $("#id").val("");
    $("#title").val("");

    $("#h1").selectBox('value', '<?=date("H", $shop['server_time'])?>');
    $("#i1").selectBox('value', '<?=date("i", $shop['server_time'])?>');
    $("#h2").selectBox('value', '<?=date("H", $shop['server_time'])?>');
    $("#i2").selectBox('value', '<?=date("i", $shop['server_time'])?>');

    var viewDate = $("#viewDate").val();

    if (viewDate == '') {

        var win = $(window);
        var layer = $("#calendar_write");
        var box = $(".calendar_box");

        layer.show();

        var layerLeft = (win.scrollLeft() + (win.width() / 2)) - (box.width() / 2);
        var layerTop = (win.scrollTop() + (win.height() / 2)) - (box.height() / 2);

        layer.css( { 'left': layerLeft+'px', 'top': layerTop+'px'} );

        $("#date1").val(day);
        $("#date2").val(day);
        $("#viewDate").val(day);
        $("#title").focus();

    } else {

        $("#viewDate").val("");
        $("#calendar_write").hide();

    }

}

function calendarSave()
{

    submitCalender();

}

function calendarClose()
{

    var viewDate = $("#viewDate").val();

    $("#viewDate").val("");
    $("#calendar_write").hide();

}
</script>

<!-- calendar write start //-->
<div id="calendar_write" class="contents_box">
<div class="calendar_box" style="border:2px solid #3e424e; background-color:#f5f5f5;">
<form name="formCalender" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" id="m" name="m" value="" />
<input type="hidden" id="id" name="id" value="" />
<input type="hidden" id="date_etc1" name="date_etc1" value="<?=text($tmpYmdEtc1)?>" />
<input type="hidden" id="date_etc2" name="date_etc2" value="<?=text($tmpYmdEtc2)?>" />
<input type="hidden" id="viewDate" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="250">
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="calendar_title_bg">
    <td width="8"></td>
    <td class="calendar_title">:: 일정 <span id="write_msg">등록</span> ::</td>
    <td width="37"><a href="#" onclick="calendarClose(); return false;"><img src="<?=$shop['image_path']?>/adm/btn_calendar_close.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="100">
    <col width="1">
    <col width="20">
    <col width="">
</colgroup>
<tr height="52">
    <td class="subject">일시</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="date1" name="date1" value="" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:112px; border:1px solid #cbcbcb;" maxlength="10" /></td>
    <td width="10"></td>
    <td class="text1">~ 부터</td>
    <td width="10"></td>
    <td><input type="text" id="date2" name="date2" value="" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:112px; border:1px solid #cbcbcb;" maxlength="10" /></td>
    <td width="10"></td>
    <td class="text1">까지</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="52">
    <td class="subject">시각</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select1">
<select id="h1" name="h1" class="select">
<? for ($i=0; $i<=23; $i++) {

    $k = sprintf("%02d" , $i);
?>
    <option value="<?=$k?>"><?=$k?>시</option>
<? } ?>
</select>
    </td>
    <td width="2"></td>
    <td class="select1">
<select id="i1" name="i1" class="select">
<? for ($i=0; $i<=59; $i++) {

    $k = sprintf("%02d" , $i);
?>
    <option value="<?=$k?>"><?=$k?>분</option>
<? } ?>
</select>
    </td>
    <td width="10"></td>
    <td class="text1">~ 부터</td>
    <td width="10"></td>
    <td class="select1">
<select id="h2" name="h2" class="select">
<? for ($i=0; $i<=23; $i++) {

    $k = sprintf("%02d" , $i);
?>
    <option value="<?=$k?>"><?=$k?>시</option>
<? } ?>
</select>
    </td>
    <td width="2"></td>
    <td class="select1">
<select id="i2" name="i2" class="select">
<? for ($i=0; $i<=59; $i++) {

    $k = sprintf("%02d" , $i);
?>
    <option value="<?=$k?>"><?=$k?>분</option>
<? } ?>
</select>
    </td>
    <td width="10"></td>
    <td class="text1">까지</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="52">
    <td class="subject">내용</td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" id="title" name="title" value="" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:310px; border:1px solid #cbcbcb;" /></td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="calendarSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="calendarClose(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
    </td>
</tr>
</table>
</form>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#viewDate").val("");
    $("#calendar_write").draggable({ handle: '#calendar_write' });
    $("#calendar_write .select1 select").selectBox();
});
</script>
<!-- calendar write end //-->

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5"></td>
    <td width="770" bgcolor="#e6e6e6" valign="top">
<!-- left start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td></td></tr>
</table>

<!-- speed start //-->
<div style="background-color:#fcfcfc; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39">
    <td align="right">
<form method="get" name="formSearch" onSubmit="return speedSearch();" autocomplete="off">
<input type="hidden" name="f" value="" />
<input type="hidden" name="q" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="speed">관리자 빠른찾기</td>
    <td width="10"></td>
    <td><input type="text" name="user_name" value="<?=text($user_name)?>" onfocus="shopInfocus1_1(this); elementReset(this.name, 'reset');" onblur="shopOutfocus1_1(this); elementReset(this.name, 'add');" class="input3" style="width:94px;" /></td>
    <td width="2"></td>
    <td><input type="text" name="order_code" value="<?=text($order_code)?>" onfocus="shopInfocus1_1(this); elementReset(this.name, 'reset');" onblur="shopOutfocus1_1(this); elementReset(this.name, 'add');" class="input3" style="width:94px;" /></td>
    <td width="2"></td>
    <td><input type="text" name="item_title" value="<?=text($item_title)?>" onfocus="shopInfocus1_1(this); elementReset(this.name, 'reset');" onblur="shopOutfocus1_1(this); elementReset(this.name, 'add');" class="input3" style="width:94px;" /></td>
    <td width="2"></td>
    <td><input type="text" name="item_code" value="<?=text($item_code)?>" onfocus="shopInfocus1_1(this); elementReset(this.name, 'reset');" onblur="shopOutfocus1_1(this); elementReset(this.name, 'add');" class="input3" style="width:94px;" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
</tr>
</table>
</form>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>
<!-- speed end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<!-- work start //-->
<div style="height:230px; background-color:#ffffff; border:1px solid #c9c9c9;" class="work">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="110"><img src="<?=$shop['image_path']?>/adm/work_title.gif"></td>
    <td align="right" class="date">UP DATE : <?=date("Y.m.d", $shop['server_time']);?></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e6e6e6" class="none">&nbsp;</td></tr>
</table>

<div style="padding:0 2px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="work_count">
<tr height="95">
    <td width="145" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_bank_list.php?order_type=100');">
<div class="count1">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_bank(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name1.png" class="png"></div>
</div>
    </td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="1" bgcolor="#ffffff"></td>
    <td width="140" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_prepare_list.php?order_type=101');">
<div class="count2">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_prepare(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name2.png" class="png"></div>
</div>
    </td>
    <td width="1" bgcolor="#ffffff"></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="145" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_delivery_list.php?order_type=200');">
<div class="count3">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_delivery(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name3.png" class="png"></div>
</div>
    </td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#e6e6e6"></td></tr>
<tr><td colspan="7" height="1" bgcolor="#ffffff"></td></tr>
<tr height="95">
    <td width="145" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_cancel_list.php?order_type=300');">
<div class="count1">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_cancel(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name4.png" class="png"></div>
</div>
    </td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="1" bgcolor="#ffffff"></td>
    <td width="140" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_exchange_list.php?order_type=400');">
<div class="count2">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_exchange(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name5.png" class="png"></div>
</div>
    </td>
    <td width="1" bgcolor="#ffffff"></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="145" bgcolor="#fbfbfb" class="count_bg" onclick="shopMove('./order_refund_list.php?order_type=500');">
<div class="count3">
<div class="number">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><? $number = shop_count_order_refund(); if ($number) { echo preg_replace("/([0-9])/", "<span class='number$1'></span>", $number); } else { echo "<img src='".$shop['image_path']."/adm/work_number0.png' class='png'>"; } ?></td>
</tr>
</table>
</div>
<div><img src="<?=$shop['image_path']?>/adm/count_name6.png" class="png"></div>
</div>
    </td>
</tr>
</table>
</div>
</div>

<script type="text/javascript">
$(function() {


    $(".work_count .count_bg").mouseenter(function() {

        $(this).css({ 'background-color' : '#eeffff' });

    }).mouseleave(function(){

        $(this).css({ 'background-color' : '#fbfbfb' });

    });

});
</script>
<!-- work end //-->

<!-- support start //-->
<div style="margin-top:3px; height:178px; background-color:#ffffff; border:1px solid #c9c9c9;">
<div style="padding:10px 10px 0px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="support">
<tr>
    <td width="175" valign="top"><img src="<?=$shop['image_path']?>/adm/support_title.gif"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="support1" class="tab_title"><div><a href="./help_list.php">1:1문의</a></div></div></td>
    <td><div id="support2" class="tab_title"><div><a href="./qna_list.php">상품문의</a></div></div></td>
    <td><div id="support3" class="tab_title"><div><a href="./reply_list.php">상품평</a></div></div></td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="support">
<tr>
    <td valign="top">
<div id="support1_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$result = sql_query(" select * from $shop[help_table] where id = help_id order by datetime desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
<tr height="24">
    <td width="14" align="center"><img src="<?=$shop['image_path']?>/adm/dot.gif"></td>
    <td><a href="#" <? if ($row['help_count']) { echo "onclick=\"helpPopupView('".$row['id']."'); return false;\""; } else { echo "onclick=\"helpPopupWrite('".$row['id']."'); return false;\""; } ?> title="<?=text3($row['subject']);?>"><? if (!$row['help_count']) { ?><span class="no">[미답변]</span> <? } ?><?=filter3($row['subject'], 60);?> <span class="category"><?=shop_help_category($row['help_category']);?></span></a></td>
    <td width="40" class="date"><?=date("m-d", strtotime($row['datetime']));?></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td class="support_not">등록된 문의가 없습니다.</td></tr>
<? } ?>
</table>
</div>

<div id="support2_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$result = sql_query(" select * from $shop[qna_table] where id = qna_id order by datetime desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
<tr height="24">
    <td width="14" align="center"><img src="<?=$shop['image_path']?>/adm/dot.gif"></td>
    <td><a href="#" <? if ($row['qna_count']) { echo "onclick=\"qnaPopupView('".$row['id']."'); return false;\""; } else { echo "onclick=\"qnaPopupWrite('".$row['id']."'); return false;\""; } ?> title="<?=text3($row['qna_title']);?>"><? if (!$row['qna_count']) { ?><span class="no">[미답변]</span> <? } ?><?=filter3($row['qna_title'], 60);?> <span class="category"><?=$row['qna_category']?></span></a></td>
    <td width="40" class="date"><?=date("m-d", strtotime($row['datetime']));?></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td class="support_not">등록된 문의가 없습니다.</td></tr>
<? } ?>
</table>
</div>

<div id="support3_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$result = sql_query(" select * from $shop[reply_table] where id = reply_id order by datetime desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
<tr height="24">
    <td width="14" align="center"><img src="<?=$shop['image_path']?>/adm/dot.gif"></td>
    <td><a href="#" <? if ($row['reply_count']) { echo "onclick=\"replyPopupView('".$row['id']."'); return false;\""; } else { echo "onclick=\"replyPopupWrite('".$row['id']."'); return false;\""; } ?> title="<?=text3($row['reply_title']);?>"><? if (!$row['reply_count']) { ?><span class="no">[미답변]</span> <? } ?><?=filter3($row['reply_title'], 60);?> <span class="category"><?=shop_reply_score($row['reply_score']);?></span></a></td>
    <td width="40" class="date"><?=date("m-d", strtotime($row['datetime']));?></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td class="support_not">등록된 문의가 없습니다.</td></tr>
<? } ?>
</table>
</div>
    </td>
</tr>
</table>
</div>
</div>

<script type="text/javascript">
var support_on = function(id) {

    $("#"+id).removeClass("tab_off");
    $("#"+id+" div a").removeClass("tab_off_text");

    $("#"+id).addClass("tab_on");
    $("#"+id+" div a").addClass("tab_on_text");
    $("#"+id+"_layer").show();

};

var support_off = function() {

    $(".support .tab_title").removeClass("tab_on");
    $(".support .tab_title div a").removeClass("tab_on_text");

    $(".support .tab_title").addClass("tab_off");
    $(".support .tab_title div a").addClass("tab_off_text");
    $(".support .layer").hide();

};

$(function() {

    $(".support .tab_title").mouseover(function() {

        var this_id = $(this).attr("id");

        support_off();
        support_on(this_id);

    });

    support_off();
    support_on("support1");

});
</script>
<!-- support end //-->
    </td>
    <td width="5"></td>
    <td width="325" valign="top">
<!-- calendar start //-->
<div style="height:290px; background-color:#f8f8f8; border:1px solid #b6b8bb;">
<div id="calendar"></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"><img src="<?=$shop['image_path']?>/adm/calendar_mini_bg1.gif"></td>
    <td>
<div style="border:2px solid #30333d;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90">
    <td width="65" bgcolor="#3a445c">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/calendar_mini_today_list.gif"></td>
</tr>
<tr>
    <td><a href="./calendar.php" class="calendar_all"></a></td>
</tr>
</table>
    </td>
    <td bgcolor="#3a3d48"><div id="calendar_list"></div></td>
</tr>
</table>
</div>
    </td>
    <td width="15"><img src="<?=$shop['image_path']?>/adm/calendar_mini_bg2.gif"></td>
</tr>
</table>
</div>

<script type="text/javascript">
function calendarLoad(d)
{

    $.post('./calendar_mini.php', {'d' : d}, function(data) {

        $('#calendar').html(data);

    });

    $.post('./calendar_list.php', {'tmp' : ''}, function(data) {

        $('#calendar_list').html(data);

    });

}

calendarLoad();
</script>
<!-- calendar end //-->

<!-- board start //-->
<div style="margin-top:3px; height:118px; background-color:#ffffff; border:1px solid #b6b8bb;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/board_title.gif"></td>
</tr>
</table>

<div style="border-top:1px solid #e6e6e6;">
<div class="board_scroll">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td bgcolor="#f7f7f7" class="title">게시판명</td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="title">오늘</td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="title">어제</td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="title">그제</td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#e6e6e6"></td></tr>
<?
$result = sql_query(" select * from $shop[board_table] $sql_search order by bbs_position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $cnt1 = sql_fetch(" select count(*) as cnt from {$shop['article_table']}{$row['bbs_id']} where substring(datetime,1,10) = '".$shop['time_ymd']."' ");
    $cnt2 = sql_fetch(" select count(*) as cnt from {$shop['article_table']}{$row['bbs_id']} where substring(datetime,1,10) = '".date("Y-m-d", $shop['server_time'] - (1 * 86400))."' ");
    $cnt3 = sql_fetch(" select count(*) as cnt from {$shop['article_table']}{$row['bbs_id']} where substring(datetime,1,10) = '".date("Y-m-d", $shop['server_time'] - (2 * 86400))."' ");
?>
<tr height="24">
    <td bgcolor="#f7f7f7" class="title"><a href="./board_write.php?m=u&bbs_id=<?=$row['bbs_id']?>"><?=$row['bbs_title']?></a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="count"><a href="<?=$shop['path']?>/board.php?bbs_id=<?=$row['bbs_id']?>"><?=number_format($cnt1['cnt']);?></a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="count"><a href="<?=$shop['path']?>/board.php?bbs_id=<?=$row['bbs_id']?>"><?=number_format($cnt2['cnt']);?></a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td width="65" class="count"><a href="<?=$shop['path']?>/board.php?bbs_id=<?=$row['bbs_id']?>"><?=number_format($cnt3['cnt']);?></a></td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#e6e6e6"></td></tr>
<? } ?>
</table>
</div>
</div>
</div>

<script type="text/javascript">
$(function() {
    $('.board_scroll').jScrollPane({ showArrows: true, verticalGutter: 0, horizontalGutter: 0 });
});
</script>

<script type="text/javascript">
$(function() {

    $(".board_scroll .count a").mouseenter(function() {

        $(this).addClass('on');

    }).mouseleave(function(){

        $(this).removeClass('on');

    });

});
</script>
<!-- board end //-->
    </td>
</tr>
</table>

<!-- sale start //-->
<div style="margin-top:3px; background-color:#ffffff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="salebest">
<tr height="148">
    <td width="148" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/sale_title.gif"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:87px;">
<tr>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" style="border:1px solid #c9c9c9;">
<tr>
    <td width="34" id="salebest1" class="tab_title">주간</td>
    <td width="1" bgcolor="#c9c9c9"></td>
    <td width="34" id="salebest2" class="tab_title">월간</td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td width="5"><img src="<?=$shop['image_path']?>/adm/sale_bg.gif"></td>
    <td width="3" bgcolor="#f8f8f8"></td>
    <td valign="top" bgcolor="#f8f8f8">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div id="salebest1_layer" class="layer">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
$result = sql_query("  select *, sum(order_limit) as total_count from $shop[order_table] where order_datetime >= '".date("Y-m-d H:i:s", $shop['server_time'] - (7 * 86400))."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' group by item_id order by total_count desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_item = shop_item($row['item_id']);

    $thumb = shop_item_thumb($row['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $shop['image_path']."/adm/noimage.gif"; }
?>
<? if ($i > '0') { ?>
    <td width="1" bgcolor="#e1e1e1"></td>
<? } ?>
    <td width="120" valign="top">
<table width="80" border="0" cellspacing="0" cellpadding="0" class="auto" style="table-layout:fixed;">
<tr>
    <td>
<div style="margin:0 auto 7px auto; width:50px; height:50px; border:2px solid #e4e4e4;"><a href="<?=$shop['path']?>/item.php?id=<?=text($dmshop_item['item_code'])?>"><img src="<?=$thumb?>" border="0"></a></div>
<p><nobr title="<?=text3($dmshop_item['item_title']);?>"><a href="<?=$shop['path']?>/item.php?id=<?=text($dmshop_item['item_code'])?>"><?=text($dmshop_item['item_title'])?></a></nobr></p>
<p class="sale_count">판매수량 : <b><?=number_format($row['total_count']);?></b></p>
<p class="sale_hit">조회수 : <b><?=number_format($dmshop_item['item_hit']);?></b></p>
    </td>
</tr>
</table>
    </td>
<? } ?>
</tr>
</table>
</div>

<div id="salebest2_layer" class="layer">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
$result = sql_query("  select *, sum(order_limit) as total_count from $shop[order_table] where order_datetime >= '".date("Y-m-d H:i:s", $shop['server_time'] - (30 * 86400))."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' group by item_id order by total_count desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_item = shop_item($row['item_id']);

    $thumb = shop_item_thumb($row['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $shop['image_path']."/adm/noimage.gif"; }
?>
<? if ($i > '0') { ?>
    <td width="1" bgcolor="#e1e1e1"></td>
<? } ?>
    <td width="120" valign="top">
<table width="80" border="0" cellspacing="0" cellpadding="0" class="auto" style="table-layout:fixed;">
<tr>
    <td>
<div style="margin:0 auto 7px auto; width:50px; height:50px; border:2px solid #e4e4e4;"><a href="<?=$shop['path']?>/item.php?id=<?=text($dmshop_item['item_code'])?>"><img src="<?=$thumb?>" border="0"></a></div>
<p><nobr title="<?=text3($dmshop_item['item_title']);?>"><a href="<?=$shop['path']?>/item.php?id=<?=text($dmshop_item['item_code'])?>"><?=text($dmshop_item['item_title'])?></a></nobr></p>
<p class="sale_count">판매수량 : <b><?=number_format($row['total_count']);?></b></p>
<p class="sale_hit">조회수 : <b><?=number_format($dmshop_item['item_hit']);?></b></p>
    </td>
</tr>
</table>
    </td>
<? } ?>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<script type="text/javascript">
var salebest_on = function(id) {

    $("#"+id).removeClass("tab_off_text");
    $("#"+id).addClass("tab_on_text");
    $("#"+id+"_layer").show();

};

var salebest_off = function() {

    $(".salebest .tab_title").removeClass("tab_on_text");
    $(".salebest .tab_title").addClass("tab_off_text");
    $(".salebest .layer").hide();

};

$(function() {

    $(".salebest .tab_title").click(function() {

        var this_id = $(this).attr("id");

        salebest_off();
        salebest_on(this_id);

    });

    salebest_off();
    salebest_on("salebest1");

});
</script>
<!-- salebest end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="3"></td></tr>
</table>

<!-- orderbox start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordertab">
<tr>
    <td width="9"></td>
    <td class="ordertab1" name="ordertab1"><a href="./order_bank_list.php?order_type=100" class="tablink"></a></td>
    <td class="ordertab2" name="ordertab2"><a href="./order_prepare_list.php?order_type=101" class="tablink"></a></td>
    <td class="ordertab3" name="ordertab3"><a href="./order_delivery_list.php?order_type=200" class="tablink"></a></td>
    <td class="ordertab4" name="ordertab4"><a href="./order_cancel_list.php?order_type=300" class="tablink"></a></td>
    <td class="ordertab5" name="ordertab5"><a href="./order_exchange_list.php?order_type=400" class="tablink"></a></td>
    <td class="ordertab6" name="ordertab6"><a href="./order_refund_list.php?order_type=500" class="tablink"></a></td>
    <td class="none">&nbsp;</td>
    <td width="55"><span id="orderbox_more"><a href="./order_bank_list.php?order_type=100"><img src="<?=$shop['image_path']?>/adm/orderbox_more.gif" border="0"></a></span></td>
</tr>
</table>

<div class="ordertab_layer">

<div id="ordertab1_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">무통장 입금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab1_load"></div>
</div>
</div>

<div id="ordertab2_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">주문금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab2_load"></div>
</div>
</div>

<div id="ordertab3_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">주문금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab3_load"></div>
</div>
</div>

<div id="ordertab4_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">주문금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab4_load"></div>
</div>
</div>

<div id="ordertab5_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">주문금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab5_load"></div>
</div>
</div>

<div id="ordertab6_layer" class="layer">
<div style="height:257px; background-color:#fff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="12" height="1" bgcolor="#ffffff"></td></tr>
<tr height="30" bgcolor="#fbfbfb">
    <td width="90" class="title">주문일시</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="100" class="title">주문번호</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="80" class="title">주문자명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td class="title">주문상품</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">주문금액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/line3.gif"></td>
    <td width="90" class="title">개별설정</td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#e6e6e6"></td></tr>
</table>
<div id="ordertab6_load"></div>
</div>
</div>

</div>

<script type="text/javascript">
var ordertab_on = function(id) {

    $(".ordertab1").removeClass("ordertab1_on");
    $(".ordertab2").removeClass("ordertab2_on");
    $(".ordertab3").removeClass("ordertab3_on");
    $(".ordertab4").removeClass("ordertab4_on");
    $(".ordertab5").removeClass("ordertab5_on");
    $(".ordertab6").removeClass("ordertab6_on");

    $("."+id).addClass(id+"_on");
    $("#"+id+"_layer").show();

    $.post('./'+id+'_load.php', {'tmp' : ''}, function(data) {

        $('#'+id+'_load').html(data);

    });

};

var ordertab_off = function() {

    $(".ordertab_layer .layer").hide();

};

$(function() {

    $(".ordertab a.tablink").click(function() {

        var this_id = $(this).parent().attr("name");

        if (this_id) {

            ordertab_off();
            ordertab_on(this_id);

            $("#orderbox_more a").attr("href", $(this).attr("href"));

        }

        return false;

    });

    ordertab_off();
    ordertab_on("ordertab1");

});
</script>
<!-- orderbox end //-->

<!-- setting start //-->
<div style="margin-top:3px; background-color:#ffffff; border:1px solid #c9c9c9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr bgcolor="#e6e6e6">
    <td><img src="<?=$shop['image_path']?>/adm/setting_title.gif"></td>
</tr>
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<div style="padding:12px 14px; background-color:#f8f8f8;">
<table border="0" cellspacing="0" cellpadding="0" class="setting">
<tr>
    <td width="240" valign="top">
<div style="border:1px solid #e6e6e6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#serial_key">솔루션 정품인증</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#serial_key"><? if (shop_serial_check()) { echo "<font color='#179847'>인증완료</font>"; } else { echo "<font color='#ed1c24'>인증전</font>"; } ?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_signup.php#user_real_check">가입시 실명인증</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_signup.php#user_real_check"><? if ($dmshop_signup['user_real_check'] == '1') { echo "주민등록번호"; } else if ($dmshop_signup['user_real_check'] == '2') { echo "이메일"; } else if ($dmshop_signup['user_real_check'] == '3') { echo "휴대폰"; } else { echo "사용안함"; } ?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#order_guest_use">비회원 주문</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#order_guest_use"><? if ($dmshop['order_guest_use']) { echo "사용"; } else { echo "사용안함"; } ?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_pg.php#order_pg">전자결제 연동</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_pg.php#order_pg"><?
if ($dmshop['order_pg'] == '1') {

    if ($dmshop['ini_site_code']) { echo "YES"; } else { echo "NO"; }

}
else if ($dmshop['order_pg'] == '2') {

    if ($dmshop['ags_site_code']) { echo "YES"; } else { echo "NO"; }

}
else if ($dmshop['order_pg'] == '3') {

    if ($dmshop['kcp_site_code']) { echo "YES"; } else { echo "NO"; }

}
else if ($dmshop['order_pg'] == '4') {

    if ($dmshop['kicc_site_code']) { echo "YES"; } else { echo "NO"; }

}

echo " / ".shop_pg_name($dmshop['order_pg']);
?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_sms.php#sms_type">SMS문자 연동</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_sms.php#sms_type"><?
// 아이코드 체크
$tmp_sms = array();
if ($dmshop['icode_id'] && $dmshop['icode_pw']) {

    $tmp_sms = shop_sms_sock("http://www.icodekorea.com/res/userinfo.php?userid=".text($dmshop['icode_id'])."&userpw=".text($dmshop['icode_pw'])."");
    $tmp_sms = explode(';', $tmp_sms);
    $icode = array('code' => $tmp_sms[0], 'coin' => $tmp_sms[1], 'gpay' => $tmp_sms[2], 'payment' => $tmp_sms[3]);

}

if ($tmp_sms[0]) { echo "YES / ".number_format($tmp_sms[1]); } else { echo "NO"; }
?></a></td>
</tr>
</table>
</div>
    </td>
    <td width="10"></td>
    <td width="240" valign="top">
<div style="border:1px solid #e6e6e6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_delivery.php#parcel_id">기본 택배회사</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_delivery.php#parcel_id"><?=text($dmshop['parcel_name'])?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#delivery_money">기본 배송비</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#delivery_money"><?=number_format($dmshop['delivery_money']);?> 원</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#delivery_money_free">무료 배송조건</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#delivery_money_free"><?=number_format($dmshop['delivery_money_free']);?> 원</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#payment_type6">적립금 기능</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#payment_type6"><? if ($dmshop['payment_type6']) { echo "사용"; } else { echo "사용안함"; } ?></a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#order_cash_min">적립금 사용조건</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#order_cash_min"><?=number_format($dmshop['order_cash_min']);?> 원+ 보유시</a></td>
</tr>
</table>
</div>
    </td>
    <td width="10"></td>
    <td width="240" valign="top">
<div style="border:1px solid #e6e6e6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#order_receive_day">자동상품 수령기간</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#order_receive_day"><?=text($dmshop['order_receive_day'])?> 일</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#order_exchange_day">자동구매 확정기간</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#order_exchange_day"><?=text($dmshop['order_exchange_day'])?> 일</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#cart_day">장바구니 보관기간</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#cart_day"><?=text($dmshop['cart_day'])?> 일</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_dmshop.php#view_day">최근본상품 유지기간</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_dmshop.php#view_day"><?=text($dmshop['view_day'])?> 일</a></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e6e6e6"></td></tr>
<tr height="22">
    <td width="120" bgcolor="#f8f8f8" class="text"><a href="./config_pg.php#order_bank_day">무통장/가상입금기간</a></td>
    <td width="1" bgcolor="#e6e6e6"></td>
    <td bgcolor="#ffffff" class="text"><a href="./config_pg.php#order_bank_day"><?=text($dmshop['order_bank_day'])?> 일 / <?=text($dmshop['order_pgbank_day'])?> 일</a></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- setting end //-->

<div style="margin-top:3px; background-color:#e6e6e6; border:1px solid #dcdcdc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25">
    <td class="solutionby">2012. Solution by. <b>DMSHOP</b></td>
</tr>
</table>
</div>

<div style='height:48px;'></div>
<!-- left end //-->
    </td>
    <td width="5"></td>
    <td width="1" bgcolor="#b0b4bd"></td>
    <td width="1" bgcolor="#caccd0"></td>
    <td width="236" bgcolor="#bcc0c9" valign="top">
<!-- right start //-->
<!-- report start //-->
<div class="member_bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="43">
    <td align="right">
<div id="timer">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><p id="time_h1" class="timer"></p></td>
    <td><p id="time_h2" class="timer"></p></td>
    <td><img src="<?=$shop['image_path']?>/adm/time_second.gif"></td>
    <td><p id="time_i1" class="timer"></p></td>
    <td><p id="time_i2" class="timer"></p></td>
</tr>
</table>
</div>
    </td>
    <td width="10"></td>
</tr>
</table>

<?
$strYear = date("Y", $shop['server_time']);
$strMonth = date("m", $shop['server_time']) - 1;
$strDay = date("d", $shop['server_time']);
$strHour = date("H", $shop['server_time']);
$strMin = date("i", $shop['server_time']);
$strSec = date("s", $shop['server_time']);
?>

<script type="text/javascript">
var strYear = "<?=$strYear?>";
var strMonth = "<?=$strMonth?>";
var strDay = "<?=$strDay?>";
var strHour = "<?=$strHour?>";
var strMin = "<?=$strMin?>";
var strSec = "<?=$strSec?>";
var cnt = 0;

function timerLoad(obj, mode, num)
{

    var str = num.toString();

    if (mode == '1') {

        var timerN = str.substring(0,1);

    } else {

        var timerN = str.substring(1,2);

    }

    if (timerN == '0') {

        $('#'+obj).css('background-position','0px 0px');

    } else {

        $('#'+obj).css('background-position','0px -'+parseInt(timerN * 30)+'px');

    }

}

function startTime()
{

    var date = new Date(strYear, strMonth, strDay, strHour, strMin, strSec);

    date.setSeconds(date.getSeconds() + cnt);

    var Year = date.getFullYear();
    var Month = date.getMonth() + 1;
    var Day = date.getDate();
    var Hour = date.getHours();
    var Min = date.getMinutes();
    var Sec = date.getSeconds();

    if (Month < 10) {

        var Month = "0"+date.getMonth() + 1;

    } else {

        var Month = date.getMonth() + 1;

    }

    if (Day < 10) {

        var Day = "0"+date.getDate();

    } else {

        var Day = date.getDate();

    }

    if (Hour < 10) {

        var Hour = "0"+date.getHours();

    } else {

        var Hour = date.getHours();

    }

    if (Min < 10) {

        var Min = "0"+date.getMinutes();

    } else {

        var Min = date.getMinutes();

    }

    if (Sec < 10) {

        var Sec = "0"+date.getSeconds();

    } else {

        var Sec = date.getSeconds();

    }

    timerLoad("time_h1", "1", Hour);
    timerLoad("time_h2", "2", Hour);

    timerLoad("time_i1", "1", Min);
    timerLoad("time_i2", "2", Min);

    //timerLoad("time_s1", "1", Sec);
    //timerLoad("time_s2", "2", Sec);

    cnt++;

    setTimeout("startTime();", 1000);

}

startTime();
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="35">
    <td></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39">
    <td><p class="count1"><a href="./reporting_visit.php?reporting=1"><?=number_format(shop_count_visit_today());?></a></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="34">
    <td><p class="count2"><a href="./user_list.php?date1=<?=$shop['time_ymd']?>&date2=<?=$shop['time_ymd']?>"><?=number_format(shop_count_user_today());?></a></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="34">
    <td><p class="count3"><a href="./user_list.php?date1=2012-01-01&date2=<?=$shop['time_ymd']?>"><?=number_format(shop_count_user());?></a></p></td>
</tr>
</table>
</div>

<?
$order1 = sql_fetch(" select sum(order_pay_money) as total_money from $shop[order_table] where substring(order_datetime,1,10) = '".$shop['time_ymd']."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_number = '0' ");
$order2 = sql_fetch(" select sum(order_pay_money) as total_money from $shop[order_table] where substring(order_datetime,1,10) = '".date("Y-m-d", $shop['server_time'] - (1 * 86400))."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_number = '0' ");
$order3 = sql_fetch(" select sum(order_pay_money) as total_money from $shop[order_table] where substring(order_datetime,1,10) = '".date("Y-m-d", $shop['server_time'] - (2 * 86400))."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_number = '0' ");
$order4 = sql_fetch(" select sum(order_pay_money) as total_money from $shop[order_table] where substring(order_datetime,1,7) = '".date("Y-m", $shop['server_time'])."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_number = '0' ");
?>
<div style="padding:10px 10px 0 10px;">
<div style="border:5px solid #c9ced6; background-color:#f7f8fa;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="report">
<tr height="26" onclick="shopMove('./reporting_sales.php?reporting=2&date1=<?=$shop['time_ymd']?>&date2=<?=$shop['time_ymd']?>');" class="pointer">
    <td width="10"></td>
    <td width="75" class="rtitle"><?=date("d", $shop['server_time']);?>일 결제금액</td>
    <td class="rmoney"><?=number_format($order1['total_money']);?></td>
    <td width="10"></td>
</tr>
<tr><td width="8"></td><td colspan="2" class="line4"></td><td width="8"></td></tr>
<tr height="26" onclick="shopMove('./reporting_sales.php?reporting=2&date1=<?=date("Y-m-d", $shop['server_time'] - (1 * 86400));?>&date2=<?=date("Y-m-d", $shop['server_time'] - (1 * 86400));?>');" class="pointer">
    <td width="10"></td>
    <td width="75" class="rtitle"><?=date("d", $shop['server_time'] - (1 * 86400));?>일 결제금액</td>
    <td class="rmoney"><?=number_format($order2['total_money']);?></td>
    <td width="10"></td>
</tr>
<tr><td width="8"></td><td colspan="2" class="line4"></td><td width="8"></td></tr>
<tr height="26" onclick="shopMove('./reporting_sales.php?reporting=2&date1=<?=date("Y-m-d", $shop['server_time'] - (2 * 86400));?>&date2=<?=date("Y-m-d", $shop['server_time'] - (2 * 86400));?>');" class="pointer">
    <td width="10"></td>
    <td width="75" class="rtitle"><?=date("d", $shop['server_time'] - (2 * 86400));?>일 결제금액</td>
    <td class="rmoney"><?=number_format($order3['total_money']);?></td>
    <td width="10"></td>
</tr>
<tr><td width="8"></td><td colspan="2" class="line4"></td><td width="8"></td></tr>
<tr height="26" onclick="shopMove('./reporting_sales.php?reporting=2&date1=<?=date("Y-m", $shop['server_time']);?>-01&date2=<?=$shop['time_ymd']?>');" class="pointer" bgcolor="#eef5ff">
    <td width="10"></td>
    <td width="75" class="rtitle">이달의 합계</td>
    <td class="rmoney"><?=number_format($order4['total_money']);?></td>
    <td width="10"></td>
</tr>
</table>
</div>
</div>
<!-- report end //-->

<!-- order start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/right_line.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#caccd0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/order_title1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#a4a8b0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#caccd0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#c9ced6">
<tr height="6"><td></td></tr>
</table>

<div style="padding:0px 10px 0 10px; background-color:#c9ced6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?page=1&order_type=100');">
    <td width="15"></td>
    <td width="50" class="title">결제전</td>
    <td class="count"><? $count = shop_count_order_wait(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?order_type=101');">
    <td width="15"></td>
    <td width="50" class="title">결제완료</td>
    <td class="count"><? $count = shop_count_order_prepare(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?order_type=200');">
    <td width="15"></td>
    <td width="50" class="title">배송준비</td>
    <td class="count"><? $count = shop_count_order_delivery(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?order_type=201');">
    <td width="15"></td>
    <td width="50" class="title">배송중</td>
    <td class="count"><? $count = shop_count_order_delivery1(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?order_type=202');">
    <td width="15"></td>
    <td width="50" class="title">상품수령</td>
    <td class="count"><? $count = shop_count_order_delivery2(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_all_list.php?order_type=900');">
    <td width="15"></td>
    <td width="50" class="title">구매완료</td>
    <td class="count"><? $count = shop_count_order_ok(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#92969e" class="none">&nbsp;</td></tr>
</table>
<!-- order end //-->

<!-- order start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/right_line.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#caccd0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/order_title2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#caccd0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#c9ced6">
<tr height="6"><td></td></tr>
</table>

<div style="padding:0px 10px 0 10px; background-color:#c9ced6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<tr height="25" class="type" onclick="shopMove('./order_cancel_list.php?order_type=300');">
    <td width="15"></td>
    <td width="50" class="title">취소접수</td>
    <td class="count"><? $count = shop_count_order_cancel(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_cancel_list.php?order_type=301');">
    <td width="15"></td>
    <td width="50" class="title">취소완료</td>
    <td class="count"><? $count = shop_count_order_cancel_ok(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_exchange_list.php?order_type=400');">
    <td width="15"></td>
    <td width="50" class="title">교환접수</td>
    <td class="count"><? $count = shop_count_order_exchange(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_exchange_list.php?order_type=401');">
    <td width="15"></td>
    <td width="50" class="title">교환중</td>
    <td class="count"><? $count = shop_count_order_exchange_ok(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_refund_list.php?order_type=500');">
    <td width="15"></td>
    <td width="50" class="title">환불접수</td>
    <td class="count"><? $count = shop_count_order_refund(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
<tr><td colspan="4" class="line5"></td></tr>
<tr height="25" class="type" onclick="shopMove('./order_refund_list.php?order_type=501');">
    <td width="15"></td>
    <td width="50" class="title">환불완료</td>
    <td class="count"><? $count = shop_count_order_refund_ok(); if ($count) { echo number_format($count)." 건"; } else { echo "<font color='#e7ebf3'>없음</font>"; } ?></td>
    <td width="15"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/right_line2.gif"></td>
</tr>
</table>

<script type="text/javascript">
$(function() {

    $(".order_list .type").mouseenter(function() {

        $(this).addClass('on');

    }).mouseleave(function(){

        $(this).removeClass('on');

    });

});
</script>
<!-- order end //-->

<!-- right end //-->
    </td>
    <td width="1" bgcolor="#caccd0"></td>
    <td width="1" bgcolor="#8e9299"></td>
    <td bgcolor="#c6c9ce" class="none">&nbsp;</td>
</tr>
</table>
</div>

<?
include_once("./_bottom.php");
?>