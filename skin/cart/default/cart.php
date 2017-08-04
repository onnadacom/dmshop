<?
if (!defined('_DMSHOP_')) exit;

$colspan = 15;
?>
<style type="text/css">
/* 분류 */
.cart_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.cart_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.cart_top .bg {height:79px; background:url('<?=$dmshop_cart_path?>/img/top_bg.gif') repeat-x;}

.cart_message .title {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.cart_title .bg1 {width:2px; height:30px; background:url('<?=$dmshop_cart_path?>/img/title_bg1.gif') no-repeat;}
.cart_title .bg2 {height:30px; background:url('<?=$dmshop_cart_path?>/img/title_bg2.gif') repeat-x;}
.cart_title .bg3 {width:2px; background:url('<?=$dmshop_cart_path?>/img/title_bg3.gif') no-repeat;}

.cart_list .title {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.cart_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.cart_list .money {line-height:18px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.cart_list .delivery1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.cart_list .delivery2 {line-height:18px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.cart_list .coupon {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.cart_list .total {font-weight:bold; line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.cart_list .line_w {height:1px; background-color:#d6d6d6;}
.cart_list .line_h {width:1px; background-color:#efefef;}

.cart_list .input {width:22px; height:17px; border:1px solid #bbbbbb; padding:1px 3px 0px 3px;}
.cart_list .input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}

.cart_btn .msg {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.cart_sum.bg {height:88px; background:url('<?=$dmshop_cart_path?>/img/bg.gif') no-repeat;}
.cart_sum .money1 {font-weight:bold; line-height:28px; font-size:26px; color:#626262; font-family:Tahoma,dotum,gulim;}
.cart_sum .money2 {font-weight:bold; line-height:28px; font-size:26px; color:#cc1414; font-family:Tahoma,dotum,gulim;}
.cart_sum .won1 {font-weight:bold; line-height:15px; font-size:13px; color:#787878; font-family:gulim,굴림;}
.cart_sum .won2 {font-weight:bold; line-height:15px; font-size:13px; color:#cc1414; font-family:gulim,굴림;}
.cart_sum .sign {margin-top:18px;}

.cart_help .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<script type="text/javascript" src="<?=$dmshop_cart_path?>/cart.js"></script>

<form method="post" name="formUpdate">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="item_id" value="" />
<input type="hidden" name="cart_id" value="" />
<input type="hidden" name="order_limit" value="" />
<input type="hidden" name="order_option" value="" />
</form>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_position">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_cart_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/cart.php' class='off'>장바구니</a></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_top">
<tr>
    <td width="4"><img src="<?=$dmshop_cart_path?>/img/top_bg_side1.gif"></td>
    <td width="604"><img src="<?=$dmshop_cart_path?>/img/top_bg_title.gif"></td>
    <td class="bg none">&nbsp;</td>
    <td width="4"><img src="<?=$dmshop_cart_path?>/img/top_bg_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_message">
<tr height="40">
    <td class="title">장바구니 목록을 통해 주문하신 상품의 옵션과 가격을 확인 후, 소지하신 <u>할인쿠폰을 적용</u> 합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<!-- 타이틀 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_title">
<tr>
    <td class="bg1"></td>
    <td class="bg2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="6"></td>
    <td width="21"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" checked /></td>
    <td align="center"><img src="<?=$dmshop_cart_path?>/img/title_item.gif"></td>
    <td width="1"></td>
    <td width="60" align="center"><img src="<?=$dmshop_cart_path?>/img/title_limit.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_cart_path?>/img/title_money.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_cart_path?>/img/title_coupon.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_cart_path?>/img/title_total.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_cart_path?>/img/title_delivery.gif"></td>
    <td width="1"></td>
    <td width="78" align="center"><img src="<?=$dmshop_cart_path?>/img/title_order.gif"></td>
</tr>
</table>
    </td>
    <td class="bg3"></td>
</tr>
</table>
<!-- 타이틀 end //-->

<!-- 리스트 start //-->
<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="submit" value="ok" disabled style="display:none;" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_list">
<colgroup>
    <col width="6">
    <col width="21">
    <col width="">
    <col width="1">
    <col width="60">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="78">
</colgroup>
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_cart_path."/img/noimage.gif"; }
?>
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<tr>
    <td></td>
    <td valign="top" style="padding:15px 0 15px 0;" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" checked class="checkbox" /></td>
    <td valign="top" style="padding:15px 0 15px 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="84" valign="top"><div style="border:1px solid #e0e0e0;"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>"><img src="<?=$thumb?>" width="82" height="82" border="0"></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" class="title"><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<? if ($list[$i]['order_option']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5">
    <td></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option">주문옵션 : <?=text($list[$i]['option_name'])?><?=$list[$i]['option_money']?></span></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$dmshop_cart_path?>/img/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="text" id="order_limit_<?=$list[$i]['id']?>" name="order_limit[<?=$i?>]" class="input" value="<?=$list[$i]['order_limit']?>" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartLimit('<?=$list[$i]['id']?>', '<?=$list[$i]['item_id']?>', '<?=$list[$i]['order_option']?>'); return false;"><img src="<?=$dmshop_cart_path?>/img/limit.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="money" align="center"><?=number_format($list[$i]['order_item_money'])?> 원</td>
    <td class="line_h"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="coupon"><? if ($list[$i]['order_coupon']) { echo "- ".number_format($list[$i]['order_coupon'])." 원"; } ?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartCoupon('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_cart_path?>/img/coupon.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="total" align="center"><?=number_format($list[$i]['order_total_money']);?> 원</td>
    <td class="line_h"></td>
    <td class="money" align="center">
<?
if ($list[$i]['delivery_type'] == 1) {

    echo "<span class='delivery1'>";
    echo "묶음배송상품<br />";
    echo "총 주문금액이 ".number_format($dmshop['delivery_money_free'])."원 이하일 경우 묶음배송비 ".number_format($dmshop['delivery_money'])."원 추가";
    echo "</span>";

}

else if ($list[$i]['delivery_type'] == 2) {

    echo "<span class='delivery2'>".number_format($list[$i]['item_delivery'])." 원<br />묶음배송불가</span>";

} else {

    echo "<span class='delivery1'>";
    echo "묶음배송상품<br />";
    echo "총 주문금액이 ".number_format($dmshop['delivery_money_free'])."원 이하일 경우 묶음배송비 ".number_format($dmshop['delivery_money'])."원 추가";
    echo "</span>";

}
?>
    </td>
    <td class="line_h"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartOrder('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_cart_path?>/img/order.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartFavorite('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_cart_path?>/img/favorite.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_cart_path?>/img/delete.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" class="line_w"></td></tr>
<? } ?>
</table>
</form>
<!-- 리스트 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1">
    <td></td>
</tr>
</table>

<? if ($i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_btn">
<tr height="34" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="msg">선택상품</td>
    <td width="7"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$dmshop_cart_path?>/img/check_delete.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="checkFavorite(); return false;"><img src="<?=$dmshop_cart_path?>/img/check_favorite.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_sum bg">
<tr>
    <td align="right" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_cart_path?>/img/sum_money.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="money1"><?=number_format($order_total_item_money);?></span></td>
    <td width="5"></td>
    <td><span class="won1">원</span></td>
</tr>
</table>
    </td>
    <td width="50" align="center"><img src="<?=$dmshop_cart_path?>/img/sign1.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_cart_path?>/img/sum_delivery.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="money1"><?=number_format($order_delivery_money);?></span></td>
    <td width="5"></td>
    <td><span class="won1">원</span></td>
</tr>
</table>
    </td>
    <td width="50" align="center"><img src="<?=$dmshop_cart_path?>/img/sign2.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_cart_path?>/img/sum_coupon.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="money1"><?=number_format($order_total_coupon);?></span></td>
    <td width="5"></td>
    <td><span class="won1">원</span></td>
</tr>
</table>
    </td>
    <td width="50" align="center"><img src="<?=$dmshop_cart_path?>/img/sign3.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_cart_path?>/img/sum_total.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="money2"><?=number_format($order_total_money);?></span></td>
    <td width="5"></td>
    <td><span class="won2">원</span></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#6b6b6b" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartBack(); return false;"><img src="<?=$dmshop_cart_path?>/img/cart_back.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkOrder(); return false;"><img src="<?=$dmshop_cart_path?>/img/cart_order.gif" border="0"></a></td>
</tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="225" align="center"><img src="<?=$dmshop_cart_path?>/img/cart_no.gif"></td></tr>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto cart_help">
<tr>
    <td>
<div style="padding:20px 68px; border:1px solid #d6d6d6;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_cart_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">장바구니의 <b>저장기간은 <?=$dmshop['cart_day']?>일</b> 입니다. <?=$dmshop['cart_day']?>일 경과 후, 장바구니는 자동 비워집니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="6"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_cart_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">주문하신 상품금액이 <b><?=number_format($dmshop['delivery_money_free']);?></b>원 이하일 경우 배송비 <b><?=number_format($dmshop['delivery_money']);?></b>원이 추가 됩니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="6"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_cart_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">보유하신 적립금 주문/결제 페이지에서 사용하실 수 있습니다.</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>