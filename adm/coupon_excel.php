<?php
include_once("./_dmshop.php");

if ($m == 'check_coupon') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = shop_coupon_list(addslashes($_POST['coupon_list_id'][$k]));

    }

} else {

    $sql_search = " where coupon_type = '1' ";

    if ($m == 'coupon_id') {

        $sql_search .= " and coupon_id = '".addslashes($coupon_id)."' ";

    }

    if ($m == 'coupon') {

        $sql_search .= " ";

    }

    $result = sql_query(" select * from $shop[coupon_list_table] $sql_search order by id desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

}

if ($coupon_id) {

    $dmshop_coupon = shop_coupon(addslashes($coupon_id));

}

$filename="coupon.xls";
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

<? if ($m == 'coupon_id' || $m == 'coupon' || $m == 'check_coupon') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="9" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b><? if ($dmshop_coupon['coupon_title']) { echo text($dmshop_coupon['coupon_title']); } else { echo "인쇄용"; } ?> 쿠폰 등록현황</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">등록일시</td>
    <td align="center" bgcolor="#d9d9d9">아이디</td>
    <td align="center" bgcolor="#d9d9d9">성명</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰번호</td>
    <td align="center" bgcolor="#d9d9d9">할인혜택</td>
    <td align="center" bgcolor="#d9d9d9">사용 시작일</td>
    <td align="center" bgcolor="#d9d9d9">사용 종료일</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰명</td>
    <td align="center" bgcolor="#d9d9d9">사용조건</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    // 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".addslashes($list[$i]['user_id'])."' and order_type in ('202','900')) as x ");

?>
<tr height="25">
    <td align="center"><? if ($list[$i]['datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['datetime']; } ?></td>
    <td align="center"><?=text($list[$i]['user_id'])?></td>
    <td align="center"><?=text($list[$i]['user_name'])?></td>
    <td align="center"><?=text($list[$i]['coupon_number'])?></td>
    <td align="center"><?=$list[$i]['coupon_discount'].shop_coupon_discount_type($list[$i]['coupon_discount_type']);?></td>
    <td align="center">
<?
if ($list[$i]['coupon_date1'] == '0000-00-00') {

    echo "&nbsp;";

} else {

    echo date("Y-m-d", strtotime($list[$i]['coupon_date1']));

}
?>
    </td>
    <td align="center">
<?
if ($list[$i]['coupon_date1'] == '0000-00-00') {

    echo "&nbsp;";

} else {

    echo date("Y-m-d", strtotime($list[$i]['coupon_date2']));

}
?>
    </td>
    <td align="center"><?=text($list[$i]['coupon_title'])?></td>
    <td align="center">
<?
// 기획전
if ($list[$i]['coupon_category_type']) {

    if ($list[$i]['coupon_plan']) {

        echo "[".text(shop_plan_name($list[$i]['coupon_plan']))." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($list[$i]['coupon_category']) {

        echo "[".text(shop_category_name($list[$i]['coupon_category']))." 분류]";

    } else {

        echo "[모든 카테고리]";

    }

}

// 최소 또는 최대 금액이 있다
if ($list[$i]['coupon_discount_min'] || $list[$i]['coupon_discount_type'] == '1' && $list[$i]['coupon_discount_max']) {

    // 최소금액
    if ($list[$i]['coupon_discount_min']) {

        echo " ".number_format($list[$i]['coupon_discount_min'])."원 이상 구매시";

    }

    // 퍼센트비율, 최대금액
    if ($list[$i]['coupon_discount_type'] == '1' && $list[$i]['coupon_discount_max']) {

        echo " 최대 ".number_format($list[$i]['coupon_discount_max'])."원 할인";

    }

} else {

    echo " 자유이용 쿠폰";

}

if ($list[$i]['coupon_bank']) {

    echo " / 무통장 입금 전용";

}

if ($list[$i]['coupon_cash']) {

    echo " / 적립금 동시사용 불가";

}

if ($list[$i]['coupon_overlap']) {

    echo " / 중복다운불가";

}
?>
    </td>
</tr>
<? } ?>
</table>
<? } ?>

</body>
</html>