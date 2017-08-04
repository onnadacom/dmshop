<?
if (!defined("_DMSHOP_")) exit;

// 개별결제
function shop_payment($pay_id)
{

    global $shop;

    if ($pay_id) { $pay_id = preg_match("/^[0-9]+$/", $pay_id) ? $pay_id : ""; }

    if (!$pay_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[payment_table] where id = '$pay_id' ");

}

// 결제코드
function shop_payment_code($pay_code)
{

    global $shop;

    if ($pay_code) { $pay_code = preg_match("/^[a-zA-Z0-9]+$/", $pay_code) ? $pay_code : ""; }

    if (!$pay_code) {

        return false;

    }

    return sql_fetch(" select * from $shop[payment_table] where pay_code = '$pay_code' ");

}

// 결제상태
function shop_payment_type($id)
{

    if ($id == '100') {

        $data = "결제전";

    }

    else if ($id == '101') {

        $data = "결제완료";

    }

    else if ($id == '300') {

        $data = "취소접수";

    }

    else if ($id == '301') {

        $data = "취소완료";

    } else {

        $data = "기타";

    }

    return $data;

}

// 영수증 버튼
function shop_payment_receipt_btn($pay_code)
{

    global $shop, $dmshop;

    if (!$pay_code) {

        return false;

    }

    // 결제정보
    $dmshop_payment = shop_payment_code($pay_code);

    // 데이터가 없다
    if (!$dmshop_payment['id']) {

        return false;

    }

    // 미결제
    if ($dmshop_payment['pay_payment'] == '100') {

        return false;

    }

    $data = "";

    // KCP
    if ($dmshop_payment['pay_pg'] == '3') {

        // 신용카드
        if ($dmshop_payment['pay_type'] == '1') {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_payment['pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_payment['pay_pg_code1']."', '".$pay_code."', '".$dmshop_payment['pay_receipt']."', '".$dmshop_payment['pay_receipt_code']."'); return false;\">btn</a>";

        }

        // 실시간 계좌이체
        else if ($dmshop_payment['pay_type'] == '2' && $dmshop_payment['pay_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_payment['pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_payment['pay_pg_code1']."', '".$pay_code."', '".$dmshop_payment['pay_receipt']."', '".$dmshop_payment['pay_receipt_code']."'); return false;\">btn</a>";

        }

        // 가상계좌
        else if ($dmshop_payment['pay_type'] == '4' && $dmshop_payment['pay_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_payment['pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_payment['pay_pg_code1']."', '".$pay_code."', '".$dmshop_payment['pay_receipt']."', '".$dmshop_payment['pay_receipt_code']."'); return false;\">btn</a>";

        }

        // 무통장
        else if ($dmshop_payment['pay_type'] == '5' && $dmshop_payment['pay_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_payment['pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_payment['pay_pg_code1']."', '".$pay_code."', '".$dmshop_payment['pay_receipt']."', '".$dmshop_payment['pay_receipt_code']."'); return false;\">btn</a>";

        } else {

            $data = "";

        }

    } else {

        return false;

    }

    return $data;

}
?>