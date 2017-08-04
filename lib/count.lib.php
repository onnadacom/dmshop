<?
if (!defined("_DMSHOP_")) exit;

// 전체 주문내역
function shop_count_order_all()
{

    global $shop;

    //$data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and substring(order_datetime,1,10) >= '".$shop['time_ymd']."' ");
    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 일일 주문내역
function shop_count_order_day()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and substring(order_datetime,1,10) >= '".$shop['time_ymd']."' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 결제전
function shop_count_order_wait()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('100') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 무통장 입금
function shop_count_order_bank()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_pay_type = '5' and order_type in ('100') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 배송 준비
function shop_count_order_prepare()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('101') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 상품 발송
function shop_count_order_delivery()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('200') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 배송중
function shop_count_order_delivery1()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('201') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 상품수령
function shop_count_order_delivery2()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('202') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 취소 접수
function shop_count_order_cancel()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('300') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 취소 완료
function shop_count_order_cancel_ok()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('301') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 교환 접수
function shop_count_order_exchange()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('400') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 교환 완료
function shop_count_order_exchange_ok()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('401') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 환불 접수
function shop_count_order_refund()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('500') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 환불 접수
function shop_count_order_refund_ok()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('501') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 구매완료
function shop_count_order_ok()
{

    global $shop;

    $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where order_payment != '0' and order_type in ('900') ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 전체 등록된 상품
function shop_count_item()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[item_table] ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 전체 등록된 기획전
function shop_count_plan()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[plan_table] ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 1:1문의 내역
function shop_count_help()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[help_table] where id = help_id and help_count = '0' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 상품문의 내역
function shop_count_qna()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[qna_table] where id = qna_id and qna_count = '0' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 상품평 내역
function shop_count_reply()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[reply_table] where id = reply_id and reply_count = '0' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 전체회원
function shop_count_user()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[user_table] where user_leave_datetime = '0000-00-00 00:00:00' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 오늘방문자
function shop_count_visit_today()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[visit_table] where vi_first = '1' and substring(vi_datetime,1,10) = '".$shop['time_ymd']."' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 오늘가입자
function shop_count_user_today()
{

    global $shop;

    $data = sql_fetch(" select count(*) as total_count from $shop[user_table] where substring(datetime,1,10) = '".$shop['time_ymd']."' and user_leave_datetime = '0000-00-00 00:00:00' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}
?>