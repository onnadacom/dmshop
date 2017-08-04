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
if (!$dmshop_skin['skin_help']) {

    message("<p class='title'>알림</p><p class='text'>1:1 문의/상담 스킨이 설정되지 않았습니다.</p>", "b");

}

// 검색조건
$sql_search = "";
$sql_search = " where id = help_id and user_id = '".$dmshop_user['user_id']."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[help_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select * from $shop[help_table] $sql_search order by datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_help_path = "";
$dmshop_help_path = $shop['path']."/skin/help/".$dmshop_skin['skin_help'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 1:1 문의 내역";

// 페이지 아이디
$page_id = "help_list";

include_once("./_top.php");
include_once("$dmshop_help_path/help_list.php");
include_once("./_bottom.php");
?>