<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.order_box .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_box .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_box .title {font-weight:bold; line-height:56px; font-size:16px; color:#393939; font-family:gulim,굴림;}

.order_list_all .bg {height:44px; background:url('<?=$dmshop_order_guest_path?>/img/title_bg.gif') repeat-x;}
.order_list_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_list_all .date {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .view {text-decoration:underline; line-height:14px; font-size:11px; color:#7da7d9; font-family:dotum,돋움;}
.order_list_all .thumb {border:2px solid #e4e4e4;}
.order_list_all .item_title {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.order_list_all .money {line-height:15px; font-size:12px; color:#333333; font-family:gulim,굴림;}
.order_list_all .type {line-height:15px; font-size:13px; color:#717171; font-family:gulim,굴림;}
.order_list_all .payment {line-height:15px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.order_list_all .msg {line-height:15px; font-size:11px; color:#777777; font-family:dotum,돋움;}
.order_list_all .line2 {height:1px; background:url('<?=$dmshop_order_guest_path?>/img/line2.gif') repeat-x;}

.order_list_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<form method="post" name="formOrder">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="order_code" value="" />
</form>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_box">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_guest_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/order_guest_list.php' class='off'>비회원 주문조회</a></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="55">
    <td><img src="<?=$dmshop_order_guest_path?>/img/message2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_box">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff; padding:15px 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="56">
    <td class="title"><span style="color:#027d94;"><?=text($dmshop_order['order_name'])?></span><span style="color:#787878;">(비회원)</span>님의 주문내역</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_all">
<colgroup>
    <col width="139">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="118">
    <col width="2">
    <col width="180">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>주문일자</b></td>
    <td><img src="<?=$dmshop_order_guest_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>상품명/주문옵션</b><br>(결제금액/수량)</td>
    <td><img src="<?=$dmshop_order_guest_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문상태</b><br>(결제수단)</td>
    <td><img src="<?=$dmshop_order_guest_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문옵션</b></td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_order_guest_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="line"></td></tr>
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
    <td class="type"><?=shop_order_type($list[$i]['order_type']);?></td>
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
<?
if ($list[$i]['order_delivery'] == '2') {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="orderPopupDelivery('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_order_guest_path?>/img/btn4.gif" border="0"></a></td>
</tr>
</table>
<?
} else {
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="msg"><?=shop_order_type($list[$i]['order_type']);?></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center">&nbsp;</td></tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#efefef"></td></tr>
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
<tr>
    <td>
<div style="border:2px solid #f6f6f6; background-color:#dddddd; padding:1px;">
<div style="padding:15px 20px; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_msg">
<tr>
    <td class="t1">
- 비회원으로 주문하신 주문건은 주문상태와 배송조회만 가능 합니다.<br>
- 배송지의 변경, 주문옵션 변경, 주문취소 희망시 전화로 요청하실 수 있습니다.<br>
- <b>교환 및 반품신청 희망시에는 상품 수령 후, <?=$dmshop['order_exchange_day']?>일 이내</b>에만 전화로 요청하실 수 있습니다.<br>
- <b>결제수단이 무통장입금 또는 가상계좌 입금일 경우, <?=$dmshop['order_bank_day']?>일 이내 미입금시 자동 취소</b> 됩니다. <br>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr> 
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>