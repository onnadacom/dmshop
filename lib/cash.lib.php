<?
if (!defined("_DMSHOP_")) exit;

// 적립금 (지급,차감)
function shop_cash_insert($user_id, $cash, $content='', $cash_key1='', $cash_key2='', $cash_key3='')
{

    global $dmshop, $shop;

    // 미사용
    if ($cash == '0' || !$cash || !$user_id || !$dmshop['payment_type6']) {

        return false;

    }

    // 회원 정보
    $user = shop_user($user_id);

    if (!$user['user_id']) {

        return false;

    }

    if ($cash_key1 || $cash_key2 || $cash_key3) {

        $data = sql_fetch(" select * from $shop[cash_table] where user_id = '".$user_id."' and cash_key1 = '".$cash_key1."' and cash_key2 = '".$cash_key2."' and cash_key3 = '".$cash_key3."' ");

        if ($data['id']) {

            return false;

        }

    } else {

        return false;

    }

    // 내역 생성
    sql_query(" insert into $shop[cash_table] set user_id = '".$user_id."', user_name = '".addslashes($user['user_name'])."', content = '".addslashes($content)."', cash = '".$cash."', cash_key1 = '".$cash_key1."', cash_key2 = '".$cash_key2."', cash_key3 = '".$cash_key3."', datetime = '".$shop['time_ymdhis']."' ");

    // 합산
    $row = sql_fetch(" select sum(cash) as total_cash from $shop[cash_table] where user_id = '".$user_id."' ");

    // 회원 테이블 업데이트
    sql_query(" update $shop[user_table] set user_cash = '".$row['total_cash']."' where user_id = '".$user_id."' ");

    return true;

}

// 적립금 (삭제)
function shop_cash_delete($user_id, $cash_id='', $cash_key1='', $cash_key2='', $cash_key3='')
{

    global $dmshop, $shop;

    // 아이디
    if ($cash_id) {

        $data = sql_fetch(" select * from $shop[cash_table] where id = '".$cash_id."' ");

        if (!$data['id']) {

            return false;

        }

        // 아이디 설정
        $user_id = $data['user_id'];

    }

    // 키
    else if ($cash_key1 || $cash_key2 || $cash_key3) {

        // 아이디가 없다
        if (!$user_id) {

            return false;

        }

        $data = sql_fetch(" select * from $shop[cash_table] where user_id = '".$user_id."' and cash_key1 = '".$cash_key1."' and cash_key2 = '".$cash_key2."' and cash_key3 = '".$cash_key3."' ");

        if (!$data['id']) {

            return false;

        }

    } else {

        return false;

    }

    // 내역 삭제
    sql_query(" delete from $shop[cash_table] where id = '".$data['id']."' ");

    // 합산
    $row = sql_fetch(" select sum(cash) as total_cash from $shop[cash_table] where user_id = '".$user_id."' ");

    // 회원 테이블 업데이트
    sql_query(" update $shop[user_table] set user_cash = '".$row['total_cash']."' where user_id = '".$user_id."' ");

    return true;

}

// 적립금 형식
function shop_cash_type($cash_type)
{

    if ($cash_type == 'order') {

        $data = "주문 차감";

    }

    else if ($cash_type == 'order_item') {

        $data = "상품 주문";

    }

    else if ($cash_type == 'recommend') {

        $data = "추천인";

    }

    else if ($cash_type == 'cash_plus') {

        $data = "관리자 지급";

    }

    else if ($cash_type == 'cash_minus') {

        $data = "관리자 차감";

    } else {

        $data = "기타";

    }

    return $data;

}

// 적립금 자동지급
function shop_cash_auto()
{

    global $shop, $dmshop;

    $cash_auto_time = date("Y-m-d", strtotime($dmshop['cash_auto_time']));

    if ($shop['time_ymd'] == $cash_auto_time) {

        return false;

    }

    // 00~09 시간은 피한다
    if (date("H", $shop['server_time']) >= '00' && date("H", $shop['server_time']) <= '09') {

        return false;

    }

    // 생일
    if ($dmshop['birth_cash_use'] && $dmshop['birth_cash']) {

        // 오늘 생일이면서 레벨 2이상
        $result = sql_query(" select * from $shop[user_table] where substring(user_birth,5,4) = '".date("md", $shop['server_time'])."' and user_level >= '2' ");
        for ($i=0; $user=sql_fetch_array($result); $i++) {

            // 적립금 지급
            shop_cash_insert($user['user_id'], (int)($dmshop['birth_cash'] * 1), $user['user_name']."님의 생일을 축하합니다.", $user['user_id'], $shop['time_ymd'], "birth");

        }

    }

    // 시간 업데이트
    sql_query(" update $shop[config_table] set cash_auto_time = '".$shop['time_ymdhis']."' ");

    return true;

}
?>