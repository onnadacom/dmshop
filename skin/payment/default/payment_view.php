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
.top_bg {height:45px; background:url('<?=$dmshop_payment_path?>/img/top_bg.gif') repeat-x;}

.payment_list .title {text-align:center; background-color:#f7f7f7; font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.payment_list .text {margin-left:15px; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_payment_path?>/img/title.png" class="png"></td>
    <td width="200" align="right" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top"><a href="#" onclick="dataPrint(); return false;"><img src="<?=$dmshop_payment_path?>/img/print.png" class="png" border="0"></a></td>
    <td width="2"></td>
    <td valign="top"><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_payment_path?>/img/close.png" class="png" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<div id="print_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"></td>
    <td>
<!-- 회원정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_payment_path?>/img/v_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_payment_path?>/img/v_t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="payment_list">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="150">
    <col width="1">
    <col width="148">
    <col width="1">
    <col width="">
</colgroup>
<tr height="30">
    <td class="title">성명 (수령자)</td>
    <td bgcolor="#e4e4e4"></td>
    <td><p class="text"><?=text($dmshop_payment['user_name'])?></p></td>
    <td bgcolor="#e4e4e4"></td>
    <td class="title">결제번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td><p class="text"><?=text($dmshop_payment['pay_code'])?></p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<tr height="30">
    <td class="title">휴대폰</td>
    <td bgcolor="#e4e4e4"></td>
    <td><p class="text"><?=text($dmshop_payment['user_hp'])?></p></td>
    <td bgcolor="#e4e4e4"></td>
    <td class="title">전화번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td><p class="text"><?=text($dmshop_payment['user_tel'])?></p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<tr height="30">
    <td class="title">주소 (배송지)</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="5"><p class="text">(우: <?=text($dmshop_payment['user_zip1'])?><?=text($dmshop_payment['user_zip2'])?>) <?=text($dmshop_payment['user_addr1'])?> <?=text($dmshop_payment['user_addr2'])?></p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<tr height="30">
    <td class="title">결제금액/수단</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="5"><p class="text"><?=number_format($dmshop_payment['pay_money']);?> 원 / <?=shop_pay_name($dmshop_payment['pay_type']);?></p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<? if ($dmshop_payment['pay_type'] == '4' || $dmshop_payment['pay_type'] == '5') { ?>
<tr height="30">
    <td class="title">입금은행</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="5"><p class="text"><?=text($dmshop_payment['pay_bank_name'])?> <?=text($dmshop_payment['pay_bank_number'])?> (예금주 : <?=text($dmshop_payment['pay_bank_holder'])?>)</p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<? } ?>
<tr height="30">
    <td class="title">결제정보</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="5"><p class="text"><?=shop_payment_type($dmshop_payment['pay_payment']);?><? if ($dmshop_payment['pay_ok_datetime'] != '0000-00-00 00:00:00') { echo " (".$dmshop_payment['pay_ok_datetime'].")"; } ?></p></td>
</tr>
<tr><td colspan="7" bgcolor="#e4e4e4" height="1"></td></tr>
<tr height="30">
    <td class="title">영수증</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="5">
<p class="text">
<?
// 영수증 버튼
$receipt_btn = str_replace("btn", "<img src='".$dmshop_payment_path."/img/receipt_btn.gif' border='0'>", shop_payment_receipt_btn($dmshop_payment['pay_code']));
echo $receipt_btn;
?>
</p>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 회원정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 메세지 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_payment_path?>/img/v_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_payment_path?>/img/v_t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
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
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 메세지 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

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