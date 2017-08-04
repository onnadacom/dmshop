<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
?>
<div style="padding:5px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="20">
    <td><p style="margin-left:5px; line-height:13px; font-size:11px; color:#000000; font-family:gulim,굴림;"><?=text($dmshop['shop_name'])?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="76">
    <td width="245"><p style="text-align:right; line-height:50px; font-size:48px; color:#940708; font-family:Arial,gulim,굴림;"><?=number_format($_POST['coupon_discount']);?> <?=shop_coupon_discount_type($_POST['coupon_discount_type']);?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="26">
    <td>
<p style="text-align:center; line-height:14px; font-size:12px; color:#ffffff; font-family:gulim,굴림;">
<?
// 발급일
if ($_POST['coupon_day_type']) {

    echo "발급일로 부터 ".number_format((int)($_POST['coupon_day']))." 일간";

} else {
// 고정기간

    echo date("Y년 m월 d일", strtotime($_POST['coupon_date1']))." 부터 ~ ".date("Y년 m월 d일", strtotime($_POST['coupon_date2']))." 까지";

}
?>
</p>
    </td>
</tr>
</table>
</div>