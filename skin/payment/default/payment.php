<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.payment_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.payment_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.payment_title .b1 {margin-top:6px;}
.payment_title .b2 {margin-top:7px;}
.payment_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.payment_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.payment_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.payment_all .bg {height:44px; background:url('<?=$dmshop_payment_path?>/img/title_bg.gif') repeat-x;}
.payment_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.payment_all .date {text-align:center; line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.payment_all .time {text-align:center; line-height:14px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.payment_all .view {text-decoration:underline; line-height:14px; font-size:12px; color:#1883e4; font-family:gulim,굴림;}
.payment_all .pay_title {text-align:center; line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.payment_all .money {line-height:15px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}
.payment_all .option {text-align:center; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.payment_all .etc {text-align:center; line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.payment_all .pay_type {line-height:15px; font-size:13px; color:#717171; font-family:gulim,굴림;}
.payment_all .payment {line-height:15px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.payment_all .msg {line-height:15px; font-size:11px; color:#777777; font-family:dotum,돋움;}
.payment_all .dot {height:1px; background:url('<?=$dmshop_payment_path?>/img/dot.gif') repeat-x;}

.payment_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="payment_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_payment_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_payment_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/payment.php' class='off'>개별 결제창</a></td>";
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
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="payment_title">
<tr>
    <td width="9"></td>
    <td width="104" valign="top"><img src="<?=$dmshop_payment_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">회원님 앞으로 발급된 개별(전용) 결제창 입니다. 결제번호를 클릭 하세요.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="payment_all">
<colgroup>
    <col width="110">
    <col width="2">
    <col width="90">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="100">
    <col width="2">
    <col width="110">
    <col width="2">
    <col width="100">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>발급일시</b></td>
    <td><img src="<?=$dmshop_payment_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>결제번호</b></td>
    <td><img src="<?=$dmshop_payment_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>제목</b></td>
    <td><img src="<?=$dmshop_payment_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>결제금액</b></td>
    <td><img src="<?=$dmshop_payment_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>결제상태</b></td>
    <td><img src="<?=$dmshop_payment_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>결제옵션</b></td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="11" class="dot"></td></tr>
<? } ?>
<tr height="74">
    <td><p class="date"><?=date("Y-m-d", strtotime($list[$i]['pay_datetime']));?></p><p class="time"><?=date("H시 i분", strtotime($list[$i]['pay_datetime']));?></p></td>
    <td></td>
    <td align="center"><a href="#" onclick="payPopupView('<?=$list[$i]['pay_code']?>'); return false;" class="view"><?=$list[$i]['pay_code']?></a></td>
    <td></td>
    <td class="pay_title"><?=$list[$i]['pay_title']?></td>
    <td></td>
    <td class="etc"><b class="money"><?=number_format($list[$i]['pay_money']);?></b> 원</td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="pay_type"><?=shop_payment_type($list[$i]['pay_payment']);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="payment"><?=shop_pay_name($list[$i]['pay_type']);?></td>
</tr>
</table>
    </td>
    <td></td>
    <td align="center" class="none">
<? if ($list[$i]['pay_payment'] == '100') { ?>
<? if ($list[$i]['pay_type'] == '5') { ?>
<a href="#" onclick="payPopupView('<?=$list[$i]['pay_code']?>'); return false;"><img src="<?=$dmshop_payment_path?>/img/bank.gif" border="0"></a>
<? } else { ?>
<a href="#" onclick="paymentStart('<?=$list[$i]['pay_code']?>'); return false;"><img src="<?=$dmshop_payment_path?>/img/payment.gif" border="0"></a>
<? } ?>
<? } else { ?>
<p class="date"><?=date("Y-m-d", strtotime($list[$i]['pay_datetime']));?></p>
<p class="option"><?=shop_payment_type($list[$i]['pay_payment']);?></p>
<? } ?>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="11" height="225" align="center"><img src="<?=$dmshop_payment_path?>/img/payment_no.gif"></td></tr>
<? } ?>
<tr><td colspan="11" height="2" bgcolor="#dddddd"></td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:2px solid #f6f6f6; background-color:#dddddd; padding:1px;">
<div style="padding:15px 20px; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="payment_msg">
<tr>
    <td class="t1">
- 개별 결제창은 1:1 문의 또는 전화상담을 통해 접수된 건에 한하여, 회원님께 발급되는 전용 결제 시스템 입니다.<br>
- 반품/교환/주문옵션 변경 시, 발생되는 추가요금 또는 대량상품 구매 등을 목적으로 제공 됩니다.<br>
- 개별 결제창은 결제수단이 지정되어있습니다. 또한 전산상 환불기능이 제공되지 않습니다.<br>
* 결제번호를 클릭하시면, 세부결제내역과 관리자의 전달사항을 확인하실 수 있습니다.<br>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<?
// 키 생성
$robot_mkey1 = substr($shop['time_ymdhis'],17,2);
$robot_mkey2 = rand(10,99);
$robot_mkey3 = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));
$robot_mkey = substr(md5($robot_mkey1.$robot_mkey2.$robot_mkey3),0,10);
?>
<form method="post" name="formPayment" autocomplete="off">
<input type="hidden" name="robot_mkey1" value="<?=$shop['time_ymdhis']?>" />
<input type="hidden" name="robot_mkey2" value="<?=$robot_mkey2?>" />
<input type="hidden" name="robot_mkey3" value="<?=trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));?>" />
<input type="hidden" name="robot_mkey" value="<?=$robot_mkey?>" />
<input type="hidden" name="pay_code" value="" />
</form>

<!--결제처리 위한 iframe start //-->
<iframe id="order_update" name="order_update" width="0" height="0" style="display:none;"></iframe>
<!--결제처리 위한 iframe end //-->

<script type="text/javascript">
function paymentStart(pay_code)
{

    var f = document.formPayment;

    if (confirm("결제 하시겠습니까?")) {

        f.pay_code.value = pay_code;
        f.action = "<?=$pay_url?>";
        //f.target = "order_update";
        f.submit();

    } else {

        return false;

    }

}
</script>

<?
// inicis
if ($dmshop['order_pg'] == '1') {
?>
<script language=javascript src="http://plugin.inicis.com/pay61_uni_cross.js"></script>
<script language=javascript>
kcpTx_install();
</script>
<?
}

// allthegate
else if ($dmshop['order_pg'] == '2') {
?>
<script language=javascript src="http://www.allthegate.com/plugin/AGSWallet_utf8.js"></script>
<script language="javascript">
kcpTx_install(); 
</script>
<?
}

// kcp
else if ($dmshop['order_pg'] == '3') {
include_once("$shop[path]/pay/kcp/cfg/site_conf_inc.php");
?>
<script type="text/javascript" src="<?=$g_conf_js_url?>"></script>
<script type="text/javascript">
kcpTx_install();
</script>
<?
}

// kicc
else if ($dmshop['order_pg'] == '4') {
?>

<?
}

// lgu+
else if ($dmshop['order_pg'] == '5') {
?>

<?
}
?>