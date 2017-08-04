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
if (!$dmshop_skin['skin_refund']) {

    message("<p class='title'>알림</p><p class='text'>환불신청내역 스킨이 설정되지 않았습니다.</p>", "b");

}

// 검색조건 (내 주문, 결제승인, 환불)
$sql_search = "";
$sql_search = " where user_id = '".$dmshop_user['user_id']."' and order_payment != '0' and order_refund != '0' ";

$cnt = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select *, count(order_code) as cnt from $shop[order_table] $sql_search group by order_code order by order_datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 1건도 포함됨으로 빼준다.
    $list[$i]['cnt'] = (int)($row['cnt'] - 1);

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_refund_path = "";
$dmshop_refund_path = $shop['path']."/skin/refund/".$dmshop_skin['skin_refund'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 환불 내역";

// 페이지 아이디
$page_id = "refund";

include_once("./_top.php");
include_once("$dmshop_refund_path/refund.php");
include_once("./_bottom.php");
?>