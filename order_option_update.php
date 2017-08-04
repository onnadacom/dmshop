<?
include_once("./_dmshop.php");
if ($order_id) { $order_id = preg_match("/^[0-9]+$/", $order_id) ? $order_id : ""; }

if ($m == '') {

    echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

    // 로그인
    if (!$shop_user_login) {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "", "", false, true);

    }

    $dmshop_order = shop_order_id($order_id);

    // 주문 내역이 없다.
    if (!$dmshop_order['id']) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "", "", false, true);

    }

    // 주문자가 다르다.
    if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "", "", false, true);

    }

    // 상품발송되었다면
    if ($dmshop_order['order_delivery']) {

        message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "", "", false, true);

    }

    // 취소, 교환, 환불
    if ($dmshop_order['order_cancel'] || $dmshop_order['order_exchange'] || $dmshop_order['order_refund']) {

        message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "", "", false, true);

    }

    // 주문 상품명
    echo $dmshop_order['item_title'];

    echo "<script type='text/javascript'>";

    // 주문 옵션명
    if ($dmshop_order['option_name']) {

        echo "document.getElementById('item_option').innerHTML = \"".addslashes($dmshop_order['option_name'])."\";";

    } else {

        echo "document.getElementById('item_option').innerHTML = \"없음\";";

    }

    // 변경할 상품명
    echo "document.getElementById('target_name').innerHTML = \"".addslashes($dmshop_order['item_title'])."\";";

    // 상품정보
    $dmshop_item = shop_item($dmshop_order['item_id']);

    // 상품 옵션 사용
    $item_order_option_select = "";
    if ($dmshop_item['item_option_use']) {

        $result = sql_query(" select * from $shop[item_option_table] where item_id = '".$dmshop_item['id']."' and option_mode = '1' and option_money = '".$dmshop_order['option_money']."' and id != '".$dmshop_order['option_id']."' order by option_position asc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            if ($row['id']) {

                $item_order_option_select .= "<option value='".$row['id']."'>";
                $item_order_option_select .= addslashes($row['option_name']);
                $item_order_option_select .= "</option>";

            }

        }

        if ($item_order_option_select) {

            $item_order_option_select = "<select id='option_id' name='option_id' class='select'><option value=''>변경하실 주문옵션을 선택하세요.</option>".$item_order_option_select."</select>";

            // 변경할 옵션
            echo "document.getElementById('target_option').innerHTML = \"".$item_order_option_select."\";";

        }

    }

    if (!$item_order_option_select) {

        // 변경할 옵션
        echo "document.getElementById('target_option').innerHTML = \"변경가능한 옵션이 없습니다.\";";

    }

    echo "</script>";

}

// 수정
else if ($m == 'u') {

    // 옵션이 없다.
    if (!$option_id) {

        message("<p class='title'>알림</p><p class='text'>주문옵션이 선택되지 않았습니다.</p>", "b");

    }

    $dmshop_order = shop_order_id($order_id);

    // 주문 내역이 없다.
    if (!$dmshop_order['id']) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "b");

    }

    // 주문자가 다르다.
    if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "b");

    }

    // 상품발송되었다면
    if ($dmshop_order['order_delivery']) {

        message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "b");

    }

    // 취소, 교환, 환불
    if ($dmshop_order['order_cancel'] || $dmshop_order['order_exchange'] || $dmshop_order['order_refund']) {

        message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "b");

    }

    // 옵션정보
    $dmshop_item_option = shop_item_option($option_id);

    // 옵션이 없다.
    if (!$dmshop_item_option['id']) {

        message("<p class='title'>알림</p><p class='text'>해당 옵션이 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 주문 가격과 선택한 옵션정보가 다르다.
    if ($dmshop_order['option_money'] != $dmshop_item_option['option_money']) {

        message("<p class='title'>알림</p><p class='text'>변경가능한 옵션이 아닙니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 옵션 변경 (옵션아이디와 옵션명만 바뀌어야 한다.)
    sql_query(" update $shop[order_table] set option_id = '".trim(strip_tags(mysql_real_escape_string($option_id)))."', option_name = '".trim(strip_tags(mysql_real_escape_string($dmshop_item_option['option_name'])))."' where id = '".addslashes($order_id)."' ");

    message("<p class='title'>알림</p><p class='text'>옵션변경을 완료하였습니다.</p>", "c");

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}
?>