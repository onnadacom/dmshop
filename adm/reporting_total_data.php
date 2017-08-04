<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($reporting_mode) { $reporting_mode = preg_match("/^[a-zA-Z0-9_\-]+$/", $reporting_mode) ? $reporting_mode : ""; }
if ($c1) { $c1 = preg_match("/^[0-9]+$/", $c1) ? $c1 : ""; }
if ($c2) { $c2 = preg_match("/^[0-9]+$/", $c2) ? $c2 : ""; }
if ($c3) { $c3 = preg_match("/^[0-9]+$/", $c3) ? $c3 : ""; }
if ($c4) { $c4 = preg_match("/^[0-9]+$/", $c4) ? $c4 : ""; }
if ($c5) { $c5 = preg_match("/^[0-9]+$/", $c5) ? $c5 : ""; }
if ($c6) { $c6 = preg_match("/^[0-9]+$/", $c6) ? $c6 : ""; }
if ($c7) { $c7 = preg_match("/^[0-9]+$/", $c7) ? $c7 : ""; }
if ($c8) { $c8 = preg_match("/^[0-9]+$/", $c8) ? $c8 : ""; }
if ($c9) { $c9 = preg_match("/^[0-9]+$/", $c9) ? $c9 : ""; }
if ($c10) { $c10 = preg_match("/^[0-9]+$/", $c10) ? $c10 : ""; }
if ($c11) { $c11 = preg_match("/^[0-9]+$/", $c11) ? $c11 : ""; }
if ($c12) { $c12 = preg_match("/^[0-9]+$/", $c12) ? $c12 : ""; }
if ($c13) { $c13 = preg_match("/^[0-9]+$/", $c13) ? $c13 : ""; }
if ($c14) { $c14 = preg_match("/^[0-9]+$/", $c14) ? $c14 : ""; }
if ($c15) { $c15 = preg_match("/^[0-9]+$/", $c15) ? $c15 : ""; }
if ($c16) { $c16 = preg_match("/^[0-9]+$/", $c16) ? $c16 : ""; }
if ($c17) { $c17 = preg_match("/^[0-9]+$/", $c17) ? $c17 : ""; }
if ($c18) { $c18 = preg_match("/^[0-9]+$/", $c18) ? $c18 : ""; }
if ($c19) { $c19 = preg_match("/^[0-9]+$/", $c19) ? $c19 : ""; }
if ($c20) { $c20 = preg_match("/^[0-9]+$/", $c20) ? $c20 : ""; }
if ($c21) { $c21 = preg_match("/^[0-9]+$/", $c21) ? $c21 : ""; }
if ($c22) { $c22 = preg_match("/^[0-9]+$/", $c22) ? $c22 : ""; }
if ($c23) { $c23 = preg_match("/^[0-9]+$/", $c23) ? $c23 : ""; }
if ($c24) { $c24 = preg_match("/^[0-9]+$/", $c24) ? $c24 : ""; }
if ($c25) { $c25 = preg_match("/^[0-9]+$/", $c25) ? $c25 : ""; }
if ($c26) { $c26 = preg_match("/^[0-9]+$/", $c26) ? $c26 : ""; }
if ($c27) { $c27 = preg_match("/^[0-9]+$/", $c27) ? $c27 : ""; }
if ($c28) { $c28 = preg_match("/^[0-9]+$/", $c28) ? $c28 : ""; }
if ($c29) { $c29 = preg_match("/^[0-9]+$/", $c29) ? $c29 : ""; }
if ($c30) { $c30 = preg_match("/^[0-9]+$/", $c30) ? $c30 : ""; }
if ($c31) { $c31 = preg_match("/^[0-9]+$/", $c31) ? $c31 : ""; }
if ($c32) { $c32 = preg_match("/^[0-9]+$/", $c32) ? $c32 : ""; }
if ($c33) { $c33 = preg_match("/^[0-9]+$/", $c33) ? $c33 : ""; }
if ($c34) { $c34 = preg_match("/^[0-9]+$/", $c34) ? $c34 : ""; }
if ($c35) { $c35 = preg_match("/^[0-9]+$/", $c35) ? $c35 : ""; }
if ($c36) { $c36 = preg_match("/^[0-9]+$/", $c36) ? $c36 : ""; }

if (!$c1 && !$c2 && !$c3 && !$c4 && !$c5 && !$c6 && !$c7 && !$c8 && !$c9 && !$c10 && !$c11 && !$c12 && !$c13 && !$c14 && !$c15 && !$c16 && !$c17 && !$c18 && !$c19 && !$c20 && !$c21 && !$c22 && !$c23 && !$c24 && !$c25 && !$c26 && !$c27 && !$c28 && !$c29 && !$c30 && !$c31 && !$c32 && !$c33 && !$c34 && !$c35 && !$c36) {

    echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
    echo "<script type='text/javascript'>alert('세그먼트가 선택되지 않았습니다.');</script>";
    exit;

}

if ($m == 'excel') {

    $filename="reporting.xls";
    header("Content-Type: application/vnd.ms-xls");
    header("Content-Disposition: inline; filename=$filename");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$shop['charset']?>" />
<title>xls</title>
</head>
<body>
<style type="text/css">
.text {mso-number-format:"\@";mso-text-control:shrinktofit;white-space:nowrap;}
.reporting_title {font-weight:bold; font-size:12px; color:#474747; font-family:gulim,굴림;}
.reporting_list {line-height:23px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.reporting_subject {text-align:center; font-weight:bold; line-height:30px; font-size:12px; color:#959595; font-family:dotum,돋움;}
</style>
<?
} else {

    echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

}

$colspan = 2;

if ($c1) { $colspan++; }
if ($c2) { $colspan++; }
if ($c3) { $colspan++; }
if ($c4) { $colspan++; }
if ($c5) { $colspan++; }
if ($c6) { $colspan++; }
if ($c7) { $colspan++; }
if ($c8) { $colspan++; }
if ($c9) { $colspan++; }
if ($c10) { $colspan++; }
if ($c11) { $colspan++; }
if ($c12) { $colspan++; }
if ($c13) { $colspan++; }
if ($c14) { $colspan++; }
if ($c15) { $colspan++; }
if ($c16) { $colspan++; }
if ($c17) { $colspan++; }
if ($c18) { $colspan++; }
if ($c19) { $colspan++; }
if ($c20) { $colspan++; }
if ($c21) { $colspan++; }
if ($c22) { $colspan++; }
if ($c23) { $colspan++; }
if ($c24) { $colspan++; }
if ($c25) { $colspan++; }
if ($c26) { $colspan++; }
if ($c27) { $colspan++; }
if ($c28) { $colspan++; }
if ($c29) { $colspan++; }
if ($c30) { $colspan++; }
if ($c31) { $colspan++; }
if ($c32) { $colspan++; }
if ($c33) { $colspan++; }
if ($c34) { $colspan++; }
if ($c35) { $colspan++; }
if ($c36) { $colspan++; }

if (!$date1) {

    $date1 = $shop['time_ymd'];

}

if ($date1 > $shop['time_ymd']) {

    $date1 = $shop['time_ymd'];

}

if ($date2 > $shop['time_ymd']) {

    $date2 = $shop['time_ymd'];

}

if ($reporting_mode == 'year') {

    include_once("./reporting_total_data.year.php");

}

else if ($reporting_mode == 'month') {

    include_once("./reporting_total_data.month.php");

}

else if ($reporting_mode == 'day') {

    include_once("./reporting_total_data.day.php");

}

else if ($reporting_mode == 'hour') {

    include_once("./reporting_total_data.hour.php");

}

else if ($reporting_mode == 'week') {

    include_once("./reporting_total_data.week.php");

} else {

    // pass

}
?>
<? if ($m == 'excel') { ?>
</body>
</html>
<? } else { ?>
<script type="text/javascript">
document.getElementById("reporting_date1").innerHTML = "<?=$date1?>";
document.getElementById("reporting_date2").innerHTML = "<?=$date2?>";
</script>
<? } ?>