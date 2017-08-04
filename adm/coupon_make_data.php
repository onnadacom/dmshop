<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$coupon_id) {

    echo "<script type='text/javascript'>alert('쿠폰이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');</script>";
    exit;

}

// 쿠폰
$dmshop_coupon = shop_coupon($coupon_id);

if (!$dmshop_coupon['id']) {

    echo "<script type='text/javascript'>alert('쿠폰이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');</script>";
    exit;

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="65">
    <col width="1">
    <col width="65">
    <col width="20">
</colgroup>
<tr height="50">
    <td></td>
    <td align="center" class="tx1"><?=number_format($dmshop_coupon['coupon_discount']);?> <?=shop_coupon_discount_type($dmshop_coupon['coupon_discount_type']);?></td>
    <td class="bc1"></td>
    <td style="line-height:20px;">
<p style="margin:5px 10px 5px 10px;">
<?
echo "<a href='#' onclick=\"couponPopupView('".$dmshop_coupon['id']."'); return false;\" class='coupon_title'>".text($dmshop_coupon['coupon_title'])."</a><br>";

echo "<span class='coupon_category'>";

// 기획전
if ($dmshop_coupon['coupon_category_type']) {

    if ($dmshop_coupon['coupon_plan']) {

        echo "[".text(shop_plan_name($dmshop_coupon['coupon_plan']))." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($dmshop_coupon['coupon_category']) {

        echo "[".text(shop_category_name($dmshop_coupon['coupon_category']))." 분류]";

    } else {

        echo "[모든 카테고리]";

    }

}

echo "</span>";
echo "<span class='coupon_type'>";

// 최소 또는 최대 금액이 있다
if ($dmshop_coupon['coupon_discount_min'] || $dmshop_coupon['coupon_discount_type'] == '1' && $dmshop_coupon['coupon_discount_max']) {

    // 최소금액
    if ($dmshop_coupon['coupon_discount_min']) {

        echo " ".number_format($dmshop_coupon['coupon_discount_min'])."원 이상 구매시";

    }

    // 퍼센트비율, 최대금액
    if ($dmshop_coupon['coupon_discount_type'] == '1' && $dmshop_coupon['coupon_discount_max']) {

        echo " 최대 ".number_format($dmshop_coupon['coupon_discount_max'])."원 할인";

    }

} else {

    echo " 자유이용 쿠폰";

}

if ($dmshop_coupon['coupon_bank']) {

    echo " / 무통장 입금 전용";

}

if ($dmshop_coupon['coupon_cash']) {

    echo " / 적립금 동시사용 불가";

}

if ($dmshop_coupon['coupon_overlap']) {

    echo " / 중복다운불가";

}

echo "</span>";
?>
</p>
    </td>
    <td class="bc1"></td>
    <td align="center" class="coupon_date">
<?
// 발급일
if ($dmshop_coupon['coupon_day_type']) {

    echo "<p class='coupon_date'>발급일로 부터</p>";
    echo "<p class='coupon_date'>".number_format($dmshop_coupon['coupon_day'])." 일간</p>";


} else {
// 고정기간

    echo "<p class='coupon_date'>".date("Y/m/d", strtotime($dmshop_coupon['coupon_date1']))." 부터</p>";
    echo "<p class='coupon_date'>".date("Y/m/d", strtotime($dmshop_coupon['coupon_date2']))." 까지</p>";


}
?>
    </td>
    <td class="bc1"></td>
    <td align="center"><span class="order_coupon"><?=number_format($dmshop_coupon['coupon_max']);?></span> <span class="tx1">매</span></td>
    <td class="bc1"></td>
    <td align="center"><span class="coupon_down"><?=number_format($dmshop_coupon['coupon_down']);?></span> <span class="tx1">건</span></td>
    <td class="bc1"></td>
    <td align="center"><span class="coupon_order"><?=number_format($dmshop_coupon['coupon_order']);?></span> <span class="tx1">건</span></td>
    <td></td>
</tr>
<tr><td colspan="13" height="1" class="bc1"></td></tr>
</table>