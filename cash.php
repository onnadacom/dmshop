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
if (!$dmshop_skin['skin_cash']) {

    message("<p class='title'>알림</p><p class='text'>적립금 스킨이 설정되지 않았습니다.</p>", "b");

}

// 검색조건
$sql_search = "";
$sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[cash_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select * from $shop[cash_table] $sql_search order by datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    if ($row['cash'] >= '0') {

        $list[$i]['icon'] = "ic1.gif";
        $list[$i]['icon_text'] = "적립";
        $list[$i]['icon_class'] = "ic1";
        $list[$i]['cash'] = "+ ".number_format($row['cash'])." 원";
        $list[$i]['cash_class'] = "cash1";

    } else {

        $list[$i]['icon'] = "ic2.gif";
        $list[$i]['icon_text'] = "사용";
        $list[$i]['icon_class'] = "ic2";
        $list[$i]['cash'] = str_replace("-", "- ", number_format($row['cash'])." 원");
        $list[$i]['cash_class'] = "cash2";

    }

}

// 누적적립금액
$data = sql_fetch(" select sum(cash) as total from $shop[cash_table] $sql_search and cash > '0' ");
$cash_sum1 = (int)($data['total']);

// 누적사용금액
$data = sql_fetch(" select sum(cash) as total from $shop[cash_table] $sql_search and cash < '0' ");
$cash_sum2 = (int)(str_replace("-", "", $data['total']));

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_cash_path = "";
$dmshop_cash_path = $shop['path']."/skin/cash/".$dmshop_skin['skin_cash'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 적립금";

// 페이지 아이디
$page_id = "cash";

include_once("./_top.php");
include_once("$dmshop_cash_path/cash.php");
include_once("./_bottom.php");
?>