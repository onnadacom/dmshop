<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 스킨 경로
$dmshop_coupon_path = "";
$dmshop_coupon_path = $shop['path']."/skin/coupon/".$dmshop_skin['skin_coupon'];

$coupon_number = trim($coupon_number);
if ($coupon_number) { $coupon_number = preg_match("/^[A-Za-z0-9_\-]+$/", $coupon_number) ? $coupon_number : ""; }

// 비회원
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "", "", false, true);

}

if (!$coupon_number) {

    //message("<p class='title'>알림</p><p class='text'>쿠폰번호를 입력하여 주시기 바랍니다.</p>", "", "", false, true);
    echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
    exit;

}

// 쿠폰
$dmshop_coupon_list = sql_fetch(" select * from $shop[coupon_list_table] where coupon_number = '".$coupon_number."' and user_id = '' ");

if (!$dmshop_coupon_list['id']) {

    //message("<p class='title'>알림</p><p class='text'>쿠폰번호가 올바르지 않거나 발행되지 않은 쿠폰입니다.</p>", "", "", false, true);
    echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
    exit;

}

if ($dmshop_coupon_list['user_id']) {

    //message("<p class='title'>알림</p><p class='text'>이미 사용한 쿠폰번호입니다.</p>", "", "", false, true);
    echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
    exit;

}

// 쿠폰 설정
$dmshop_coupon = shop_coupon($dmshop_coupon_list['coupon_id']);

if (!$dmshop_coupon['id']) {

    //message("<p class='title'>알림</p><p class='text'>쿠폰번호가 올바르지 않거나 발행되지 않은 쿠폰입니다.</p>", "", "", false, true);
    echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
    exit;

}

// 고정기간
if (!$dmshop_coupon['coupon_day_type']) {

    // 사용기간이 지났다.
    if ($shop['time_ymd'] > $dmshop_coupon['coupon_date2']) {

        //message("<p class='title'>알림</p><p class='text'>해당 쿠폰번호는 사용기간이 지났습니다.</p>", "", "", false, true);
        echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
        exit;

    }

}

// 중복 다운로드 불가
if ($dmshop_coupon['coupon_overlap']) {

    // 쿠폰내역
    $chk = sql_fetch(" select * from $shop[coupon_list_table] where coupon_number = '".$coupon_number."' and user_id = '".$dmshop_user['user_id']."' ");

    // 있다
    if ($chk['id']) {

        //message("<p class='title'>알림</p><p class='text'>쿠폰번호가 올바르지 않거나 발행되지 않은 쿠폰입니다.</p>", "", "", false, true);
        echo "<img src='".$dmshop_coupon_path."/img/msg3.gif'>";
        exit;

    }

}

$sql_common = "";
$sql_common .= " set user_id = '".$dmshop_user['user_id']."' ";
$sql_common .= ", user_name = '".addslashes($dmshop_user['user_name'])."' ";

if ($dmshop_coupon['coupon_day_type']) {

    $sql_common .= ", coupon_date1 = '".$shop['time_ymd']."' ";
    $sql_common .= ", coupon_date2 = '".date("Y-m-d", $shop['server_time'] + ($dmshop_coupon['coupon_day'] * 86400))."' ";

}

$sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

// update
sql_query(" update $shop[coupon_list_table] $sql_common where id = '".$dmshop_coupon_list['id']."' ");

// 다운수 증가
sql_query(" update $shop[coupon_table] set coupon_down = coupon_down + 1 where id = '".$dmshop_coupon_list['coupon_id']."' ");

// ok
echo "<img src='".$dmshop_coupon_path."/img/msg2.gif'>";
?>