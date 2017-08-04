<?
if (!defined('_DMSHOP_')) exit;

$colspan = 12;
?>
<style type="text/css">
.order_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.order_top .bg {height:79px; background:url('<?=$dmshop_order_path?>/img/top_bg.gif') repeat-x;}

.order_message .title {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.order_title .bg1 {width:2px; height:30px; background:url('<?=$dmshop_order_path?>/img/title_bg1.gif') no-repeat;}
.order_title .bg2 {height:30px; background:url('<?=$dmshop_order_path?>/img/title_bg2.gif') repeat-x;}
.order_title .bg3 {width:2px; background:url('<?=$dmshop_order_path?>/img/title_bg3.gif') no-repeat;}

.order_list .title {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.order_list .money {line-height:18px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .delivery1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
.order_list .delivery2 {line-height:18px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .limit {line-height:16px; font-size:12px; color:#555555; font-family:dotum,돋움;}
.order_list .coupon {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .coupon_msg {line-height:16px; font-size:12px; color:#fe6e1a; font-family:dotum,돋움;}
.order_list .total {font-weight:bold; line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.order_list .line_w {height:1px; background-color:#d6d6d6;}
.order_list .line_h {width:1px; background-color:#efefef;}

.order_cart .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.order_cash .cash {font-weight:bold; line-height:17px; font-size:12px; color:#3197f0; font-family:dotum,돋움;}
.order_cash .input {width:52px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_cash .input {font-weight:bold; line-height:17px; font-size:12px; color:#3197f0; font-family:dotum,돋움;}

.order_sum.bg {height:88px; background:url('<?=$dmshop_order_path?>/img/bg.gif') no-repeat;}
.order_sum .money1 {font-weight:bold; line-height:28px; font-size:26px; color:#626262; font-family:Tahoma,dotum,gulim;}
.order_sum .money2 {font-weight:bold; line-height:28px; font-size:26px; color:#cc1414; font-family:Tahoma,dotum,gulim;}
.order_sum .won1 {font-weight:bold; line-height:15px; font-size:13px; color:#787878; font-family:gulim,굴림;}
.order_sum .won2 {font-weight:bold; line-height:15px; font-size:13px; color:#cc1414; font-family:gulim,굴림;}
.order_sum .sign {margin-top:18px;}

.order_buy_title .bg {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}
.order_buy .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_buy .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_buy .input2 {width:342px; height:19px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_buy .input2 {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_buy .hyphen {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_buy .title {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.order_buy .help {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.order_addr_title .bg {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}
.order_addr .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_addr .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_addr .input2 {width:342px; height:19px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_addr .input2 {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_addr .hyphen {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_addr .textarea  {padding:3px; width:342px; height:40px; border:1px solid #c9c9c9;}
.order_addr .textarea  {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.order_addr .title {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.order_addr .user {line-height:17px; font-size:12px; color:#787878; font-family:dotum,돋움;}

.order_pay_title {height:35px; background:url('<?=$dmshop_order_path?>/img/title_bg.gif') repeat-x;}

.order_pay .pay_bg {width:250px; height:50px; background:url('<?=$dmshop_order_path?>/img/pay_bg.gif') no-repeat;}
.order_pay .money {font-weight:bold; line-height:28px; font-size:26px; color:#ffffff; font-family:Tahoma,dotum,gulim;}
.order_pay .title {line-height:14px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_pay .message {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}

.order_pay .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_pay .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_pay .input2 {background-color:#f0f3fa; width:110px; height:17px; border:1px solid #bdc1cb; padding:1px 3px 0px 3px;}
.order_pay .input2 {line-height:17px; font-size:12px; color:#000000; font-family:gulim,굴림;}

.order_pay .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.order_pay .selectBox-dropdown {width:120px; height:19px;}
.order_pay .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.order_help .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".order_pay select").selectBox();
});
</script>

<div id="order_data" style="display:none;"></div>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_position">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_path."/img/arrow.gif' class='up1'></td>";
echo "<td><span class='off'>주문/결제</span></td>";
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
    <td width="610"><img src="<?=$dmshop_order_path?>/img/top_bg_title.gif"></td>
    <td class="bg none">&nbsp;</td>
    <td width="4"><img src="<?=$dmshop_order_path?>/img/top_bg_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_message">
<tr height="40">
    <td class="title">주문상품 목록을 확인 > 적립금 적용 > 배송정보 입력 > 결제수단 선택 순으로 진행 합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

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
    <td align="center"><img src="<?=$dmshop_order_path?>/img/title_item.gif"></td>
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
<script type="text/javascript">
// 쿠폰 업데이트 (주문 테이블로 재전송)
function cartCouponUpdate()
{

    var f = document.formCoupon;

    f.action = "<?=$shop['path']?>/order.php";
    f.submit();

}
</script>

<?
// 키 생성
$robot_mkey1 = substr($shop['time_ymdhis'],17,2);
$robot_mkey2 = rand(10,99);
$robot_mkey3 = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));
$robot_mkey = substr(md5($robot_mkey1.$robot_mkey2.$robot_mkey3),0,10);

$ss_name = "order_".rand(100000,999999);

if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

}
?>
<form method="post" name="formCoupon">
<input type="hidden" name="m" value="all" />
<? for ($i=0; $i<count($list); $i++) { ?>
<input type="hidden" name="chk_id[]" value="<?=$i?>" />
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<? } ?>
</form>

<form method="post" name="formOrder" autocomplete="off">
<input type="hidden" name="ss_name" value="<?=$ss_name?>" />
<input type="hidden" name="robot_mkey1" value="<?=$shop['time_ymdhis']?>" />
<input type="hidden" name="robot_mkey2" value="<?=$robot_mkey2?>" />
<input type="hidden" name="robot_mkey3" value="<?=trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));?>" />
<input type="hidden" name="robot_mkey" value="<?=$robot_mkey?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="order_receipt_name" value="" />
<input type="hidden" name="order_receipt_number" value="" />
<input type="hidden" id="order_delivery_money" name="order_delivery_money" value="<?=$order_delivery_money?>" />
<input type="hidden" id="order_total_money" name="order_total_money" value="<?=$order_total_money?>" />
<input type="hidden" id="order_total_item_money" name="order_total_item_money" value="<?=$order_total_item_money?>" />
<input type="hidden" id="order_total_coupon" name="order_total_coupon" value="<?=$order_total_coupon?>" />
<input type="hidden" id="order_pay_money" name="order_pay_money" value="0" />
<input type="submit" value="ok" disabled style="display:none;" />
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
<input type="hidden" name="chk_id[]" value="<?=$i?>" />
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
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

<? if ($list[$i]['order_option']) { ?>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="cartCoupon('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_order_path?>/img/coupon.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="total" align="center"><?=number_format($list[$i]['order_total_money']);?> 원</td>
    <td class="line_h"></td>
    <td class="money" align="center">
<?
if ($list[$i]['delivery_type'] == 2) {

    echo "<span class='delivery2'>";

    if ($list[$i]['order_delivery_pay']) {

        echo "착불<br />";

    } else {

        echo "선결제<br />";

    }

    echo number_format($list[$i]['item_delivery'])." 원<br />";

    echo "묶음배송불가";

    echo "</span>";

} else {

    echo "<span class='delivery2'>";

    if ($order_total_item_money >= $dmshop['delivery_money_free']) {

        echo "묶음배송무료<br />";

    } else {

        if (!$item_delivery_bunch) {

            if ($order_delivery_pay) {

                echo "선결제<br />";

            } else {

                echo "착불<br />";

            }

            echo number_format($dmshop['delivery_money'])." 원<br />";

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

<table border="0" cellspacing="0" cellpadding="0" class="order_cart">
<tr height="34">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/cart.php"><img src="<?=$dmshop_order_path?>/img/cart.gif" border="0"></a></td>
    <td width="10"></td>
    <td class="title">주문상품의 변경과 쿠폰을 적용하고자 하신다면 장바구니로 돌아가 다시 진행하시기 바랍니다.</td>
</tr>
</table>

<!-- 적립금사용 start //-->
<? if ($shop_user_login && $dmshop['payment_type6']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_cash">
<tr height="40" bgcolor="#f5f5f5">
    <td width="20"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/title_cash.gif"></td>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/title_user_cash.gif"></td>
    <td width="10"></td>
    <td><span class="cash"><?=number_format($dmshop_user['user_cash']);?> P</span></td>
    <td width="20"></td>
    <td><img src="<?=$dmshop_order_path?>/img/title_order_cash.gif"></td>
    <td width="10"></td>
    <td><input type="text" id="order_cash" name="order_cash" class="input" value="0" onkeyup="orderCheck();" /></td>
    <td width="3"></td>
    <td><img src="<?=$dmshop_order_path?>/img/title_cash_p.gif"></td>
    <td width="10"></td>
    <td><a href="#" onclick="orderCash(); return false;"><img src="<?=$dmshop_order_path?>/img/cash_all.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
<? } ?>
<!-- 적립금사용 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<!-- 결제금액합산 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_sum bg">
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
    <td><img src="<?=$dmshop_order_path?>/img/sum_money.gif"></td>
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
    <td width="50" align="center"><img src="<?=$dmshop_order_path?>/img/sign1.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_order_path?>/img/sum_delivery.gif"></td>
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
    <td width="50" align="center"><img src="<?=$dmshop_order_path?>/img/sign2.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_order_path?>/img/sum_coupon.gif"></td>
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
<? if ($shop_user_login && $dmshop['payment_type6']) { ?>
    <td width="50" align="center"><img src="<?=$dmshop_order_path?>/img/sign2.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_order_path?>/img/sum_cash.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span id="order_cash_view" class="money1">0</span></td>
    <td width="5"></td>
    <td><span class="won1">원</span></td>
</tr>
</table>
    </td>
<? } ?>
    <td width="50" align="center"><img src="<?=$dmshop_order_path?>/img/sign3.gif" class="sign"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="14">
    <td><img src="<?=$dmshop_order_path?>/img/sum_total.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span id="order_total_money_view" class="money2"><?=number_format($order_total_money);?></span></td>
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
<!-- 결제금액합산 end //-->

<!-- 주문자정보 start //-->
<?
// 회원
if ($shop_user_login) {
?>
<input type="hidden" name="order_name" value="<?=text($dmshop_user['user_name'])?>" />
<input type="hidden" name="order_email" value="<?=text($dmshop_user['user_email'])?>" />
<input type="hidden" name="order_tel1" value="<?=text($order_rec_tel1)?>" />
<input type="hidden" name="order_tel2" value="<?=text($order_rec_tel2)?>" />
<input type="hidden" name="order_tel3" value="<?=text($order_rec_tel3)?>" />
<input type="hidden" name="order_hp1" value="<?=text($order_rec_hp1)?>" />
<input type="hidden" name="order_hp2" value="<?=text($order_rec_hp2)?>" />
<input type="hidden" name="order_hp3" value="<?=text($order_rec_hp3)?>" />
<input type="hidden" name="order_zip1" value="<?=text($dmshop_user['user_zip1'])?>" />
<input type="hidden" name="order_zip2" value="<?=text($dmshop_user['user_zip2'])?>" />
<input type="hidden" name="order_addr1" value="<?=text($dmshop_user['user_addr1'])?>" />
<input type="hidden" name="order_addr2" value="<?=text($dmshop_user['user_addr2'])?>" />
<?
} else {
// 비회원
?>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="60">
    <td><img src="<?=$dmshop_order_path?>/img/arrow2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_buy_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_buy.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_buy">
<tr>
    <td width="1" bgcolor="#d6d6d6"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td width="460" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_buy_name.gif"></td>
    <td><input type="text" name="order_name" value="<?=$dmshop_user['user_name']?>" class="input" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10" valign="top" style="padding-top:8px;"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100" valign="top" style="padding-top:6px;"><img src="<?=$dmshop_order_path?>/img/order_addr.gif"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_zip1" value="<?=text($dmshop_user['user_zip1'])?>" readonly class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_zip2" value="<?=text($dmshop_user['user_zip2'])?>" readonly class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formOrder', 'order_zip1', 'order_zip2', 'order_addr1', 'order_addr2'); return false;"><img src="<?=$dmshop_order_path?>/img/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_addr1" value="<?=text($dmshop_user['user_addr1'])?>" readonly class="input2" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_addr2" value="<?=text($dmshop_user['user_addr2'])?>" class="input2" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_hp.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_hp1" value="<?=text($order_rec_hp1)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_hp2" value="<?=text($order_rec_hp2)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_hp3" value="<?=text($order_rec_hp3)?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_tel.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_tel1" value="<?=text($order_rec_tel1)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_tel2" value="<?=text($order_rec_tel2)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_tel3" value="<?=text($order_rec_tel3)?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_email.gif"></td>
    <td><input type="text" name="order_email" value="<?=$dmshop_user['user_email']?>" class="input" style="width:137px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_password.gif"></td>
    <td><input type="password" name="order_password" value="" class="input" /></td>
    <td width="10"></td>
    <td class="help">상품주문내역 / 배송 조회시 사용하실 비밀번호 입력</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 주문자정보 end //-->

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="60">
    <td><img src="<?=$dmshop_order_path?>/img/arrow2.gif"></td>
</tr>
</table>

<!-- 배송정보입력 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_addr.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr">
<tr>
    <td width="1" bgcolor="#d6d6d6"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td width="460" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_addr_type.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($shop_user_login) { ?>
    <td><input type="radio" name="addr_type" value="0" checked onclick="orderAddr('insert');" /></td>
    <td width="5"></td>
    <td class="title">기본주소</td>
    <td width="10"></td>
    <td><input type="radio" name="addr_type" value="1" onclick="orderAddr('reset');" /></td>
    <td width="5"></td>
    <td class="title">새로입력</td>
<? } else { ?>
    <td><input type="checkbox" name="addr_type" value="1" onclick="orderAddr2();" /></td>
    <td width="5"></td>
    <td class="title">주문자 정보와 동일 (자동입력)</td>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_rec_name.gif"></td>
    <td><input type="text" name="order_rec_name" value="<?=$dmshop_user['user_name']?>" class="input" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10" valign="top" style="padding-top:8px;"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100" valign="top" style="padding-top:6px;"><img src="<?=$dmshop_order_path?>/img/order_addr.gif"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_zip1" value="<?=text($dmshop_user['user_zip1'])?>" readonly class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_zip2" value="<?=text($dmshop_user['user_zip2'])?>" readonly class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formOrder', 'order_rec_zip1', 'order_rec_zip2', 'order_rec_addr1', 'order_rec_addr2'); return false;"><img src="<?=$dmshop_order_path?>/img/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr1" value="<?=text($dmshop_user['user_addr1'])?>" readonly class="input2" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr2" value="<?=text($dmshop_user['user_addr2'])?>" class="input2" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_hp.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_hp1" value="<?=text($order_rec_hp1)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp2" value="<?=text($order_rec_hp2)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp3" value="<?=text($order_rec_hp3)?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100"><img src="<?=$dmshop_order_path?>/img/order_tel.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_tel1" value="<?=text($order_rec_tel1)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel2" value="<?=text($order_rec_tel2)?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel3" value="<?=text($order_rec_tel3)?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10" valign="top" style="padding-top:6px;"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td width="100" valign="top" style="padding-top:4px;"><img src="<?=$dmshop_order_path?>/img/order_memo.gif"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="order_memo" name="order_memo" class="textarea" onkeyup="orderByte('order_memo', 'order_memo_byte');"></textarea></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="title">( <span id="order_memo_byte">0</span> / 120byte)</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
<? if ($shop_user_login) { ?>
    <td width="25"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="20"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="<?=$dmshop_order_path?>/img/arrow3.gif"></td>
    <td><img src="<?=$dmshop_order_path?>/img/order_name.gif"></td>
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/signup_check.php" target="_blank"><img src="<?=$dmshop_order_path?>/img/user_edit.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<div style="padding:0 0 0 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><b><?=text($dmshop_user['user_name'])?></b></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><?=text($dmshop_user['user_addr1'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><?=text($dmshop_user['user_addr2'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><?=text($dmshop_user['user_hp'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><?=text($dmshop_user['user_tel'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="user"><?=text($dmshop_user['user_emil'])?></td>
</tr>
</table>
</div>
    </td>
<? } ?>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<!-- 배송정보입력 end //-->

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="60">
    <td><img src="<?=$dmshop_order_path?>/img/arrow2.gif"></td>
</tr>
</table>

<!-- 결제수단선택 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_pay_title">
<tr>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side1.gif"></td>
    <td class="bg" align="center"><img src="<?=$dmshop_order_path?>/img/title_pay.gif"></td>
    <td width="5"><img src="<?=$dmshop_order_path?>/img/title_side2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_pay">
<tr>
    <td width="1" bgcolor="#d6d6d6"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="80" bgcolor="#f5f5f5">
    <td width="144" align="center"><img src="<?=$dmshop_order_path?>/img/title_pay_money.gif"></td>
    <td>
<table width="250" border="0" cellspacing="0" cellpadding="0" class="pay_bg">
<tr>
    <td align="center"><span id="order_pay_money_view" class="money">0 원</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="144" align="center"><img src="<?=$dmshop_order_path?>/img/title_pay_type.gif"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop['payment_type1']) { ?>
    <td><input type="radio" name="order_pay_type" value="1" class="radio" checked onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td class="title"><?=shop_pay_name("1");?></td>
    <td width="15"></td>
<? } ?>
<? if ($dmshop['payment_type2']) { ?>
    <td><input type="radio" name="order_pay_type" value="2" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td class="title"><?=shop_pay_name("2");?></td>
    <td width="15"></td>
<? } ?>
<? if ($dmshop['payment_type3']) { ?>
    <td><input type="radio" name="order_pay_type" value="3" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td class="title"><?=shop_pay_name("3");?></td>
    <td width="15"></td>
<? } ?>
<? if ($dmshop['payment_type4']) { ?>
    <td><input type="radio" name="order_pay_type" value="4" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td class="title"><?=shop_pay_name("4");?></td>
    <td width="15"></td>
<? } ?>
<? if ($dmshop['payment_type5']) { ?>
    <td><input type="radio" name="order_pay_type" value="5" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td class="title"><?=shop_pay_name("5");?></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span id="order_pay_message" class="message"><font color="#6d71d0">[신용카드]</font> 온라인상에서 소유하신 신용카드를 통해, 전자결제를 진행 합니다.</span></td>
</tr>
</table>

<div id="order_pay_bank" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="500" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #d6d6d6;">
<div style="border:1px solid #ffffff; background-color:#fbfbfb;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="40">
    <td width="25"></td>
    <td><img src="<?=$dmshop_order_path?>/img/order_dep_name.gif"></td>
    <td width="20"></td>
    <td><input type="text" name="order_dep_name" value="<?=text($dmshop_user['user_name'])?>" class="input" style="width:92px;" /></td>
    <td width="50"></td>
    <td><img src="<?=$dmshop_order_path?>/img/order_receipt.gif"></td>
    <td width="20"></td>
    <td>
<select id="order_receipt" name="order_receipt" onchange="orderReceipt(this.value);" class="select">
    <option value="0"><?=shop_receipt_name("0");?></option>
    <option value="1"><?=shop_receipt_name("1");?></option>
    <option value="2"><?=shop_receipt_name("2");?></option>
</select>
    </td>
</tr>
</table>
</div>
</div>

<div id="order_receipt_layer1" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="35" bgcolor="#fbfbfb">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="28"></td>
    <td><img src="<?=$dmshop_order_path?>/img/order_receipt_type.gif"></td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="0" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="title">휴대폰</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="1" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="title">주민등록번호</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="2" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="title">현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div id="order_receipt_type_layer0" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="title">이름</td>
    <td width="15"></td>
    <td><input type="text" id="tmp0_order_receipt_name" value="<?=text($dmshop_user['user_name'])?>" class="input2" style="width:110px;" /></td>
    <td width="30"></td>
    <td class="title">휴대폰</td>
    <td width="15"></td>
    <td><input type="text" id="tmp0_order_receipt_number" value="<? echo str_replace("-", "", text($dmshop_user['user_hp'])); ?>" class="input2" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer1" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="title">이름</td>
    <td width="15"></td>
    <td><input type="text" id="tmp1_order_receipt_name" value="<?=text($dmshop_user['user_name'])?>" class="input2" style="width:110px;" /></td>
    <td width="30"></td>
    <td class="title">주민등록번호</td>
    <td width="15"></td>
    <td><input type="text" id="tmp1_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="title">이름</td>
    <td width="15"></td>
    <td><input type="text" id="tmp2_order_receipt_name" value="<?=text($dmshop_user['user_name'])?>" class="input2" style="width:110px;" /></td>
    <td width="30"></td>
    <td class="title">현금영수증카드 번호</td>
    <td width="15"></td>
    <td><input type="text" id="tmp2_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="40">
    <td class="message">번호 입력시 하이픈 (-)을 제외한 숫자만 입력하세요.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
</div>

<div id="order_receipt_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="35" bgcolor="#fbfbfb">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="28"></td>
    <td><img src="<?=$dmshop_order_path?>/img/order_receipt_type.gif"></td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="3" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="title">사업자번호</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="4" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="title">현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div id="order_receipt_type_layer3" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="title">이름</td>
    <td width="15"></td>
    <td><input type="text" id="tmp3_order_receipt_name" value="<?=text($dmshop_user['user_name'])?>" class="input2" style="width:110px;" /></td>
    <td width="30"></td>
    <td class="title">사업자등록 번호</td>
    <td width="15"></td>
    <td><input type="text" id="tmp3_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer4" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="title">이름</td>
    <td width="15"></td>
    <td><input type="text" id="tmp4_order_receipt_name" value="<?=text($dmshop_user['user_name'])?>" class="input2" style="width:110px;" /></td>
    <td width="30"></td>
    <td class="title">현금영수증카드 번호</td>
    <td width="15"></td>
    <td><input type="text" id="tmp4_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="40">
    <td class="message">번호 입력시 하이픈 (-)을 제외한 숫자만 입력하세요.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
</div>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
    </td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d6d6d6" class="none">&nbsp;</td></tr>
</table>
<!-- 결제수단선택 end //-->

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
    <td><a href="<?=$shop['https_url']?>/cart.php"><img src="<?=$dmshop_order_path?>/img/cart_go.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="orderSave(); return false;"><img src="<?=$dmshop_order_path?>/img/order_pay.gif" border="0"></a></td>
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
    <td class="title">결제하기 버튼을 클릭하여, 선택하신 결제수단으로 결제를 진행해 주시기 바랍니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="6"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">처음 구매시, 결제를 위해 회원님의 PC에 전자결제 모듈이 설치를 진행해 주세요.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="6"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_path?>/img/dot.gif" class="up1"></td>
    <td width="5"></td>
    <td class="title">결제결과는 이 후, 주문완료 페이지에서 확인 가능 합니다.</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</form>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<!--결제처리 위한 iframe start //-->
<iframe id="order_update" name="order_update" width="0" height="0" style="display:none;"></iframe>
<!--결제처리 위한 iframe end //-->

<script type="text/javascript">
var user_cash_use = "<? if ($shop_user_login && $dmshop['payment_type6']) { echo "1"; } ?>";
var user_cash = parseInt("<?=(int)($dmshop_user['user_cash']);?>");
var order_cash_min = parseInt("<?=(int)($dmshop['order_cash_min']);?>");
var order_total_money = parseInt("<?=(int)($order_total_money);?>");
var order_card_percent = parseFloat("<?=($dmshop['order_card_percent'] * 0.01);?>");
var order_mobile_percent = parseFloat("<?=($dmshop['order_mobile_percent'] * 0.01);?>");
</script>

<script type="text/javascript">
var order_rec_name = "<?=text($dmshop_user['user_name'])?>";
var order_rec_zip1 = "<?=text($dmshop_user['user_zip1'])?>";
var order_rec_zip2 = "<?=text($dmshop_user['user_zip2'])?>";
var order_rec_addr1 = "<?=text($dmshop_user['user_addr1'])?>";
var order_rec_addr2 = "<?=text($dmshop_user['user_addr2'])?>";
var order_rec_hp1 = "<?=text($order_rec_hp1)?>";
var order_rec_hp2 = "<?=text($order_rec_hp2)?>";
var order_rec_hp3 = "<?=text($order_rec_hp3)?>";
var order_rec_tel1 = "<?=text($order_rec_tel1)?>";
var order_rec_tel2 = "<?=text($order_rec_tel2)?>";
var order_rec_tel3 = "<?=text($order_rec_tel3)?>";
</script>

<script type="text/javascript">
var order_coupon_bank = "<?=$order_coupon_bank?>";
var order_coupon_cash = "<?=$order_coupon_cash?>";
</script>

<script type="text/javascript">
var order_pay_url = "<?=$order_pay_url?>";
</script>

<script type="text/javascript" src="<?=$dmshop_order_path?>/order.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    orderByte('order_memo', 'order_memo_byte');
    orderCheck();
    orderPayTypeLoad();
});
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
include_once("$shop[path]/pay/kicc/inc/easypay_config.php");
?>
<script type="text/javascript" src="<?=$g_gw_js_url?>"></script>
<script type="text/javascript">
StartSmartInstall();
</script>
<?
}

// lgu+
else if ($dmshop['order_pg'] == '5') {
?>

<?
}
?>