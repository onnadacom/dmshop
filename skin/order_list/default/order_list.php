<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.order_list_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_list_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.order_list_title .b1 {margin-top:6px;}
.order_list_title .b2 {margin-top:7px;}
.order_list_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.order_list_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.order_list_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.order_list_all .bg {height:44px; background:url('<?=$dmshop_order_list_path?>/img/title_bg.gif') repeat-x;}
.order_list_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_list_all .date {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .view {text-decoration:underline; line-height:14px; font-size:11px; color:#7da7d9; font-family:dotum,돋움;}
.order_list_all .thumb {border:2px solid #e4e4e4;}
.order_list_all .item_name {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .option {line-height:15px; font-size:12px; color:#0459c1; font-family:gulim,굴림;}
.order_list_all .money {line-height:15px; font-size:12px; color:#333333; font-family:gulim,굴림;}
.order_list_all .order_type {line-height:15px; font-size:13px; color:#717171; font-family:gulim,굴림;}
.order_list_all .payment {line-height:15px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.order_list_all .msg {text-align:center; line-height:16px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.order_list_all .dot {height:1px; background:url('<?=$dmshop_order_list_path?>/img/dot.gif') repeat-x;}

.order_list_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
// 상품수령
function orderReceive(order_code)
{

    var f = document.formOrder;

    f.order_code.value = order_code;

    if (confirm("상품수령을 하시겠습니까?")) {

        f.action = "<?=$shop['path']?>/order_receive_update.php";
        f.submit();

    } else {

        return false;

    }

}

// 구매확정
function orderOk(order_code)
{

    var f = document.formOrder;

    f.order_code.value = order_code;

    if (confirm("구매확정 하시겠습니까?")) {

        f.action = "<?=$shop['path']?>/order_ok_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<form method="post" name="formOrder">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="order_code" value="" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_list_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_list_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/order_list.php' class='off'>주문 내역</a></td>";
?>
</tr>
</table>
    </td>
</tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_title">
<tr>
    <td width="9"></td>
    <td width="82" valign="top"><img src="<?=$dmshop_order_list_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">주문중이거나 구매완료된 상품 목록 입니다. (취소/교환/환불 내역은 해당메뉴에서 확인)</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_all">
<colgroup>
    <col width="139">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="118">
    <col width="2">
    <col width="190">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>주문일</b></td>
    <td><img src="<?=$dmshop_order_list_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>상품명/주문옵션</b></td>
    <td><img src="<?=$dmshop_order_list_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문상태</b></td>
    <td><img src="<?=$dmshop_order_list_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>옵션</b></td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_order_list_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="74">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="date"><?=date("Y-m-d", strtotime($list[$i]['order_datetime']));?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="orderPopupView('<?=$list[$i]['order_code']?>'); return false;" class="view">상세주문내역</a></td>
</tr>
</table>
    </td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_name"><?=text($list[$i]['order_title'])?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><b class="money"><?=number_format($list[$i]['order_pay_money']);?> 원</b></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="order_type"><?=shop_order_type($list[$i]['order_type']);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="payment"><?=shop_pay_name($list[$i]['order_pay_type']);?></td>
</tr>
</table>
    </td>
    <td></td>
    <td>
<!-- btn start //-->
<?
// 구매확정
if ($list[$i]['order_ok']) {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="msg">구매가 완료 되었습니다.<br>감사합니다.</td>
</tr>
</table>
<?
}

// 교환접수
else if ($list[$i]['order_exchange'] == '1') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="msg">교환접수</td>
</tr>
</table>
<?
}

// 교환완료
else if ($list[$i]['order_exchange'] == '2') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="orderOk('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn8.gif" border="0"></a></td>
</tr>
</table>
<?
}

// 상품수령
else if ($list[$i]['order_receive']) {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<?
// 해당 상품의 교환가능한 날짜를 구함
$order_receive_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_exchange_day'] * 86400));

// 날짜가 지나지 않았고, 환불 신청이 없을 때
if ($order_receive_datetime <= $list[$i]['order_receive_datetime'] && !$list[$i]['order_exchange']) {
?>
    <td><a href="#" onclick="orderPopupExchange('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn6.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupRefund('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn7.gif" border="0"></a></td>
<? } ?>
<?
// 구매확정을 안 했을 때
if (!$list[$i]['order_ok'] ) {
?>
    <td width="2"></td>
    <td><a href="#" onclick="orderOk('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn8.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
<?
}

// 배송준비중이 아닐 때
else if ($list[$i]['order_delivery'] == '0') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="orderPopupAddress('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn1.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupOption('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn2.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupCancel('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn3.gif" border="0"></a></td>
</tr>
</table>
<?
}

// 배송준비중
else if ($list[$i]['order_delivery'] == '1') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="msg">포장/배송 준비중 입니다.<br>상품수령 후, 교환/환불 신청 가능</td>
</tr>
</table>
<?
}

// 상품발송
else if ($list[$i]['order_delivery'] == '2') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="orderPopupDelivery('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn4.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderReceive('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_list_path?>/img/btn5.gif" border="0"></a></td>
</tr>
</table>
<?
} else {

    // pass

}
?>
<!-- btn end //-->
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_order_list_path?>/img/order_no.gif"></td></tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#dddddd"></td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr><td><img src="<?=$dmshop_order_list_path?>/img/step.gif"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="order_list_msg">
<tr>
    <td width="50"></td>
    <td class="t1">
- 결제전, 결제완료 단계에서는 고객님의 임의로 상품의 배송지 변경, 주문옵션 변경, 주문취소가 가능 합니다.<br>
- 배송준비중 단계 부터는, 배송지 변경, 주문옵션 변경, 주문취소가 불가 합니다. (상품수령 후, 교환/환불 신청 가능)<br>
* 결제전 단계에서 <b>무통장입금 <?=$dmshop['order_bank_day']?>일, 가상계좌입금 <?=$dmshop['order_pgbank_day']?>일</b> 경과시, <b>주문내역은 자동 삭제</b> 됩니다.<br>
* 상품수령 버튼을 클릭하지 않을 경우, <b>배송일로 부터 <?=$dmshop['order_receive_day']?>일 경과 후 자동으로 상품수령</b>이 됩니다.<br>
* 구매확정 버튼을 클릭하지 않을 경우, <b>상품수령일로 부터 <?=$dmshop['order_exchange_day']?>일 경과 후 자동으로 구매완료</b>가 됩니다.<br>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>