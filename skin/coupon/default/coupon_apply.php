<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
.top_bg {height:45px; background:url('<?=$dmshop_coupon_path?>/img/top_bg.gif') repeat-x;}

.coupon_title .msg {line-height:16px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.item_list .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.item_list .subject {line-height:16px; font-size:12px; color:#626262; font-family:dotum,돋움;}
.item_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.item_list .limit {line-height:16px; font-size:12px; color:#626262; font-family:dotum,돋움;}
.item_list .money {line-height:16px; font-size:12px; color:#626262; font-family:dotum,돋움;}

.item_list .select {height:18px; border:1px solid #e4e4e4;}
.item_list .select {line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.item_list .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}

.coupon_money .title {font-weight:bold; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.coupon_money .money {font-weight:bold; line-height:16px; font-size:14px; color:#197b30; font-family:gulim,굴림;}
.coupon_money .won {font-weight:bold; line-height:16px; font-size:12px; color:#197b30; font-family:gulim,굴림;}

.coupon_all .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.coupon_all .discount {font-weight:bold; line-height:14px; font-size:12px; color:#197b30; font-family:dotum,돋움;}
.coupon_all .date1 {line-height:18px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.coupon_all .date2 {line-height:18px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.coupon_all .subject {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.coupon_all .option {line-height:16px; font-size:11px; color:#959595; font-family:gulim,굴림;}
.coupon_all .mode1 {line-height:14px; font-size:12px; color:#197b30; font-family:dotum,돋움;}
.coupon_all .mode2 {line-height:14px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.coupon_all .dot {height:1px; background:url('<?=$dmshop_coupon_path?>/img/dot.gif') repeat-x;}
</style>

<script type="text/javascript">
function couponApply(m)
{

    var coupon_id = document.getElementById("coupon_id").value;

    $.post("./coupon_apply_update.php", {"coupon_page" : "<?=text($coupon_page)?>", "m" : m, "cart_id" : "<?=text($cart_id)?>", "coupon_id" : coupon_id}, function(data) {

        $("#coupon_update").html(data);

    });

}
</script>

<div id="coupon_update" style="display:none;"></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/apply_title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"></td>
    <td>
<!-- 쿠폰선택 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_title">
<tr>
    <td width="100" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_coupon_path?>/img/arrow2.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/apply_t1.gif"></td>
</tr>
</table>
    </td>
    <td class="msg" align="right"><p>적용하실 쿠폰을 선택하신 후, 쿠폰적용 버튼을 클릭하세요.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="item_list">
<colgroup>
    <col width="">
    <col width="50">
    <col width="90">
    <col width="90">
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">상품명/주문옵션</td>
    <td align="center" class="title">수량</td>
    <td align="center" class="title">판매가격</td>
    <td align="center" class="title">쿠폰적용가</td>
</tr>
<tr><td colspan="4" height="2" bgcolor="#777777"></td></tr>
<tr height="60">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank" class="subject"><?=text($dmshop_item['item_title'])?></a></td>
</tr>
</table>

<? if ($dmshop_item_option['option_name']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option">주문옵션 : <?=text($dmshop_item_option['option_name'])?></span></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="coupon_id" name="coupon_id" class="select" onchange="couponApply('change');"><? if ($coupon_applys) { ?><option value="">선택하세요.</option><?=$coupon_applys?><? } else { ?><option value="">쿠폰 없음</option><? } ?></select></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td align="center" class="limit"><?=number_format($dmshop_cart['order_limit']);?> 개</td>
    <td align="center" class="money"><?=number_format($order_item_money);?> 원</td>
    <td align="center" class="money"><span id="order_total_money">미적용</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_money">
<tr height="40" bgcolor="#f7f7f7">
    <td width="20"></td>
    <td><span class="title">쿠폰할인 금액 :</span> <span id="coupon_money" class="money">0</span> <span class="won">원</span></td>
    <td width="200" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="couponApply('apply'); return false;"><img src="<?=$dmshop_coupon_path?>/img/coupon_apply.gif" border="0"></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_coupon_path?>/img/close.gif" border="0"></a></td>
    <td width="1"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<?
// 쿠폰이 선택되었다면
if ($dmshop_cart['order_coupon_id']) {
?>
<script type="text/javascript">
document.getElementById("coupon_id").value = "<?=$dmshop_cart['order_coupon_id']?>";
</script>

<script type="text/javascript">
couponApply('change');
</script>
<? } ?>
<!-- 쿠폰선택 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<!-- 내쿠폰 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_title">
<tr>
    <td width="100" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_coupon_path?>/img/arrow2.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/apply_t2.gif"></td>
</tr>
</table>
    </td>
    <td class="msg" align="right"><p>회원님이 현재 소유하신 쿠폰목록 입니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_all">
<colgroup>
    <col width="90">
    <col width="">
    <col width="100">
    <col width="80">
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">할인/혜택</td>
    <td align="center" class="title">쿠폰명/사용조건</td>
    <td align="center" class="title">사용기간</td>
    <td align="center" class="title">비고</td>
</tr>
<tr><td colspan="4" height="2" bgcolor="#777777"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="4" class="dot"></td></tr>
<? } ?>
<tr height="50">
    <td align="center" class="discount"><?=number_format($list[$i]['coupon_discount']);?> <?=shop_coupon_discount_type($list[$i]['coupon_discount_type']);?></td>
    <td>
<div style="margin:5px 0 5px 10px;">
<p class="subject"><?=$list[$i]['coupon_title']?></p>
<p class="option">
<?
// 기획전
if ($list[$i]['coupon_category_type']) {

    if ($list[$i]['coupon_plan']) {

        echo "[".shop_plan_name($list[$i]['coupon_plan'])." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($list[$i]['coupon_category']) {

        echo "<a href='".$shop['path']."/list.php?ct_id=".$list[$i]['coupon_category']."' class='option' target='_blank'>[".shop_category_name($list[$i]['coupon_category'])." 분류]</a>";

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
?>
</p>
</div>
    </td>
    <td align="center" class="date1">
<?
echo date("Y/m/d", strtotime($list[$i]['coupon_date1']))." 부터<br>";
echo "<span class='date2'>".date("Y/m/d", strtotime($list[$i]['coupon_date2']))." 까지</span>";
?>
    </td>
    <td align="center"><?=$list[$i]['coupon_message']?></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="4" height="100" align="center"><img src="<?=$dmshop_coupon_path?>/img/coupon_no.gif"></td></tr>
<? } ?>
<tr><td colspan="4" height="2" bgcolor="#dddddd"></td></tr>
</table>
<!-- 내쿠폰 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>
    </td>
    <td width="15"></td>
</tr>
</table>