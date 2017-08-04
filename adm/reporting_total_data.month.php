<?php
if (!defined('_DMSHOP_')) exit;

// 날짜별 카운트 수를 구해야한다.
$date_count = strtotime($date2) - strtotime(substr($date1,0,7)."-01");
$date_count = (int)(($date_count / 86400) + 1);

$month_count = 0;
for ($i=0; $i<(int)($date_count); $i++) {

    if (date("d", strtotime(substr($date1,0,7)."-01") + (86400 * $i)) == '01') {

        $month_count++;

    }

}

$list = array();
for ($i=0; $i<(int)($month_count); $i++) {

    if ($i == '0') {

        $month = date("Y-m", strtotime(substr($date1,0,7)."-15"));

    } else {

        $month = date("Y-m", strtotime(substr($month,0,7)."-15") + (86400 * 30));

    }

    $list[$i]['month'] = $month;

}

// 방문자 수
if ($c1) {

    $total_visit_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 방문자 수
        $visit = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,1,7) = '".$list[$i]['month']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' ");

        $list[$i]['total_visit_count'] = $visit['total_count'];

        $total_visit_count += $list[$i]['total_visit_count'];

    }

}

// 주문 수
if ($c2) {

    $total_order_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것만
        $order = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

        $list[$i]['total_order_count'] = $order['total_count'];

        $total_order_count += $list[$i]['total_order_count'];

    }

}

// 방문자대비 주문율
if ($c3) {

    $total_visit_order_count = 0;
    for ($i=0; $i<count($list); $i++) {

        if (!$c1) {

            // 방문자 수
            $visit = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,1,7) = '".$list[$i]['month']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' ");

            $list[$i]['total_visit_count'] = $visit['total_count'];

        }

        if (!$c2) {

            // 결제가 되고, 취소, 환불 완료가 아닌 것만
            $order = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

            $list[$i]['total_order_count'] = $order['total_count'];

        }

        if ($list[$i]['total_visit_count'] && $list[$i]['total_order_count']) {

            $list[$i]['total_visit_order_count'] = round(($list[$i]['total_order_count'] * 100) / $list[$i]['total_visit_count'], 2);

        } else {

            $list[$i]['total_visit_order_count'] = 0;

        }

        $total_visit_order_count += $list[$i]['total_visit_order_count'];

    }

}

// 주문 상품 수
if ($c4) {

    $total_order_limit_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것만
        $order = sql_fetch(" select sum(order_limit) as total_count from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

        $list[$i]['total_order_limit_count'] = $order['total_count'];

        $total_order_limit_count += $list[$i]['total_order_limit_count'];

    }

}

// 취소 수, 취소 금액
if ($c5 || $c25) {

    $total_order_cancel_count = 0;
    $total_order_cancel_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소 완료
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_cancel_ok_datetime,1,7) = '".$list[$i]['month']."' and substring(order_cancel_ok_datetime,1,10) >= '".$date1."' and substring(order_cancel_ok_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel = '2') as x ");

        $list[$i]['total_order_cancel_count'] = $order['total_order_count'];
        $list[$i]['total_order_cancel_money'] = $order['total_order_pay_money']; // 취소금액 = 결제금액으로 한다

        $total_order_cancel_count += $list[$i]['total_order_cancel_count'];
        $total_order_cancel_money += $list[$i]['total_order_cancel_money'];

    }

}

// 환불 수, 환불 금액
if ($c6 || $c26) {

    $total_order_refund_count = 0;
    $total_order_refund_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 환불 완료
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_refund_ok_datetime,1,7) = '".$list[$i]['month']."' and substring(order_refund_ok_datetime,1,10) >= '".$date1."' and substring(order_refund_ok_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_refund = '2') as x ");

        $list[$i]['total_order_refund_count'] = $order['total_order_count'];
        $list[$i]['total_order_refund_money'] = $order['total_order_pay_money']; // 환불금액 = 결제금액으로 한다

        $total_order_refund_count += $list[$i]['total_order_refund_count'];
        $total_order_refund_money += $list[$i]['total_order_refund_money'];

    }

}

// 교환  수
if ($c7) {

    $total_order_exchange_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 교환 완료
        $order = sql_fetch(" select count(distinct order_exchange) as total_count from $shop[order_table] where substring(order_exchange_ok_datetime,1,7) = '".$list[$i]['month']."' and substring(order_exchange_ok_datetime,1,10) >= '".$date1."' and substring(order_exchange_ok_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_exchange = '2' ");

        $list[$i]['total_order_exchange_count'] = $order['total_count'];

        $total_order_exchange_count += $list[$i]['total_order_exchange_count'];

    }

}

// 적립금 사용 수
if ($c8 || $c27) {

    $total_cash_minus_count = 0;
    $total_cash_minus_cash = 0;
    for ($i=0; $i<count($list); $i++) {

        // 적립금 사용 전체 내역
        $cash = sql_fetch(" select count(*) as total_count, sum(cash) as total_cash from $shop[cash_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and cash < '0' ");

        $list[$i]['total_cash_minus_count'] = $cash['total_count'];
        $list[$i]['total_cash_minus_cash'] = str_replace("-", "", $cash['total_cash']);

        $total_cash_minus_count += $list[$i]['total_cash_minus_count'];
        $total_cash_minus_cash += $list[$i]['total_cash_minus_cash'];

    }

}

// 적립금 지급 수
if ($c9 || $c28) {

    $total_cash_plus_count = 0;
    $total_cash_plus_cash = 0;
    for ($i=0; $i<count($list); $i++) {

        // 적립금 사용 전체 내역
        $cash = sql_fetch(" select count(*) as total_count, sum(cash) as total_cash from $shop[cash_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and cash > '0' ");

        $list[$i]['total_cash_plus_count'] = $cash['total_count'];
        $list[$i]['total_cash_plus_cash'] = $cash['total_cash'];

        $total_cash_plus_count += $list[$i]['total_cash_plus_count'];
        $total_cash_plus_cash += $list[$i]['total_cash_plus_cash'];

    }

}

// 쿠폰 사용 수
if ($c10 || $c29) {

    $total_order_coupon_count = 0;
    $total_order_coupon_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 쿠폰 아이디가 있는 것
        $order = sql_fetch(" select count(*) as total_count, sum(order_coupon) as total_order_coupon from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_coupon_id != '0' ");

        $list[$i]['total_order_coupon_count'] = $order['total_count'];
        $list[$i]['total_order_coupon_money'] = $order['total_order_coupon'];

        $total_order_coupon_count += $list[$i]['total_order_coupon_count'];
        $total_order_coupon_money += $list[$i]['total_order_coupon_money'];

    }

}

// 쿠폰 지급 수
if ($c11) {

    $total_coupon_make_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 쿠폰 아이디가 있는 것
        $coupon = sql_fetch(" select count(*) as total_count from $shop[coupon_list_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' ");

        $list[$i]['total_coupon_make_count'] = $coupon['total_count'];

        $total_coupon_make_count += $list[$i]['total_coupon_make_count'];

    }

}

// 유료 배송 수
if ($c12 || $c30) {

    $total_order_delivery_count = 0;
    $total_order_delivery_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 배송비가 있는 것
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_delivery_money) as total_order_delivery_money from (select distinct order_code, order_delivery_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_delivery_money != '0') as x ");

        $list[$i]['total_order_delivery_count'] = $order['total_order_count'];
        $list[$i]['total_order_delivery_money'] = $order['total_order_delivery_money'];

        $total_order_delivery_count += $list[$i]['total_order_delivery_count'];
        $total_order_delivery_money += $list[$i]['total_order_delivery_money'];

    }

}

// 누적 회원 수
if ($c13) {

    $total_user_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 해당 기간일 이전의 회원 수
        $user = sql_fetch(" select count(*) as total_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_level >= '2' ");

        $list[$i]['total_user_count'] = $user['total_count'];

        $total_user_count += $list[$i]['total_user_count'];

    }

}

// 신규 가입자 수
if ($c14) {

    $total_user_regist_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 해당 기간의 가입자 수
        $user = sql_fetch(" select count(*) as total_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_level >= '2' ");

        $list[$i]['total_user_regist_count'] = $user['total_count'];

        $total_user_regist_count += $list[$i]['total_user_regist_count'];

    }

}

// 방문자대비 가입율
if ($c15) {

    $total_visit_regist_count = 0;
    for ($i=0; $i<count($list); $i++) {

        if (!$c1) {

            // 방문자 수
            $visit = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,1,7) = '".$list[$i]['month']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' ");

            $list[$i]['total_visit_count'] = $visit['total_count'];

        }

        if (!$c14) {

            // 해당 기간의 가입자 수
            $user = sql_fetch(" select count(*) as total_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_level >= '2' ");

            $list[$i]['total_user_regist_count'] = $user['total_count'];

        }

        if ($list[$i]['total_visit_count'] && $list[$i]['total_user_regist_count']) {

            $list[$i]['total_visit_regist_count'] = round(($list[$i]['total_user_regist_count'] * 100) / $list[$i]['total_visit_count'], 2);

        } else {

            $list[$i]['total_visit_regist_count'] = 0;

        }

        $total_visit_regist_count += $list[$i]['total_visit_regist_count'];

    }

}

// 탈퇴 회원 수
if ($c16) {

    $total_user_leave_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 해당 기간의 탈퇴 회원 수
        $user = sql_fetch(" select count(*) as total_count from $shop[user_table] where substring(user_leave_datetime,1,7) = '".$list[$i]['month']."' and substring(user_leave_datetime,1,10) >= '".$date1."' and substring(user_leave_datetime,1,10) <= '".$date2."' ");

        $list[$i]['total_user_leave_count'] = $user['total_count'];

        $total_user_leave_count += $list[$i]['total_user_leave_count'];

    }

}

// 로그인 수
if ($c17) {

    $total_user_login_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 해당 기간의 로그인 회원 수
        $user = sql_fetch(" select count(distinct user_id) as total_count from $shop[user_login_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' ");

        $list[$i]['total_user_login_count'] = $user['total_count'];

        $total_user_login_count += $list[$i]['total_user_login_count'];

    }

}

// 신용카드 결제 수
if ($c18 || $c31) {

    $total_order_pay_type1_count = 0;
    $total_order_pay_type1_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 신용카드 결제
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '1') as x ");

        $list[$i]['total_order_pay_type1_count'] = $order['total_order_count'];
        $list[$i]['total_order_pay_type1_money'] = $order['total_order_pay_money'];

        $total_order_pay_type1_count += $list[$i]['total_order_pay_type1_count'];
        $total_order_pay_type1_money += $list[$i]['total_order_pay_type1_money'];

    }

}

// 실시간계좌 이체 수
if ($c19 || $c32) {

    $total_order_pay_type2_count = 0;
    $total_order_pay_type2_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 실시간계좌 이체
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '2') as x ");

        $list[$i]['total_order_pay_type2_count'] = $order['total_order_count'];
        $list[$i]['total_order_pay_type2_money'] = $order['total_order_pay_money'];

        $total_order_pay_type2_count += $list[$i]['total_order_pay_type2_count'];
        $total_order_pay_type2_money += $list[$i]['total_order_pay_type2_money'];

    }

}

// 휴대폰 결제 수
if ($c20 || $c33) {

    $total_order_pay_type3_count = 0;
    $total_order_pay_type3_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 휴대폰 결제
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '3') as x ");

        $list[$i]['total_order_pay_type3_count'] = $order['total_order_count'];
        $list[$i]['total_order_pay_type3_money'] = $order['total_order_pay_money'];

        $total_order_pay_type3_count += $list[$i]['total_order_pay_type3_count'];
        $total_order_pay_type3_money += $list[$i]['total_order_pay_type3_money'];

    }

}

// 가상계좌 결제 수
if ($c21 || $c34) {

    $total_order_pay_type4_count = 0;
    $total_order_pay_type4_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 가상계좌 결제
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '4') as x ");

        $list[$i]['total_order_pay_type4_count'] = $order['total_order_count'];
        $list[$i]['total_order_pay_type4_money'] = $order['total_order_pay_money'];

        $total_order_pay_type4_count += $list[$i]['total_order_pay_type4_count'];
        $total_order_pay_type4_money += $list[$i]['total_order_pay_type4_money'];

    }

}

// 무통장 입금 수
if ($c22 || $c35) {

    $total_order_pay_type5_count = 0;
    $total_order_pay_type5_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것, 무통장 입금
        $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '5') as x ");

        $list[$i]['total_order_pay_type5_count'] = $order['total_order_count'];
        $list[$i]['total_order_pay_type5_money'] = $order['total_order_pay_money'];

        $total_order_pay_type5_count += $list[$i]['total_order_pay_type5_count'];
        $total_order_pay_type5_money += $list[$i]['total_order_pay_type5_money'];

    }

}

// 결제 금액, 주문금액
if ($c23 || $c24) {

    $total_order_pay_money = 0;
    $total_order_total_item_money = 0;
    for ($i=0; $i<count($list); $i++) {

        // 결제가 되고, 취소, 환불 완료가 아닌 것만
        $order_count = sql_fetch(" select sum(order_pay_money) as total_order_pay_money, sum(order_total_item_money) as total_order_total_item_money from (select distinct order_code, order_pay_money, order_total_item_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

        $list[$i]['total_order_pay_money'] = $order_count['total_order_pay_money'];
        $list[$i]['total_order_total_item_money'] = $order_count['total_order_total_item_money'];

        $total_order_pay_money += $list[$i]['total_order_pay_money'];
        $total_order_total_item_money += $list[$i]['total_order_total_item_money'];

    }

}

// 페이지뷰
if ($c36) {

    $total_visit_page_count = 0;
    for ($i=0; $i<count($list); $i++) {

        // 방문자 수
        $visit = sql_fetch(" select count(*) as total_count from $shop[visit_table] where substring(vi_datetime,1,7) = '".$list[$i]['month']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' ");

        $list[$i]['total_visit_page_count'] = $visit['total_count'];

        $total_visit_page_count += $list[$i]['total_visit_page_count'];

    }

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "종합 통계분석"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<? if ($c1) { ?><td <?=shop_reporting_style("list_title");?>>방문자 수</td><? } ?>
<? if ($c36) { ?><td <?=shop_reporting_style("list_title");?>>페이지 뷰</td><? } ?>
<? if ($c2) { ?><td <?=shop_reporting_style("list_title");?>>주문 수</td><? } ?>
<? if ($c3) { ?><td <?=shop_reporting_style("list_title");?>>방문자대비 주문율</td><? } ?>
<? if ($c4) { ?><td <?=shop_reporting_style("list_title");?>>주문 상품 수</td><? } ?>
<? if ($c5) { ?><td <?=shop_reporting_style("list_title");?>>취소 수</td><? } ?>
<? if ($c6) { ?><td <?=shop_reporting_style("list_title");?>>환불 수</td><? } ?>
<? if ($c7) { ?><td <?=shop_reporting_style("list_title");?>>교환 수</td><? } ?>
<? if ($c8) { ?><td <?=shop_reporting_style("list_title");?>>적립금 사용 수</td><? } ?>
<? if ($c9) { ?><td <?=shop_reporting_style("list_title");?>>적립금 지급 수</td><? } ?>
<? if ($c10) { ?><td <?=shop_reporting_style("list_title");?>>쿠폰 사용 수</td><? } ?>
<? if ($c11) { ?><td <?=shop_reporting_style("list_title");?>>쿠폰 지급 수</td><? } ?>
<? if ($c12) { ?><td <?=shop_reporting_style("list_title");?>>유료 배송 수</td><? } ?>
<? if ($c13) { ?><td <?=shop_reporting_style("list_title");?>>누적 회원 수</td><? } ?>
<? if ($c14) { ?><td <?=shop_reporting_style("list_title");?>>신규 가입자 수</td><? } ?>
<? if ($c15) { ?><td <?=shop_reporting_style("list_title");?>>방문자대비 가입율</td><? } ?>
<? if ($c16) { ?><td <?=shop_reporting_style("list_title");?>>탈퇴 회원 수</td><? } ?>
<? if ($c17) { ?><td <?=shop_reporting_style("list_title");?>>로그인 수</td><? } ?>
<? if ($c18) { ?><td <?=shop_reporting_style("list_title");?>>신용카드 결제 수</td><? } ?>
<? if ($c19) { ?><td <?=shop_reporting_style("list_title");?>>실시간계좌 이체 수</td><? } ?>
<? if ($c20) { ?><td <?=shop_reporting_style("list_title");?>>휴대폰 결제 수</td><? } ?>
<? if ($c21) { ?><td <?=shop_reporting_style("list_title");?>>가상계좌 결제 수</td><? } ?>
<? if ($c22) { ?><td <?=shop_reporting_style("list_title");?>>무통장 입금 수</td><? } ?>
<? if ($c23) { ?><td <?=shop_reporting_style("list_title");?>>결제 금액</td><? } ?>
<? if ($c24) { ?><td <?=shop_reporting_style("list_title");?>>주문 금액</td><? } ?>
<? if ($c25) { ?><td <?=shop_reporting_style("list_title");?>>취소 금액</td><? } ?>
<? if ($c26) { ?><td <?=shop_reporting_style("list_title");?>>환불 금액</td><? } ?>
<? if ($c27) { ?><td <?=shop_reporting_style("list_title");?>>적립금 사용금액</td><? } ?>
<? if ($c28) { ?><td <?=shop_reporting_style("list_title");?>>적립금 지급금액</td><? } ?>
<? if ($c29) { ?><td <?=shop_reporting_style("list_title");?>>쿠폰 사용금액</td><? } ?>
<? if ($c30) { ?><td <?=shop_reporting_style("list_title");?>>유료배송 결제금액</td><? } ?>
<? if ($c31) { ?><td <?=shop_reporting_style("list_title");?>>신용카드 결제금액</td><? } ?>
<? if ($c32) { ?><td <?=shop_reporting_style("list_title");?>>실시간계좌 이체금액</td><? } ?>
<? if ($c33) { ?><td <?=shop_reporting_style("list_title");?>>휴대폰 결제금액</td><? } ?>
<? if ($c34) { ?><td <?=shop_reporting_style("list_title");?>>가상계좌 결제금액</td><? } ?>
<? if ($c35) { ?><td <?=shop_reporting_style("list_title");?>>무통장 입금액</td><? } ?>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['month']?></td>
<? if ($c1) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_count']);?> 명</td><? } ?>
<? if ($c36) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_page_count']);?> 건</td><? } ?>
<? if ($c2) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_count']);?> 건</td><? } ?>
<? if ($c3) { ?><td <?=shop_reporting_style("list_text");?>><?=$list[$i]['total_visit_order_count']?> %</td><? } ?>
<? if ($c4) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_limit_count']);?> 개</td><? } ?>
<? if ($c5) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_cancel_count']);?> 건</td><? } ?>
<? if ($c6) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_refund_count']);?> 건</td><? } ?>
<? if ($c7) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_exchange_count']);?> 건</td><? } ?>
<? if ($c8) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_cash_minus_count']);?> 건</td><? } ?>
<? if ($c9) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_cash_plus_count']);?> 건</td><? } ?>
<? if ($c10) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_coupon_count']);?> 건</td><? } ?>
<? if ($c11) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_coupon_make_count']);?> 건</td><? } ?>
<? if ($c12) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_delivery_count']);?> 건</td><? } ?>
<? if ($c13) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_user_count']);?> 명</td><? } ?>
<? if ($c14) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_user_regist_count']);?> 명</td><? } ?>
<? if ($c15) { ?><td <?=shop_reporting_style("list_text");?>><?=$list[$i]['total_visit_regist_count']?> %</td><? } ?>
<? if ($c16) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_user_leave_count']);?> 명</td><? } ?>
<? if ($c17) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_user_login_count']);?> 명</td><? } ?>
<? if ($c18) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type1_count']);?> 건</td><? } ?>
<? if ($c19) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type2_count']);?> 건</td><? } ?>
<? if ($c20) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type3_count']);?> 건</td><? } ?>
<? if ($c21) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type4_count']);?> 건</td><? } ?>
<? if ($c22) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type5_count']);?> 건</td><? } ?>
<? if ($c23) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money']);?> 원</td><? } ?>
<? if ($c24) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_total_item_money']);?> 원</td><? } ?>
<? if ($c25) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_cancel_money']);?> 원</td><? } ?>
<? if ($c26) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_refund_money']);?> 원</td><? } ?>
<? if ($c27) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_cash_minus_cash']);?> 원</td><? } ?>
<? if ($c28) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_cash_plus_cash']);?> 원</td><? } ?>
<? if ($c29) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_coupon_money']);?> 원</td><? } ?>
<? if ($c30) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_delivery_money']);?> 원</td><? } ?>
<? if ($c31) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type1_money']);?> 원</td><? } ?>
<? if ($c32) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type2_money']);?> 원</td><? } ?>
<? if ($c33) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type3_money']);?> 원</td><? } ?>
<? if ($c34) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type4_money']);?> 원</td><? } ?>
<? if ($c35) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type5_money']);?> 원</td><? } ?>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<? if ($c1) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_count);?> 명</td><? } ?>
<? if ($c36) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_page_count);?> 건</td><? } ?>
<? if ($c2) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_count);?> 건</td><? } ?>
<? if ($c3) { ?><td <?=shop_reporting_style("list_text");?>>평균 <? if ($total_visit_order_count) { echo round($total_visit_order_count / count($list), 2); } else { echo 0; } ?> %</td><? } ?>
<? if ($c4) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_limit_count);?> 개</td><? } ?>
<? if ($c5) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_cancel_count);?> 건</td><? } ?>
<? if ($c6) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_refund_count);?> 건</td><? } ?>
<? if ($c7) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_exchange_count);?> 건</td><? } ?>
<? if ($c8) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_cash_minus_count);?> 건</td><? } ?>
<? if ($c9) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_cash_plus_count);?> 건</td><? } ?>
<? if ($c10) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_coupon_count);?> 건</td><? } ?>
<? if ($c11) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_coupon_make_count);?> 건</td><? } ?>
<? if ($c12) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_delivery_count);?> 건</td><? } ?>
<? if ($c13) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_user_count);?> 명</td><? } ?>
<? if ($c14) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_user_regist_count);?> 명</td><? } ?>
<? if ($c15) { ?><td <?=shop_reporting_style("list_text");?>>평균 <? if ($total_visit_regist_count) { echo round($total_visit_regist_count / count($list), 2); } else { echo 0; } ?> %</td><? } ?>
<? if ($c16) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_user_leave_count);?> 명</td><? } ?>
<? if ($c17) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_user_login_count);?> 명</td><? } ?>
<? if ($c18) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type1_count);?> 건</td><? } ?>
<? if ($c19) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type2_count);?> 건</td><? } ?>
<? if ($c20) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type3_count);?> 건</td><? } ?>
<? if ($c21) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type4_count);?> 건</td><? } ?>
<? if ($c22) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type5_count);?> 건</td><? } ?>
<? if ($c23) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money);?> 원</td><? } ?>
<? if ($c24) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_total_item_money);?> 원</td><? } ?>
<? if ($c25) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_cancel_money);?> 원</td><? } ?>
<? if ($c26) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_refund_money);?> 원</td><? } ?>
<? if ($c27) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_cash_minus_cash);?> 원</td><? } ?>
<? if ($c28) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_cash_plus_cash);?> 원</td><? } ?>
<? if ($c29) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_coupon_money);?> 원</td><? } ?>
<? if ($c30) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_delivery_money);?> 원</td><? } ?>
<? if ($c31) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type1_money);?> 원</td><? } ?>
<? if ($c32) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type2_money);?> 원</td><? } ?>
<? if ($c33) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type3_money);?> 원</td><? } ?>
<? if ($c34) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type4_money);?> 원</td><? } ?>
<? if ($c35) { ?><td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type5_money);?> 원</td><? } ?>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Year');

<? if ($c1) { ?>data.addColumn('number', '방문자 수');<? } ?>
<? if ($c36) { ?>data.addColumn('number', '페이지 뷰');<? } ?>
<? if ($c2) { ?>data.addColumn('number', '주문 수');<? } ?>
<? if ($c3) { ?>data.addColumn('number', '방문자대비 주문율');<? } ?>
<? if ($c4) { ?>data.addColumn('number', '주문 상품 수');<? } ?>
<? if ($c5) { ?>data.addColumn('number', '취소 수');<? } ?>
<? if ($c6) { ?>data.addColumn('number', '환불 수');<? } ?>
<? if ($c7) { ?>data.addColumn('number', '교환 수');<? } ?>
<? if ($c8) { ?>data.addColumn('number', '적립금 사용 수');<? } ?>
<? if ($c9) { ?>data.addColumn('number', '적립금 지급 수');<? } ?>
<? if ($c10) { ?>data.addColumn('number', '쿠폰 사용 수');<? } ?>
<? if ($c11) { ?>data.addColumn('number', '쿠폰 지급 수');<? } ?>
<? if ($c12) { ?>data.addColumn('number', '유료 배송 수');<? } ?>
<? if ($c13) { ?>data.addColumn('number', '누적 회원 수');<? } ?>
<? if ($c14) { ?>data.addColumn('number', '신규 가입자 수');<? } ?>
<? if ($c15) { ?>data.addColumn('number', '방문자대비 가입율');<? } ?>
<? if ($c16) { ?>data.addColumn('number', '탈퇴 회원 수');<? } ?>
<? if ($c17) { ?>data.addColumn('number', '로그인 수');<? } ?>
<? if ($c18) { ?>data.addColumn('number', '신용카드 결제 수');<? } ?>
<? if ($c19) { ?>data.addColumn('number', '실시간계좌 이체 수');<? } ?>
<? if ($c20) { ?>data.addColumn('number', '휴대폰 결제 수');<? } ?>
<? if ($c21) { ?>data.addColumn('number', '가상계좌 결제 수');<? } ?>
<? if ($c22) { ?>data.addColumn('number', '무통장 입금 수');<? } ?>
<? if ($c23) { ?>data.addColumn('number', '결제 금액');<? } ?>
<? if ($c24) { ?>data.addColumn('number', '주문 금액');<? } ?>
<? if ($c25) { ?>data.addColumn('number', '취소 금액');<? } ?>
<? if ($c26) { ?>data.addColumn('number', '환불 금액');<? } ?>
<? if ($c27) { ?>data.addColumn('number', '적립금 사용금액');<? } ?>
<? if ($c28) { ?>data.addColumn('number', '적립금 지급금액');<? } ?>
<? if ($c29) { ?>data.addColumn('number', '쿠폰 사용금액');<? } ?>
<? if ($c30) { ?>data.addColumn('number', '유료배송 결제금액');<? } ?>
<? if ($c31) { ?>data.addColumn('number', '신용카드 결제금액');<? } ?>
<? if ($c32) { ?>data.addColumn('number', '실시간계좌 이체금액');<? } ?>
<? if ($c33) { ?>data.addColumn('number', '휴대폰 결제금액');<? } ?>
<? if ($c34) { ?>data.addColumn('number', '가상계좌 결제금액');<? } ?>
<? if ($c35) { ?>data.addColumn('number', '무통장 입금액');<? } ?>

    data.addRows([

<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    if ($c1) { $c1 = ",".(int)($list[$i]['total_visit_count']); }
    if ($c36) { $c36 = ",".(int)($list[$i]['total_visit_page_count']); }
    if ($c2) { $c2 = ",".(int)($list[$i]['total_order_count']); }
    if ($c3) { $c3 = ",".$list[$i]['total_visit_order_count']; }
    if ($c4) { $c4 = ",".(int)($list[$i]['total_order_limit_count']); }
    if ($c5) { $c5 = ",".(int)($list[$i]['total_order_cancel_count']); }
    if ($c6) { $c6 = ",".(int)($list[$i]['total_order_refund_count']); }
    if ($c7) { $c7 = ",".(int)($list[$i]['total_order_exchange_count']); }
    if ($c8) { $c8 = ",".(int)($list[$i]['total_cash_minus_count']); }
    if ($c9) { $c9 = ",".(int)($list[$i]['total_cash_plus_count']); }
    if ($c10) { $c10 = ",".(int)($list[$i]['total_order_coupon_count']); }
    if ($c11) { $c11 = ",".(int)($list[$i]['total_coupon_make_count']); }
    if ($c12) { $c12 = ",".(int)($list[$i]['total_order_delivery_count']); }
    if ($c13) { $c13 = ",".(int)($list[$i]['total_user_count']); }
    if ($c14) { $c14 = ",".(int)($list[$i]['total_user_regist_count']); }
    if ($c15) { $c15 = ",".$list[$i]['total_visit_regist_count']; }
    if ($c16) { $c16 = ",".(int)($list[$i]['total_user_leave_count']); }
    if ($c17) { $c17 = ",".(int)($list[$i]['total_user_login_count']); }
    if ($c18) { $c18 = ",".(int)($list[$i]['total_order_pay_type1_count']); }
    if ($c19) { $c19 = ",".(int)($list[$i]['total_order_pay_type2_count']); }
    if ($c20) { $c20 = ",".(int)($list[$i]['total_order_pay_type3_count']); }
    if ($c21) { $c21 = ",".(int)($list[$i]['total_order_pay_type4_count']); }
    if ($c22) { $c22 = ",".(int)($list[$i]['total_order_pay_type5_count']); }
    if ($c23) { $c23 = ",".(int)($list[$i]['total_order_pay_money']); }
    if ($c24) { $c24 = ",".(int)($list[$i]['total_order_total_item_money']); }
    if ($c25) { $c25 = ",".(int)($list[$i]['total_order_cancel_money']); }
    if ($c26) { $c26 = ",".(int)($list[$i]['total_order_refund_money']); }
    if ($c27) { $c27 = ",".(int)($list[$i]['total_cash_minus_cash']); }
    if ($c28) { $c28 = ",".(int)($list[$i]['total_cash_plus_cash']); }
    if ($c29) { $c29 = ",".(int)($list[$i]['total_order_coupon_money']); }
    if ($c30) { $c30 = ",".(int)($list[$i]['total_order_delivery_money']); }
    if ($c31) { $c31 = ",".(int)($list[$i]['total_order_pay_type1_money']); }
    if ($c32) { $c32 = ",".(int)($list[$i]['total_order_pay_type2_money']); }
    if ($c33) { $c33 = ",".(int)($list[$i]['total_order_pay_type3_money']); }
    if ($c34) { $c34 = ",".(int)($list[$i]['total_order_pay_type4_money']); }
    if ($c35) { $c35 = ",".(int)($list[$i]['total_order_pay_type5_money']); }

    echo $comma."['".$list[$i]['month']."'".$c1.$c36.$c2.$c3.$c4.$c5.$c6.$c7.$c8.$c9.$c10.$c11.$c12.$c13.$c14.$c15.$c16.$c17.$c18.$c19.$c20.$c21.$c22.$c23.$c24.$c25.$c26.$c27.$c28.$c29.$c30.$c31.$c32.$c33.$c34.$c35."]";

}
?>

    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));

    chart.draw(data, {

    width: '100%', height: '500',
    legend: 'right',
    legendTextStyle: {fontName: 'gulim', fontSize: '12'},
    tooltipTextStyle: {color: '#006679', fontName: 'dotum', fontSize: '12'},

    hAxis: {textStyle: {color: '#959595', fontName: 'dotum', fontSize: '12'}},
    vAxis: {textStyle: {color: '#959595', fontName: 'dotum', fontSize: '12'}, gridlineColor: '#e1e1e1', baselineColor: '#e1e1e1', textPosition: 'out'},

lineWidth: 3,
pointSize: 5

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>