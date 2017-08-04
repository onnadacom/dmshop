<?php
include_once("./_dmshop.php");
if ($order_option) { $order_option = preg_match("/^[0-9]+$/", $order_option) ? $order_option : ""; }
if ($order_limit) { $order_limit = @preg_match("/^[0-9]+$/", $order_limit) ? $order_limit : ""; }

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

// 게스트 아이디
$guest_id = "";

// 회원
if ($shop_user_login) {

    $user_id = $dmshop_user['user_id'];

} else {
// 비회원

    $user_id = "";

    // 쿠키 아이디
    $cookie_id = "dmshop_cart";

    // 쿠키
    if (shop_get_cookie($cookie_id)) {

        $guest_id = shop_get_cookie($cookie_id);

    } else {

        $cookie_value = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR']))).rand(10000,99999);

        shop_set_cookie($cookie_id, $cookie_value, 86400);

        //$guest_id = base64_encode($cookie_value);
        $guest_id = $cookie_value;

    }

}

// 상품 및 재고 체크
if ($m == 'item_option_array') {

    $message_mode = "";
    $message_url = "";
    $message_html = false;
    $message_stop = true;

    $array = array();
    for ($i=0; $i<count($list_option_id); $i++) {

        $order_option = addslashes($list_option_id[$i]);
        $order_limit = addslashes($list_order_limit[$i]);

        if (!$order_option) {

            message("<p class='title'>알림</p><p class='text'>옵션이 삭제되었거나 존재하지 않습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 아이디가 없다.
        if (!$item_id) {

            message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 상품
        $dmshop_item = shop_item($item_id);

        // 상품이 없다.
        if (!$dmshop_item['id']) {

            message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 판매중지
        else if ($dmshop_item['item_use'] == '1') {

            message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 품절
        else if ($dmshop_item['item_use'] == '2') {

            message("<p class='title'>알림</p><p class='text'>현재 상품은 품절되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 숨김
        else if ($dmshop_item['item_use'] == '3') {

            message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        } else {

            // 통과

        }

        // 0개 이하
        if ($order_limit <= 0 || !$order_limit) {

            message("<p class='title'>알림</p><p class='text'>수량을 1개 이상으로 하세요.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        // 옵션정보
        $dmshop_item_option = shop_item_option($order_option);

        // 수량이 적다면
        if ($dmshop_item_option['option_limit'] < $order_limit) {

            message("<p class='title'>알림</p><p class='text'>".text($dmshop_item_option['option_name'])."<br />재고가 부족합니다. 수량을 확인하여 주시기 바랍니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

        $array[$order_option]['option_id'] = $order_option;
        $array[$order_option]['option_limit'] = $dmshop_item_option['option_limit'];
        $array[$order_option]['option_name'] = $dmshop_item_option['option_name'];
        $array[$order_option]['order_limit'] += $order_limit;

    }

    $i = 0;
    $list = array();
    foreach ($array as $key => $row) {

        $list[$i] = $row;
        $i++;

        // 전체수량 체크
        if ($row['option_limit'] < $row['order_limit']) {

            message("<p class='title'>알림</p><p class='text'>".text($row['option_name'])."<br />재고가 부족합니다. 수량을 확인하여 주시기 바랍니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

    }

}

else if ($m == '' || $m == 'u') {

    if ($m == 'u') {

        $message_mode = "b";
        $message_url = "";
        $message_html = true;
        $message_stop = true;

    } else {

        $message_mode = "";
        $message_url = "";
        $message_html = false;
        $message_stop = true;

    }

    // 아이디가 없다.
    if (!$item_id) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

    }

    // 상품
    $dmshop_item = shop_item($item_id);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

    }

    // 판매중지
    else if ($dmshop_item['item_use'] == '1') {

        message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

    }

    // 품절
    else if ($dmshop_item['item_use'] == '2') {

        message("<p class='title'>알림</p><p class='text'>현재 상품은 품절되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

    }

    // 숨김
    else if ($dmshop_item['item_use'] == '3') {

        message("<p class='title'>알림</p><p class='text'>현재 상품은 판매가 중지되었습니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

    } else {

        // 통과

    }

    // 0개 이하
    if ($order_limit < '0' || !$order_limit) {

        message("<p class='title'>알림</p><p class='text'>주문수량을 1개 이상으로 하세요.</p>", $message_mode, $message_url, $message_html, $message_stop);

    }

    // 옵션이 있다면
    if ($order_option) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($order_option);

        // 수량이 적다면
        if ($dmshop_item_option['option_limit'] < $order_limit) {

            message("<p class='title'>알림</p><p class='text'>재고가 부족합니다. 주문수량을 확인하여 주시기 바랍니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

    } else {
    // 기본 재고

        // 수량이 적다면
        if ($dmshop_item['item_limit'] < $order_limit) {

            message("<p class='title'>알림</p><p class='text'>재고가 부족합니다. 주문수량을 확인하여 주시기 바랍니다.</p>", $message_mode, $message_url, $message_html, $message_stop);

        }

    }

}

// 수정삭제 권한체크
if ($m == 'u' || $m == 'd') {

    // 장바구니 정보
    $dmshop_cart = shop_cart($cart_id);

    if (!$dmshop_cart['id']) {

        message("<p class='title'>알림</p><p class='text'>해당 상품이 장바구니에서 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 회원
    if ($shop_user_login) {

        // 아이디가 다르다
        if ($dmshop_user['user_id'] != $dmshop_cart['user_id']) {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    } else {
    // 비회원

        // 아이디가 다르다
        if ($guest_id != $dmshop_cart['guest_id']) {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

}

// 등록
if ($m == '') {

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", guest_id = '".$guest_id."' ";
    $sql_common .= ", item_id = '".trim(strip_tags(mysql_real_escape_string($item_id)))."' ";
    $sql_common .= ", order_option = '".trim(strip_tags(mysql_real_escape_string($order_option)))."' ";
    $sql_common .= ", order_limit = '".trim(strip_tags(mysql_real_escape_string($order_limit)))."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[cart_table] $sql_common ");

    $cart_id = mysql_insert_id();

    // 바로구매
    if ($cart_type == 'order') {

        echo "<script type='text/javascript'>";
        echo "document.getElementById('order_start').value = '1';";
        echo "document.getElementById('cart_id').value = '".addslashes($cart_id)."';";
        echo "</script>";

    }

    // 장바구니
    else if ($cart_type == 'cart') {

        message("<p class='text' style='text-align:center;'>선택하신 상품을 장바구니에 담았습니다.</p>", "", "", false, true);

    } else {
    // 뒤로

        $url = $shop['url']."/item.php?id=".$dmshop_item['item_code'];

        shop_url($url);

    }

    exit;

}

// 개별등록 (관심상품에서 데이터가 넘어온다)
else if ($m == 'favorite') {

    // 관심상품 정보
    $dmshop_favorite = shop_favorite($favorite_id);

    // 내꺼
    if ($dmshop_favorite['id'] && $dmshop_user['user_id'] == $dmshop_favorite['user_id']) {

        $sql_common = "";
        $sql_common .= " set user_id = '".$dmshop_user['user_id']."' ";
        $sql_common .= ", item_id = '".$dmshop_favorite['item_id']."' ";
        $sql_common .= ", order_option = '".$dmshop_favorite['order_option']."' ";
        $sql_common .= ", order_limit = '".$dmshop_favorite['order_limit']."' ";
        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

        // insert
        sql_query(" insert into $shop[cart_table] $sql_common ");

        // 관심상품 삭제
        sql_query(" delete from $shop[favorite_table] where id = '".addslashes($favorite_id)."' ");

    }

    message("<p class='title'>알림</p><p class='text'>장바구니로 이동하였습니다.</p>", "", $urlencode, true, true);

}

// 선택등록 (관심상품에서 데이터가 넘어온다)
else if ($m == 'all') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 관심상품 정보
        $dmshop_favorite = shop_favorite($favorite_id[$k]);

        // 내꺼
        if ($dmshop_favorite['id'] && $dmshop_user['user_id'] == $dmshop_favorite['user_id']) {

            $sql_common = "";
            $sql_common .= " set user_id = '".$dmshop_user['user_id']."' ";
            $sql_common .= ", item_id = '".$dmshop_favorite['item_id']."' ";
            $sql_common .= ", order_option = '".$dmshop_favorite['order_option']."' ";
            $sql_common .= ", order_limit = '".$dmshop_favorite['order_limit']."' ";
            $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

            // insert
            sql_query(" insert into $shop[cart_table] $sql_common ");

            // 관심상품 삭제
            sql_query(" delete from $shop[favorite_table] where id = '".addslashes($favorite_id[$k])."' ");

        }

    }

    message("<p class='title'>알림</p><p class='text'>장바구니로 이동하였습니다.</p>", "", $urlencode, true, true);

}

// 선택등록 (상품목록에서 데이터가 넘어온다)
else if ($m == 'listall') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 상품
        $dmshop_item = shop_item($item_id[$k]);

        // 상품이 존재한다면
        if ($dmshop_item['id']) {

            // 상품의 첫번째 옵션
            $dmshop_item_option = sql_fetch(" select * from $shop[item_option_table] where item_id = '".addslashes($item_id[$k])."' and option_mode = '1' order by option_position asc ");

            // 있을 때
            if ($dmshop_item_option['id']) {

                $order_option = $dmshop_item_option['id'];

            } else {

                $order_option = "";

            }

            $sql_common = "";
            $sql_common .= " set user_id = '".trim(strip_tags(mysql_real_escape_string($user_id)))."' ";
            $sql_common .= ", guest_id = '".trim(strip_tags(mysql_real_escape_string($guest_id)))."' ";
            $sql_common .= ", item_id = '".trim(strip_tags(mysql_real_escape_string($item_id[$k])))."' ";
            $sql_common .= ", order_option = '".trim(strip_tags(mysql_real_escape_string($order_option)))."' ";
            $sql_common .= ", order_limit = '1' ";
            $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

            // insert
            sql_query(" insert into $shop[cart_table] $sql_common ");

        }

    }

    message("<p class='title'>알림</p><p class='text'>장바구니에 담았습니다.</p>", "", $urlencode, true, true);

}

// 옵션등록
else if ($m == 'item_option_array') {

    for ($i=0; $i<count($list); $i++) {

        $sql_common = "";
        $sql_common .= " set user_id = '".$user_id."' ";
        $sql_common .= ", guest_id = '".$guest_id."' ";
        $sql_common .= ", item_id = '".trim(strip_tags(mysql_real_escape_string($item_id)))."' ";
        $sql_common .= ", order_option = '".trim(strip_tags(mysql_real_escape_string($list[$i]['option_id'])))."' ";
        $sql_common .= ", order_limit = '".trim(strip_tags(mysql_real_escape_string($list[$i]['order_limit'])))."' ";
        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

        sql_query(" insert into $shop[cart_table] $sql_common ");

        $cart_id = mysql_insert_id();

        $list[$i]['cart_id'] = $cart_id;

    }

    if (count($list) == 0) {

        exit;

    }

    // 바로구매
    if ($cart_type == 'order') {

        echo "<form method='post' name='formCartList' autocomplete='off'>";
        echo "<input type='hidden' name='m' value='all' />";

        for ($i=0; $i<count($list); $i++) {

            echo "<input type='hidden' name='cart_id[".$i."]' value='".$list[$i]['cart_id']."' />";
            echo "<input type='hidden' name='chk_id[]' value='".$i."' />";

        }

        echo "</form>";

    }

    // 장바구니
    else if ($cart_type == 'cart') {

        message("<p class='text' style='text-align:center;'>선택하신 상품을 장바구니에 담았습니다.</p>", "", "", false, true);

    } else {
    // 뒤로

        $url = $shop['url']."/item.php?id=".$dmshop_item['item_code'];

        shop_url($url);

    }

    exit;

}

// 수정
else if ($m == 'u') {

    $sql_common = "";
    $sql_common .= " set order_limit = '".trim(strip_tags(mysql_real_escape_string($order_limit)))."' ";

    sql_query(" update $shop[cart_table] $sql_common where id = '".addslashes($cart_id)."' ");

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($cart_id)."' and coupon_mode = '1' ");

    // 장바구니 쿠폰 초기화
    sql_query(" update $shop[cart_table] set order_coupon_id  = '0', order_coupon = '0' where id = '".addslashes($cart_id)."' ");

}

// 삭제
else if ($m == 'd') {

    // 장바구니 삭제
    sql_query(" delete from $shop[cart_table] where id = '".addslashes($cart_id)."' ");

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($cart_id)."' and coupon_mode = '1' ");

    // 장바구니 쿠폰 초기화
    sql_query(" update $shop[cart_table] set order_coupon_id  = '0', order_coupon = '0' where id = '".addslashes($cart_id)."' ");

}

// 선택삭제
else if ($m == 'alld') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 장바구니 정보
        $dmshop_cart = shop_cart($cart_id[$k]);

        // 내꺼
        if ($shop_user_login && $user_id == $dmshop_cart['user_id'] || !$shop_user_login && $guest_id == $dmshop_cart['guest_id']) {

            // 삭제
            sql_query(" delete from $shop[cart_table] where id = '".addslashes($cart_id[$k])."' ");

            // 적용중인 쿠폰 미사용으로 변경
            sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($cart_id[$k])."' and coupon_mode = '1' ");

            // 장바구니 쿠폰 초기화
            sql_query(" update $shop[cart_table] set order_coupon_id  = '0', order_coupon = '0' where id = '".addslashes($cart_id[$k])."' ");

        }

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

shop_url($urlencode);
?>