<?
if (!defined("_DMSHOP_")) exit;

// 쿠폰 정보
function shop_coupon($coupon_id)
{

    global $shop;

    if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

    if (!$coupon_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[coupon_table] where id = '$coupon_id' ");

}

// 쿠폰 내역 정보
function shop_coupon_list($id)
{

    global $shop;

    if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

    if (!$id) {

        return false;

    }

    return sql_fetch(" select * from $shop[coupon_list_table] where id = '$id' ");

}

// 쿠폰 내역 정보
function shop_coupon_list_user($coupon_id, $user_id)
{

    global $shop;

    if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

    if (!$coupon_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[coupon_list_table] where coupon_id = '$coupon_id' and user_id = '$user_id' ");

}

// 쿠폰 유형
function shop_coupon_type($id)
{

    if ($id == '0') {

        $data = "일반";

    }

    else if ($id == '1') {

        $data = "인쇄용";

    } else {

        $data = "기타";

    }

    return $data;

}

// 쿠폰 할인 유형
function shop_coupon_discount_type($id)
{

    if ($id == '0') {

        $data = "원";

    }

    else if ($id == '1') {

        $data = "%";

    } else {

        $data = "기타";

    }

    return $data;

}

// 쿠폰 자동지급 유형
function shop_coupon_auto($id)
{

    if ($id == '0') {

        $data = "설정안함";

    }

    else if ($id == '1') {

        $data = "신규가입";

    }

    else if ($id == '2') {

        $data = "생일기념";

    }

    else if ($id == '3') {

        $data = "첫구매";

    }

    else if ($id == '4') {

        $data = "상품평 작성";

    }

    else if ($id == '5') {

        //$data = "주문금액";
        $data = "";

    } else {

        $data = "기타";

    }

    return $data;

}

// 쿠폰 사용 상태
function shop_coupon_mode($id)
{

    if ($id == '0') {

        $data = "사용전";

    }

    else if ($id == '1') {

        $data = "사용중";

    }

    else if ($id == '2') {

        $data = "사용완료";

    }

    else if ($id == '3') {

        $data = "소멸";

    } else {

        $data = "기타";

    }

    return $data;

}

// 쿠폰 파일
function shop_coupon_file($coupon_id, $upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[coupon_file_table] where coupon_id = '$coupon_id' and upload_mode = '$upload_mode' ");

}

// 쿠폰 보유 수량
function shop_coupon_user_count($user_id)
{

    global $shop;

    if (!$user_id) {

        return false;

    }

    // 해당 회원의 보유쿠폰
    $data = sql_fetch(" select count(*) as total_count from $shop[coupon_list_table] where user_id = '".$user_id."' and coupon_date2 >= '".$shop['time_ymd']."' and coupon_mode in (0,1) ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 쿠폰 지급
function shop_coupon_make($coupon_id, $user_id, $sms_send, $return)
{

    global $shop, $dmshop, $coupon_make_admin;

    if (!$coupon_id || !$user_id) {

        return false;

    }

    // 쿠폰
    $dmshop_coupon = shop_coupon($coupon_id);

    if (!$dmshop_coupon['id']) {

        return shop_coupon_return(1, $return);

    }

    // 인쇄용
    if ($dmshop_coupon['coupon_type']) {

        return shop_coupon_return(2, $return);

    }

    // 지급중단
    if ($dmshop_coupon['coupon_use']) {

        return shop_coupon_return(3, $return);

    }

    // 발행매수제한
    if ($dmshop_coupon['coupon_max']) {

        // 발행초과
        if ($dmshop_coupon['coupon_max'] <= $dmshop_coupon['coupon_down']) {

            return shop_coupon_return(4, $return);

        }

    }

    // 고정기간
    if (!$dmshop_coupon['coupon_day_type']) {

        // 사용기간이 지났다.
        if ($shop['time_ymd'] > $dmshop_coupon['coupon_date2']) {

            return shop_coupon_return(5, $return);

        }

    }

    // 중복다운 불가
    if ($dmshop_coupon['coupon_overlap']) {

        // 쿠폰내역
        $dmshop_coupon_list = sql_fetch(" select * from $shop[coupon_list_table] where coupon_id = '".$coupon_id."' and user_id = '".$user_id."' ");

        // 있다
        if ($dmshop_coupon_list['id']) {

            return shop_coupon_return(6, $return);

        }

    }

    // 쿠폰옵션정보
    $coupon_option= "";

    // 최소 또는 최대 금액이 있다
    if ($dmshop_coupon['coupon_discount_min'] || $dmshop_coupon['coupon_discount_type'] == '1' && $dmshop_coupon['coupon_discount_max']) {

        // 최소금액
        if ($dmshop_coupon['coupon_discount_min']) {

            $coupon_option = number_format($dmshop_coupon['coupon_discount_min'])."원 이상 구매시";

        }

        // 퍼센트비율, 최대금액
        if ($dmshop_coupon['coupon_discount_type'] == '1' && $dmshop_coupon['coupon_discount_max']) {

            $coupon_option = " 최대 ".number_format($dmshop_coupon['coupon_discount_max'])."원 할인";

        }

    } else {

        $coupon_option = " 자유이용 쿠폰";

    }

    // 회원정보
    $user = shop_user($user_id);

    // set
    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", user_name = '".$user['user_name']."' ";
    $sql_common .= ", coupon_id = '".$coupon_id."' ";
    $sql_common .= ", coupon_type = '".$dmshop_coupon['coupon_type']."' ";
    $sql_common .= ", coupon_title = '".addslashes($dmshop_coupon['coupon_title'])."' ";
    $sql_common .= ", coupon_discount_type = '".$dmshop_coupon['coupon_discount_type']."' ";
    $sql_common .= ", coupon_discount = '".$dmshop_coupon['coupon_discount']."' ";
    $sql_common .= ", coupon_discount_max = '".$dmshop_coupon['coupon_discount_max']."' ";
    $sql_common .= ", coupon_discount_min = '".$dmshop_coupon['coupon_discount_min']."' ";
    $sql_common .= ", coupon_category_type = '".$dmshop_coupon['coupon_category_type']."' ";
    $sql_common .= ", coupon_category = '".$dmshop_coupon['coupon_category']."' ";
    $sql_common .= ", coupon_plan = '".$dmshop_coupon['coupon_plan']."' ";
    $sql_common .= ", coupon_bank = '".$dmshop_coupon['coupon_bank']."' ";
    $sql_common .= ", coupon_cash = '".$dmshop_coupon['coupon_cash']."' ";
    $sql_common .= ", coupon_overlap = '".$dmshop_coupon['coupon_overlap']."' ";
    $sql_common .= ", coupon_use = '".$dmshop_coupon['coupon_use']."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 발급일 기간
    if ($dmshop_coupon['coupon_day_type']) {

        $sql_common .= ", coupon_date1 = '".$shop['time_ymd']."' ";
        $sql_common .= ", coupon_date2 = '".date("Y-m-d", $shop['server_time'] + ($dmshop_coupon['coupon_day'] * 86400))."' ";

    } else {

        $sql_common .= ", coupon_date1 = '".$dmshop_coupon['coupon_date1']."' ";
        $sql_common .= ", coupon_date2 = '".$dmshop_coupon['coupon_date2']."' ";

    }

    // insert
    sql_query(" insert into $shop[coupon_list_table] $sql_common ");

    // 다운수 증가
    sql_query(" update $shop[coupon_table] set coupon_down = coupon_down + 1 where id = '".$coupon_id."' ");

    // sms 발송
    if ($sms_send) {

        // 관리자 지급
        if ($coupon_make_admin) {

            // sms
            $shop_sms_config = shop_sms_config("coupon");

        } else {
        // 자동 지급

            // sms
            $shop_sms_config = shop_sms_config("coupon_auto");

        }

        // 사용
        if ($shop_sms_config['sms_use'] && $user['user_hp']) {

            $sms_to = $user['user_hp'];
            $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

            $sms_message = $shop_sms_config['sms_message'];
            $sms_message = str_replace("[성명]", $user['user_name'], $sms_message);
            $sms_message = str_replace("[쿠폰명]", $dmshop_coupon['coupon_title'], $sms_message);
            $sms_message = str_replace("[쿠폰정보]", $coupon_option, $sms_message);
            $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
            $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

            // 전송
            shop_sms_send("coupon", $user['user_id'], $sms_to, $sms_from, $sms_message);

        }

    }

    return shop_coupon_return("ok", $return);

}

// 쿠폰 자동지급
function shop_coupon_auto_make($coupon_auto, $user_id, $order_code)
{

    global $shop, $dmshop;

    if (!$coupon_auto) {

        return false;

    }

    $coupon_auto_time = date("Y-m-d", strtotime($dmshop['coupon_auto_time']));

    // 신규가입, 첫구매, 상품평 작성, 원 이상 구매
    if ($coupon_auto == '1' || $coupon_auto == '3' || $coupon_auto == '4' || $coupon_auto == '5') {

        $sql_search = " where coupon_auto = '".$coupon_auto."' and coupon_type = '0' and coupon_use = '0' ";

        if (!$user_id) {

            return false;

        }

        // 첫구매
        if ($coupon_auto == '3') {

            // 구매완료
            $chk = sql_fetch(" select * from $shop[order_table] where user_id = '".$user_id."' and order_ok = '1' ");

            // 구매완료가 있다면 첫구매가 아니다.
            if ($chk['order_code']) {

                return false;

            }

        }

        // 원 이상 구매
        if ($coupon_auto == '5') {

            if (!$order_code) {

                return false;

            }

            $dmshop_order = shop_order($order_code);

            if (!$dmshop_order['order_code']) {

                return false;

            }

            $sql_search .= " and coupon_order_money <= '".$dmshop_order['order_total_item_money']."' ";

        }

        $result = sql_query(" select * from $shop[coupon_table] $sql_search ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            shop_coupon_make($row['id'], $user_id, true, false);

        }

        return true;

    }

    // 생일
    else if ($coupon_auto == '2') {

        if ($shop['time_ymd'] == $coupon_auto_time) {

            return false;

        }

        // 00~09 시간은 피한다
        if (date("H", $shop['server_time']) >= '00' && date("H", $shop['server_time']) <= '09') {

            return false;

        }

        // 오늘 생일이면서 레벨 2이상
        $result = sql_query(" select * from $shop[user_table] where substring(user_birth,5,4) = '".date("md", $shop['server_time'])."' and user_level >= '2' ");
        for ($i=0; $user=sql_fetch_array($result); $i++) {

            $result2 = sql_query(" select * from $shop[coupon_table] where coupon_auto = '".$coupon_auto."' and coupon_type = '0' and coupon_use = '0' ");
            for ($k=0; $coupon=sql_fetch_array($result2); $k++) {

                shop_coupon_make($coupon['id'], $user['user_id'], true, false);

            }

        }

    } else {

        return false;

    }

    // 시간 업데이트
    sql_query(" update $shop[config_table] set coupon_auto_time = '".$shop['time_ymdhis']."' ");

    return true;

}

// 쿠폰 리턴 메세지
function shop_coupon_return($id, $return)
{

    if ($id == '1') {

        $message = "쿠폰이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.";

    }

    else if ($id == '2') {

        $message = "쿠폰이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.";

    }

    else if ($id == '3') {

        $message = "쿠폰 발행이 중지된 상태입니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.";

    }

    else if ($id == '4') {

        $message = "발행된 모든 쿠폰이 소진 되었습니다.\\n\\n다음에 다시 이용하여 주시기 바랍니다.";

    }

    else if ($id == '5') {

        $message = "쿠폰 사용기간이 지났습니다.\\n\\n더이상 다운받으실 수 없습니다.";

    }

    else if ($id == '6') {

        $message = "이미 지급된 쿠폰입니다. 현재 쿠폰은 중복지급이 되지 않습니다.";

    }

    else if ($id == 'ok') {

        $message = "쿠폰이 발행되었습니다.";

    } else {

        return false;

    }

    if ($return) {

        return $message;

    } else {

        return false;

    }

}
?>