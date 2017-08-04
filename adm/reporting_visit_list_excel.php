<?php
include_once("./_dmshop.php");

if ($m == 'check_visit') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = sql_fetch(" select * from $shop[visit_table] where id = '".addslashes($_POST['visit_id'][$k])."' ");

    }

} else {

    $sql_search = " where vi_first = '1' ";

    if ($m == 'visit') {

        $sql_search .= " ";

    }

    $result = sql_query(" select * from $shop[visit_table] $sql_search order by vi_datetime desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

}

$filename="visit.xls";
header("Content-Type: application/vnd.ms-xls");
header("Content-Disposition: inline; filename=$filename");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$shop['charset']?>" />
<title>xls</title>
<style type="text/css">
.text {mso-number-format:"\@";mso-text-control:shrinktofit;white-space:nowrap;}
</style>
</head>
<body>

<? if ($m == 'visit' || $m == 'check_visit') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="8" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>개별방문 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">방문일시</td>
    <td align="center" bgcolor="#d9d9d9">아이피</td>
    <td align="center" bgcolor="#d9d9d9">유입유형</td>
    <td width="500" align="center" bgcolor="#d9d9d9">유입경로</td>
    <td align="center" bgcolor="#d9d9d9">유입 키워드</td>
    <td align="center" bgcolor="#d9d9d9">브라우저</td>
    <td align="center" bgcolor="#d9d9d9">운영체제</td>
    <td align="center" bgcolor="#d9d9d9">모니터 해상도</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    if (shop_is_utf8(urldecode($list[$i]['vi_referer']))) { $vi_referer = urldecode($list[$i]['vi_referer']); } else { $vi_referer = mb_convert_encoding(urldecode($list[$i]['vi_referer']), 'UTF-8', 'CP949'); }
?>
<tr height="25">
    <td align="center"><?=$list[$i]['vi_datetime']?></td>
    <td align="center"><?=text($list[$i]['vi_ip'])?></td>
    <td align="center"><?=shop_visit_host_name($list[$i]['vi_host']);?></td>
    <td align="center"><?=text($vi_referer);?></td>
    <td align="center"><?=text($list[$i]['vi_keyword']);?></td>
    <td align="center"><?=text($list[$i]['vi_browser']);?></td>
    <td align="center"><?=text($list[$i]['vi_os']);?></td>
    <td align="center"><?=text($list[$i]['vi_resolution']);?></td>
</tr>
<? } ?>
</table>
<? } ?>

</body>
</html>