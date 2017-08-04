<?
include_once("./_dmshop.php");

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

// 판매 가격 (옵션가격 포함)
$order_item_money = ($dmshop_item['item_money'] * $dmshop_cart['order_limit']) + ((int)($dmshop_item_option['option_money']) * $dmshop_cart['order_limit']);

// 검색조건
$sql_search = "";
$sql_search = " where user_id = '".$dmshop_user['user_id']."' and coupon_date2 >= '".$shop['time_ymd']."' and coupon_mode in (0,1) ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 1000;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$coupon_applys = "";

$list = array();
$result = sql_query(" select * from $shop[coupon_list_table] $sql_search order by datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 퍼센트
    if ($row['coupon_discount_type']) {

        // 할인금액
        $coupon_money = (int)(($order_item_money * $row['coupon_discount']) / 100);

        // 할인금액이 최대금액을 초과
        if ($row['coupon_discount_max'] && $coupon_money > $row['coupon_discount_max']) {

            // 할인금액을 최대금액으로 설정
            $coupon_money = $row['coupon_discount_max'];

        }

        // 할인된 상품금액
        $order_total_money = (int)($order_item_money - $coupon_money);

    } else {
    // 금액

        // 할인금액
        $coupon_money = (int)($row['coupon_discount']);

        // 할인된 상품금액
        $order_total_money = (int)($order_item_money - $row['coupon_discount']);

    }

    // 할인된 상품금액이 마이너스일 경우
    if ($order_total_money < '0') {

        // 금액을 0원으로 처리
        $order_total_money = "0";

    }

    // 사용가능 초기화
    $coupon_check = false;

    // 기획전
    if ($row['coupon_category_type']) {

        // 기획전이 지정되어 있다
        if ($row['coupon_plan']) {

            // 주문 상품이 해당 기획전에 있는지 체크
            $chk = shop_plan_item($row['coupon_plan'], $dmshop_cart['item_id']);

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
        if ($row['coupon_category']) {

            // 1~4차까지 있는지 체크
            if ($row['coupon_category'] == $dmshop_item['category1'] || $row['coupon_category'] == $dmshop_item['category2'] || $row['coupon_category'] == $dmshop_item['category3'] || $row['coupon_category'] == $dmshop_item['category4']) {

                $coupon_check = true;

            }

        } else {

            $coupon_check = true;

        }

    }

    // 상품가격이 최소가격 이하라면
    if ($row['coupon_discount_min'] && $order_item_money < $row['coupon_discount_min']) {

        $coupon_check = false;

    }

    // 사용가능 쿠폰
    if ($coupon_check) {

        // 미적용 (현재상품에 적용한 것이면 통과)
        if (!$row['coupon_mode'] || $dmshop_cart['order_coupon_id'] && $row['id'] == $dmshop_cart['order_coupon_id']) {

            $coupon_applys .= "<option value='".$row['id']."'>".$row['coupon_title']."</option>\n";
            $list[$i]['coupon_message'] = "<span class='mode1'>적용가능</span>";

        } else {

            $list[$i]['coupon_message'] = "<span class='mode2'>다른상품적용중</span>";

        }

    } else {
    // 사용불가

        $list[$i]['coupon_message'] = "<span class='mode2'>적용불가</span>";

    }

}

// 총 카운트
$coupon_total_count = $total_count;

// 스킨 경로
$dmshop_coupon_path = "";
$dmshop_coupon_path = $shop['path']."/skin/coupon/".$dmshop_skin['skin_coupon'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 할인쿠폰적용";

// 페이지 아이디
$page_id = "coupon_apply";

include_once("./shop.top.php");
include_once("$dmshop_coupon_path/coupon_apply.php");
include_once("./shop.bottom.php");
?>