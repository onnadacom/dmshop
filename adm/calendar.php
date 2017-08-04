<?php
include_once("./_dmshop.php");
if ($d) { $d = preg_match("/^[0-9\-]+$/", $d) ? $d : ""; }
if ($calendarView) { $calendarView = preg_match("/^[a-zA-Z0-9_\-]+$/", $calendarView) ? $calendarView : ""; }

$top_id = "2";
$left_id = "6";
$menu_id = "500";
$shop['title'] = "일정관리";
include_once("./_top.php");

$colspan = "6";

$datetime = $d;

if (!$datetime) {

    $datetime = $shop['time_ymd'];

}

// 현재 시각 지정.
//$datetime = "2008-12-01";
//$datetime = $shop['time_ymd'];

// 현재 시각에서 월을 구한다.
$dateT1 = date("Y-m", strtotime($datetime));

// 현재 월의 1일의 요일 값을 구한다.
$dateT2 = date("w", strtotime($dateT1."-01"));

// 현재 월의 1일에서 요일 값을 뺀다.
$dateT3 = date("Y-m-d", strtotime($dateT1."-01") - (86400 * $dateT2));

// 현재 월의 1일에서 31일을 더한다.
$dateN1 = date("Y-m-d", strtotime($dateT1."-01") + (86400 * 31));

// 다음 달의 월을 구한다.
$dateN2 = date("Y-m", strtotime($dateN1));

// 다음 달 1일을 구한다.
$dateN3 = date("Y-m-d", strtotime($dateN2."-01"));

// 다음 달 1일에서 1일을 뺀다. 그럼 이번 달 마지막일
$dateN4 = date("d", strtotime($dateN3) - (86400 * 1));

// 6 뺀다. 현재 달 마지막 일 요일을 구해서.
$dateN5 = 6 - date("w", strtotime($dateT1."-".$dateN4));

// 현재 월의 1일에서 1일을 뺀다.
$dateP1 = date("Y-m-d", strtotime($dateT1."-01") - (86400 * 1));
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select1 .selectBox-dropdown {width:17px; height:19px; border:1px solid #cbcbcb;}
.select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .todaybg {background-color:#d9fcff;}

.contents_box .year {font-weight:bold; line-height:26px; font-size:24px; color:#474747; font-family:arial black,dotum,돋움;}
.contents_box .week {font-weight:bold; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움; padding:0 0 0 1px;}
.contents_box .list_title {font-weight:bold; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}

.contents_box .sun1 {font-weight:bold; line-height:14px; font-size:12px; color:#ff3b43; font-family:dotum,돋움;}
.contents_box .sat1 {font-weight:bold; line-height:14px; font-size:12px; color:#6589dc; font-family:dotum,돋움;}
.contents_box .day1 {font-weight:bold; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}

.contents_box .sun2 {font-weight:bold; line-height:14px; font-size:12px; color:#ff3b43; font-family:dotum,돋움;}
.contents_box .sat2 {font-weight:bold; line-height:14px; font-size:12px; color:#6589dc; font-family:dotum,돋움;}
.contents_box .day2 {font-weight:bold; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}

.contents_box .sun3 {line-height:14px; font-size:12px; color:#ff3b43; font-family:dotum,돋움;}
.contents_box .sat3 {line-height:14px; font-size:12px; color:#6589dc; font-family:dotum,돋움;}
.contents_box .day3 {line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}

#calendar_write {position:absolute; z-index:2; left:0px; top:0px; width:0px; height:0px; display:none;}
#calendar_write .calendar_box {width:500px; height:275px;}
.contents_box .calendar_title {font-weight:bold; line-height:16px; font-size:14px; color:#ffffff; font-family:gulim,굴림;}
.contents_box .calendar_title_bg {height:40px; background:url('<?=$shop['image_path']?>/adm/calendar_title_bg.gif') repeat-x;}
.contents_box .calendar_list {clear:both; display:block; cursor:pointer; padding-bottom:5px; text-align:left;}
.contents_box .calendar_list div {margin:0 5px;}
.contents_box .calendar_list .calendar_time {font-weight:bold; line-height:13px; font-size:11px; color:#a3a3a3; font-family:dotum,돋움;}
.contents_box .calendar_list .calendar_memo {line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}
.contents_box .calendar_on {background-color:#d9fcff;}

.contents_box .calendar_line {background:url('<?=$shop['image_path']?>/adm/calendar_line.gif') repeat-y 150px 0;}
.contents_box .calendar_table .calendar_time {font-weight:bold; line-height:13px; font-size:11px; color:#474747; font-family:dotum,돋움;}
.contents_box .calendar_table .calendar_memo {margin-left:20px; line-height:14px; font-size:12px; color:#474747; font-family:dotum,돋움;}
</style>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td class="pagetitle">:: 일정관리 캘린더 ::</td>
</tr>
<tr><td height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="60">
    <td width="200">
<? if ($calendarView == 'list') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td><a href="?d=<?=$d?>&calendarView=list"><img src="<?=$shop['image_path']?>/adm/btn_calendar1_on.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="?d=<?=$d?>"><img src="<?=$shop['image_path']?>/adm/btn_calendar2_off.gif" border="0"></a></td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td><a href="?d=<?=$d?>&calendarView=list"><img src="<?=$shop['image_path']?>/adm/btn_calendar1_off.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="?d=<?=$d?>"><img src="<?=$shop['image_path']?>/adm/btn_calendar2_on.gif" border="0"></a></td>
</tr>
</table>
<? } ?>
    </td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="?d=<?=$dateP1?>&calendarView=<?=$calendarView?>"><img src="<?=$shop['image_path']?>/adm/btn_calendar_prev.gif" border="0"></a></td>
    <td width="8"></td>
    <td><p class="year up2"><?=date("Y. m", strtotime($dateT1."-01"));?></p></td>
    <td width="8"></td>
    <td><a href="?d=<?=$dateN3?>&calendarView=<?=$calendarView?>"><img src="<?=$shop['image_path']?>/adm/btn_calendar_next.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="200" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td><a href="#" onclick="calendarView('<?=$shop['time_ymd']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_calendar_write.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="./calendar.php?calendarView=<?=$calendarView?>"><img src="<?=$shop['image_path']?>/adm/btn_calendar_today.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>

<? if ($calendarView == 'list') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="150">
    <col width="1">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr height="1">
    <td></td>
    <td bgcolor="#d9d9d9"></td>
    <td></td>
    <td bgcolor="#d9d9d9"></td>
    <td></td>
</tr>
<tr height="31" bgcolor="#f5f5f5">
    <td align="center" class="list_title">년월일</td>
    <td bgcolor="#d9d9d9"></td>
    <td align="center" class="list_title">시간</td>
    <td bgcolor="#d9d9d9"></td>
    <td align="center" class="list_title">내용</td>
</tr>
<tr><td colspan="5" height="1" bgcolor="#a6a7ab"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<?
// 1셀만 출력. 다음 셀로 자동 변경.
$mod = "1";

// 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
for ($i=0; $i<($dateN4 + $dateT2 + $dateN5); $i++) {

    // 6일 뺀 날짜부터 돌린다.
    $dateT4 = date("Y-m-d", strtotime($dateT3) + (86400 * $i));

    // 해당 날짜의 요일을 구한다.
    $dateT5 = date("w", strtotime($dateT3) + (86400 * $i));

    // 토요일
    if ($dateT5 == '6') {

        $dateLine = "background-color:#a5a5aa;";

    } else {

        $dateLine = "background-color:#d9d9d9;";

    }

    // 현재 월과 돌린 월이 일치할 때만.
    if ($dateT1 == substr($dateT4,0,7)) {

        $dateW = true;

        // 오늘 날짜면
        if ($shop['time_ymd'] == $dateT4) {

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun2";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat2";

            } else {

                // 기타
                $dateClassName = "day2";

            }

        } else {

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun1";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat1";

            } else {

                // 기타
                $dateClassName = "day1";

            }

        }

        // 오늘 날짜면
        if ($shop['time_ymd'] == $dateT4) {

            // 레이어 색상 지정
            $todayClassBg = "class='todaybg'";

        } else {

            $todayClassBg = "";

        }

        // 첫번째만
        if ($i == '0') {

            // 시작일
            $tmpYmdEtc1 = $dateT4;

        }

        // 종료일
        $tmpYmdEtc2 = $dateT4;



        echo "<tr id='cd-".text($dateT4)."' height='40' {$todayClassBg} onclick=\"calendarView('".text($dateT4)."');\">";
        echo "<td align='center'><a href=\"#\" onclick=\"calendarView('".text($dateT4)."'); return false;\"><span class='".text($dateClassName)."'>".date("Y. m. d", strtotime($dateT4))." <span style='font-weight:normal;'>".shop_week(date("w", strtotime($dateT4)))."</span></span></a></td>";
        echo "<td bgcolor='#d9d9d9'></td>";
        echo "<td colspan='3' class='calendar_line'><table id='listAdd-".text($dateT4)."' width='100%' cellpadding='0' cellspacing='0' border='0' style='display:inline;'></table></td>";
        echo "</tr>\n";
        echo "<tr height='1' style='".text($dateLine)."'><td colspan='5'></td></tr>";

    }

}
?>
</table>
    </td>
</tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="15%">
    <col width="14%">
    <col width="14%">
    <col width="14%">
    <col width="14%">
    <col width="14%">
    <col width="15%">
</colgroup>
<tr height="1">
    <td></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
    <td style="border-left:1px solid #d9d9d9;"></td>
</tr>
<tr height="31" bgcolor="#f5f5f5">
    <td align="center" class="week"><font color="#ff3b43">일</font></td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;">월</td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;">화</td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;">수</td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;">목</td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;">금</td>
    <td align="center" class="week" style="border-left:1px solid #d9d9d9;"><font color="#6589dc">토</font></td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#a6a7ab"></td></tr>
<tr>
<?
// 7셀만 출력. 다음 셀로 자동 변경.
$mod = "7";

// 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
for ($i=0; $i<($dateN4 + $dateT2 + $dateN5); $i++) {

    // 6일 뺀 날짜부터 돌린다.
    $dateT4 = date("Y-m-d", strtotime($dateT3) + (86400 * $i));

    // 해당 날짜의 요일을 구한다.
    $dateT5 = date("w", strtotime($dateT3) + (86400 * $i));

    if ($i && $i%$mod == '0') {

        echo "</tr><tr>";

    }

    // 일요일 제외
    if ($dateT5 != '0') {

        $dateLine = "border-left:1px solid #d9d9d9;";

    } else {

        $dateLine = "";

    }

    // 현재 월과 돌린 월이 일치할 때만.
    if ($dateT1 == substr($dateT4,0,7)) {

        $dateW = true;

        // 오늘 날짜면
        if ($shop['time_ymd'] == $dateT4) {

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun2";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat2";

            } else {

                // 기타
                $dateClassName = "day2";

            }

        } else {

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun1";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat1";

            } else {

                // 기타
                $dateClassName = "day1";

            }

        }

    } else {
    // 다른 달

        $dateW = false;

        // 0은 일요일.
        if ($dateT5 == '0') {

            // 빨강색
            $dateClassName = "sun3";

        }

        // 6은 토요일
        else if ($dateT5 == '6') {

            // 파랑색
            $dateClassName = "sat3";

        } else {

            // 기타
            $dateClassName = "day3";

        }

    }

    // 오늘 날짜면
    if ($shop['time_ymd'] == $dateT4) {

        // 레이어 색상 지정
        $todayClassBg = "class='todaybg'";

    } else {

        $todayClassBg = "";

    }

    echo "<td id='cd-".text($dateT4)."' align='center' valign='top' style='".text($dateLine)." border-bottom:1px solid #d9d9d9; height:140px;' ".text($todayClassBg)." onclick=\"calendarView('".text($dateT4)."');\">";
    echo "<div style='clear:both; position:relative; left:0px; top:0px; width:100%;'>";

    // 첫번째만
    if ($i == '0') {

        // 시작일
        $tmpYmdEtc1 = $dateT4;

    }

    // 종료일
    $tmpYmdEtc2 = $dateT4;

    // 이번 달
    if ($dateW) {

        echo "<div style='position:absolute; z-index:1; left:4px; top:3px; text-align:left;'>";
        echo "<a href=\"#\" onclick=\"calendarView('".text($dateT4)."'); return false;\">";
        echo "<span class='".text($dateClassName)."'>";
        echo substr($dateT4,8,2);
        echo "</span>";
        echo "</a>";
        echo "</div>";

    } else {
    // 다른 달

        echo "<div style='position:absolute; z-index:1; left:4px; top:3px; text-align:left;'>";
        //echo "<a href=\"#\" onclick=\"dateGo('".substr($dateT4,5,5)."'); return false;\">";
        echo "<span class='".text($dateClassName)."'>";
        echo substr($dateT4,5,5);
        echo "</span>";
        //echo "</a>";
        echo "</div>";

    }

    echo "</div>";

    echo "<div style='clear:both; width:100%;'>";
    echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
    echo "<tr><td height='20'></td></tr>";
    echo "<tr><td>";
    echo "<table id='listAdd-".text($dateT4)."' width='100%' cellpadding='0' cellspacing='0' border='0' style='display:inline;'></table>";
    echo "</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</td>\n";

}

// 나머지 셀을 채운다.
$cnt = $i%$mod;
if ($cnt) {

    for ($i=$cnt; $i<$mod; $i++) {

        echo "<td>&nbsp;</td>\n";

    }

}
?>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>

<div id="calendar_write">
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

<div id="calendar_btn1" style="display:inline;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="calendarSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="calendarClose(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>
</div>

<div id="calendar_btn2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="calendarSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="calendarEra(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="calendarClose(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>
</div>

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
  $("#calendar_write").draggable({ handle: '#calendar_write' });
});
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

        $("#dmshop_update").html(data);

    });

}
</script>

<script type="text/javascript">
function calendarView(day)
{

    $("#write_msg").html("등록");
    $("#calendar_btn1").show();
    $("#calendar_btn2").hide();

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
        $("#cd-"+day).css({ 'background-color' : '#dee3e7' });
        $("#title").focus();

    } else {

        $("#viewDate").val("");
        $("#calendar_write").hide();
        $("#cd-"+viewDate).css({ 'background-color' : '#ffffff' });

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

    if (viewDate) {

        $("#cd-"+viewDate).css({ 'background-color' : '#ffffff' });

    }

}

function calendarAdd(day, calendar_id, calendar_title, calendar_date1, calendar_date2, calendar_h1, calendar_h2, calendar_i1, calendar_i2, calendarView)
{

    var id = document.getElementById("listAdd-"+day);

    if (!id) {
        return false;
    }

    var objRow = id.insertRow(id.rows.length);
    var objCell = objRow.insertCell(0);

    var list_html = "";

    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_title' name='calendar_"+calendar_id+"_title' value='"+calendar_title+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_date1' name='calendar_"+calendar_id+"_date1' value='"+calendar_date1+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_date2' name='calendar_"+calendar_id+"_date2' value='"+calendar_date2+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_h1' name='calendar_"+calendar_id+"_h1' value='"+calendar_h1+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_h2' name='calendar_"+calendar_id+"_h2' value='"+calendar_h2+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_i1' name='calendar_"+calendar_id+"_i1' value='"+calendar_i1+"' />";
    list_html += "<input type='hidden' id='calendar_"+calendar_id+"_i2' name='calendar_"+calendar_id+"_i2' value='"+calendar_i2+"' />";

    if (calendarView == 'list') {

        list_html += "<table width='100%' border='0' cellspacing='0' cellpadding='0' onclick=\"event.cancelBubble=true; calendarEdit('"+day+"', '"+calendar_id+"');\" class='calendar_table pointer'><tr height='40'><td width='150' align='center'><p class='calendar_time'>"+calendar_h1+":"+calendar_i1+" ~ "+calendar_h2+":"+calendar_i2+"</p></td><td width='1'></td><td><p><span class='calendar_memo'>"+calendar_title+"</span></p></td></tr></table>";

    } else {

        list_html += "<div class='calendar_list pointer' onclick=\"event.cancelBubble=true; calendarEdit('"+day+"', '"+calendar_id+"');\"><div><p class='calendar_time'>"+calendar_h1+":"+calendar_i1+" ~ "+calendar_h2+":"+calendar_i2+"</p><p><span class='calendar_memo'>"+calendar_title+"</span></p></div></div>";

    }

    objCell.innerHTML = list_html;

}

function calendarDel(day)
{

    var id = document.getElementById("listAdd-"+day);

    if (!id) {
        return false;
    }

    if (!id.rows.length || id.rows.length <= '0') {

        return false;

    }

    id.deleteRow(0);

}

function calendarEra()
{

    var f = document.formCalender;

    f.m.value = "d";

    $.post("./calendar_update.php", {"calendarView" : "<?=text($calendarView)?>", "m" : f.m.value, "id" : f.id.value, "date_etc1" : f.date_etc1.value, "date_etc2" : f.date_etc2.value, "viewDate" : f.viewDate.value, "date1" : f.date1.value, "h1" : f.h1.value, "i1" : f.i1.value, "date2" : f.date2.value, "h2" : f.h2.value, "i2" : f.i2.value, "title" : f.title.value}, function(data) {

        $("#dmshop_update").html(data);

    });

}

function calendarEdit(day, id)
{

    var win = $(window);
    var layer = $("#calendar_write");
    var box = $(".calendar_box");

    layer.show();

    var layerLeft = (win.scrollLeft() + (win.width() / 2)) - (box.width() / 2);
    var layerTop = (win.scrollTop() + (win.height() / 2)) - (box.height() / 2);

    layer.css( { 'left': layerLeft+'px', 'top': layerTop+'px'} );

    var viewDate = $("#viewDate").val();

    if (viewDate) {
        $("#cd-"+viewDate).css({ 'background-color' : '#ffffff' });
    }

    $("#m").val("u");
    $("#id").val(id);
    $("#date1").val($("#calendar_"+id+"_date1").val());
    $("#date2").val($("#calendar_"+id+"_date2").val());
    $("#title").val($("#calendar_"+id+"_title").val());
    $("#h1").selectBox('value', $("#calendar_"+id+"_h1").val());
    $("#i1").selectBox('value', $("#calendar_"+id+"_i1").val());
    $("#h2").selectBox('value', $("#calendar_"+id+"_h2").val());
    $("#i2").selectBox('value', $("#calendar_"+id+"_i2").val());
    $("#viewDate").val(day);
    $("#cd-"+day).css({ 'background-color' : '#dee3e7' });
    $("#write_msg").html("수정");
    $("#calendar_btn1").hide();
    $("#calendar_btn2").show();
    $("#title").focus();

}
</script>

<script type="text/javascript">
$("#viewDate").val("");
</script>

<?
$calendar_add_list = "";

// 현재 구간 데이터 로딩
$result = sql_query(" select * from $shop[calendar_table] where date >= '$tmpYmdEtc1' and date <= '$tmpYmdEtc2' order by h1 asc, i1 asc ");
for ($i=0; $data=sql_fetch_array($result); $i++) {

    // 일정 추가
    $calendar_add_list .= "calendarAdd('".text($data['date'])."', '".text($data['id'])."', '".text($data['title'])."', '".text($data['date1'])."', '".text($data['date2'])."', '".text($data['h1'])."', '".text($data['h2'])."', '".text($data['i1'])."', '".text($data['i2'])."', '".text($calendarView)."');";

}

echo "<script type='text/javascript'> ".$calendar_add_list." </script>";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="./calendar_excel.php"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">버튼을 클릭하시면, 위 내용을 액셀 파일로 저장 합니다.</td>
</tr>
</table>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
$(function() {

    $(".calendar_list").mouseover(function() {

        $(this).addClass("calendar_on");

    }).mouseout(function(){

        $(this).removeClass("calendar_on");

    });

    $(".calendar_table").mouseover(function() {

        $(this).addClass("calendar_on");

    }).mouseout(function(){

        $(this).removeClass("calendar_on");

    });

});
</script>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select1 select").selectBox();
});
</script>

<?
include_once("./_bottom.php");
?>