<?
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($reporting_mode) { $reporting_mode = preg_match("/^[a-zA-Z0-9_\-]+$/", $reporting_mode) ? $reporting_mode : ""; }
if ($reporting_segment) { $reporting_segment = preg_match("/^[1-7]+$/", $reporting_segment) ? $reporting_segment : ""; }

if (!$reporting_segment) {

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

    include_once("./reporting_sales_data.{$reporting_segment}.year.php");

}

else if ($reporting_mode == 'month') {

    include_once("./reporting_sales_data.{$reporting_segment}.month.php");

}

else if ($reporting_mode == 'day') {

    include_once("./reporting_sales_data.{$reporting_segment}.day.php");

}

else if ($reporting_mode == 'hour') {

    include_once("./reporting_sales_data.{$reporting_segment}.hour.php");

}

else if ($reporting_mode == 'week') {

    include_once("./reporting_sales_data.{$reporting_segment}.week.php");

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