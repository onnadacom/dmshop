<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
$top_id = "2";
$left_id = "7";
$menu_id = "100";
$shop['title'] = "종합 통계분석";
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

    f.action = "./reporting_total_data.php";
    f.submit();

}

function reportingStart()
{

    var f = document.formSearch;

    f.m.value = "";

    if (!f.c1.value && !f.c2.value && !f.c3.value && !f.c4.value && !f.c5.value && !f.c6.value && !f.c7.value && !f.c8.value && !f.c9.value && !f.c10.value && !f.c11.value && !f.c12.value && !f.c13.value && !f.c14.value && !f.c15.value && !f.c16.value && !f.c17.value && !f.c18.value && !f.c19.value && !f.c20.value && !f.c21.value && !f.c22.value && !f.c23.value && !f.c24.value && !f.c25.value && !f.c26.value && !f.c27.value && !f.c28.value && !f.c29.value && !f.c30.value && !f.c31.value && !f.c32.value && !f.c33.value && !f.c34.value && !f.c35.value && !f.c36.value) {

        alert("세그먼트가 선택되지 않았습니다.");
        return false;

    }

    reportingLoader('start');

    $.post("./reporting_total_data.php", {"date1" : f.date1.value , "date2" : f.date2.value, "reporting_mode" : f.reporting_mode.value, "c1" : f.c1.value, "c2" : f.c2.value, "c3" : f.c3.value, "c4" : f.c4.value, "c5" : f.c5.value, "c6" : f.c6.value, "c7" : f.c7.value, "c8" : f.c8.value, "c9" : f.c9.value, "c10" : f.c10.value, "c11" : f.c11.value, "c12" : f.c12.value, "c13" : f.c13.value, "c14" : f.c14.value, "c15" : f.c15.value, "c16" : f.c16.value, "c17" : f.c17.value, "c18" : f.c18.value, "c19" : f.c19.value, "c20" : f.c20.value, "c21" : f.c21.value, "c22" : f.c22.value, "c23" : f.c23.value, "c24" : f.c24.value, "c25" : f.c25.value, "c26" : f.c26.value, "c27" : f.c27.value, "c28" : f.c28.value, "c29" : f.c29.value, "c30" : f.c30.value, "c31" : f.c31.value, "c32" : f.c32.value, "c33" : f.c33.value, "c34" : f.c34.value, "c35" : f.c35.value, "c36" : f.c36.value}, function(data) {

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

    if (document.getElementById("c"+id).value == '') {

        document.getElementById("c"+id).value = "1";
        document.getElementById("vc"+id).checked = true;

        $("#bc"+id).css( { 'background-color' : '#ffcc66' } );

    } else {

        document.getElementById("c"+id).value = "";
        document.getElementById("vc"+id).checked = false;

        $("#bc"+id).css( { 'background-color' : '#ffffff' } );

    }

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
<input type="hidden" id="c1" name="c1" value="" />
<input type="hidden" id="c2" name="c2" value="" />
<input type="hidden" id="c3" name="c3" value="" />
<input type="hidden" id="c4" name="c4" value="" />
<input type="hidden" id="c5" name="c5" value="" />
<input type="hidden" id="c6" name="c6" value="" />
<input type="hidden" id="c7" name="c7" value="" />
<input type="hidden" id="c8" name="c8" value="" />
<input type="hidden" id="c9" name="c9" value="" />
<input type="hidden" id="c10" name="c10" value="" />
<input type="hidden" id="c11" name="c11" value="" />
<input type="hidden" id="c12" name="c12" value="" />
<input type="hidden" id="c13" name="c13" value="" />
<input type="hidden" id="c14" name="c14" value="" />
<input type="hidden" id="c15" name="c15" value="" />
<input type="hidden" id="c16" name="c16" value="" />
<input type="hidden" id="c17" name="c17" value="" />
<input type="hidden" id="c18" name="c18" value="" />
<input type="hidden" id="c19" name="c19" value="" />
<input type="hidden" id="c20" name="c20" value="" />
<input type="hidden" id="c21" name="c21" value="" />
<input type="hidden" id="c22" name="c22" value="" />
<input type="hidden" id="c23" name="c23" value="" />
<input type="hidden" id="c24" name="c24" value="" />
<input type="hidden" id="c25" name="c25" value="" />
<input type="hidden" id="c26" name="c26" value="" />
<input type="hidden" id="c27" name="c27" value="" />
<input type="hidden" id="c28" name="c28" value="" />
<input type="hidden" id="c29" name="c29" value="" />
<input type="hidden" id="c30" name="c30" value="" />
<input type="hidden" id="c31" name="c31" value="" />
<input type="hidden" id="c32" name="c32" value="" />
<input type="hidden" id="c33" name="c33" value="" />
<input type="hidden" id="c34" name="c34" value="" />
<input type="hidden" id="c35" name="c35" value="" />
<input type="hidden" id="c36" name="c36" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reporting_bg">
<tr>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
<tr>
    <td width="30"></td>
    <td width="290"  valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="reporting_title">건 단위 세그먼트</td>
</tr>
</table>

<div style="margin-top:6px; width:288px; height:118px; border:1px solid #999999; background-color:#ffffff; overflow:auto; overflow-x:hidden; position:relative;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr id="bc1" onclick="segmentCheck('1');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc1" name="vc1" value="1" class="checkbox" /></td>
    <td class="reporting_list">방문자 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc36" onclick="segmentCheck('36');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc36" name="vc36" value="1" class="checkbox" /></td>
    <td class="reporting_list">페이지 뷰</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc2" onclick="segmentCheck('2');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc2" name="vc2" value="1" class="checkbox" /></td>
    <td class="reporting_list">주문 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc3" onclick="segmentCheck('3');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc3" name="vc3" value="1" class="checkbox" /></td>
    <td class="reporting_list">방문자대비 주문율</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc4" onclick="segmentCheck('4');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc4" name="vc4" value="1" class="checkbox" /></td>
    <td class="reporting_list">주문 상품 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc5" onclick="segmentCheck('5');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc5" name="vc5" value="1" class="checkbox" /></td>
    <td class="reporting_list">취소 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc6" onclick="segmentCheck('6');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc6" name="vc6" value="1" class="checkbox" /></td>
    <td class="reporting_list">환불 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc7" onclick="segmentCheck('7');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc7" name="vc7" value="1" class="checkbox" /></td>
    <td class="reporting_list">교환 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc8" onclick="segmentCheck('8');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc8" name="vc8" value="1" class="checkbox" /></td>
    <td class="reporting_list">적립금 사용 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc9" onclick="segmentCheck('9');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc9" name="vc9" value="1" class="checkbox" /></td>
    <td class="reporting_list">적립금 지급 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc10" onclick="segmentCheck('10');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc10" name="vc10" value="1" class="checkbox" /></td>
    <td class="reporting_list">쿠폰 사용 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc11" onclick="segmentCheck('11');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc11" name="vc11" value="1" class="checkbox" /></td>
    <td class="reporting_list">쿠폰 지급 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc12" onclick="segmentCheck('12');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc12" name="vc12" value="1" class="checkbox" /></td>
    <td class="reporting_list">유료 배송 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc13" onclick="segmentCheck('13');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc13" name="vc13" value="1" class="checkbox" /></td>
    <td class="reporting_list">누적 회원 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc14" onclick="segmentCheck('14');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc14" name="vc14" value="1" class="checkbox" /></td>
    <td class="reporting_list">신규 가입자 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc15" onclick="segmentCheck('15');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc15" name="vc15" value="1" class="checkbox" /></td>
    <td class="reporting_list">방문자대비 가입율</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc16" onclick="segmentCheck('16');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc16" name="vc16" value="1" class="checkbox" /></td>
    <td class="reporting_list">탈퇴 회원 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc17" onclick="segmentCheck('17');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc17" name="vc17" value="1" class="checkbox" /></td>
    <td class="reporting_list">로그인 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc18" onclick="segmentCheck('18');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc18" name="vc18" value="1" class="checkbox" /></td>
    <td class="reporting_list">신용카드 결제 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc19" onclick="segmentCheck('19');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc19" name="vc19" value="1" class="checkbox" /></td>
    <td class="reporting_list">실시간계좌 이체 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc20" onclick="segmentCheck('20');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc20" name="vc20" value="1" class="checkbox" /></td>
    <td class="reporting_list">휴대폰 결제 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc21" onclick="segmentCheck('21');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc21" name="vc21" value="1" class="checkbox" /></td>
    <td class="reporting_list">가상계좌 결제 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc22" onclick="segmentCheck('22');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc22" name="vc22" value="1" class="checkbox" /></td>
    <td class="reporting_list">무통장 입금 수</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
</table>
</div>
    </td>
    <td width="25"></td>
    <td width="290"  valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="reporting_title">원 단위 세그먼트</td>
</tr>
</table>

<div style="margin-top:6px; width:288px; height:118px; border:1px solid #999999; background-color:#ffffff; overflow:auto; overflow-x:hidden; position:relative;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr id="bc23" onclick="segmentCheck('23');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc23" name="vc23" value="1" class="checkbox" /></td>
    <td class="reporting_list">결제 금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc24" onclick="segmentCheck('24');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc24" name="vc24" value="1" class="checkbox" /></td>
    <td class="reporting_list">주문 금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc25" onclick="segmentCheck('25');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc25" name="vc25" value="1" class="checkbox" /></td>
    <td class="reporting_list">취소 금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc26" onclick="segmentCheck('26');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc26" name="vc26" value="1" class="checkbox" /></td>
    <td class="reporting_list">환불 금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc27" onclick="segmentCheck('27');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc27" name="vc27" value="1" class="checkbox" /></td>
    <td class="reporting_list">적립금 사용금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc28" onclick="segmentCheck('28');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc28" name="vc28" value="1" class="checkbox" /></td>
    <td class="reporting_list">적립금 지급금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc29" onclick="segmentCheck('29');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc29" name="vc29" value="1" class="checkbox" /></td>
    <td class="reporting_list">쿠폰 사용금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc30" onclick="segmentCheck('30');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc30" name="vc30" value="1" class="checkbox" /></td>
    <td class="reporting_list">유료배송 결제금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc31" onclick="segmentCheck('31');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc31" name="vc31" value="1" class="checkbox" /></td>
    <td class="reporting_list">신용카드 결제금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc32" onclick="segmentCheck('32');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc32" name="vc32" value="1" class="checkbox" /></td>
    <td class="reporting_list">실시간계좌 이체금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc33" onclick="segmentCheck('33');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc33" name="vc33" value="1" class="checkbox" /></td>
    <td class="reporting_list">휴대폰 결제금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc34" onclick="segmentCheck('34');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc34" name="vc34" value="1" class="checkbox" /></td>
    <td class="reporting_list">가상계좌 결제금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
<tr id="bc35" onclick="segmentCheck('35');">
    <td width="4"></td>
    <td width="20"><input type="checkbox" id="vc35" name="vc35" value="1" class="checkbox" /></td>
    <td class="reporting_list">무통장 입금액</td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#f8f8f8"></td></tr>
</table>
</div>
    </td>
    <td width="25"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="reporting_title">분석 기간</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
<tr>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="date1" name="date1" value="<?=$date1?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date1'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="16" align="center" class="tx1">~</td>
    <td><input type="text" id="date2" name="date2" value="<?=$date2?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date2'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
<tr>
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
    <td width="25"></td>
    <td valign="top"><a href="#" onclick="reportingStart(); return false;"><img src="<?=$shop['image_path']?>/adm/reporting_start.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
    <td class="tx1">TIP : 세그먼트는 분석항목을 말합니다. 세그먼트와 분석기간을 여러개 또는 길게 설정하실 경우, 서버 사양에 따라 느려질 수 있습니다. 또한 아래의 차트선택을 통해 분석조건을 변경하실 수 있습니다.</td>
</tr>
</table>
    </td>
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
</script>

<script type="text/javascript">
$(document).ready(function() {

<?
$k = 0;
$str = explode(",", trim($seg));
for ($i=0; $i<count($str); $i++) {

    if ($str[$i]) {

        $k++;

        echo "segmentCheck('".text($str[$i])."');";

    }

}

if (!$k) {

    echo "segmentCheck('1');";
    echo "segmentCheck('36');";

}

echo "reportingMode('day');";

?>
});
</script>

<?
include_once("./_bottom.php");
?>