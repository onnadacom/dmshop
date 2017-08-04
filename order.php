<?
include_once("./_dmshop.php");

// 회원만 주문가능하다면
if (!$dmshop['order_guest_use'] && !$shop_user_login) {

    // 로그인 이동 후 장바구니로
    shop_url("$shop[path]/signin.php?url=".urlencode("/cart.php"));

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

// 스킨이 없다.
if (!$dmshop_skin['skin_order']) {

    message("<p class='title'>알림</p><p class='text'>주문페이지 스킨이 설정되지 않았습니다.</p>", "b");

}

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

        shop_url("$shop[path]/cart.php");

    }

} else {

    shop_url("$shop[path]/cart.php");

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

// inicis
if ($dmshop['order_pg'] == '1') {

    $order_pay_url = $shop['path']."/pay/inicis/pay.php";

}

// allthegate
else if ($dmshop['order_pg'] == '2') {

    $order_pay_url = $shop['path']."/pay/allthegate/pay.php";

}

// kcp
else if ($dmshop['order_pg'] == '3') {

    $order_pay_url = $shop['path']."/pay/kcp/pay.php";

}

// kicc
else if ($dmshop['order_pg'] == '4') {

    $order_pay_url = $shop['path']."/pay/kicc/pay.php";

}

// lgu+
else if ($dmshop['order_pg'] == '5') {

    $order_pay_url = $shop['path']."/pay/lgd/pay.php";

} else {

    $order_pay_url = "";

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

// 스킨 경로
$dmshop_order_path = "";
$dmshop_order_path = $shop['path']."/skin/order/".$dmshop_skin['skin_order'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 주문/결제";

// 페이지 아이디
$page_id = "order";

include_once("./_top.php");
include_once("$dmshop_order_path/order.php");
include_once("./_bottom.php");
?>