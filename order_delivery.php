<?
include_once("./_dmshop.php");

if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 스킨이 없다.
if (!$dmshop_skin['skin_order_delivery']) {

    message("<p class='title'>알림</p><p class='text'>배송조회 스킨이 설정되지 않았습니다.</p>", "c");

}

// 주문정보
$dmshop_order = shop_order($order_code);

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

}

// 관리자 통과
if ($shop_user_admin) {

    // pass

}

// 회원이 주문
else if ($dmshop_order['user_id']) {

    if (!$shop_user_login) {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

    }

    // 주문한 회원이 다르다
    if ($dmshop_user['user_id'] != $dmshop_order['user_id']) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

    }

}

// 비회원이 주문
else if (!$dmshop_order['user_id']) {

    $ss_name = "order_guest";

    if (!shop_get_session($ss_name)) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

    // 세션이 없다
    if (!$dmshop_order['order_guest_session']) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

    // 세션이 다르다
    if ($dmshop_order['order_guest_session'] != $_SESSION[$ss_name]) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

}

// 1은 준비중, 2부터 상품발송
if ($dmshop_order['order_delivery'] < '2') {

    message("<p class='title'>알림</p><p class='text'>배송중인 상품이 아닙니다.</p>", "c");

}

// 스킨 경로
$dmshop_order_delivery_path = "";
$dmshop_order_delivery_path = $shop['path']."/skin/order_delivery/".$dmshop_skin['skin_order_delivery'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 배송조회";

// 페이지 아이디
$page_id = "order_delivery";

include_once("./shop.top.php");
include_once("$dmshop_order_delivery_path/order_delivery.php");
include_once("./shop.bottom.php");
?>