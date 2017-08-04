<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($id) { $id = preg_match("/^[a-zA-Z0-9_\-]+$/", $id) ? $id : ""; }
if ($d) { $d = preg_match("/^[0-9\-]+$/", $d) ? $d : ""; }

$datetime = $d;

if (!$datetime) {

    $datetime = $shop['time_ymd'];

}

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

// 작년
$dateM1 = (int)(date("Y", strtotime($datetime)) - 1)."-".date("m", strtotime($datetime))."-01";

// 내년
$dateM2 = (int)(date("Y", strtotime($datetime)) + 1)."-".date("m", strtotime($datetime))."-01";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div class="calendar">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="118" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="calendar_year">
<?
echo preg_replace("/([0-9])/", "<p class='calendar_year$1'></p>", substr($dateT1,0,4));
?>
    </td>
    <td width="1"></td>
    <td><img src="<?=$shop['image_path']?>/adm/calendar_mini_year.gif"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><p class="calendar_btn"><a href="#" onclick="calendarLoad('<?=text($dateP1)?>'); return false;" class="calendar_preg"></a></p></td>
    <td width="5"></td>
    <td><p class="calendar_month<?=substr($dateT1,5,2);?>"></p></td>
    <td width="5"></td>
    <td><p class="calendar_btn"><a href="#" onclick="calendarLoad('<?=text($dateN3)?>'); return false;" class="calendar_next"></a></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="calendarLoad('<?=$shop['time_ymd']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar_mini_today.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="calendarView('<?=$shop['time_ymd']?>'); return false;" class="calendar_write"></a></td>
</tr>
</table>
    </td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="7"><img src="<?=$shop['image_path']?>/adm/calendar_mini_week.gif"></td></tr>
<tr><td colspan="7" height="5"></td></tr>
<colgroup>
    <col width="27">
    <col width="27">
    <col width="27">
    <col width="27">
    <col width="27">
    <col width="27">
    <col width="27">
</colgroup>
<tr height="20">
<?
// 7셀만 출력. 다음 셀로 자동 변경.
$mod = "7";

// 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
for ($i=0; $i<($dateN4 + $dateT2 + $dateN5); $i++) {

    // 6일 뺀 날짜부터 돌린다.
    $dateT4 = date("Y-m-d", strtotime($dateT3) + (86400 * $i));

    // 해당 날짜의 요일을 구한다.
    $dateT5 = date("w", strtotime($dateT3) + (86400 * $i));

    $cd = sql_fetch(" select * from $shop[calendar_table] where date = '".$dateT4."' ");

    $dateClassName = "";
    $registClassName = "";

    // 현재 월과 돌린 월이 일치할 때만.
    if ($dateT1 == substr($dateT4,0,7)) {

        $dateW = true;

        // 오늘 날짜면
        if ($shop['time_ymd'] == $dateT4) {

            $dateClassName = "today";

            // 지정일 클래스 지정
            if ($cd['id']) {

                $registClassName = "regist";

            }

        } else {

            if ($dateT5 == '0') {

                $dateClassName = "sun";

            }

            else if ($dateT5 == '6') {

                $dateClassName = "sat";

            } else {

                $dateClassName = "day";

            }

            if ($cd['id']) {

                $registClassName = "regist";

            }

        }

    } else {
    // 다른 달

        $dateW = false;

        if ($dateT5 == '0') {

            $dateClassName = "sun2";

        }

        else if ($dateT5 == '6') {

            $dateClassName = "sat2";

        } else {

            $dateClassName = "day2";

        }

        if ($cd['id']) {

            $registClassName = "regist";

        }

    }

    if ($shop['time_ymd'] == $dateT4) {

        $todayClassBg = "class='todaybg'";

    } else {

        $todayClassBg = "";

    }

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr height='21'>\n";

    }

    echo "<td align='center' ".text($todayClassBg).">";

    // 이번 달
    if ($dateW) {

        echo "<a href='./calendar.php?d=".$dateT4."'>";
        echo "<span class='".text($dateClassName)." ".text($registClassName)."'>";
        echo substr($dateT4,8,2);
        echo "</span>";
        echo "</a>";

    } else {
    // 다른 달

        echo "<a href='./calendar.php?d=".$dateT4."'>";
        echo "<span class='".text($dateClassName)." ".text($registClassName)."'>";
        echo substr($dateT4,8,2);
        echo "</span>";
        echo "</a>";

    }

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
</div>