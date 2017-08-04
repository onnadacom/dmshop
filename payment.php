<?
include_once("./_dmshop.php");

// 로그인
if (!$shop_user_login) {

    shop_url("$shop[path]/signin.php?url={$urlencode}");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_mypage']) {

    message("<p class='title'>알림</p><p class='text'>마이페이지 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_payment']) {

    message("<p class='title'>알림</p><p class='text'>개별결제창 스킨이 설정되지 않았습니다.</p>", "b");

}

// 검색조건
$sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[payment_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select * from $shop[payment_table] $sql_search order by pay_datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// inicis
if ($dmshop['order_pg'] == '1') {

    $pay_url = $shop['path']."/pay/inicis/pay.php";

}

// allthegate
else if ($dmshop['order_pg'] == '2') {

    $pay_url = $shop['path']."/pay/allthegate/pay.php";

}

// kcp
else if ($dmshop['order_pg'] == '3') {

    $pay_url = $shop['path']."/pay/kcp/pay.php";

}

// kicc
else if ($dmshop['order_pg'] == '4') {

    $pay_url = $shop['path']."/pay/kicc/pay.php";

}

// lgu+
else if ($dmshop['order_pg'] == '5') {

    $pay_url = $shop['path']."/pay/lgd/pay.php";

} else {

    $pay_url = "";

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_payment_path = "";
$dmshop_payment_path = $shop['path']."/skin/payment/".$dmshop_skin['skin_payment'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 개별 결제창";

// 페이지 아이디
$page_id = "payment";

include_once("./_top.php");
include_once("$dmshop_payment_path/payment.php");
include_once("./_bottom.php");
?>