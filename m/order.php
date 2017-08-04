<?php
include_once("./_dmshop.php");

// 회원만 주문가능하다면
if (!$dmshop['order_guest_use'] && !$shop_user_login) {

    // 로그인 이동 후 장바구니로
    shop_url("signin.php?url=".urlencode("cart.php"));

}

/*
if ($shop_user_login) {

    // 보유한 적립금이 마이너스다
    if ($dmshop_user['user_cash'] < '0') {

        message("<p class='title'>알림</p><p class='text'>보유한 적립금이 ".number_format($dmshop_user['user_cash'])."원입니다. 마이너스일 경우에는 주문할 수 없습니다. 고객센터로 문의하여주시기 바랍니다.</p>", "b");

    }

}
*/

// 주문시간
$order_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_bank_day'] * 86400));

// 미승인 주문내역삭제
sql_query(" delete from $shop[order_table] where order_payment = '0' and order_datetime <= '$order_datetime' ");

if (!$dmshop['payment_type1'] && !$dmshop['payment_type2'] && !$dmshop['payment_type3'] && !$dmshop['payment_type4'] && !$dmshop['payment_type5']) {

    message("<p class='title'>알림</p><p class='text'>결제수단이 선택/등록되어 있지 않습니다.<br />관리자 모드 > 환경설정 > 전자결제(PG) 메뉴를 통해 PG사 정보와 \"이용 결제수단\"을 체크하시기 바랍니다.</p>", "b");

}

// 주문
if ($m == '' || $m == 'all') {

    // 개별주문 처리
    if ($m == '' && $cart_id) {

        // 초기화
        unset($chk_id);
        unset($cart_id);

        $chk_id[0] = 0;
        $cart_id[0] = addslashes($_POST['cart_id']);

    }

    // 상품이 없을경우
    if (count($chk_id) == '0') {

        shop_url("{$shop['mobile_url']}/cart.php");

    }

} else {

    shop_url("{$shop['mobile_url']}/cart.php");

}

// 비회원
if (!$shop_user_login) {

    $guest_id = "";
    $guest_id = shop_get_cookie("dmshop_cart");

    if (!$guest_id) {

        message("<p class='title'>알림</p><p class='text'>주문하는 도중 장바구니의 상품이 삭제되었습니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

    }

}

// 가격 초기화
$order_total_item_money = 0;
$order_total_coupon = 0;
$order_delivery_money = 0;
$order_total_money = 0;

// 묶음배송
$delivery_money_free = false;

// 쿠폰
$order_coupon_bank = false;
$order_coupon_cash = false;

// 상품
$list = array();
for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // 장바구니 정보
    $row = shop_cart($cart_id[$k]);

    // 장바구니에 상품이 없다면
    if (!$row['id']) {

        message("<p class='title'>알림</p><p class='text'>주문하는 도중 장바구니의 상품이 삭제되었습니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

    }

    $list[$i] = $row;

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>주문하는 도중 상품이 삭제되었습니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 판매중지
    else if ($dmshop_item['item_use'] == '1') {

        message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품은 판매가 중지되었습니다.</p>", "b");

    }

    // 품절
    else if ($dmshop_item['item_use'] == '2') {

        message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품은 품절되었습니다.</p>", "b");

    }

    // 숨김
    else if ($dmshop_item['item_use'] == '3') {

        message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", "b");

    } else {

        // 통과

    }

    // 회원
    if ($shop_user_login) {

        if ($dmshop_user['user_id'] != $row['user_id']) {

            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품은 내 장바구니에 담긴 상품이 아닙니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

        }

    } else {

        if ($guest_id != $row['guest_id']) {

            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품은 내 장바구니에 담긴 상품이 아닙니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션 가격 문구 초기화
    $option_money = "";

    // 옵션
    if ($row['order_option']) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($row['order_option']);

        // 옵션이 삭제되었다.
        if (!$dmshop_item_option['id']) {

            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품의 옵션정보가 변경되었습니다. 새로고침 또는 해당 상품을 장바구니에서 삭제하신 후 다시 주문하여 주시기 바랍니다.</p>", "b");

        }

        if ($dmshop_item_option['option_money'] > '0') {

            $option_money = " (+".number_format($dmshop_item_option['option_money'])."원)";

        }

        else if ($row['option_money'] < '0') {

            $option_money = " (".number_format($dmshop_item_option['option_money'])."원)";

        } else {

            $option_money = "";

        }

        // 옵션재고 부족
        if ($dmshop_item_option['option_limit'] < $row['order_limit']) {

            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품의 ".text($dmshop_item_option['option_name'])." 재고수량은 {$dmshop_item_option['option_limit']}개 입니다. 수량을 확인하신 후 다시 주문하시기 바랍니다.</p>", "b");

        }

    } else {
    // 일반

        // 재고 부족
        if ($dmshop_item['item_limit'] < $row['order_limit']) {
    
            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item['item_title'])." 상품의 재고수량은 {$dmshop_item_option['option_limit']}개 입니다. 수량을 확인하신 후 다시 주문하시기 바랍니다.</p>", "b");

        }

    }

    // 쿠폰 설정
    if ($row['order_coupon_id']) {

        // 쿠폰 데이터
        $dmshop_coupon_list = shop_coupon_list($row['order_coupon_id']);

        // 무통장만 가능
        if ($dmshop_coupon_list['coupon_bank']) {

            // 쿠폰
            $order_coupon_bank = true;

        }

        // 적립금 사용불가
        if ($dmshop_coupon_list['coupon_cash']) {

            // 쿠폰
            $order_coupon_cash = true;

        }

    }

    // 옵션 금액이 없다면
    if (!$dmshop_item_option['option_money']) {

        // 옵션 가격 초기화(옵션이 없을경우를 처리)
        $dmshop_item_option['option_money'] = 0;

    }

    // 판매 가격 (옵션가격 포함)
    $order_item_money = ($dmshop_item['item_money'] * $row['order_limit']) + ((int)($dmshop_item_option['option_money']) * $row['order_limit']);

    // 판매가 합계
    $order_total_item_money += $order_item_money;

    // 쿠폰 합계
    $order_total_coupon += $row['order_coupon'];

    // 기타 설정
    $list[$i]['item_code'] = $dmshop_item['item_code']; // 상품코드
    $list[$i]['item_title'] = $dmshop_item['item_title']; // 상품제목
    $list[$i]['option_name'] = $dmshop_item_option['option_name']; // 옵션명
    $list[$i]['option_money'] = $option_money; // 옵션금액
    $list[$i]['order_item_money'] = $order_item_money; // 옵션포함 상품가격
    $list[$i]['item_delivery'] = $dmshop_item['item_delivery']; // 배송비
    $list[$i]['item_delivery_bunch'] = $dmshop_item['item_delivery_bunch']; // 묶음배송

    // 배송비
    if ($list[$i]['item_delivery']) {

        // 묶음배송
        if ($list[$i]['item_delivery_bunch']) {

            $delivery_money_free = true;

            $list[$i]['item_delivery'] = 0;
            $list[$i]['delivery_type'] = 1;

        } else {
        // 묶음배송이 아니다면 추가배송비

            $order_delivery_money += $list[$i]['item_delivery'];
            $list[$i]['item_delivery'] = $list[$i]['item_delivery'];
            $list[$i]['delivery_type'] = 2;

        }

    } else {

            $delivery_money_free = true;

        $list[$i]['item_delivery'] = 0;
        $list[$i]['delivery_type'] = 0;

    }

    $list[$i]['order_total_money'] = ($order_item_money + $list[$i]['item_delivery']) - $row['order_coupon']; // 옵션포함상품가, 배송비, 쿠폰적용 (해당 상품의 결제가격이다)

}

if ($i) {

    // 판매가 합계가 무료배송비 미만
    if ($delivery_money_free && $order_total_item_money < $dmshop['delivery_money_free']) {

        // 기본 배송비
        $order_delivery_money += $dmshop['delivery_money'];

    }

    // 결제 총액 (옵션포함 총 판매가격 - 총 쿠폰가격 + 배송비)
    $order_total_money = ($order_total_item_money - $order_total_coupon) + $order_delivery_money;

}

// 연락처 처리
$order_rec_hp1 = "";
$order_rec_hp2 = "";
$order_rec_hp3 = "";

$order_rec_tel1 = "";
$order_rec_tel2 = "";
$order_rec_tel3 = "";

if ($dmshop_user['user_hp']) {

    $user_hp = explode("-", trim($dmshop_user['user_hp']));
    for ($i=0; $i<count($user_hp); $i++) {

        if ($user_hp[$i]) {

            $order_rec_hp1 = $user_hp[0];
            $order_rec_hp2 = $user_hp[1];
            $order_rec_hp3 = $user_hp[2];

        }

    }

}

if ($dmshop_user['user_tel']) {

    $user_tel = explode("-", trim($dmshop_user['user_tel']));
    for ($i=0; $i<count($user_tel); $i++) {

        if ($user_tel[$i]) {

            $order_rec_tel1 = $user_tel[0];
            $order_rec_tel2 = $user_tel[1];
            $order_rec_tel3 = $user_tel[2];

        }

    }

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 주문/결제";
include_once("./_top.php");
?>
<style type="text/css">
.conts .main {padding:5px 10px 10px 10px;}
.conts .main .text {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

#order_cash {width:52px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
#order_cash {font-weight:bold; line-height:17px; font-size:12px; color:#3197f0; font-family:dotum,돋움;}

.conts .main .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.conts .main .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.conts .main .input2 {width:220px; height:19px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.conts .main .input2 {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.conts .main .textarea {padding:3px; width:220px; height:40px; border:1px solid #c9c9c9;}
.conts .main .textarea {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.conts .main .hyphen {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.conts .main .step {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.conts .main .help {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.conts .main .money {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

#zip_data {display:none; width:100%; height:500px; z-index:10000; position:absolute; left:0; top:0;}
</style>

<div id="order_data" style="display:none;"></div>
<div id="zip_data"></div>

<!-- 리스트 start //-->
<script type="text/javascript">
// 쿠폰 업데이트 (주문 테이블로 재전송)
function cartCouponUpdate()
{

    var f = document.formCoupon;

    f.action = "<?=$shop['mobile_url']?>/m/order.php";
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
<form method="post" name="formCoupon"><input type="hidden" name="m" value="<?=$_POST['m']?>" /><? if (count($list) > '1') { ?><? for ($i=0; $i<count($list); $i++) { ?><input type="hidden" name="chk_id[]" value="<?=$i?>" /><input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" /><? } ?><? } else { ?><input type="hidden" name="cart_id" value="<?=$_POST['cart_id']?>" /><? } ?></form>
<form method="post" name="formOrder" autocomplete="off">
<input type="hidden" name="ss_name" value="<?=$ss_name?>" />
<input type="hidden" name="robot_mkey1" value="<?=$shop['time_ymdhis']?>" />
<input type="hidden" name="robot_mkey2" value="<?=$robot_mkey2?>" />
<input type="hidden" name="robot_mkey3" value="<?=trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));?>" />
<input type="hidden" name="robot_mkey" value="<?=$robot_mkey?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$_POST['m']?>" />
<input type="hidden" name="order_receipt_name" value="" />
<input type="hidden" name="order_receipt_number" value="" />
<input type="hidden" id="order_delivery_money" name="order_delivery_money" value="<?=$order_delivery_money?>" />
<input type="hidden" id="order_total_money" name="order_total_money" value="<?=$order_total_money?>" />
<input type="hidden" id="order_total_item_money" name="order_total_item_money" value="<?=$order_total_item_money?>" />
<input type="hidden" id="order_total_coupon" name="order_total_coupon" value="<?=$order_total_coupon?>" />
<input type="hidden" id="order_pay_money" name="order_pay_money" value="0" />
<input type="submit" value="ok" disabled style="display:none;" />
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $shop['mobile_url']."/img/noimage.gif"; }
?>
<input type="hidden" name="chk_id[]" value="<?=$i?>" />
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px; border:1px solid #eeeeee;" class="text">
<tr>
    <td width="84" valign="top"><div style="border:1px solid #e0e0e0; width:82px; height:82px;"><a href="item.php?id=<?=$list[$i]['item_code']?>"><img src="<?=$thumb?>" width="82" height="82" border="0"></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<a href="item.php?id=<?=$list[$i]['item_code']?>" class="title"><?=$list[$i]['item_title']?></a>
<?
if ($list[$i]['delivery_type'] == 2) {

    echo " (묶음배송불가)";

}
?>
    </td>
</tr>
</table>

<? if ($list[$i]['order_option']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>옵션 : <?=$list[$i]['option_name']?><?=$list[$i]['option_money']?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>수량 : <?=$list[$i]['order_limit']?>개 / <?=number_format($list[$i]['order_item_money'])?> 원</td>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>
<!-- 리스트 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td align="right"><a href="cart.php"><img src="<?=$shop['mobile_url']?>/img/cart.gif" border="0"></a></td>
</tr>
</table>

<!-- 적립금사용 start //-->
<? if ($shop_user_login && $dmshop['payment_type6']) { ?>
<div style="margin-top:30px; border:1px solid #eeeeee;" class="text">
<div style="background-color:#f5f5f5; padding:5px 10px 3px 10px;">

<b class="step">적립금 사용</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">내 적립금</td>
    <td width="5"></td>
    <td><span class="cash"><?=number_format($dmshop_user['user_cash']);?>원</span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">사용할 적립금</td>
    <td width="5"></td>
    <td><input type="text" id="order_cash" name="order_cash" value="0" onkeyup="orderCheck();" /></td>
    <td width="3"></td>
    <td>원</td>
    <td width="10"></td>
    <td><a href="#" onclick="orderCash(); return false;"><img src="<?=$shop['mobile_url']?>/img/cash_all.gif" align="absmiddle" border="0"></a></td>
</tr>
</table>
</div>
</div>
<? } ?>
<!-- 적립금사용 end //-->

<!-- 결제금액합산 start //-->
<div style="margin-top:30px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">할인혜택 내용</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">주문금액</td>
    <td><?=number_format($order_total_item_money);?>원</td>
</tr>
<tr>
    <td width="80">배송비</td>
    <td><?=number_format($order_delivery_money);?>원</td>
</tr>
<tr>
    <td>쿠폰할인</td>
    <td><?=number_format($order_total_coupon);?>원</td>
</tr>
<? if ($shop_user_login && $dmshop['payment_type6']) { ?>
<tr>
    <td>적립금 사용</td>
    <td><span id="order_cash_view">0</span>원</td>
</tr>
<? } ?>
<tr>
    <td>결제금액</td>
    <td><span id="order_total_money_view"><?=number_format($order_total_money);?></span>원</td>
</tr>
</table>
</div>
</div>
<!-- 결제금액합산 end //-->

<!-- 주문자정보 start //-->
<?
// 회원
if ($shop_user_login) {
?>
<input type="hidden" name="order_name" value="<?=$dmshop_user['user_name']?>" />
<input type="hidden" name="order_email" value="<?=$dmshop_user['user_email']?>" />
<input type="hidden" name="order_tel1" value="<?=$order_rec_tel1?>" />
<input type="hidden" name="order_tel2" value="<?=$order_rec_tel2?>" />
<input type="hidden" name="order_tel3" value="<?=$order_rec_tel3?>" />
<input type="hidden" name="order_hp1" value="<?=$order_rec_hp1?>" />
<input type="hidden" name="order_hp2" value="<?=$order_rec_hp2?>" />
<input type="hidden" name="order_hp3" value="<?=$order_rec_hp3?>" />
<input type="hidden" name="order_zip1" value="<?=$dmshop_user['user_zip1']?>" />
<input type="hidden" name="order_zip2" value="<?=$dmshop_user['user_zip2']?>" />
<input type="hidden" name="order_addr1" value="<?=$dmshop_user['user_addr1']?>" />
<input type="hidden" name="order_addr2" value="<?=$dmshop_user['user_addr2']?>" />
<?
} else {
// 비회원
?>
<div style="margin-top:30px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">주문자 정보입력</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">주문자명</td>
    <td><input type="text" name="order_name" value="<?=$dmshop_user['user_name']?>" class="input" /></td>
</tr>
<tr>
    <td width="80">주소</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_zip1" value="<?=$dmshop_user['user_zip1']?>" readonly class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_zip2" value="<?=$dmshop_user['user_zip2']?>" readonly class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="zipOpen('order'); return false;"><img src="<?=$shop['mobile_url']?>/img/find_addr.gif" align="absmiddle" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_addr1" value="<?=$dmshop_user['user_addr1']?>" readonly class="input2" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_addr2" value="<?=$dmshop_user['user_addr2']?>" class="input2" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">휴대폰번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_hp1" value="<?=$order_rec_hp1?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_hp2" value="<?=$order_rec_hp2?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_hp3" value="<?=$order_rec_hp3?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">전화번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_tel1" value="<?=$order_rec_tel1?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_tel2" value="<?=$order_rec_tel2?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_tel3" value="<?=$order_rec_tel3?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">이메일</td>
    <td><input type="text" name="order_email" value="<?=$dmshop_user['user_email']?>" class="input" style="width:137px;" /></td>
</tr>
<tr>
    <td width="80">비밀번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="password" name="order_password" value="" class="input" style="width:60px;"  /></td>
    <td width="10"></td>
    <td class="help">주문조회에 사용할 비밀번호</td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
<? } ?>
<!-- 주문자정보 end //-->

<!-- 배송정보입력 start //-->
<div style="margin-top:30px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">배송지 정보입력</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">선택</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($shop_user_login) { ?>
    <td><input type="radio" name="addr_type" value="0" checked onclick="orderAddr('insert');" /></td>
    <td width="5"></td>
    <td>기본주소</td>
    <td width="10"></td>
    <td><input type="radio" name="addr_type" value="1" onclick="orderAddr('reset');" /></td>
    <td width="5"></td>
    <td>새로입력</td>
<? } else { ?>
    <td><input type="checkbox" name="addr_type" value="1" onclick="orderAddr2();" /></td>
    <td width="5"></td>
    <td>주문자 정보와 동일 (자동입력)</td>
<? } ?>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">수령자명</td>
    <td><input type="text" name="order_rec_name" value="<?=$dmshop_user['user_name']?>" class="input" /></td>
</tr>
<tr>
    <td width="80">주소</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_zip1" value="<?=$dmshop_user['user_zip1']?>" readonly class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_zip2" value="<?=$dmshop_user['user_zip2']?>" readonly class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="zipOpen('order_rec'); return false;"><img src="<?=$shop['mobile_url']?>/img/find_addr.gif" align="absmiddle" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr1" value="<?=$dmshop_user['user_addr1']?>" readonly class="input2" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr2" value="<?=$dmshop_user['user_addr2']?>" class="input2" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">휴대폰번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_hp1" value="<?=$order_rec_hp1?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp2" value="<?=$order_rec_hp2?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp3" value="<?=$order_rec_hp3?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">전화번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_tel1" value="<?=$order_rec_tel1?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel2" value="<?=$order_rec_tel2?>" maxlength="4" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel3" value="<?=$order_rec_tel3?>" maxlength="4" class="input" style="width:27px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td width="80">배송요구사항</td>
    <td><textarea id="order_memo" name="order_memo" class="textarea" onkeyup="orderByte('order_memo', 'order_memo_byte');"></textarea><br />(<span id="order_memo_byte">0</span> / 120byte)</td>
</tr>
</table>
</div>
</div>
<!-- 배송정보입력 end //-->

<!-- 결제수단선택 start //-->
<div style="margin-top:30px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">결제수단 선택</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">결제금액</td>
    <td><span id="order_pay_money_view" class="money">0 원</span></td>
</tr>
<tr>
    <td width="80">결제수단</td>
    <td>
<? if ($dmshop['payment_type1']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" id="order_pay_type1" name="order_pay_type" value="1" class="radio" checked onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td onclick="$('#order_pay_type1').attr('checked', true); orderPayType(1);"><?=shop_pay_name("1");?></td>
</tr>
</table>
<? } ?>
<? if ($dmshop['payment_type2']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" id="order_pay_type2" name="order_pay_type" value="2" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td onclick="$('#order_pay_type2').attr('checked', true); orderPayType(2);"><?=shop_pay_name("2");?></td>
</tr>
</table>
<? } ?>
<? if ($dmshop['payment_type3']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" id="order_pay_type3" name="order_pay_type" value="3" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td onclick="$('#order_pay_type3').attr('checked', true); orderPayType(3);"><?=shop_pay_name("3");?></td>
</tr>
</table>
<? } ?>
<? if ($dmshop['payment_type4']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" id="order_pay_type4" name="order_pay_type" value="4" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td onclick="$('#order_pay_type4').attr('checked', true); orderPayType(4);"><?=shop_pay_name("4");?></td>
</tr>
</table>
<? } ?>
<? if ($dmshop['payment_type5']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" id="order_pay_type5" name="order_pay_type" value="5" class="radio" onclick="orderPayType(this.value);" /></td>
    <td width="5"></td>
    <td onclick="$('#order_pay_type5').attr('checked', true); orderPayType(5);"><?=shop_pay_name("5");?></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>

<!-- bank start //-->
<div id="order_pay_bank" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입금자명</td>
    <td><input type="text" name="order_dep_name" value="<?=$dmshop_user['user_name']?>" class="input" style="width:92px;" /></td>
</tr>
<tr>
    <td width="80">현금영수증</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="order_receipt" name="order_receipt" onchange="orderReceipt(this.value);" class="select">
    <option value="0"><?=shop_receipt_name("0");?></option>
    <option value="1"><?=shop_receipt_name("1");?></option>
    <option value="2"><?=shop_receipt_name("2");?></option>
</select>
    </td>
</tr>
</table>
    </td>
</tr>
</table>

<!-- receipt1 start //-->
<div id="order_receipt_layer1" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">방식</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt_type" value="0" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td>휴대폰</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="2" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td>현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<div id="order_receipt_type_layer0" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입력</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60">이름</td>
    <td><input type="text" id="tmp0_order_receipt_name" value="<?=$dmshop_user['user_name']?>" class="input2" style="width:100px;" /></td>
</tr>
<tr>
    <td width="60">휴대폰</td>
    <td><input type="text" id="tmp0_order_receipt_number" value="<? echo str_replace("-", "", $dmshop_user['user_hp']); ?>" class="input2" style="width:100px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer1" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입력</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60">이름</td>
    <td><input type="text" id="tmp1_order_receipt_name" value="<?=$dmshop_user['user_name']?>" class="input2" style="width:110px;" /></td>
</tr>
<tr>
    <td width="60">주민번호</td>
    <td><input type="text" id="tmp1_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입력</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">이름</td>
    <td><input type="text" id="tmp2_order_receipt_name" value="<?=$dmshop_user['user_name']?>" class="input2" style="width:110px;" /></td>
</tr>
<tr>
    <td width="90">현금영수증카드</td>
    <td><input type="text" id="tmp2_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80"></td>
    <td>하이픈 (-)을 제외한 숫자만 입력하세요.</td>
</tr>
</table>
</div>
<!-- receipt1 end //-->

<!-- receipt2 start //-->
<div id="order_receipt_layer2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">방식</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt_type" value="3" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td>사업자번호</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt_type" value="4" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td>현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<div id="order_receipt_type_layer3" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입력</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">이름</td>
    <td><input type="text" id="tmp3_order_receipt_name" value="<?=$dmshop_user['user_name']?>" class="input2" style="width:110px;" /></td>
</tr>
<tr>
    <td width="90">사업자등록번호</td>
    <td><input type="text" id="tmp3_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer4" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">입력</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="90">이름</td>
    <td><input type="text" id="tmp4_order_receipt_name" value="<?=$dmshop_user['user_name']?>" class="input2" style="width:110px;" /></td>
</tr>
<tr>
    <td width="90">현금영수증카드</td>
    <td><input type="text" id="tmp4_order_receipt_number" value="" class="input2" style="width:110px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80"></td>
    <td>하이픈 (-)을 제외한 숫자만 입력하세요.</td>
</tr>
</table>
</div>
<!-- receipt2 start //-->

</div>
<!-- bank end //-->

</div>
</div>
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
    <td><a href="#" onclick="orderSave(); return false;"><img src="<?=$shop['mobile_url']?>/img/order_pay.gif" border="0"></a></td>
</tr>
</table>
</form>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<script type="text/javascript">
var user_cash_use = "<? if ($shop_user_login && $dmshop['payment_type6']) { echo "1"; } ?>";
var user_cash = parseInt("<?=(int)($dmshop_user['user_cash']);?>");
var order_cash_min = parseInt("<?=(int)($dmshop['order_cash_min']);?>");
var order_total_money = parseInt("<?=(int)($order_total_money);?>");
var order_card_percent = parseFloat("<?=($dmshop['order_card_percent'] * 0.01);?>");
var order_mobile_percent = parseFloat("<?=($dmshop['order_mobile_percent'] * 0.01);?>");
</script>

<script type="text/javascript">
var order_rec_name = "<?=$dmshop_user['user_name']?>";
var order_rec_zip1 = "<?=$dmshop_user['user_zip1']?>";
var order_rec_zip2 = "<?=$dmshop_user['user_zip2']?>";
var order_rec_addr1 = "<?=$dmshop_user['user_addr1']?>";
var order_rec_addr2 = "<?=$dmshop_user['user_addr2']?>";
var order_rec_hp1 = "<?=$order_rec_hp1?>";
var order_rec_hp2 = "<?=$order_rec_hp2?>";
var order_rec_hp3 = "<?=$order_rec_hp3?>";
var order_rec_tel1 = "<?=$order_rec_tel1?>";
var order_rec_tel2 = "<?=$order_rec_tel2?>";
var order_rec_tel3 = "<?=$order_rec_tel3?>";
</script>

<script type="text/javascript">
var order_coupon_bank = "<?=$order_coupon_bank?>";
var order_coupon_cash = "<?=$order_coupon_cash?>";
</script>

<script type="text/javascript">
var order_pay_url = "<?=$shop['url']?>/pay/kcp/smart/pay.php";
</script>

<script type="text/javascript" src="<?=$shop['mobile_url']?>/js/order.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    orderByte('order_memo', 'order_memo_byte');
    orderCheck();
    orderPayTypeLoad();
});
</script>
<?
include_once("./_bottom.php");
?>