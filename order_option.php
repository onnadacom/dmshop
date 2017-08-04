<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_order_option']) {

    message("<p class='title'>알림</p><p class='text'>주문옵션변경 스킨이 설정되지 않았습니다.</p>", "c");

}

// 검색조건
$sql_search = "";
$sql_search = " where order_code = '".$order_code."' ";

$cnt = sql_fetch(" select *, count(*) as cnt from $shop[order_table] $sql_search group by order_code ");

// 데이터 임시저장
$dmshop_order = $cnt;

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

}

// 주문자가 다르다.
if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

}

// 상품발송되었다면
if ($dmshop_order['order_delivery']) {

    message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "c");

}

// 취소, 교환, 환불
if ($dmshop_order['order_cancel'] || $dmshop_order['order_exchange'] || $dmshop_order['order_refund']) {

    message("<p class='title'>알림</p><p class='text'>주문옵션 변경은 배송준비중 이전에만 가능합니다.</p>", "c");

}

$total_count = $cnt['cnt'];

$rows = 1000;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$order_optons = "";
$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by order_number asc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    $order_optons .= "<option value='".$row['id']."'>".$row['item_title']."</option>";

}

// 스킨 경로
$dmshop_order_option_path = "";
$dmshop_order_option_path = $shop['path']."/skin/order_option/".$dmshop_skin['skin_order_option'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 주문옵션 변경";

// 페이지 아이디
$page_id = "order_option";

include_once("./shop.top.php");
include_once("$dmshop_order_option_path/order_option.php");
include_once("./shop.bottom.php");
?>