<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 삭제
if ($m == 'd') {

    // 쿠폰정보
    $dmshop_coupon_list = shop_coupon_list(addslashes($_POST['coupon_list_id']));

    // 쿠폰이 있다면
    if ($dmshop_coupon_list['id']) {

        // 사용중이 아닐 때
        if ($dmshop_coupon_list['coupon_mode'] != '1') {

            // 쿠폰 내역 삭제
            sql_query(" delete from $shop[coupon_list_table] where id = '".addslashes($_POST['coupon_list_id'])."' ");

            // 총 발행수
            $total_down = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] where coupon_id = '".$dmshop_coupon_list['coupon_id']."' and user_id != '' ");

            // 총 사용수
            $total_order = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] where coupon_id = '".$dmshop_coupon_list['coupon_id']."' and user_id != '' and coupon_mode = '2' ");

            // 발행수와 사용수를 변경
            sql_query(" update $shop[coupon_table] set coupon_down = '".$total_down['cnt']."', coupon_order = '".$total_order['cnt']."' where id = '".$dmshop_coupon_list['coupon_id']."' ");

        }

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 삭제
else if ($m == 'alld') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 쿠폰정보
        $dmshop_coupon_list = shop_coupon_list(addslashes($_POST['coupon_list_id'][$k]));

        // 쿠폰이 있다면
        if ($dmshop_coupon_list['id']) {

            // 사용중이 아닐 때
            if ($dmshop_coupon_list['coupon_mode'] != '1') {

                // 쿠폰 내역 삭제
                sql_query(" delete from $shop[coupon_list_table] where id = '".addslashes($_POST['coupon_list_id'][$k])."' ");

            }

        }

    }

    // 전체 쿠폰 업데이트
    $result = sql_query(" select * from $shop[coupon_table] order by id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 총 발행수
        $total_down = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] where coupon_id = '".$row['id']."' and user_id != '' ");

        // 총 사용수
        $total_order = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] where coupon_id = '".$row['id']."' and coupon_mode = '2' and user_id != '' ");

        // 발행수와 사용수를 변경
        sql_query(" update $shop[coupon_table] set coupon_down = '".$total_down['cnt']."', coupon_order = '".$total_order['cnt']."' where id = '".$row['id']."' ");

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>