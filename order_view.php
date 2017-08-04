<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 스킨이 없다.
if (!$dmshop_skin['skin_order_view']) {

    message("<p class='title'>알림</p><p class='text'>주문상세정보 스킨이 설정되지 않았습니다.</p>", "c");

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

// 관리자 통과
if ($shop_user_admin) {

    // pass

}

// 회원이 주문
else if ($dmshop_order['user_id']) {

    if (!$shop_user_login) {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

    }

    // 주문한 회원이 다르다
    if ($dmshop_user['user_id'] != $dmshop_order['user_id']) {

        message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

    }

}

// 비회원이 주문
else if (!$dmshop_order['user_id']) {

    $ss_name = "order_guest";

    if (!shop_get_session($ss_name)) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

    // 세션이 없다
    if (!$dmshop_order['order_guest_session']) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

    // 세션이 다르다
    if ($dmshop_order['order_guest_session'] != $_SESSION[$ss_name]) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 시도하여 주시기 바랍니다.</p>", "c");

}

$total_count = $cnt['cnt'];

$rows = 1000;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

// 배송비 선결제
$order_delivery_pay = false;

$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by order_number asc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 묶음배송
    if ($row['order_delivery_type']) {

        // 선결제
        if (!$row['order_delivery_pay']) {

            $order_delivery_pay = true;

        }

    }

}

// 총 카운트
$order_total_count = $total_count;

// 스킨 경로
$dmshop_order_view_path = "";
$dmshop_order_view_path = $shop['path']."/skin/order_view/".$dmshop_skin['skin_order_view'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 상세주문내역";

// 페이지 아이디
$page_id = "order_view";

include_once("./shop.top.php");
include_once("$dmshop_order_view_path/order_view.php");
include_once("./shop.bottom.php");
?>