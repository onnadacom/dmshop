<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
$shop['title'] = "쿠폰 상세정보";
include_once("$shop[path]/shop.top.php");

if (!$coupon_id) {

    alert_close("쿠폰이 삭제되었거나 존재하지 않습니다.");

}

$dmshop_coupon = shop_coupon($coupon_id);

if (!$dmshop_coupon['id']) {

    alert_close("쿠폰이 삭제되었거나 존재하지 않습니다.");

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.coupon_code {clear:both; width:398px; height:78px; border:1px solid #f0f0f0; overflow:auto; overflow-x:hidden; position:relative;}
.coupon_code div {padding:5px 5px 5px 5px; line-height:21px; font-size:12px; color:#414141; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function couponMove(coupon_id)
{

    document.location.href = "./coupon_view.php?coupon_id="+coupon_id;

}
</script>

<div class="contents_box">
<form method="post" name="formCoupon">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="u" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8"></td></tr>
<tr><td height="1" bgcolor="#eeeeef"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg2">
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td><span class="bigtitle">쿠폰 상세정보</span></td>
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
    <td><span class="tx1">쿠폰 선택</span></td>
    <td width="10"></td>
    <td>
<select id="coupon_id" name="coupon_id" size="1" class="select3" onchange="couponMove(this.value);">
<?
// 쿠폰
$result = sql_query(" select * from $shop[coupon_table] order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".$row['id']."'>".text($row['coupon_title'])."</option>\n";

}
?>
</select>

<script type="text/javascript">
$("#coupon_id").val("<?=$coupon_id?>");
</script>
    </td>
    <td width="10"></td>
    <td width="280"><span class="tx1">상세정보를 열람하실 쿠폰을 선택하세요.</span></td>
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
    <col width="170">
    <col width="1">
    <col width="">
</colgroup>
<tr height="1">
    <td></td>
    <td class="bc1"></td>
    <td></td>
</tr>
<tr>
    <td align="center" class="tx2">미리보기<br>(소스 퍼가기)</td>
    <td class="bc1"></td>
    <td valign="top">
<? if ($dmshop_coupon['coupon_type']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="200">
    <td width="30"></td>
    <td class="tx2">인쇄용은 미리보기가 제공되지 않습니다.</td>
</tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td>
<?
$file = sql_fetch(" select * from $shop[coupon_file_table] where coupon_id = '".$coupon_id."' and upload_mode = 'default' ");

if ($file['upload_file']) {

    $coupon_image = $shop['path']."/data/coupon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

} else {

    $coupon_image = $shop['image_path']."/coupon/".text($dmshop_coupon['coupon_image']).".jpg";

}
?>
<div id="preview_image" style="width:400px; height:140px; background:url('<?=$coupon_image?>') no-repeat;">
<div style="padding:5px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="20">
    <td><p style="margin-left:5px; line-height:13px; font-size:11px; color:#000000; font-family:gulim,굴림;"><?=text($dmshop['shop_name'])?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="76">
    <td width="245"><p style="text-align:right; line-height:50px; font-size:48px; color:#940708; font-family:Arial,gulim,굴림;"><?=number_format($dmshop_coupon['coupon_discount']);?> <?=shop_coupon_discount_type($dmshop_coupon['coupon_discount_type']);?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="26">
    <td>
<p style="text-align:center; line-height:14px; font-size:12px; color:#ffffff; font-family:gulim,굴림;">
<?
// 발급일
if ($dmshop_coupon['coupon_day_type']) {

    echo "발급일로 부터 ".number_format($dmshop_coupon['coupon_day'])." 일간";

} else {
// 고정기간

    echo date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date1']))." 부터 ~ ".date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date2']))." 까지";

}
?>
</p>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td><div class="coupon_code"><div>&lt;script type="text/javascript">var coupon_download_id = "<?=$coupon_id?>";&lt;/script>&lt;script type="text/javascript" src="<?=$shop['url']?>/js/coupon.js">&lt;/script></div></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td class="tx2">해당 소스코드를 복사하여, 상품페이지에 붙여넣기 하세요.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>
<? } ?>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="170">
    <col width="1">
    <col width="">
</colgroup>
<tr height="1">
    <td></td>
    <td class="bc1"></td>
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td class="boxtitle">구분</td>
    <td class="bc1"></td>
    <td class="boxtitle">설정값</td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">쿠폰유형</td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2"><?=shop_coupon_type($dmshop_coupon['coupon_type']);?> 쿠폰</p></td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">쿠폰명</td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2"><?=text($dmshop_coupon['coupon_title'])?></p></td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">발행매수</td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2"><b><?=number_format($dmshop_coupon['coupon_max']);?></b> 매 <span class="tx2">(지급매수 <span class="tx2"><?=number_format($dmshop_coupon['coupon_down']);?></span> 건 / 사용건수 <span class="tx2"><?=number_format($dmshop_coupon['coupon_order']);?></span> 건)</span></p></td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">할인금액</td>
    <td class="bc1"></td>
    <td>
<p style="margin-left:20px;" class="tx2"><b><?=number_format($dmshop_coupon['coupon_discount']);?></b> <?=shop_coupon_discount_type($dmshop_coupon['coupon_discount_type']);?>
<?
// 퍼센트비율, 최대금액
if ($dmshop_coupon['coupon_discount_type'] == '1' && $dmshop_coupon['coupon_discount_max']) {

    echo " <span class='tx2'>(최대할인 금액 <span class='tx2'>".number_format($dmshop_coupon['coupon_discount_max'])."</span> 원)</span>";

}
?>
</p>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">사용조건</td>
    <td class="bc1"></td>
    <td>
<p style="margin-left:20px;" class="tx2">
<?
// 최소금액
if ($dmshop_coupon['coupon_discount_min']) {

    echo number_format($dmshop_coupon['coupon_discount_min'])." 원 이상 구매시";

} else {

    echo "자유이용 쿠폰";

}
?>
</p>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">사용기간</td>
    <td class="bc1"></td>
    <td>
<p style="margin-left:20px;" class="tx2">
<?
// 발급일
if ($dmshop_coupon['coupon_day_type']) {

    echo "발급일로 부터 ".number_format($dmshop_coupon['coupon_day'])." 일간";

} else {
// 고정기간

    echo date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date1']))." 부터 ~ ".date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date2']))." 까지";

}
?>
</p>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">이용 카테고리</td>
    <td class="bc1"></td>
    <td>
<p style="margin-left:20px;" class="tx2">
<?
// 기획전
if ($dmshop_coupon['coupon_category_type']) {

    if ($dmshop_coupon['coupon_plan']) {

        echo text(shop_plan_name($dmshop_coupon['coupon_plan']))." 기획전";

    } else {

        echo "모든 카테고리";

    }

} else {
// 분류

    if ($dmshop_coupon['coupon_category']) {

        echo text(shop_category_name($dmshop_coupon['coupon_category']))." 분류";

    } else {

        echo "모든 카테고리";

    }

}
?>
</p>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">기타 이용제한</td>
    <td class="bc1"></td>
    <td>
<p class="tx2" style="margin:5px 0 5px 20px; line-height:21px;" >
<?
if ($dmshop_coupon['coupon_bank']) {

    echo "- 무통장 입금 전용<br>";

}

if ($dmshop_coupon['coupon_cash']) {

    echo "- 적립금 동시사용 불가<br>";

}

if ($dmshop_coupon['coupon_overlap']) {

    echo "- 중복다운불가<br>";

}

if (!$dmshop_coupon['coupon_bank'] && !$dmshop_coupon['coupon_cash'] && !$dmshop_coupon['coupon_overlap']) {

    echo "없음";

}
?>
</p>
    </td>
</tr>
<tr><td colspan="3" height="1" class="bc1"></td></tr>
<tr height="40">
    <td align="center" class="tx2">자동 지급설정</td>
    <td class="bc1"></td>
    <td><p style="margin-left:20px;" class="tx2"><?=shop_coupon_auto($dmshop_coupon['coupon_auto']);?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close.gif" border="0" /></a></td>
</tr>
</table>
</form>

<div style="height:20px;"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>