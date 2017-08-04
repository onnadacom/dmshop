<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_coupon']) {

    message("<p class='title'>알림</p><p class='text'>쿠폰 스킨이 설정되지 않았습니다.</p>", "c");

}

// 장바구니 정보
$dmshop_cart = shop_cart($cart_id);

// 장바구니에 상품이 없다면
if (!$dmshop_cart['id']) {

    message("<p class='title'>알림</p><p class='text'>장바구니의 상품이 삭제되었습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 정보가 다르다
if ($dmshop_user['user_id'] != $dmshop_cart['user_id']) {

    message("<p class='title'>알림</p><p class='text'>장바구니의 상품이 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 상품정보
$dmshop_item = shop_item($dmshop_cart['item_id']);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 판매중지
else if ($dmshop_item['item_use'] == '1') {

    message("<p class='title'>알림</p><p class='text'>{$dmshop_item['item_title']} 상품은 판매가 중지되었습니다.</p>", "c");

}

// 품절
else if ($dmshop_item['item_use'] == '2') {

    message("<p class='title'>알림</p><p class='text'>{$dmshop_item['item_title']} 상품은 품절되었습니다.</p>", "c");

}

// 숨김
else if ($dmshop_item['item_use'] == '3') {

    message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", "c");

} else {

    // 통과

}

// 옵션
if ($dmshop_cart['order_option']) {

    // 옵션정보
    $dmshop_item_option = shop_item_option($dmshop_cart['order_option']);

    // 상품옵션이 없다.
    if (!$dmshop_item_option['id']) {

        message("<p class='title'>알림</p><p class='text'>상품옵션이 삭제되었습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

    }

}

// 옵션 금액이 없다면
if (!$dmshop_item_option['option_money']) {

    // 옵션 가격 초기화(옵션이 없을경우를 처리)
    $dmshop_item_option['option_money'] = 0;

}

$coupon_money = "";
$order_total_money = "";

// 쿠폰 선택
if ($coupon_id) {

    // 쿠폰 정보
    $dmshop_coupon_list = shop_coupon_list($coupon_id);

    // 정보가 다르다
    if ($dmshop_user['user_id'] != $dmshop_coupon_list['user_id']) {

        message("<p class='title'>알림</p><p class='text'>선택하신 쿠폰은 다른 곳에 적용하였거나 사용이 완료된 쿠폰입니다.</p>", "", "", false, true);

    }

    // 적용중 또는 사용완료
    if ($dmshop_coupon_list['coupon_mode'] && $dmshop_cart['order_coupon_id'] && $dmshop_coupon_list['id'] != $dmshop_cart['order_coupon_id']) {

        message("<p class='title'>알림</p><p class='text'>선택하신 쿠폰은 다른 곳에 적용하였거나 사용이 완료된 쿠폰입니다.</p>", "", "", false, true);

    }

    // 판매 가격 (옵션가격 포함)
    $order_item_money = ($dmshop_item['item_money'] * $dmshop_cart['order_limit']) + ((int)($dmshop_item_option['option_money']) * $dmshop_cart['order_limit']);

    // 퍼센트
    if ($dmshop_coupon_list['coupon_discount_type']) {

        // 할인금액
        $coupon_money = (int)(($order_item_money * $dmshop_coupon_list['coupon_discount']) / 100);

        // 할인금액이 최대금액을 초과
        if ($dmshop_coupon_list['coupon_discount_max'] && $coupon_money > $dmshop_coupon_list['coupon_discount_max']) {

            // 할인금액을 최대금액으로 설정
            $coupon_money = $dmshop_coupon_list['coupon_discount_max'];

        }

        // 할인된 상품금액
        $order_total_money = (int)($order_item_money - $coupon_money);

    } else {
    // 금액

        // 할인금액
        $coupon_money = (int)($dmshop_coupon_list['coupon_discount']);

        // 할인된 상품금액
        $order_total_money = (int)($order_item_money - $dmshop_coupon_list['coupon_discount']);

    }

    // 할인금액
    $order_coupon = $coupon_money;

    // 할인된 상품금액이 마이너스일 경우
    if ($order_total_money < '0') {

        // 금액을 0원으로 처리
        $order_total_money = "0";

        // 쿠폰을 아이템가격으로 (DB 저장용)
        $order_coupon = $order_item_money;

    }

    // 사용가능 초기화
    $coupon_check = false;

    // 기획전
    if ($dmshop_coupon_list['coupon_category_type']) {

        // 기획전이 지정되어 있다
        if ($dmshop_coupon_list['coupon_plan']) {

            // 주문 상품이 해당 기획전에 있는지 체크
            $chk = shop_plan_item($dmshop_coupon_list['coupon_plan'], $dmshop_cart['item_id']);

            // 있다면
            if ($chk['id']) {

                $coupon_check = true;

            }

        } else {
        // 전체

            // 주문 상품이 전체 기획전에 있는지 체크
            $chk = sql_fetch(" select * from $shop[plan_item_table] where item_id = '".$dmshop_cart['item_id']."' ");

            // 있다면
            if ($chk['id']) {

                $coupon_check = true;

            }

        }

    } else {
    // 분류

        // 분류가 지정되어 있다
        if ($dmshop_coupon_list['coupon_category']) {

            // 1~4차까지 있는지 체크
            if ($dmshop_coupon_list['coupon_category'] == $dmshop_item['category1'] || $dmshop_coupon_list['coupon_category'] == $dmshop_item['category2'] || $dmshop_coupon_list['coupon_category'] == $dmshop_item['category3'] || $dmshop_coupon_list['coupon_category'] == $dmshop_item['category4']) {

                $coupon_check = true;

            }

        } else {

            $coupon_check = true;

        }

    }

    // 상품가격이 최소가격 이하라면
    if ($dmshop_coupon_list['coupon_discount_min'] && $order_item_money < $dmshop_coupon_list['coupon_discount_min']) {

        $coupon_check = false;

    }

    // 사용불가
    if (!$coupon_check) {

        message("<p class='title'>알림</p><p class='text'>선택하신 쿠폰은 사용하실 수 없습니다.</p>", "", "", false, true);

    }

}

// 쿠폰 선택
if ($m == 'change') {

    if ($coupon_id) {

        echo "<script type='text/javascript'>";
        echo "document.getElementById('coupon_money').innerHTML = '".number_format($coupon_money)."';";
        echo "document.getElementById('order_total_money').innerHTML = '".number_format($order_total_money)." 원';";
        echo "</script>";

    } else {

        echo "<script type='text/javascript'>";
        echo "document.getElementById('coupon_money').innerHTML = '0';";
        echo "document.getElementById('order_total_money').innerHTML = '미적용';";
        echo "</script>";

    }

    exit;

}

// 쿠폰 적용
else if ($m == 'apply') {

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($cart_id)."' and coupon_mode = '1' ");

    // 장바구니 쿠폰 초기화
    sql_query(" update $shop[cart_table] set order_coupon_id  = '0', order_coupon = '0' where id = '".addslashes($cart_id)."' ");

    // 쿠폰 선택
    if ($coupon_id) {

        // 쿠폰 사용으로 변경
        sql_query(" update $shop[coupon_list_table] set coupon_mode  = '1', cart_id = '".trim(strip_tags(mysql_real_escape_string($cart_id)))."' where id = '".addslashes($coupon_id)."' ");

        // 장바구니 쿠폰 적용
        sql_query(" update $shop[cart_table] set order_coupon_id  = '".trim(strip_tags(mysql_real_escape_string($coupon_id)))."', order_coupon = '".trim(strip_tags(mysql_real_escape_string($order_coupon)))."' where id = '".addslashes($cart_id)."' ");

    }

    if ($coupon_page == 'order') {

        echo "<script type='text/javascript'>opener.cartCouponUpdate(); window.close();</script>";

    } else {

        echo "<script type='text/javascript'>opener.location.reload(); window.close();</script>";

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}
?>