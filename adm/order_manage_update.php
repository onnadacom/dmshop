<?php
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 주문번호가 없다면
if (!$order_code) {

    alert("주문내역이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 주문
$dmshop_order = shop_order($order_code);

if (!$dmshop_order['id']) {

    alert("주문내역이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 입금확인
if ($m == 'bank_ok') {

    // 결제전 단계가 아니라면
    if ($dmshop_order['order_type'] != '100') {

        alert("[".shop_order_type("100")."] 단계에서 하실 수 있습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_bank("ok", addslashes($order_code), addslashes($_POST['order_dep_name_real']), addslashes($_POST['order_dep_money_real']), addslashes($_POST['order_pay_datetime']), addslashes($_POST['order_pay_smstype1']), addslashes($_POST['order_pay_smstype2']));

    $sql_common = "";
    $sql_common .= " set order_refund_holder = '".addslashes($_POST['order_refund_holder'])."' ";
    $sql_common .= ", order_refund_number = '".addslashes($_POST['order_refund_number'])."' ";
    $sql_common .= ", order_refund_code = '".addslashes($_POST['order_refund_code'])."' ";
    $sql_common .= ", order_refund_jumin = '".addslashes($_POST['order_refund_jumin'])."' ";

    sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

}

// 입금수정
else if ($m == 'bank_update') {

    shop_order_bank("update", addslashes($order_code), addslashes($_POST['order_dep_name_real']), addslashes($_POST['order_dep_money_real']), addslashes($_POST['order_pay_datetime']), addslashes($_POST['order_pay_smstype1']), addslashes($_POST['order_pay_smstype2']));

    $sql_common = "";
    $sql_common .= " set order_refund_holder = '".addslashes($_POST['order_refund_holder'])."' ";
    $sql_common .= ", order_refund_number = '".addslashes($_POST['order_refund_number'])."' ";
    $sql_common .= ", order_refund_code = '".addslashes($_POST['order_refund_code'])."' ";
    $sql_common .= ", order_refund_jumin = '".addslashes($_POST['order_refund_jumin'])."' ";

    sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

}

// 환불은행수정
else if ($m == 'bank_update') {

    shop_order_bank("update", addslashes($order_code), addslashes($_POST['order_dep_name_real']), addslashes($_POST['order_dep_money_real']), addslashes($_POST['order_pay_datetime']), addslashes($_POST['order_pay_smstype1']), addslashes($_POST['order_pay_smstype2']));

    $sql_common = "";
    $sql_common .= " set order_refund_holder = '".addslashes($_POST['order_refund_holder'])."' ";
    $sql_common .= ", order_refund_number = '".addslashes($_POST['order_refund_number'])."' ";
    $sql_common .= ", order_refund_code = '".addslashes($_POST['order_refund_code'])."' ";
    $sql_common .= ", order_refund_jumin = '".addslashes($_POST['order_refund_jumin'])."' ";

    sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

}

// 입금취소
else if ($m == 'bank_cancel') {

    // 결제완료 단계가 아니라면
    if ($dmshop_order['order_type'] != '101') {

        alert("[".shop_order_type("101")."] 단계에서 취소하실 수 있습니다.\\n\\n다음단계로 넘어간 경우에는 변경하실 수 없습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_bank("cancel", addslashes($order_code), addslashes($_POST['order_dep_name_real']), addslashes($_POST['order_dep_money_real']), addslashes($_POST['order_pay_datetime']), addslashes($_POST['order_pay_smstype1']), addslashes($_POST['order_pay_smstype2']));

    $sql_common = "";
    $sql_common .= " set order_refund_holder = '".addslashes($_POST['order_refund_holder'])."' ";
    $sql_common .= ", order_refund_number = '".addslashes($_POST['order_refund_number'])."' ";
    $sql_common .= ", order_refund_code = '".addslashes($_POST['order_refund_code'])."' ";
    $sql_common .= ", order_refund_jumin = '".addslashes($_POST['order_refund_jumin'])."' ";

    sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

}

// 환불 은행정보 등록
else if ($m == 'bank_refund') {

    $sql_common = "";
    $sql_common .= " set order_refund_holder = '".addslashes($_POST['order_refund_holder'])."' ";
    $sql_common .= ", order_refund_number = '".addslashes($_POST['order_refund_number'])."' ";
    $sql_common .= ", order_refund_code = '".addslashes($_POST['order_refund_code'])."' ";
    $sql_common .= ", order_refund_jumin = '".addslashes($_POST['order_refund_jumin'])."' ";

    sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

}

// 배송준비
else if ($m == 'prepare_ok') {

    // 결제완료 단계가 아니라면
    if ($dmshop_order['order_type'] != '101') {

        alert("[".shop_order_type("101")."] 단계에서 변경하실 수 있습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_prepare("ok", $order_code);

}

// 배송준비 취소
else if ($m == 'prepare_cancel') {

    // 배송준비중 단계가 아니라면
    if ($dmshop_order['order_type'] != '200') {

        alert("[".shop_order_type("200")."] 단계에서 취소하실 수 있습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_prepare("cancel", $order_code);

}

// 상품발송
else if ($m == 'delivery_ok') {

    // 배송준비중 단계가 아니라면
    if ($dmshop_order['order_type'] != '200') {

        alert("[".shop_order_type("200")."] 단계에서 변경하실 수 있습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_delivery("ok", $order_code, addslashes($_POST['order_delivery_id']), addslashes($_POST['order_delivery_tel']), addslashes($_POST['order_delivery_url']), addslashes($_POST['order_delivery_number']), addslashes($_POST['order_delivery_datetime']), addslashes($_POST['order_delivery_smstype1']), addslashes($_POST['order_delivery_smstype2']));

}

// 상품발송 수정
else if ($m == 'delivery_update') {

    shop_order_delivery("update", $order_code, addslashes($_POST['order_delivery_id']), addslashes($_POST['order_delivery_tel']), addslashes($_POST['order_delivery_url']), addslashes($_POST['order_delivery_number']), addslashes($_POST['order_delivery_datetime']), addslashes($_POST['order_delivery_smstype1']), addslashes($_POST['order_delivery_smstype2']));

}

// 상품발송 취소
else if ($m == 'delivery_cancel') {

    // 상품발송 단계가 아니라면
    if ($dmshop_order['order_type'] != '201') {

        alert("[".shop_order_type("201")."] 단계에서 취소하실 수 있습니다.\\n\\n현재 [".shop_order_type($dmshop_order['order_type'])."] 단계입니다.");

    }

    shop_order_delivery("cancel", $order_code, addslashes($_POST['order_delivery_id']), addslashes($_POST['order_delivery_tel']), addslashes($_POST['order_delivery_url']), addslashes($_POST['order_delivery_number']), addslashes($_POST['order_delivery_datetime']), addslashes($_POST['order_delivery_smstype1']), addslashes($_POST['order_delivery_smstype2']));

}

// 취소 승인
else if ($m == 'cancel_ok') {

    shop_order_cancel("ok", $order_code);

}

// 취소 거절
else if ($m == 'cancel_cancel') {

    shop_order_cancel("cancel", $order_code);

}

// 교환 승인
else if ($m == 'exchange_ok') {

    shop_order_exchange("ok", $order_code);

}

// 교환 거절
else if ($m == 'exchange_cancel') {

    shop_order_exchange("cancel", $order_code);

}

// 환불 승인
else if ($m == 'refund_ok') {

    shop_order_refund("ok", $order_code);

}

// 환불 거절
else if ($m == 'refund_cancel') {

    shop_order_refund("cancel", $order_code);

}

// 답변
else if ($m == 'help') {

    // help 데이터
    $dmshop_help = shop_help_reply(addslashes($_POST['help_id']));

    // 있다면
    if ($dmshop_help['id']) {

        alert("이미 등록된 답변이 있습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 업데이트
    $sql_common = "";
    $sql_common .= " set user_id = '".addslashes($dmshop_user['user_id'])."' ";
    $sql_common .= ", user_name = '".addslashes($dmshop_user['user_name'])."' ";
    $sql_common .= ", help_id = '".addslashes($_POST['help_id'])."' ";
    $sql_common .= ", subject = '".addslashes($_POST['subject'])."' ";
    $sql_common .= ", content = '".addslashes($_POST['content'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[help_table] $sql_common ");

    $help_id = "";
    $help_id = mysql_insert_id();

    // 질문에 답변수 증가
    sql_query(" update $shop[help_table] set help_count = help_count + 1 where id = '".addslashes($_POST['help_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/help/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // help
    $upload_mode = $help_id;
    include("$shop[path]/upload_help_file.php");

    // 답변안내 SMS
    if ($dmshop_help['help_send_sms'] && $dmshop_help['user_hp']) {

        // sms
        $shop_sms_config = shop_sms_config("help");

        // 사용
        if ($shop_sms_config['sms_use'] && $dmshop_help['user_hp']) {

            $sms_to = $dmshop_help['user_hp'];
            $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

            $sms_message = $shop_sms_config['sms_message'];
            $sms_message = str_replace("[성명]", $dmshop_user['user_name'], $sms_message);
            $sms_message = str_replace("[아이디]", $dmshop_user['user_id'], $sms_message);
            $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
            $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

            // 전송
            shop_sms_send("help", $dmshop_help['user_id'], $sms_to, $sms_from, $sms_message);

            sql_query(" update $shop[help_table] set help_send_sms = '1'where id = '".addslashes($help_id)."' ");

        }

    }

    // 답변안내 이메일
    if ($dmshop_help['help_send_email'] && $dmshop_help['user_email']) {

        $content = text2($content, 0);

        ob_start();
        include_once ("./help_email_text.php");
        $content = ob_get_contents();
        ob_end_clean();

        $to_email = $dmshop_help['user_email']; // 받는사람
        $title = $dmshop['shop_name']." - 1:1문의 답변이 등록되었습니다."; // 제목
        $from_name = $dmshop['shop_name']; // 보내는사람 이름
        $from_email = $dmshop['ceo_email']; // 보내는사람 이메일

        // 발송
        shop_email_send($to_email, $title, $content, $from_name, $from_email, 1);

        sql_query(" update $shop[help_table] set help_send_email = '1'where id = '".addslashes($help_id)."' ");

    }

}

// 메모작성
else if ($m == 'memo') {

    // 업데이트
    $sql_common = "";
    $sql_common .= " set order_code = '".$order_code."' ";
    $sql_common .= ", content = '".addslashes($_POST['content'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[memo_table] $sql_common ");

}

// 메모삭제
else if ($m == 'memo_delete') {

    // delete
    sql_query(" delete from $shop[memo_table] where id = '".addslashes($_POST['memo_id'])."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

echo "<script type='text/javascript'>opener.location.reload();</script>";

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>