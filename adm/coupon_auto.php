<?php
include_once("./_dmshop.php");
$shop['title'] = "쿠폰 자동 지급 설정";
include_once("$shop[path]/shop.top.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

if ($coupon_id) {

    $dmshop_coupon = shop_coupon($coupon_id);

    if (!$dmshop_coupon['id']) {

        alert_close("자동지급 설정할 쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

} else {

    // 최근 쿠폰
    $dmshop_coupon = sql_fetch(" select * from $shop[coupon_table] order by id desc ");

    if (!$dmshop_coupon['id']) {

        alert_close("쿠폰을 먼저 생성하신 후 이용하여주시기 바랍니다.");

    }

    $coupon_id = $dmshop_coupon['id'];

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category .selectBox-dropdown {width:300px; height:19px;}
.category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".category select").selectBox();
});
</script>

<script type="text/javascript">
function couponLoad(coupon_id)
{

    if (!coupon_id) {

        var coupon_id = $("#coupon_id").val();

    }

    $.post("./coupon_make_data.php", {"coupon_id" : coupon_id}, function(data) {

        $("#coupon_data").html(data);

    });

}

function couponAutoMove(coupon_id)
{

    document.location.href = "./coupon_auto.php?coupon_id="+coupon_id;

}
</script>

<script type="text/javascript">
function couponSave()
{

    var f = document.formCoupon;

    if (f.coupon_auto[5].checked == true) {

        if (f.coupon_order_money.value == '') {

            alert('금액을 입력하십시오.');
            f.coupon_order_money.focus();
            return false;

        }

    }

    if (!confirm("설정하시겠습니까?")) {

        return false;

    }

    f.action = "./coupon_auto_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formCoupon" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="u" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg2">
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle"><?=text($shop['title'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">쿠폰 선택</td>
    <td width="10"></td>
    <td class="category">
<select id="coupon_id" name="coupon_id" size="1" class="select" onchange="couponAutoMove(this.value);">
<?
// 쿠폰
$result = sql_query(" select * from $shop[coupon_table] where coupon_type = '0' order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['id'])."'>".text($row['coupon_title'])."</option>\n";

}
?>
</select>

<script type="text/javascript">
$("#coupon_id").val("<?=$coupon_id?>");
</script>
    </td>
    <td width="10"></td>
    <td width="280" class="help1">자동지급을 설정하실 쿠폰을 선택 하세요.</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

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
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td class="boxtitle">할인/혜택</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰명/사용조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용기간</td>
    <td class="bc1"></td>
    <td class="boxtitle">발행매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용내역</td>
    <td></td>
</tr>
<tr><td colspan="13" height="1" class="bc1"></td></tr>
</table>

<div id="coupon_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>
</div>

<script type="text/javascript">
$(function() { couponLoad('<?=$coupon_id?>'); });
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">지급 조건</td>
    <td width="10"></td>
    <td class="help1">아래에서 쿠폰의 자동지급 조건을 선택 하세요.</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="180">
    <col width="1">
    <col width="">
    <col width="20">
</colgroup>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td class="boxtitle">선택</td>
    <td class="bc1"></td>
    <td class="boxtitle">조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">설명</td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="0" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '0') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_auto("0");?></td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">선택하신 쿠폰을 자동 지급하지 않습니다.</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="1" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '1') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_auto("1");?></td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">쇼핑몰 신규회원 가입시 자동지급</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="2" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '2') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_auto("2");?></td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">회원 가입시 입력된 생일날자에 매년 자동지급 (미입력시 지급불가)</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="3" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '3') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_auto("3");?></td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">회원 가입후 최초로 구매하였을 때 1회에 한하여 자동지급 (배송완료후 지급)</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="4" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '4') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_auto("4");?></td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">상품평 작성시 마다 복수적으로 자동지급</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td align="center"><input type="radio" name="coupon_auto" value="5" class="radio" <? if ($dmshop_coupon['coupon_auto'] == '5') { echo "checked"; } ?> /></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="text" name="coupon_order_money" value="<?=text($dmshop_coupon['coupon_order_money'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 이상 구매</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2">해당 금액 이상 주문시 마다 복수적으로 자동지급 (배송완료후 지급)</p></td>
    <td></td>
</tr>
<tr><td colspan="7" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="couponSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:14px auto 0 auto;">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 정보를 바탕으로 자동지급이 설정됩니다.</td>
</tr>
</table>
</form>

<div style="height:20px;"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>