<?
include_once("./_dmshop.php");
include_once("./shop.top.php");

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

<style type="text/css">
body {background:url('<?=$shop['image_path']?>/adm/calendar_bg.gif') repeat;}

.date_layer {width:238px; margin:0 auto; text-align:left;}
.date_layer .close {font-weight:bold; line-height:14px; font-size:12px; color:#757575; font-family:gulim,굴림;}
.date_layer .w {font-weight:bold; line-height:16px; font-size:14px; color:#474747; font-family:gulim,굴림;}

.date_layer .week {height:25px; background:url('<?=$shop['image_path']?>/adm/calendar_week.gif') repeat-x;}

.date_layer .sun {font-weight:bold; line-height:14px; font-size:12px; color:#bd1414; font-family:dotum,돋움;}
.date_layer .day {font-weight:bold; line-height:14px; font-size:12px; color:#414141; font-family:dotum,돋움;}
.date_layer .sat {font-weight:bold; line-height:14px; font-size:12px; color:#146bbd; font-family:dotum,돋움;}

.date_layer .sun1 {line-height:14px; font-size:12px; color:#bd1414; font-family:gulim,굴림;}
.date_layer .day1 {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.date_layer .sat1 {line-height:14px; font-size:12px; color:#146bbd; font-family:gulim,굴림;}

.date_layer .sun2 {font-weight:bold; line-height:14px; font-size:12px; color:#bd1414; font-family:gulim,굴림;}
.date_layer .day2 {font-weight:bold; line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.date_layer .sat2 {font-weight:bold; line-height:14px; font-size:12px; color:#146bbd; font-family:gulim,굴림;}
</style>

<div id="pop_wrap">
<div class="date_layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/calendar_title.gif"></td>
    <td width="50" align="right"><a href="#" onclick="window.close(); return false;" class="close">Close</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="?d=<?=$dateM1?>&id=<?=$id?>"><img src="<?=$shop['image_path']?>/adm/day3.gif" border="0"></a></td>
    <td><a href="?d=<?=$dateP1?>&id=<?=$id?>"><img src="<?=$shop['image_path']?>/adm/day1.gif" border="0"></a></td>
    <td width="5"></td>
    <td><span class="w"><?=$dateT1?></span></td>
    <td width="5"></td>
    <td><a href="?d=<?=$dateN3?>&id=<?=$id?>"><img src="<?=$shop['image_path']?>/adm/day2.gif" border="0"></a></td>
    <td><a href="?d=<?=$dateM2?>&id=<?=$id?>"><img src="<?=$shop['image_path']?>/adm/day4.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="7" height="1" bgcolor="#e4e4e4"></td></tr>
<tr class="week">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<colgroup>
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
</colgroup>
<tr>
    <td align="center" class="sun">일</td>
    <td align="center" class="day">월</td>
    <td align="center" class="day">화</td>
    <td align="center" class="day">수</td>
    <td align="center" class="day">목</td>
    <td align="center" class="day">금</td>
    <td align="center" class="sat">토</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#ffffff">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr><td colspan="7" height="7"></td></tr>
<colgroup>
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
    <col width="31">
</colgroup>
<tr height="21">
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

        echo "</tr>\n<tr height='21'>\n";

    }

    echo "<td align='center'>";

    // 현재 월과 돌린 월이 일치할 때만.
    if ($dateT1 == substr($dateT4,0,7)) {

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

        echo "<a href=\"#\" onclick=\"dateAdd('".substr($dateT4,8,2)."'); return false;\">";
        echo "<span class='" . $dateClassName . "'>";
        echo substr($dateT4,8,2);
        echo "</span>";
        echo "</a>";

    } else {

        // pass

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
<tr><td colspan="7" height="7"></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5">
    <td></td>
</tr>
</table>
</div>
</div>

<script type="text/javascript">
function dateAdd(day)
{

    opener.document.getElementById("<?=$id?>").value = "<?=date("Y", strtotime($datetime));?>-<?=date("m", strtotime($datetime));?>-"+day;
    opener.document.getElementById("<?=$id?>").focus();
    window.close();

}
</script>

<script type="text/javascript">
shopResizeWindow("250", "");
</script>

<?
include_once("./shop.bottom.php");
?>