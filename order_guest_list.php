<?
include_once("./_dmshop.php");

// 로그인
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_order_guest']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "b");

}

$ss_name = "order_guest";

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "b");

}

// 검색조건 (내 주문, 결제승인)
$sql_search = "";
$sql_search = " where user_id = '' and order_guest_session = '".$_SESSION['order_guest']."' and order_number = '0' and order_payment != '0' ";

$cnt = sql_fetch(" select *, count(*) as cnt from $shop[order_table] $sql_search group by order_code ");

// 데이터 임시저장
$dmshop_order = $cnt;

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by order_datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// 총 카운트
$order_total_count = $total_count;

// 스킨 경로
$dmshop_order_guest_path = "";
$dmshop_order_guest_path = $shop['path']."/skin/order_guest/".$dmshop_skin['skin_order_guest'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 비회원 주문내역";

// 페이지 아이디
$page_id = "order_guest_list";

include_once("./_top.php");
include_once("$dmshop_order_guest_path/order_guest_list.php");
include_once("./_bottom.php");
?>