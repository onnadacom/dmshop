<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9_\-]+$/", $item_code) ? $item_code : ""; }
if ($hp1) { $hp1 = preg_match("/^[0-9\-]+$/", $hp1) ? $hp1 : ""; }
if ($hp2) { $hp2 = preg_match("/^[0-9\-]+$/", $hp2) ? $hp2 : ""; }

if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 설정
$dmshop_design_item = shop_design_item();

if (!$dmshop_design_item['sns_use6']) {

    message("<p class='title'>알림</p><p class='text'>사용하지 않는 서비스입니다.</p>", "c");

}

if ($item_code) {

    // 상품
    $dmshop_item = shop_item_code($item_code);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

    $sms_code = "item_self";

} else {

    $sms_code = "self";

}

if (!$message) {

    message("<p class='title'>알림</p><p class='text'>메세지내용을 입력하세요.</p>", "c");

}

if (!$hp1) {

    message("<p class='title'>알림</p><p class='text'>수신번호를 입력하세요.</p>", "c");

}

if (!$hp2) {

    message("<p class='title'>알림</p><p class='text'>발신번호를 입력하세요.</p>", "c");

}

// 운영자가 아닐 때
if (!$shop_user_admin) {

    $ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

    $real_type = "0";

    // 휴대폰 인증 동일아이피 체크 당일
    $chk = sql_fetch(" select count(*) as cnt from $shop[real_table] where real_type = '".$real_type."' and real_ip = '".$ip."' and substring(datetime,1,10) = '".$shop['time_ymd']."' ");

    // 1일 횟수
    if ($chk['cnt'] >= '5') {

        message("<p class='title'>알림</p><p class='text'>SMS 전송은 1일 5회까지만 전송하실 수 있습니다.</p>", "c");

    }

    $sql_common = "";
    $sql_common .= " set real_type = '".$real_type."' ";
    $sql_common .= ", real_ip = '".$ip."' ";
    $sql_common .= ", user_hp = '".$hp1."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[real_table] $sql_common ");

}

// 전송
shop_sms_send($sms_code, $user_id, $hp1, $hp2, $message);

message("<p class='title'>알림</p><p class='text'>발송하였습니다.</p>", "c");
?>