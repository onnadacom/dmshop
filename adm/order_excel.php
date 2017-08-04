<?php
include_once("./_dmshop.php");

if ($m == 'check_order' || $m == 'check_bank' || $m == 'check_prepare' || $m == 'check_delivery' || $m == 'check_cancel' || $m == 'check_exchange' || $m == 'check_refund' || $m == 'check_receipt') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = shop_order(addslashes($_POST['order_code'][$k]));

    }

} else {

    $sql_search = " where order_payment != '0' and order_number = '0' ";

    if ($m == 'bank') {

        $sql_search .= " and order_pay_type = '5' and order_type in ('100','101') ";

    }

    if ($m == 'prepare') {

        $sql_search .= " and order_type in ('101','200') ";

    }

    if ($m == 'delivery') {

        $sql_search .= " and order_type in ('200','201') ";

    }

    if ($m == 'cancel') {

        $sql_search .= " and order_type in ('300','301') ";

    }

    if ($m == 'exchange') {

        $sql_search .= " and order_type in ('400','401','900') and order_exchange != '0' ";

    }

    if ($m == 'refund') {

        $sql_search .= " and order_type in ('500','501') ";

    }

    if ($m == 'receipt') {

        $sql_search .= " and order_pay_type in ('1','2','4','5') ";

    }

    $result = sql_query(" select * from $shop[order_table] $sql_search order by order_datetime desc ");
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

<? if ($m == 'order' || $m == 'check_order') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="49" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>전체 주문 내역</b></span></td>
</tr>
<tr height="35">
    <td colspan="18" align="center" bgcolor="#d9d9d9">기본 정보</td>
    <td colspan="13" align="center" bgcolor="#f2dcdb">결제 정보</td>
    <td colspan="10" align="center" bgcolor="#edeef6">배송 정보</td>
    <td colspan="8" align="center" bgcolor="#e8faeb">수령/취소/교환/환불 정보</td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">아이디</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">상품가격</td>
    <td align="center" bgcolor="#d9d9d9">옵션가격</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">주문금액</td>
    <td align="center" bgcolor="#d9d9d9">총 주문금액</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰 할인</td>
    <td align="center" bgcolor="#d9d9d9">적립금 할인</td>
    <td align="center" bgcolor="#d9d9d9">배송비</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#f2dcdb">결제수단</td>
    <td align="center" bgcolor="#f2dcdb">결제여부</td>
    <td align="center" bgcolor="#f2dcdb">입금자명</td>
    <td align="center" bgcolor="#f2dcdb">무통장입금액</td>
    <td align="center" bgcolor="#f2dcdb">입금 확인일시</td>
    <td align="center" bgcolor="#f2dcdb">입금은행</td>
    <td align="center" bgcolor="#f2dcdb">입금계좌</td>
    <td align="center" bgcolor="#f2dcdb">예금주명</td>
    <td align="center" bgcolor="#f2dcdb">PG 승인번호</td>
    <td align="center" bgcolor="#f2dcdb">PG 승인일자</td>
    <td align="center" bgcolor="#f2dcdb">PG 승인시간</td>
    <td align="center" bgcolor="#f2dcdb">신용카드 거래번호</td>
    <td align="center" bgcolor="#f2dcdb">영수증 발급번호</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
    <td align="center" bgcolor="#edeef6">배송업체</td>
    <td align="center" bgcolor="#edeef6">업체 연락처</td>
    <td align="center" bgcolor="#edeef6">배송조회 URL</td>
    <td align="center" bgcolor="#edeef6">운송장 번호</td>
    <td align="center" bgcolor="#edeef6">발송일시</td>
    <td align="center" bgcolor="#e8faeb">상품 수령일시</td>
    <td align="center" bgcolor="#e8faeb">상품 수령정보</td>
    <td align="center" bgcolor="#e8faeb">취소 접수일시</td>
    <td align="center" bgcolor="#e8faeb">취소 승인일시</td>
    <td align="center" bgcolor="#e8faeb">교환 접수일시</td>
    <td align="center" bgcolor="#e8faeb">교환 승인일시</td>
    <td align="center" bgcolor="#e8faeb">환불 접수일시</td>
    <td align="center" bgcolor="#e8faeb">환불 승인일시</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['user_id'])?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=text($list[$i]['item_money'])?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=text($list[$i]['order_limit'])?></td>
    <td align="center"><?=text($list[$i]['order_item_money'])?></td>
    <td align="center"><?=text($list[$i]['order_total_item_money'])?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo text($list[$i]['order_coupon']); } ?></td>
    <td align="center"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center"><?=text($list[$i]['order_dep_name_real'])?></td>
    <td align="center"><? if ($list[$i]['order_dep_money_real']) { echo $list[$i]['order_dep_money_real']; } ?></td>
    <td align="center"><? if ($list[$i]['order_pay_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_pay_datetime']; } ?></td>
    <td align="center"><?=text($list[$i]['order_bank_name'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_bank_number'])?></td>
    <td align="center"><?=text($list[$i]['order_bank_holder'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_pg_code1'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_pg_code1_date'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_pg_code1_time'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_pg_card_code'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_receipt_code'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_receive_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_receive_datetime']; } ?></td>
    <td align="center">
<?
if ($list[$i]['order_receive']) {

    if (date("Y-m-d H:i:s", strtotime($list[$i]['order_delivery_datetime']) + ($dmshop['order_receive_day'] * 86400)) > $list[$i]['order_receive_datetime']) {

        echo "구매자 수령확인";

    } else {

        echo "배송일로 부터 ".$dmshop['order_receive_day']."일 경과";

    }

}
?>
    </td>
    <td align="center"><? if ($list[$i]['order_cancel_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cancel_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_ok_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_exchange_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_exchange_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_ok_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_refund_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_refund_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_ok_datetime']; } ?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['user_id'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo text($list[$i]['order_coupon']); } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_dep_name_real'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_dep_money_real']) { echo $list[$i]['order_dep_money_real']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_pay_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_pay_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_bank_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_bank_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_bank_holder'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_pg_code1'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_pg_code1_date'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_pg_code1_time'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_pg_card_code'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_receipt_code'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_receive_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_receive_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>">
<?
if ($list[$i]['order_receive']) {

    if (date("Y-m-d H:i:s", strtotime($list[$i]['order_delivery_datetime']) + ($dmshop['order_receive_day'] * 86400)) > $list[$i]['order_receive_datetime']) {

        echo "구매자 수령확인";

    } else {

        echo "배송일로 부터 ".$dmshop['order_receive_day']."일 경과";

    }

}
?>
    </td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cancel_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cancel_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_ok_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_exchange_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_exchange_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_ok_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_refund_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_refund_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_ok_datetime']; } ?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['item_money']?></td>
    <td align="center"><? if ($row['option_money']) { echo $row['option_money']; } ?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['order_item_money']?></td>
    <td align="center"><? if ($row['order_coupon']) { echo $row['order_coupon']; } ?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'bank' || $m == 'check_bank') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="25" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>무통장 입금 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">상품가격</td>
    <td align="center" bgcolor="#d9d9d9">옵션가격</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">주문금액</td>
    <td align="center" bgcolor="#d9d9d9">총 주문금액</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰 할인</td>
    <td align="center" bgcolor="#d9d9d9">적립금 할인</td>
    <td align="center" bgcolor="#d9d9d9">배송비</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#f2dcdb">입금방식</td>
    <td align="center" bgcolor="#f2dcdb">결제여부</td>
    <td align="center" bgcolor="#f2dcdb">입금자명</td>
    <td align="center" bgcolor="#f2dcdb">무통장입금액</td>
    <td align="center" bgcolor="#f2dcdb">입금 확인일시</td>
    <td align="center" bgcolor="#f2dcdb">입금은행</td>
    <td align="center" bgcolor="#f2dcdb">입금계좌</td>
    <td align="center" bgcolor="#f2dcdb">예금주명</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center"><?=text($list[$i]['order_dep_name_real'])?></td>
    <td align="center"><? if ($list[$i]['order_dep_money_real']) { echo $list[$i]['order_dep_money_real']; } ?></td>
    <td align="center"><? if ($list[$i]['order_pay_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_pay_datetime']; } ?></td>
    <td align="center"><?=text($list[$i]['order_bank_name'])?></td>
    <td align="center" class="text"><?=text($list[$i]['order_bank_number'])?></td>
    <td align="center"><?=text($list[$i]['order_bank_holder'])?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_dep_name_real'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_dep_money_real']) { echo $list[$i]['order_dep_money_real']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_pay_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_pay_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_bank_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>" class="text"><?=text($list[$i]['order_bank_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_bank_holder'])?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['item_money']?></td>
    <td align="center"><? if ($row['option_money']) { echo $row['option_money']; } ?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['order_item_money']?></td>
    <td align="center"><? if ($row['order_coupon']) { echo $row['order_coupon']; } ?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'prepare' || $m == 'check_prepare') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="16" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>배송 준비 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">재고</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    // 상품
    $dmshop_item = shop_item($list[$i]['item_id']);

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($list[$i]['option_id']) {

        // 상품 옵션
        $dmshop_item_option = shop_item_option($list[$i]['option_id']);

        // 수량
        $list[$i]['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 상품정보가 있을 때
        if ($dmshop_item['id']) {

            // 수량
            $list[$i]['item_limit'] = $dmshop_item['item_limit'];

        } else {
        // 없다면

            // 수량 제로
            $list[$i]['item_limit'] = "0";

        }

    }
?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['item_limit']?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['item_limit']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {

    // 상품
    $dmshop_item = shop_item($row['item_id']);

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($row['option_id']) {

        // 상품 옵션
        $dmshop_item_option = shop_item_option($row['option_id']);

        // 수량
        $row['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 상품정보가 있을 때
        if ($dmshop_item['id']) {

            // 수량
            $row['item_limit'] = $dmshop_item['item_limit'];

        } else {
        // 없다면

            // 수량 제로
            $row['item_limit'] = "0";

        }

    }
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['item_limit']?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'delivery' || $m == 'check_delivery') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="21" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>상품 발송 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">재고</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
    <td align="center" bgcolor="#edeef6">배송업체</td>
    <td align="center" bgcolor="#edeef6">업체 연락처</td>
    <td align="center" bgcolor="#edeef6">배송조회 URL</td>
    <td align="center" bgcolor="#edeef6">운송장 번호</td>
    <td align="center" bgcolor="#edeef6">발송일시</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    // 상품
    $dmshop_item = shop_item($list[$i]['item_id']);

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($list[$i]['option_id']) {

        // 상품 옵션
        $dmshop_item_option = shop_item_option($list[$i]['option_id']);

        // 수량
        $list[$i]['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 상품정보가 있을 때
        if ($dmshop_item['id']) {

            // 수량
            $list[$i]['item_limit'] = $dmshop_item['item_limit'];

        } else {
        // 없다면

            // 수량 제로
            $list[$i]['item_limit'] = "0";

        }

    }
?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['item_limit']?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['item_limit']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {

    // 상품
    $dmshop_item = shop_item($row['item_id']);

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($row['option_id']) {

        // 상품 옵션
        $dmshop_item_option = shop_item_option($row['option_id']);

        // 수량
        $row['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 상품정보가 있을 때
        if ($dmshop_item['id']) {

            // 수량
            $row['item_limit'] = $dmshop_item['item_limit'];

        } else {
        // 없다면

            // 수량 제로
            $row['item_limit'] = "0";

        }

    }
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['item_limit']?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'cancel' || $m == 'check_cancel') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="31" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>주문 취소 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">상품가격</td>
    <td align="center" bgcolor="#d9d9d9">옵션가격</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">주문금액</td>
    <td align="center" bgcolor="#d9d9d9">총 주문금액</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰 할인</td>
    <td align="center" bgcolor="#d9d9d9">적립금 할인</td>
    <td align="center" bgcolor="#d9d9d9">배송비</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#d9d9d9">결제수단</td>
    <td align="center" bgcolor="#d9d9d9">결제여부</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
    <td align="center" bgcolor="#edeef6">배송업체</td>
    <td align="center" bgcolor="#edeef6">업체 연락처</td>
    <td align="center" bgcolor="#edeef6">배송조회 URL</td>
    <td align="center" bgcolor="#edeef6">운송장 번호</td>
    <td align="center" bgcolor="#edeef6">발송일시</td>
    <td align="center" bgcolor="#f2dcdb">취소 접수일시</td>
    <td align="center" bgcolor="#f2dcdb">취소 승인일시</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cancel_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cancel_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_ok_datetime']; } ?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cancel_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cancel_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_cancel_ok_datetime']; } ?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['item_money']?></td>
    <td align="center"><? if ($row['option_money']) { echo $row['option_money']; } ?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['order_item_money']?></td>
    <td align="center"><? if ($row['order_coupon']) { echo $row['order_coupon']; } ?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'exchange' || $m == 'check_exchange') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="31" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>교환 접수 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">상품가격</td>
    <td align="center" bgcolor="#d9d9d9">옵션가격</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">주문금액</td>
    <td align="center" bgcolor="#d9d9d9">총 주문금액</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰 할인</td>
    <td align="center" bgcolor="#d9d9d9">적립금 할인</td>
    <td align="center" bgcolor="#d9d9d9">배송비</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#d9d9d9">결제수단</td>
    <td align="center" bgcolor="#d9d9d9">결제여부</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
    <td align="center" bgcolor="#edeef6">배송업체</td>
    <td align="center" bgcolor="#edeef6">업체 연락처</td>
    <td align="center" bgcolor="#edeef6">배송조회 URL</td>
    <td align="center" bgcolor="#edeef6">운송장 번호</td>
    <td align="center" bgcolor="#edeef6">발송일시</td>
    <td align="center" bgcolor="#f2dcdb">교환 접수일시</td>
    <td align="center" bgcolor="#f2dcdb">교환 승인일시</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_exchange_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_exchange_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_ok_datetime']; } ?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_exchange_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_exchange_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_exchange_ok_datetime']; } ?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['item_money']?></td>
    <td align="center"><? if ($row['option_money']) { echo $row['option_money']; } ?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['order_item_money']?></td>
    <td align="center"><? if ($row['order_coupon']) { echo $row['order_coupon']; } ?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'refund' || $m == 'check_refund') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="31" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>환불 접수 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">주문자 휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">주문자 자택전화</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">상품가격</td>
    <td align="center" bgcolor="#d9d9d9">옵션가격</td>
    <td align="center" bgcolor="#d9d9d9">주문수량</td>
    <td align="center" bgcolor="#d9d9d9">주문금액</td>
    <td align="center" bgcolor="#d9d9d9">총 주문금액</td>
    <td align="center" bgcolor="#d9d9d9">쿠폰 할인</td>
    <td align="center" bgcolor="#d9d9d9">적립금 할인</td>
    <td align="center" bgcolor="#d9d9d9">배송비</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#d9d9d9">결제수단</td>
    <td align="center" bgcolor="#d9d9d9">결제여부</td>
    <td align="center" bgcolor="#edeef6">수령자명</td>
    <td align="center" bgcolor="#edeef6">수령자 휴대폰</td>
    <td align="center" bgcolor="#edeef6">수령자 자택전화</td>
    <td width="500" align="center" bgcolor="#edeef6">배송지 주소</td>
    <td align="center" bgcolor="#edeef6">배송 요구사항</td>
    <td align="center" bgcolor="#edeef6">배송업체</td>
    <td align="center" bgcolor="#edeef6">업체 연락처</td>
    <td align="center" bgcolor="#edeef6">배송조회 URL</td>
    <td align="center" bgcolor="#edeef6">운송장 번호</td>
    <td align="center" bgcolor="#edeef6">발송일시</td>
    <td align="center" bgcolor="#f2dcdb">환불 접수일시</td>
    <td align="center" bgcolor="#f2dcdb">환불 승인일시</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($list[$i]['order_count'] == '1') { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_rec_tel'])?></td>
    <td>(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center"><?=text($list[$i]['order_memo'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_refund_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_datetime']; } ?></td>
    <td align="center"><? if ($list[$i]['order_refund_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_ok_datetime']; } ?></td>
</tr>
<? } else { ?>
<tr height="25">
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_datetime']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_code']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['option_name'])?></td>
    <td align="center"><?=$list[$i]['item_money']?></td>
    <td align="center"><? if ($list[$i]['option_money']) { echo $list[$i]['option_money']; } ?></td>
    <td align="center"><?=$list[$i]['order_limit']?></td>
    <td align="center"><?=$list[$i]['order_item_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_total_item_money']?></td>
    <td align="center"><? if ($list[$i]['order_coupon']) { echo $list[$i]['order_coupon']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_cash']) { echo $list[$i]['order_cash']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_money']) { echo $list[$i]['order_delivery_money']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=$list[$i]['order_pay_money']?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_hp'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_rec_tel'])?></td>
    <td rowspan="<?=$list[$i]['order_count']?>">(<?=text($list[$i]['order_rec_zip1'])?><?=text($list[$i]['order_rec_zip2'])?>) <?=text($list[$i]['order_rec_addr1'])?> <?=text($list[$i]['order_rec_addr2'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_memo'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_name'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_tel'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_url'])?><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><?=text($list[$i]['order_delivery_number'])?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_delivery_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_delivery_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_refund_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_datetime']; } ?></td>
    <td align="center" rowspan="<?=$list[$i]['order_count']?>"><? if ($list[$i]['order_refund_ok_datetime'] != '0000-00-00 00:00:00') { echo $list[$i]['order_refund_ok_datetime']; } ?></td>
</tr>
<?
$result = sql_query(" select * from $shop[order_table] where order_code = '".$list[$i]['order_code']."' and id != '".$list[$i]['id']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {
?>
<tr height="25">
    <td align="center"><?=text($row['item_title'])?></td>
    <td align="center"><?=text($row['option_name'])?></td>
    <td align="center"><?=$row['item_money']?></td>
    <td align="center"><? if ($row['option_money']) { echo $row['option_money']; } ?></td>
    <td align="center"><?=$row['order_limit']?></td>
    <td align="center"><?=$row['order_item_money']?></td>
    <td align="center"><? if ($row['order_coupon']) { echo $row['order_coupon']; } ?></td>
</tr>
<? } ?>
<? } ?>
<? } ?>
</table>
<? } ?>

<? if ($m == 'receipt' || $m == 'check_receipt') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="15" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>영수증 발행 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">주문일시</td>
    <td align="center" bgcolor="#d9d9d9">주문번호</td>
    <td align="center" bgcolor="#d9d9d9">주문상태</td>
    <td align="center" bgcolor="#d9d9d9">주문자명</td>
    <td align="center" bgcolor="#d9d9d9">휴대폰</td>
    <td align="center" bgcolor="#d9d9d9">자택전화</td>
    <td align="center" bgcolor="#d9d9d9">이메일</td>
    <td align="center" bgcolor="#d9d9d9">주문상품</td>
    <td align="center" bgcolor="#d9d9d9">실 결제금액</td>
    <td align="center" bgcolor="#d9d9d9">결제수단</td>
    <td align="center" bgcolor="#d9d9d9">결제여부</td>
    <td align="center" bgcolor="#edeef6">신청여부</td>
    <td align="center" bgcolor="#edeef6">영수증 유형</td>
    <td align="center" bgcolor="#edeef6">발행여부</td>
    <td align="center" bgcolor="#edeef6">승인번호</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr height="25">
    <td align="center"><?=$list[$i]['order_datetime']?></td>
    <td align="center"><?=$list[$i]['order_code']?></td>
    <td align="center"><?=shop_order_type($list[$i]['order_type']);?></td>
    <td align="center"><?=text($list[$i]['order_name'])?></td>
    <td align="center"><?=text($list[$i]['order_hp'])?></td>
    <td align="center"><?=text($list[$i]['order_tel'])?></td>
    <td align="center"><?=$list[$i]['order_email']?></td>
    <td align="center"><?=$list[$i]['order_title']?></td>
    <td align="center"><?=$list[$i]['order_pay_money']?></td>
    <td align="center"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
    <td align="center"><?=shop_order_payment($list[$i]['order_payment']);?></td>
    <td align="center">
<?
if ($list[$i]['order_pay_type'] == '1' || $list[$i]['order_pay_type'] == '2' || $list[$i]['order_pay_type'] == '4') {

    echo "자동";

} else {

    if ($list[$i]['order_receipt']) {

        echo "신청";

    } else {

        echo "";

    }

}
?>
    </td>
    <td align="center"><? if ($list[$i]['order_receipt']) { echo shop_receipt_name($list[$i]['order_receipt']); } ?></td>
    <td align="center">
<?
if ($list[$i]['order_receipt']) {

    if ($list[$i]['order_receipt_code']) {

        echo "발행완료";

    } else {

        echo "발행 전";

    }

}
?>
    </td>
    <td><?=$list[$i]['order_receipt_code']?></td>
</tr>
<? } ?>
</table>
<? } ?>
</body>
</html>