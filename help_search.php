<?
include_once("./_dmshop.php");

if ($help_type) { $help_type = preg_match("/^[0-9]+$/", $help_type) ? $help_type : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_help']) {

    message("<p class='title'>알림</p><p class='text'>1:1 문의/상담 스킨이 설정되지 않았습니다.</p>", "c");

}

if ($help_type != '1' && $help_type != '2') {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 검색조건 (내 주문, 결제승인)
$sql_search = "";
$sql_search = " where user_id = '".$dmshop_user['user_id']."' and order_number = '0' and order_payment != '0' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[order_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 5;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?help_type=".$help_type."&page=");

$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by order_datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    if ($help_type == '1') {

        $list[$i]['help_code'] = $row['order_code'];

    } else {

        $list[$i]['help_code'] = $row['item_code'];

    }

}

// 스킨 경로
$dmshop_help_path = "";
$dmshop_help_path = $shop['path']."/skin/help/".$dmshop_skin['skin_help'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 1:1 문의/상담";

// 페이지 아이디
$page_id = "help";

include_once("./shop.top.php");
include_once("$dmshop_help_path/help_search.php");
include_once("./shop.bottom.php");
?>