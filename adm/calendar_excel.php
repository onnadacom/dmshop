<?php
include_once("./_dmshop.php");

if ($m == 'check_order' || $m == 'check_bank' || $m == 'check_prepare' || $m == 'check_delivery' || $m == 'check_cancel' || $m == 'check_exchange' || $m == 'check_refund') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = shop_order(addslashes($_POST['order_code'][$k]));

    }

} else {

    $result = sql_query(" select *, count(order_code) as cnt from $shop[order_table] where order_payment != '0' group by order_code order by order_datetime asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

}

$filename="order.xls";
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
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="3" bgcolor="#0d0d0d" align="center"><span style='font-size:13px; color:#ffffff;'><b>주문내역</b></span></td>
</tr>
<tr height="25">
    <td width="50" bgcolor="#cccccc" align="center">번호</td>
    <td width="150" bgcolor="#cccccc" align="center">주문일시</td>
    <td width="100" bgcolor="#cccccc" align="center">주문번호</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr height="35">
    <td width="50" align="center"><? echo $i + 1; ?></td>
    <td width="150" align="center" class="text"><?=text($list[$i]['order_datetime'])?></td>
    <td width="100" align="center"><?=text($list[$i]['order_code'])?></td>
</tr>
<? } ?>
</table>
</body>
</html>