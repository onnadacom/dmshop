<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($reporting) { $reporting = preg_match("/^[0-9]+$/", $reporting) ? $reporting : ""; }

$top_id = "2";
$left_id = "7";

if (!$reporting) {

    $reporting = 1;

}

if ($reporting == '1') {

    $menu_id = "400";
    $shop['title'] = "주문";

}

else if ($reporting == '2') {

    $menu_id = "401";
    $shop['title'] = "성별";

}

else if ($reporting == '3') {

    $menu_id = "402";
    $shop['title'] = "연령";

}

else if ($reporting == '4') {

    $menu_id = "403";
    $shop['title'] = "거주지";

}

else if ($reporting == '5') {

    $menu_id = "404";
    $shop['title'] = "추천인";

} else {

    alert("지정된 타입이 없습니다.");

}

include_once("./_top.php");

/*------------------------------
    ## 날짜 ##
------------------------------*/

// 어제
$search_date1 = date("Y-m-d", $shop['server_time'] - (1 * 86400));

// 일주일
$search_date2 = date("Y-m-d", $shop['server_time'] - (7 * 86400));

// 이번달 1일
$search_date3 = date("Y-m-d", strtotime(date("Y-m", $shop['server_time'])."-01"));

// 지난달 1일
$search_date4 = date("Y-m-d", strtotime(date("Y-m", strtotime(date("Y-m", $shop['server_time'])."-01") - (86400 * 1))."-01"));

// 지난달 마지막일
$search_date5 = date("Y-m-d", strtotime(date("Y-m", $shop['server_time'])."-01") - (86400 * 1));

// 전체 (기본)
$search_date_default1 = "2012-01-01";
$search_date_default2 = $shop['time_ymd'];

if (!$date1 || !$date2) {

    //$date1 = $shop['time_ymd'];
    $date1 = $search_date2;
    $date2 = $search_date_default2;

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .reporting_area {padding:5px; min-width:60px; width:60px; _width:60px;}
</style>

<div id="reporting_body"></div>
<div id="reporting_loader"><img src="<?=$shop['image_path']?>/adm/reporting_loader.gif"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() { }
</script>

<script type="text/javascript">
function reportingExcel()
{

    var f = document.formSearch;

    f.m.value = "excel";

    f.action = "./reporting_user_data.php";
    f.submit();

}

function reportingStart()
{

    var f = document.formSearch;

    f.m.value = "";

    if (f.reporting_segment.value == '') {

        alert("세그먼트가 선택되지 않았습니다.");
        return false;

    }

    reportingLoader('start');

    $.post("./reporting_user_data.php", {"date1" : f.date1.value , "date2" : f.date2.value, "reporting_mode" : f.reporting_mode.value, "reporting_segment" : f.reporting_segment.value}, function(data) {

        $("#reporting_data").html(data);
        reportingLoader('end');

    });

}

function reportingMode(mode)
{

    var f = document.formSearch;

    f.reporting_mode.value = mode;

    document.getElementById("date_year").src = "<?=$shop['image_path']?>/adm/btn_date_year_off.gif";
    document.getElementById("date_month").src = "<?=$shop['image_path']?>/adm/btn_date_month_off.gif";
    document.getElementById("date_day").src = "<?=$shop['image_path']?>/adm/btn_date_day_off.gif";
    document.getElementById("date_hour").src = "<?=$shop['image_path']?>/adm/btn_date_hour_off.gif";
    document.getElementById("date_week").src = "<?=$shop['image_path']?>/adm/btn_date_week_off.gif";

    document.getElementById("date_"+mode).src = "<?=$shop['image_path']?>/adm/btn_date_"+mode+"_on.gif";

    reportingStart();

}

function segmentCheck(id)
{

    if (document.getElementById("reporting_segment").value) {

        $("#bc"+document.getElementById("reporting_segment").value).css( { 'background-color' : '#ffffff' } );

    }

    $("#bc"+id).css( { 'background-color' : '#ffcc66' } );

    document.getElementById("reporting_segment").value = id;
    document.getElementById("vc"+id).checked = true;

}

function reportingDate(mode)
{

    var f = document.formSearch;

    if (mode == '1') {

        f.date1.value = "<?=$shop['time_ymd']?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '2') {

        f.date1.value = "<?=$search_date1?>";
        f.date2.value = "<?=$search_date1?>";

    }

    if (mode == '3') {

        f.date1.value = "<?=$search_date2?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '4') {

        f.date1.value = "<?=$search_date3?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '5') {

        f.date1.value = "<?=$search_date4?>";
        f.date2.value = "<?=$search_date5?>";

    }

    if (mode == '6') {

        f.date1.value = "<?=$search_date_default1?>";
        f.date2.value = "<?=$search_date_default2?>";

    }

    reportingStart();

}
</script>

<div class="contents_box">
<form method="post" name="formSearch" autocomplete="off">
<input type="hidden" name="m" value="" />
<input type="hidden" id="reporting_mode" name="reporting_mode" value="" />
<input type="hidden" id="reporting_segment" name="reporting_segment" value="<?=$reporting?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">분석 기간</td>
    <td width="10"></td>
    <td><input type="text" id="date1" name="date1" value="<?=$date1?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date1'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="16" align="center" class="tx1">~</td>
    <td><input type="text" id="date2" name="date2" value="<?=$date2?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date2'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="reportingStart(); return false;"><img src="<?=$shop['image_path']?>/adm/reporting_submit.gif" border="0"></a></td>
    <td width="10"></td>
    <td><a href="#" onclick="reportingDate('1'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date1.gif" border="0"></a></td>
    <td><a href="#" onclick="reportingDate('2'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date2.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="reportingDate('3'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date3.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="reportingDate('4'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date4.gif" border="0"></a></td>
    <td><a href="#" onclick="reportingDate('5'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date5.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="reportingDate('6'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date6.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#fafafa">
    <td width="250"></td>
    <td class="reporting_subject">:: 통합차트 (기간 : <span id="reporting_date1"><?=$search_date_default1?></span> ~ <span id="reporting_date2"><?=$search_date_default2?></span>) ::</td>
    <td width="250" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx1">차트선택 :</td>
    <td width="10"></td>
    <td><a href="#" onclick="reportingMode('year'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date_year_off.gif" border="0" id="date_year"></a></td>
    <td><a href="#" onclick="reportingMode('month'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date_month_off.gif" border="0" id="date_month"></a></td>
    <td><a href="#" onclick="reportingMode('day'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date_day_off.gif" border="0" id="date_day"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="reportingMode('hour'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date_hour_off.gif" border="0" id="date_hour"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="reportingMode('week'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date_week_off.gif" border="0" id="date_week"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td><div id="chart_div" style="width:99%;"></div></td>
</tr>
</table>

<div id="reporting_data">

    <div style="background-color:#ffffff; width:100%; height:100px; text-align:center;"><div style="padding-top:30px;"></div></div>

</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:30px auto 0 auto;">
<tr>
    <td><a href="#" onclick="reportingExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">개별차트 내역을 액셀파일로 생성하여 다운로드 합니다.</td>
</tr>
</table>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    reportingMode('day');
});
</script>

<?
include_once("./_bottom.php");
?>