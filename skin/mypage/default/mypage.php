<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.mypage_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.mypage_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.mypage_title .bg1 {width:30px; height:34px; background:url('<?=$dmshop_mypage_path?>/img/title_bg1.gif') no-repeat;}
.mypage_title .bg2 {height:34px; background:url('<?=$dmshop_mypage_path?>/img/title_bg2.gif') repeat-x;}
.mypage_title .bg3 {width:10px; height:34px; background:url('<?=$dmshop_mypage_path?>/img/title_bg3.gif') no-repeat;}

.mypage_title .bg2 p {line-height:14px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.mypage_title .bg2 p .t1 {text-decoration:underline; line-height:14px; font-size:11px; color:#3198f0; font-family:gulim,굴림;}
.mypage_title .bg2 p .t2 {text-decoration:underline; line-height:14px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}

.mypage_order_title .b1 {margin-top:6px;}
.mypage_order_title .b2 {margin-top:7px;}
.mypage_order_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.mypage_order_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.mypage_order_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.mypage_order_list .bg {height:44px; background:url('<?=$dmshop_mypage_path?>/img/title_bg.gif') repeat-x;}
.mypage_order_list .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.mypage_order_list .date {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.mypage_order_list .view {text-decoration:underline; line-height:14px; font-size:11px; color:#7da7d9; font-family:dotum,돋움;}
.mypage_order_list .thumb {border:2px solid #e4e4e4;}
.mypage_order_list .item_name {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.mypage_order_list .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.mypage_order_list .money {line-height:15px; font-size:12px; color:#333333; font-family:gulim,굴림;}
.mypage_order_list .order_type {line-height:15px; font-size:13px; color:#717171; font-family:gulim,굴림;}
.mypage_order_list .payment {line-height:15px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.mypage_order_list .msg {text-align:center; line-height:16px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.mypage_order_list .dot {height:1px; background:url('<?=$dmshop_mypage_path?>/img/dot.gif') repeat-x;}

.mypage_favorite_title .b1 {margin-top:6px;}
.mypage_favorite_title .b2 {margin-top:7px;}
.mypage_favorite_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.mypage_favorite_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.mypage_favorite_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.mypage_favorite_list .thumb {border:2px solid #e4e4e4;}
.mypage_favorite_list .item_name {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.mypage_favorite_list .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.mypage_favorite_list .money {line-height:15px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}
.mypage_favorite_list .dot {height:1px; background:url('<?=$dmshop_mypage_path?>/img/dot.gif') repeat-x;}

.mypage_cart_title .b1 {margin-top:6px;}
.mypage_cart_title .b2 {margin-top:7px;}
.mypage_cart_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.mypage_cart_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.mypage_cart_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.mypage_cart_list .thumb {border:2px solid #e4e4e4;}
.mypage_cart_list .item_name {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.mypage_cart_list .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.mypage_cart_list .money {line-height:15px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}
.mypage_cart_list .dot {height:1px; background:url('<?=$dmshop_mypage_path?>/img/dot.gif') repeat-x;}
</style>

<script type="text/javascript">
// 주문 (카트에 담는다)
function favoriteOrder(item_id, order_option, order_limit)
{

    var f = document.formUpdate;

    $('#order_start').val('');

    $.post(shop_path+"/cart_update.php", {"item_id" : item_id, "order_option" : order_option, "order_limit" : order_limit, "cart_type" : "order"}, function(data) {

        $("#item_cart_data").html(data);

        orderPage();

    });

}

// 주문처리
function orderPage()
{

    if ($('#order_start').val() == '') { return false; }

    var f = document.formUpdate;

    f.m.value = "";
    f.cart_type.value = "order";

    f.action = shop_path+"/order.php";
    f.submit();

}

// 장바구니
function favoriteCart(favorite_id)
{

    var f = document.formUpdate;

    f.m.value = "favorite";
    f.favorite_id.value = favorite_id;

    f.action = shop_path+"/cart_update.php";
    f.submit();

}

// 삭제
function favoriteDelete(favorite_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.favorite_id.value = favorite_id;

    if (!confirm("해당 상품을 관심상품에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = shop_path+"/favorite_update.php";
    f.submit();

}

// 주문
function cartOrder(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.cart_id.value = cart_id;

    f.action = shop_path+"/order.php";
    f.submit();

}

// 보관
function cartFavorite(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "cart";
    f.cart_id.value = cart_id;

    f.action = shop_path+"/favorite_update.php";
    f.submit();

}

// 삭제
function cartDelete(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.cart_id.value = cart_id;

    if (!confirm("해당 상품을 장바구니에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = shop_path+"/cart_update.php";
    f.submit();

}

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

<div id="item_cart_data" style="display:none;"></div>

<form method="post" name="formOrder">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="order_code" value="" />
</form>

<form method="post" name="formUpdate">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="item_id" value="" />
<input type="hidden" name="cart_type" value="" />
<input type="hidden" name="favorite_id" value="" />
<input type="hidden" name="order_limit" value="" />
<input type="hidden" name="order_option" value="" />
<input type="hidden" id="cart_id" name="cart_id" value="" />
<input type="hidden" id="order_start" name="order_start" value="" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_mypage_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_mypage_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>메인</a></td>";
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
<tr height="50"><td></td></tr>
</table>

<!-- 진행중인주문상품 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_order_title">
<tr>
    <td width="9"></td>
    <td width="162" valign="top"><img src="<?=$dmshop_mypage_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($order_total_count['cnt']);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">최근 주문내역입니다. 이전내역을 포함하여 모두 보시려면 <a href="<?=$shop['https_url']?>/order_list.php" class="t3">전체보기</a>를 클릭 하세요.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_order_list">
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
    <td><img src="<?=$dmshop_mypage_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>상품명/주문옵션</b></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문상태</b></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문옵션</b></td>
</tr>
<?
$list = array();
for ($i=0; $i<count($order_list); $i++) {

    $list[$i] = $order_list[$i];

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_mypage_path."/img/noimage.gif"; }
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
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_name"><?=$list[$i]['order_title']?></a></td>
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
    <td><a href="#" onclick="orderOk('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn8.gif" border="0"></a></td>
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
    <td><a href="#" onclick="orderPopupExchange('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn6.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupRefund('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn7.gif" border="0"></a></td>
<? } ?>
<?
// 구매확정을 안 했을 때
if (!$list[$i]['order_ok'] ) {
?>
    <td><a href="#" onclick="orderOk('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn8.gif" border="0"></a></td>
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
    <td><a href="#" onclick="orderPopupAddress('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn1.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupOption('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn2.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderPopupCancel('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn3.gif" border="0"></a></td>
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
    <td><a href="#" onclick="orderPopupDelivery('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn4.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="orderReceive('<?=$list[$i]['order_code']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn5.gif" border="0"></a></td>
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
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_mypage_path?>/img/order_no.gif"></td></tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#dddddd"></td></tr>
</table>
<!-- 진행중인주문상품 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50%" valign="top">
<!-- 관심상품 start //-->
<div style="margin-right:10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_favorite_title">
<tr>
    <td width="9"></td>
    <td width="79" valign="top"><img src="<?=$dmshop_mypage_path?>/img/t2.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($favorite_total_count['cnt']);?></span> 건</p></td>
    <td align="right"><p class="b2"><a href="<?=$shop['https_url']?>/favorite.php" class="t3">전체보기</a></p></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="9"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_favorite_list">
<?
$list = array();
for ($i=0; $i<count($favorite_list); $i++) {

    $list[$i] = $favorite_list[$i];

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_mypage_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="5" class="dot"></td></tr>
<? } ?>
<tr height="73">
    <td width="11"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_name"><?=$list[$i]['item_title']?><? if ($list[$i]['option_name']) { ?> <span class="option">(옵션 : <?=$list[$i]['option_name']?>)</span><? } ?><? if ($list[$i]['cnt']) { ?> 외 <?=number_format($list[$i]['cnt']);?>건<? } ?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option"><b class="money"><?=number_format($list[$i]['order_item_money']);?></b> 원 / <?=number_format($list[$i]['order_limit']);?>개</span></td>
</tr>
</table>
    </td>
    <td width="75">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="favoriteOrder('<?=$list[$i]['item_id']?>','<?=$list[$i]['order_option']?>','<?=$list[$i]['order_limit']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn11.gif" border="0"></a></td>
</tr>
<tr>
    <td><a href="#" onclick="favoriteCart('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn12.gif" border="0"></a></td>
</tr>
<tr>
    <td><a href="#" onclick="favoriteDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn13.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="5" height="225" align="center"><img src="<?=$dmshop_mypage_path?>/img/favorite_no.gif"></td></tr>
<? } ?>
<tr><td colspan="5" height="2" bgcolor="#dddddd"></td></tr>
</table>
</div>
<!-- 관심상품 end //-->
    </td>
    <td width="50%" valign="top">
<!-- 장바구니 start //-->
<div style="padding-left:10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_cart_title">
<tr>
    <td width="9"></td>
    <td width="79" valign="top"><img src="<?=$dmshop_mypage_path?>/img/t3.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($cart_total_count['cnt']);?></span> 건</p></td>
    <td align="right"><p class="b2"><a href="<?=$shop['https_url']?>/cart.php" class="t3">전체보기</a></p></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="9"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_cart_list">
<?
$list = array();
for ($i=0; $i<count($cart_list); $i++) {

    $list[$i] = $cart_list[$i];

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_mypage_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="5" class="dot"></td></tr>
<? } ?>
<tr height="73">
    <td width="11"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_name"><?=$list[$i]['item_title']?><? if ($list[$i]['option_name']) { ?> <span class="option">(옵션 : <?=$list[$i]['option_name']?>)</span><? } ?><? if ($list[$i]['cnt']) { ?> 외 <?=number_format($list[$i]['cnt']);?>건<? } ?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option"><b class="money"><?=number_format($list[$i]['order_item_money']);?></b> 원 / <?=number_format($list[$i]['order_limit']);?>개</span></td>
</tr>
</table>
    </td>
    <td width="75">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartOrder('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn11.gif" border="0"></a></td>
</tr>
<tr>
    <td><a href="#" onclick="cartFavorite('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn14.gif" border="0"></a></td>
</tr>
<tr>
    <td><a href="#" onclick="cartDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_mypage_path?>/img/btn13.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="5" height="225" align="center"><img src="<?=$dmshop_mypage_path?>/img/cart_no.gif"></td></tr>
<? } ?>
<tr><td colspan="5" height="2" bgcolor="#dddddd"></td></tr>
</table>
</div>
<!-- 장바구니 end //-->
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>