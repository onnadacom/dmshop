<?php
include_once("./_dmshop.php");
if ($pay_code) { $pay_code = preg_match("/^[a-zA-Z0-9]+$/", $pay_code) ? $pay_code : ""; }
$shop['title'] = "개별결제 내역서";
include_once("$shop[path]/shop.top.php");

$colspan = "9";

if (!$pay_code) {

    alert_close("주문내역이 존재하지 않습니다.");

}

$dmshop_payment = shop_payment_code($pay_code);

if (!$dmshop_payment['id']) {

    alert_close("개별결제 내역이 존재하지 않습니다.");

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#ffffff;}
</style>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="detail_bg">
    <td width="15"></td>
    <td width="11"><img src="<?=$shop['image_path']?>/adm/arrow.gif" class="up2"></td>
    <td><span style="font-weight:bold; line-height:37px; font-size:14px; color:#ffffff; font-family:gulim,굴림;">개별결제 내역서</span></td>
    <td width="80"><a href="#" onclick="dataPrint(); return false;"><img src="<?=$shop['image_path']?>/adm/print.gif" border="0"></a></td>
    <td width="5"></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<div id="print_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="75">
    <td align="center"><span style="text-decoration:underline; font-weight:bold; line-height:26px; font-size:24px; color:#010101; font-family:gulim,굴림;">개별결제 내역서</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span style="font-weight:bold; line-height:16px; font-size:13px; color:#010101; font-family:gulim,굴림;">■ 회원(수령) 정보</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#414141" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">성명(수령자 성명)</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=text($dmshop_payment['user_name'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">주소 (배송지)</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;">(우: <?=text($dmshop_payment['user_zip1'])?><?=text($dmshop_payment['user_zip2'])?>) <?=text($dmshop_payment['user_addr1'])?> <?=text($dmshop_payment['user_addr2'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">휴대폰 / 전화</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=text($dmshop_payment['user_hp'])?> / <?=text($dmshop_payment['user_tel'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">결제금액 / 수단</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=number_format($dmshop_payment['pay_money']);?> 원 / <?=shop_pay_name($dmshop_payment['pay_type']);?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">결제정보</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=shop_payment_type($dmshop_payment['pay_payment']);?><? if ($dmshop_payment['pay_ok_datetime'] != '0000-00-00 00:00:00') { echo " (".$dmshop_payment['pay_ok_datetime'].")"; } ?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150"><span style="font-weight:bold; line-height:16px; font-size:13px; color:#010101; font-family:gulim,굴림;">■ 관리자 전달 메세지</span></td>
    <td align="right"><span style="line-height:16px; font-size:11px; color:#010101; font-family:gulim,굴림;">결제번호 : <?=$pay_code?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#414141" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;"><?=text2($dmshop_payment['pay_memo'], 0);?></span></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#414141">
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span style="line-height:16px; font-size:12px; color:#ffffff; font-family:gulim,굴림;"><?=text($dmshop['shop_name'])?> | <?=text($dmshop['domain'])?><br>(우:<?=text($dmshop['zip1'])?><?=text($dmshop['zip2'])?>) <?=text($dmshop['addr1'])?> <?=text($dmshop['addr2'])?></span></td>
    <td width="300" align="right"><span style="line-height:16px; font-size:12px; color:#ffffff; font-family:gulim,굴림;">전화 : <?=text($dmshop['number1'])?>-<?=text($dmshop['number2'])?>-<?=text($dmshop['number3'])?><? if ($dmshop['fax1'] && $dmshop['fax2'] && $dmshop['fax3']) { ?> | 팩스 : <?=text($dmshop['fax1'])?>-<?=text($dmshop['fax2'])?>-<?=text($dmshop['fax3'])?><? } ?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
</div>

</div>

<script type="text/javascript">
var tmp;

function dataPrint()
{

    beforePrint();

    window.print();

    setTimeout("afterPrint();", 1000);

}

function beforePrint()
{

    tmp = document.body.innerHTML;

    document.body.innerHTML = document.getElementById("print_data").innerHTML;

}

function afterPrint()
{

    document.body.innerHTML = tmp;

}
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>