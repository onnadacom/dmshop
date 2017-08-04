<?php
include_once("./_dmshop.php");

// 스킨이 없다.
if (!$dmshop_skin['skin_cart']) {

    message("<p class='title'>알림</p><p class='text'>장바구니 스킨이 설정되지 않았습니다.</p>", "b");

}

// 기간만료 장바구니 삭제
$result = sql_query(" select * from $shop[cart_table] where datetime < '".date("Y-m-d H:i:s", $shop['server_time'] - (86400 * $dmshop['cart_day']))."' ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($row['id'])."' ");

    // 장바구니 삭제
    sql_query(" delete from $shop[cart_table] where id = '".addslashes($row['id'])."' ");

}

// 비회원용
$guest_id = "";
$guest_id = shop_get_cookie("dmshop_cart");

// 로그인
if ($shop_user_login) {

    // 비회원 장바구니를 회원으로 변경
    sql_query(" update $shop[cart_table] set user_id = '".$dmshop_user['user_id']."', guest_id = '' where user_id = '' and guest_id = '".addslashes($guest_id)."' ");

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

} else {

    $sql_search = " where guest_id = '".addslashes($guest_id)."' and user_id = '' ";

}

// 가격 초기화
$order_total_item_money = 0;
$order_total_coupon = 0;
$order_delivery_money = 0;
$order_total_money = 0;

// 묶음배송
$delivery_money_free = false;

// 배송비 선결제
$order_delivery_pay = false;

// 장바구니
$list = array();
$result = sql_query(" select * from $shop[cart_table] $sql_search order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        // 장바구니에서 삭제
        sql_query(" delete from $shop[cart_table] where id = '".$row['id']."' ");

        // 다시 로드
        shop_url("{$shop['path']}/cart.php");

    }

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션 가격 문구 초기화
    $option_money = "";

    // 옵션
    if ($row['order_option']) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($row['order_option']);

        if ($dmshop_item_option['option_money'] > '0') {

            $option_money = " (+".number_format($dmshop_item_option['option_money'])."원)";

        }

        else if ($row['option_money'] < '0') {

            $option_money = " (".number_format($dmshop_item_option['option_money'])."원)";

        } else {

            $option_money = "";

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
    $list[$i]['option_money'] = $option_money; // 옵션금액 (위에서 메세지를 따로 처리 하였다.)
    $list[$i]['order_item_money'] = $order_item_money; // 옵션포함 상품가격
    $list[$i]['item_delivery'] = $dmshop_item['item_delivery']; // 배송비
    $list[$i]['item_delivery_bunch'] = $dmshop_item['item_delivery_bunch']; // 묶음배송

    $item_delivery = 0;

    // 배송비
    if ($list[$i]['item_delivery']) {

        // 묶음배송
        if ($list[$i]['item_delivery_bunch']) {

            $delivery_money_free = true;

            $list[$i]['delivery_type'] = 1;

            $list[$i]['item_delivery'] = 0;

            // 선결제
            if (!$list[$i]['order_delivery_pay']) {

                $order_delivery_pay = true;

            }

        } else {
        // 묶음배송이 아니다면 추가배송비

            $list[$i]['delivery_type'] = 2;

            // 착불
            if ($list[$i]['order_delivery_pay']) {

                $item_delivery = 0;

            } else {
            // 착불이 아닐 때

                $order_delivery_money += $list[$i]['item_delivery'];
                $list[$i]['item_delivery'] = $list[$i]['item_delivery'];

                $item_delivery = $list[$i]['item_delivery'];

            }

        }

    } else {
    // 배송비 없음 (묶음배송)

        $delivery_money_free = true;

        $list[$i]['delivery_type'] = 0;

        $list[$i]['item_delivery'] = 0;

        // 선결제
        if (!$list[$i]['order_delivery_pay']) {

            $order_delivery_pay = true;

        }

    }

    $list[$i]['order_total_money'] = ($order_item_money + $item_delivery) - $row['order_coupon']; // 옵션포함상품가, 배송비, 쿠폰적용 (해당 상품의 결제가격이다)

}

if ($i) {

    // 판매가 합계가 무료배송비 미만
    if ($order_delivery_pay && $delivery_money_free && $order_total_item_money < $dmshop['delivery_money_free']) {

        // 기본 배송비
        $order_delivery_money += $dmshop['delivery_money'];

    }

    // 결제 총액 (옵션포함 총 판매가격 - 총 쿠폰가격 + 배송비)
    $order_total_money = ($order_total_item_money - $order_total_coupon) + $order_delivery_money;

}

// 스킨 경로
$dmshop_cart_path = "";
$dmshop_cart_path = $shop['path']."/skin/cart/".$dmshop_skin['skin_cart'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 장바구니";

// 페이지 아이디
$page_id = "cart";

include_once("./_top.php");
include_once("$dmshop_cart_path/cart.php");
include_once("./_bottom.php");
?>