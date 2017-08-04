<?php
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 주문번호가 없다
if (!$order_code) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문 세션확인
$ss_name = "order_".$order_code;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>만료된 페이지입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문완료 세션확인
$ss_name = "order_ok_".$order_code;

if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

}

// 비회원
if (!$shop_user_login) {

    $guest_id = "";
    $guest_id = shop_get_cookie("dmshop_cart");

    if (!$guest_id) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

    }

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where order_code = '".$order_code."' and user_id = '".$dmshop_user['user_id']."' ";

} else {

    $sql_search = " where order_code = '".$order_code."' and guest_id = '".addslashes($guest_id)."' ";

}

// 주문내역
$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 첫번째 데이터만 변수로 저장 (공통 정보를 사용하기 위해)
    if ($i == '0') {

        $dmshop_order = $row;

    }

    if ($row['option_money'] > '0') {

        $option_money = " (+".number_format($row['option_money'])."원)";

    }

    else if ($row['option_money'] < '0') {

        $option_money = " (".number_format($row['option_money'])."원)";

    } else {

        $option_money = "";

    }

    $list[$i]['option_money'] = $option_money; // 옵션금액

}

if (!$i) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 주문확인";
include_once("./_top.php");
?>
<style type="text/css">
.conts .main {padding:5px 10px 30px 10px;}
.conts .main .msg {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.conts .main .text {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.conts .main .step {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
</style>
<div style="border:1px solid #eeeeee;" class="msg">
<div style="padding:5px 10px 3px 10px;">
<? if ($dmshop_order['order_pay_type'] == '4') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>가상계좌 주문을 접수하였습니다.</td>
</tr>
</table>
<? } else if ($dmshop_order['order_pay_type'] == '5') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>무통장 주문을 접수하였습니다.</td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>주문결제를 완료하였습니다.</td>
</tr>
</table>
<? } ?>
</div>
</div>

<!-- 리스트 start //-->
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $shop['mobile_url']."/img/noimage.gif"; }
?>
<input type="hidden" name="chk_id[]" value="<?=$i?>" />
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px; border:1px solid #eeeeee;" class="text">
<tr>
    <td width="84" valign="top"><div style="border:1px solid #e0e0e0; width:82px; height:82px;"><a href="item.php?id=<?=$list[$i]['item_code']?>"><img src="<?=$thumb?>" width="82" height="82" border="0"></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<a href="item.php?id=<?=$list[$i]['item_code']?>" class="title"><?=$list[$i]['item_title']?></a>
<?
if ($list[$i]['delivery_type'] == 2) {

    echo " (묶음배송불가)";

}
?>
    </td>
</tr>
</table>

<? if ($list[$i]['order_option']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>옵션 : <?=$list[$i]['option_name']?><?=$list[$i]['option_money']?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>수량 : <?=$list[$i]['order_limit']?>개 / <?=number_format($list[$i]['order_item_money'])?> 원</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>쿠폰할인 : <? if ($list[$i]['order_coupon']) { echo "- ".number_format($list[$i]['order_coupon'])." 원"; } else { echo "없음"; } ?></td>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>
<!-- 리스트 end //-->

<!-- 무통장/가상계좌 start //-->
<? if ($dmshop_order['order_pay_type'] == '4' || $dmshop_order['order_pay_type'] == '5') { ?>
<div style="margin-top:10px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">입금정보</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">입금은행</td>
    <td><?=text($dmshop_order['order_bank_name'])?></td>
</tr>
<tr>
    <td>입금계좌</td>
    <td><?=text($dmshop_order['order_bank_number'])?></td>
</tr>
<tr>
    <td>예금주</td>
    <td><?=text($dmshop_order['order_bank_holder'])?></td>
</tr>
<? if ($dmshop_order['order_pay_type'] == '5') { ?>
<tr>
    <td>입금자명</td>
    <td><?=text($dmshop_order['order_dep_name'])?></td>
</tr>
<? } ?>
<tr>
    <td>입금하실금액</td>
    <td><b><?=number_format($dmshop_order['order_pay_money']);?> 원</b></td>
</tr>
</table>
</div>
</div>
<? } ?>
<!-- 무통장/가상계좌 end //-->

<!-- 배송지 start //-->
<div style="margin-top:10px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">배송지 정보</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">수령자명</td>
    <td><?=text($dmshop_order['order_rec_name'])?></td>
</tr>
<tr>
    <td>주소</td>
    <td>(우:<?=text($dmshop_order['order_rec_zip1'])?>-<?=text($dmshop_order['order_rec_zip2'])?>) <?=text($dmshop_order['order_rec_addr1'])?><br><?=text($dmshop_order['order_rec_addr2'])?></td>
</tr>
<tr>
    <td>휴대폰번호</td>
    <td><?=text($dmshop_order['order_rec_hp'])?></td>
</tr>
<tr>
    <td>전화번호</td>
    <td><?=text($dmshop_order['order_rec_tel'])?></td>
</tr>
<tr>
    <td>배송요구사항</td>
    <td><?=text2($dmshop_order['order_memo'],0)?></td>
</tr>
</table>
</div>
</div>
<!-- 배송지 end //-->

<!-- 결제정보 start //-->
<? if ($dmshop_order['order_pay_type'] == '4' || $dmshop_order['order_pay_type'] == '5') { ?>
<div style="margin-top:10px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">결제정보</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">결제금액</td>
    <td><b><?=number_format($dmshop_order['order_pay_money']);?> 원</b></td>
</tr>
<tr>
    <td>상품금액</td>
    <td><?=number_format($dmshop_order['order_total_item_money']);?> 원</td>
</tr>
<tr>
    <td>배송비</td>
    <td><?=number_format($dmshop_order['order_delivery_money']);?> 원</td>
</tr>
<tr>
    <td>할인금액</td>
    <td><? if ($dmshop_order['order_total_coupon']) { echo "- ".number_format($dmshop_order['order_total_coupon']); } else { echo "0"; } ?> 원</td>
</tr>
<tr>
    <td>적립금 할인</td>
    <td><? if ($dmshop_order['order_cash']) { echo "- ".number_format($dmshop_order['order_cash']); } else { echo "0"; } ?> 원</td>
</tr>
<tr>
    <td>결제수단</td>
    <td><?=shop_pay_name($dmshop_order['order_pay_type']);?></td>
</tr>
</table>
</div>
</div>
<? } ?>
<!-- 결제정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="<?=$shop['mobile_url']?>"><img src="<?=$shop['mobile_url']?>/img/home.gif" border="0"></a></td>
</tr>
</table>

<?
include_once("./_bottom.php");
?>