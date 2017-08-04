<?php
if (!defined("_DMSHOP_")) exit;

// 가격 초기화
$order_total_item_money = 0;
$order_total_coupon = 0;
$order_delivery_money = 0;
$order_total_money = 0;

// 묶음배송
$delivery_money_free = false;

// 상품
for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // 장바구니 정보
    $row = shop_cart($cart_id[$k]);

    // 장바구니에 상품이 없다면
    if (!$row['id']) {

        alert_close("결제하는 도중 장바구니의 상품이 삭제되었습니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

    }

    $list[$i] = $row;

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        alert_close("결제하는 도중 상품이 삭제되었습니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

    }

    // 판매중지
    else if ($dmshop_item['item_use'] == '1') {

        alert_close("{$dmshop_item['item_title']} 상품은 판매가 중지되었습니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

    }

    // 품절
    else if ($dmshop_item['item_use'] == '2') {

        alert_close("{$dmshop_item['item_title']} 상품은 품절되었습니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

    }

    // 숨김
    else if ($dmshop_item['item_use'] == '3') {

        alert_close("{$dmshop_item['item_title']} 상품은 판매가 중지되었습니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

    } else {

        // 통과

    }

    // 회원
    if ($shop_user_login) {

        if ($dmshop_user['user_id'] != $row['user_id']) {

            alert_close("{$dmshop_item['item_title']} 상품은 내 장바구니에 담긴 상품이 아닙니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

        }

    } else {

        if ($guest_id != $row['guest_id']) {

            alert_close("{$dmshop_item['item_title']} 상품은 내 장바구니에 담긴 상품이 아닙니다.\\n\\n처음부터 다시 이용하시기 바랍니다.");

        }

    }

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($row['order_option']) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($row['order_option']);

        // 옵션재고 부족
        if ($dmshop_item_option['option_limit'] < $row['order_limit']) {

            alert_close("{$dmshop_item['item_title']} 상품의 {$dmshop_item_option['option_name']} 재고수량은 {$dmshop_item_option['option_limit']}개 입니다.\\n\\n수량을 확인하신 후 다시 주문하시기 바랍니다.");

        }

    } else {
    // 일반

        // 재고 부족
        if ($dmshop_item['item_limit'] < $row['order_limit']) {
    
            alert_close("{$dmshop_item['item_title']} 상품의 재고수량은 {$dmshop_item_option['option_limit']}개 입니다.\\n\\n수량을 확인하신 후 다시 주문하시기 바랍니다.");
    
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
    $list[$i]['item_money'] = $dmshop_item['item_money']; // 상품금액
    $list[$i]['item_cash'] = $dmshop_item['item_cash']; // 상품적립금
    $list[$i]['category1'] = $dmshop_item['category1']; // 카테고리1
    $list[$i]['category2'] = $dmshop_item['category2']; // 카테고리2
    $list[$i]['category3'] = $dmshop_item['category3']; // 카테고리3
    $list[$i]['category4'] = $dmshop_item['category4']; // 카테고리4
    $list[$i]['option_name'] = $dmshop_item_option['option_name']; // 옵션명
    $list[$i]['option_money'] = $dmshop_item_option['option_money']; // 옵션금액
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

    $list[$i]['order_delivery_type'] = $list[$i]['delivery_type']; // 배송타입
    $list[$i]['order_real_delivery'] = $list[$i]['item_delivery']; // 실제배송비
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

// 총 상품가격이 다르다.
if ($_POST['order_total_money'] != $order_total_money) {

    alert_close("결제하는 도중 장애가 발생하였습니다.\\n\\n처음부터 다시 이용하여 주시기 바랍니다.");

}

// 총 상품가격이 다르다
if ($_POST['order_total_item_money'] != $order_total_item_money) {

    alert_close("결제하는 도중 장애가 발생하였습니다.\\n\\n처음부터 다시 이용하여 주시기 바랍니다.");

}

// 총 쿠폰 금액이 다르다.
if ($_POST['order_total_coupon'] != $order_total_coupon) {

    alert_close("결제하는 도중 장애가 발생하였습니다.\\n\\n처음부터 다시 이용하여 주시기 바랍니다.");

}

// 배송비가 다르다.
if ($_POST['order_delivery_money'] != $order_delivery_money) {

    alert_close("결제하는 도중 장애가 발생하였습니다.\\n\\n처음부터 다시 이용하여 주시기 바랍니다.");

}

// 기본 결제금액
$order_money = (int)($order_total_money - $_POST['order_cash']);

// 카드결제
if ($_POST['order_pay_type'] == '1' && $order_money) {

    // 총 결제금액 증가
    $order_pay_money = round($order_money + ($order_money * ($dmshop['order_card_percent'] * 0.01)),0);

}

// 휴대폰결제
else if ($_POST['order_pay_type'] == '3' && $order_money) {

    // 총 결제금액 증가
    $order_pay_money = round($order_money + ($order_money * ($dmshop['order_mobile_percent'] * 0.01)),0);

} else {
// 일반수단

    // 기본 결제금액
    $order_pay_money = (int)($order_total_money - $_POST['order_cash']);

}

// 총 결제 금액이 다르다.
if ($_POST['order_pay_money'] != $order_pay_money) {

    alert_close("결제하는 도중 장애가 발생하였습니다.\\n\\n처음부터 다시 이용하여 주시기 바랍니다.");

}

// 결제 금액이 마이너스
if ($_POST['order_pay_money'] < '0') {

    alert_close("결제 금액이 마이너스 입니다. 처음부터 다시 이용하여 주시기 바랍니다.");

}

// 보유 적립금 체크
if ($_POST['order_cash'] && $dmshop_user['user_cash'] < $_POST['order_cash']) {

    alert_close("결제에 사용될 적립금이 부족합니다. 처음부터 다시 이용하여 주시기 바랍니다.");

}

// 무통장이 아닌 결제수단, 적립금 결제
if ($_POST['order_pay_type'] != '5' && $_POST['order_cash']) {

    // 결제 상품
    for ($i=0; $i<count($list); $i++) {

        // 장바구니 데이터
        $dmshop_cart = shop_cart($list[$i]['id']);

        // 쿠폰 설정
        if ($dmshop_cart['order_coupon_id']) {

            // 쿠폰 데이터
            $dmshop_coupon_list = shop_coupon_list($dmshop_cart['order_coupon_id']);

            // 사용중인 쿠폰이 아닐 때
            if ($dmshop_coupon_list['coupon_mode'] != '1') {

                alert_close("사용하실 수 없는 쿠폰이 적용되었습니다.\\n\\n주문내역을 다시 확인하신 후 결제하시기 바랍니다.");

            }

            // 무통장만 가능
            if ($dmshop_coupon_list['coupon_bank']) {

                alert_close("무통장 결제만 가능한 쿠폰이 적용되었습니다.\\n\\n주문내역을 다시 확인하신 후 결제하시기 바랍니다.");

            }

            // 적립금 사용불가
            if ($dmshop_coupon_list['coupon_cash']) {

                alert_close("적립금을 사용할 수 없는 쿠폰이 적용되었습니다.\\n\\n주문내역을 다시 확인하신 후 결제하시기 바랍니다.");

            }

        }

    }

}
?>