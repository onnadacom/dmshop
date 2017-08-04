<?
if (!defined('_DMSHOP_')) exit;

$colspan = 12;
?>
<style type="text/css">
/* 분류 */
.order_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.order_top .bg {height:79px; background:url('<?=$dmshop_order_path?>/img/top_bg.gif') repeat-x;}

.order_title .bg1 {width:2px; height:30px; background:url('<?=$dmshop_order_path?>/img/title_bg1.gif') no-repeat;}
.order_title .bg2 {height:30px; background:url('<?=$dmshop_order_path?>/img/title_bg2.gif') repeat-x;}
.order_title .bg3 {width:2px; background:url('<?=$dmshop_order_path?>/img/title_bg3.gif') no-repeat;}

.order_bank .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.order_bank .t2 {font-weight:bold; line-height:15px; font-size:13px; color:#cc1414; font-family:gulim,굴림;}
.order_bank .t3 {line-height:14px; font-size:11px; color:#000000; font-family:dotum,돋움;}
.order_bank .t4 {line-height:16px; font-size:11px; color:#f26c4f; font-family:dotum,돋움;}
.order_bank a.t5 {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_bank a.t5:hover {line-height:14px; font-size:11px; color:#787878; font-family:gulim,굴림;}

.order_bank .sms_bg {width:164px; height:154px; background:url('<?=$dmshop_order_path?>/img/sms_bg.gif') no-repeat;}
.order_bank .sms_bg textarea {overflow:hidden; width:100px; height:88px; border:0px; margin:auto; background-color:#d9f3ff; text-align:left;}
.order_bank .sms_bg textarea {line-height:14px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.order_bank .sms_bg .sms1 {line-height:14px; font-size:12px; color:#709bae; font-family:dotum,돋움;}
.order_bank .sms_bg .sms2 {line-height:14px; font-size:12px; color:#709bae; font-family:dotum,돋움; letter-spacing:-1px;}
.order_bank .input {width:102px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_bank .input {line-height:17px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_bank .help {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}

.order_list .title {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.order_list .money {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .delivery1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.order_list .delivery2 {line-height:18px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .limit {line-height:16px; font-size:12px; color:#555555; font-family:dotum,돋움;}
.order_list .coupon {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .coupon_msg {line-height:16px; font-size:12px; color:#fe6e1a; font-family:dotum,돋움;}
.order_list .total {font-weight:bold; line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.order_list .line_w {height:1px; background-color:#d6d6d6;}
.order_list .line_h {width:1px; background-color:#efefef;}

.order_bank_title .bg {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}
.order_addr_title .bg {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}
.order_pay_title .bg {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}

.order_addr .text {line-height:19px; font-size:12px; color:#787878; font-family:dotum,돋움;}

.order_pay .pay_bg {width:250px; height:50px; background:url('<?=$dmshop_order_path?>/img/pay_bg.gif') no-repeat;}
.order_pay .money {font-weight:bold; line-height:28px; font-size:26px; color:#ffffff; font-family:Tahoma,dotum,gulim;}
.order_pay .title {line-height:14px; font-size:12px; color:#727272; font-family:dotum,돋움;}
.order_pay .title2 {line-height:14px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_pay .m1 {font-weight:bold; line-height:14px; font-size:12px; color:#727272; font-family:dotum,돋움;}
.order_pay .m2 {line-height:14px; font-size:12px; color:#727272; font-family:dotum,돋움;}
.order_pay .m3 {line-height:14px; font-size:12px; color:#fe6e1a; font-family:dotum,돋움;}
.order_pay .m4 {font-weight:bold; line-height:14px; font-size:12px; color:#006aff; font-family:dotum,돋움;}

.order_help .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<script type="text/javascript" src="<?=$dmshop_order_path?>/order.js"></script>

<div id="order_ok_update" style="display:none;"></div>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_position">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_path."/img/arrow.gif' class='up1'></td>";
echo "<td><span class='off'>주문결과 확인</span></td>";
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_top">
<tr>
    <td width="4"><img src="<?=$dmshop_order_path?>/img/top_bg_side1.gif"></td>
    <td width="599"><img src="<?=$dmshop_order_path?>/img/top_bg_title2.gif"></td>
    <td class="bg none">&nbsp;</td>
    <td width="4"><img src="<?=$dmshop_order_path?>/img/top_bg_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<? if ($dmshop_order['order_pay_type'] == '4') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/order_msg4.gif"></td>
</tr>
</table>
<? } else if ($dmshop_order['order_pay_type'] == '5') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/order_msg5.gif"></td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/order_msg2.gif"></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<!-- 무통장/가상계좌 start //-->
<? if ($dmshop_order['order_pay_type'] == '4' || $dmshop_order['order_pay_type'] == '5') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_bank_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_bank_<?=$dmshop_order['order_pay_type']?>.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<?
// sms 1
$shop_sms_config = shop_sms_config("order_bank_self");

$sms_message = $shop_sms_config['sms_message'];
$sms_message = str_replace("[주문번호]", $order_code, $sms_message);
$sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
$sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
$sms_message = str_replace("[은행명]", $dmshop_order['order_bank_name'], $sms_message);
$sms_message = str_replace("[계좌]", $dmshop_order['order_bank_number'], $sms_message);
$sms_message = str_replace("[예금주]", $dmshop_order['order_bank_holder'], $sms_message);
$sms_message = str_replace("[입금자명]", $dmshop_order['order_dep_name'], $sms_message);
$sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
$sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

$count = shop_order_etc_count($order_code);

if ($count) {

    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

} else {

    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_bank">
<tr>
    <td width="1" bgcolor="#d6d6d6"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_bank_name.gif"></td>
    <td class="t1"><?=text($dmshop_order['order_bank_name'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_bank_code.gif"></td>
    <td class="t1"><?=text($dmshop_order['order_bank_number'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_bank_holder.gif"></td>
    <td class="t1"><?=text($dmshop_order['order_bank_holder'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<? if ($dmshop_order['order_pay_type'] == '5') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_dep_name2.gif"></td>
    <td class="t1"><?=text($dmshop_order['order_dep_name'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1" bgcolor="#ebebeb"><td></td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_bank_pay_money.gif"></td>
    <td class="t2"><?=number_format($dmshop_order['order_pay_money']);?> 원</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<? if ($dmshop_order['order_pay_type'] == '4') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10">
    <td width="10"></td>
    <td class="t3">본 입금계좌는 고객님의 전용계좌로서 입금자명을 따로 확인하지 않습니다.<br>해당 계좌에 입금시, 실시간으로 전산처리가 이루어 지집니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10">
    <td width="10"></td>
    <td class="t4"><?=text($dmshop['order_bank_day'])?>일 이내, 미 입금시 본 주문건은 자동으로 취소 됩니다.</td>
</tr>
</table>
    </td>
    <td width="30"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="45"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20" bgcolor="#f7f7f7" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#f7f7f7">
    <td width="50"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/internet_bank.gif"></td>
</tr>
</table>
    </td>
    <td width="20"></td>
    <td width="1" bgcolor="#d9d9d9"></td>
    <td width="20"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100"><a href="http://www.kbstar.com/" target="_blank" class="t5">KB국민은행</a></td>
    <td width="100"><a href="http://www.hanabank.com/" target="_blank" class="t5">하나은행</a></td>
    <td width="100"><a href="http://www.nonghyup.com/" target="_blank" class="t5">농협</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100"><a href="http://www.wooribank.com/" target="_blank" class="t5">우리은행</a></td>
    <td width="100"><a href="http://www.keb.co.kr/" target="_blank" class="t5">외환은행</a></td>
    <td width="100"><a href="http://www.kfcc.co.kr/" target="_blank" class="t5">새마을금고</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100"><a href="http://www.shinhan.com/" target="_blank" class="t5">신한은행</a></td>
    <td width="100"><a href="http://www.scfirstbank.com/" target="_blank" class="t5">SC제일은행</a></td>
    <td width="100"><a href="http://www.epostbank.go.kr/" target="_blank" class="t5">우체국</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100"><a href="http://www.ibk.co.kr/" target="_blank" class="t5">기업은행</a></td>
    <td width="100"><a href="http://www.citibank.co.kr/" target="_blank" class="t5">씨티은행</a></td>
    <td width="100"><a href="http://www.kdb.co.kr/" target="_blank" class="t5">산업은행</a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20" bgcolor="#f7f7f7" class="none">&nbsp;</td></tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
<? if ($shop_sms_config['sms_use']) { ?>
    <td width="300" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="32"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/title_sms.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="sms_bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><textarea name='sms_message' id='sms_message' cols="16" onkeyup="shopByte('sms_message', 'sms_message_byte');"><?=$sms_message?></textarea></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><span class="sms1"><span id="sms_message_byte">0</span> / 80 <span class="sms2">바이트</span></span></td>
</tr>
</table>

<script type="text/javascript">
setTimeout("shopByte('sms_message', 'sms_message_byte');", 100);
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_order_path?>/img/title_hp1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" id="sms_hp1" name="sms_hp1" value="" class="input" /></td>
    <td width="10"></td>
    <td class="help">예) 010-1234-5678</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_order_path?>/img/title_hp2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" id="sms_hp2" name="sms_hp2" value="<?=text($dmshop_user['user_hp'])?>" class="input" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="smsSelfSend('<?=$order_code?>'); return false;"><img src="<?=$dmshop_order_path?>/img/sms_send.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>
    </td>
    <td width="32"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<!-- 무통장/가상계좌 end //-->
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<!-- 타이틀 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_title">
<tr>
    <td class="bg1"></td>
    <td class="bg2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="6"></td>
    <td align="center"><img src="<?=$dmshop_order_path?>/img/title_item2.gif"></td>
    <td width="1"></td>
    <td width="60" align="center"><img src="<?=$dmshop_order_path?>/img/title_limit.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_order_path?>/img/title_money.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_order_path?>/img/title_coupon.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_order_path?>/img/title_total.gif"></td>
    <td width="1"></td>
    <td width="90" align="center"><img src="<?=$dmshop_order_path?>/img/title_delivery.gif"></td>
</tr>
</table>
    </td>
    <td class="bg3"></td>
</tr>
</table>
<!-- 타이틀 end //-->

<!-- 리스트 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<colgroup>
    <col width="6">
    <col width="">
    <col width="1">
    <col width="60">
    <col width="1">
    <col width="110">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
</colgroup>
<?
$item_delivery_bunch = false;

for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_order_path."/img/noimage.gif"; }
?>
<tr>
    <td></td>
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

<? if ($list[$i]['option_id']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
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
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$dmshop_order_path?>/img/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="limit" align="center"><?=$list[$i]['order_limit']?></td>
    <td class="line_h"></td>
    <td class="money" align="center"><?=number_format($list[$i]['order_item_money'])?> 원</td>
    <td class="line_h"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="coupon"><? if ($list[$i]['order_coupon']) { echo "- ".number_format($list[$i]['order_coupon'])." 원<br><span class='coupon_msg'>쿠폰할인</span>"; } else { echo "없음"; } ?></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="total" align="center"><?=number_format($list[$i]['order_total_money']);?> 원</td>
    <td class="line_h"></td>
    <td class="money" align="center">
<?
if ($list[$i]['order_delivery_type'] == 2) {

    echo "<span class='delivery2'>";

    if ($list[$i]['order_delivery_pay']) {

        echo "착불<br />";

    } else {

        echo "선결제<br />";

    }

    echo number_format($list[$i]['order_real_delivery'])." 원<br />";

    echo "묶음배송불가";

    echo "</span>";

} else {

    echo "<span class='delivery2'>";

    if ($dmshop_order['order_total_item_money'] >= $dmshop_order['delivery_money_free']) {

        echo "묶음배송무료<br />";

    } else {

        if (!$item_delivery_bunch) {

            if ($order_delivery_pay) {

                echo "선결제<br />";

            } else {

                echo "착불<br />";

            }

            echo number_format($dmshop_order['delivery_money'])." 원<br />";

        }

        echo "묶음배송";

        $item_delivery_bunch = true;

    }

    echo "</span>";

}
?></td>
</tr>
<tr><td colspan="<?=$colspan?>" class="line_w"></td></tr>
<? } ?>
</table>
<!-- 리스트 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<!-- 배송지정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_rec.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr">
<tr height="310">
    <td width="1" bgcolor="#d6d6d6"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_rec_name.gif"></td>
    <td class="text"><?=text($dmshop_order['order_rec_name'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_addr.gif"></td>
    <td class="text">(우:<?=text($dmshop_order['order_rec_zip1'])?><?=text($dmshop_order['order_rec_zip2'])?>)<?=text($dmshop_order['order_rec_addr1'])?><br><?=text($dmshop_order['order_rec_addr2'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_mobile.gif"></td>
    <td class="text"><?=text($dmshop_order['order_rec_hp'])?> / <?=text($dmshop_order['order_rec_tel'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow4.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_memo.gif"></td>
    <td class="text"><?=text($dmshop_order['order_memo'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ebebeb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>
    </td>
    <td width="30"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<!-- 배송지정보 end //-->
    </td>
    <td width="2"></td>
    <td width="314" valign="top">
<!-- 결제정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_pay_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_payment.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_pay">
<tr height="310">
    <td width="1" bgcolor="#d6d6d6"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="32"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/title_money_ok.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="250" border="0" cellspacing="0" cellpadding="0" class="pay_bg">
<tr>
    <td align="center"><span class="money"><?=number_format($dmshop_order['order_pay_money']);?> 원</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="border:2px solid #d6d6d6;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="12" bgcolor="#f4f4f4"></td>
    <td width="73" bgcolor="#f4f4f4" class="title">상품금액</td>
    <td align="right" class="m1"><?=number_format($dmshop_order['order_total_item_money']);?> 원</td>
    <td width="10"></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#d6d6d6"></td></tr>
<tr height="31">
    <td width="12" bgcolor="#f4f4f4"></td>
    <td width="73" bgcolor="#f4f4f4" class="title">배송비</td>
    <td align="right" class="m2">
<?
echo number_format($dmshop_order['order_delivery_money'])." 원";
?></td>
    <td width="10"></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#d6d6d6"></td></tr>
<tr height="31">
    <td width="12" bgcolor="#f4f4f4"></td>
    <td width="73" bgcolor="#f4f4f4" class="title">할인금액</td>
    <td align="right" class="m3"><? if ($dmshop_order['order_total_coupon']) { echo "- ".number_format($dmshop_order['order_total_coupon']); } else { echo "0"; } ?> 원</td>
    <td width="10"></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#d6d6d6"></td></tr>
<tr height="31">
    <td width="12" bgcolor="#f4f4f4"></td>
    <td width="73" bgcolor="#f4f4f4" class="title">적립금 할인</td>
    <td align="right" class="m3"><? if ($dmshop_order['order_cash']) { echo "- ".number_format($dmshop_order['order_cash']); } else { echo "0"; } ?> 원</td>
    <td width="10"></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#d6d6d6"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="border:2px solid #cbd8e9;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="12" bgcolor="#dbeaff"></td>
    <td width="73" bgcolor="#dbeaff" class="title2">결제수단</td>
    <td bgcolor="#eff5ff" align="right" class="m4"><?=shop_pay_name($dmshop_order['order_pay_type']);?></td>
    <td width="10" bgcolor="#eff5ff"></td>
</tr>
</table>
</div>
    </td>
    <td width="32"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<!-- 결제정보 end //-->
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#6b6b6b" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="<?=$shop['url']?>"><img src="<?=$dmshop_order_path?>/img/home.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="<?=$shop['https_url']?>/mypage.php"><img src="<?=$dmshop_order_path?>/img/mypage.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto order_help">
<tr>
    <td>
<div style="padding:20px 68px; border:1px solid #d6d6d6;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">주문하신 상품은 마이페이지에서 확인/수정 하실 수 있습니다.</td>
</tr>
</table>

<? if ($_POST['order_pay_type'] == '4' || $_POST['order_pay_type'] == '5') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="6"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">가상계좌 또는 무통장 입금 후 <?=$dmshop['order_bank_day']?>일 이내, 미입금 시 주문건은 자동 취소 됩니다.</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>