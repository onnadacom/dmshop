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
if (!$dmshop_skin['skin_favorite']) {

    message("<p class='title'>알림</p><p class='text'>관심상품 스킨이 설정되지 않았습니다.</p>", "b");

}

// 검색조건
$sql_search = "";
$sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[favorite_table] $sql_search ");

$total_count = $cnt['cnt'];

$rows = 10;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$list = array();
$result = sql_query(" select * from $shop[favorite_table] $sql_search order by datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        // 보관함에서 삭제
        sql_query(" delete from $shop[favorite_table] where id = '".$row['id']."' ");

        // 다시 로드
        shop_url("{$shop['path']}/favorite.php");

    }

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션 가격 문구 초기화
    $option_money = "";

    // 옵션
    if ($row['order_option']) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($row['order_option']);

        if ($dmshop_item_option['option_money'] > '0') {

            $option_money = " (+".number_format($dmshop_item_option['option_money'])."원)";

        }

        else if ($row['option_money'] < '0') {

            $option_money = " (".number_format($dmshop_item_option['option_money'])."원)";

        } else {

            $option_money = "";

        }

        // 옵션
        $list[$i]['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 옵션
        $list[$i]['item_limit'] = $dmshop_item['item_limit'];

    }

    // 옵션 금액이 없다면
    if (!$dmshop_item_option['option_money']) {

        // 옵션 가격 초기화(옵션이 없을경우를 처리)
        $dmshop_item_option['option_money'] = 0;

    }

    // 판매 가격 (옵션가격 포함)
    $order_item_money = ($dmshop_item['item_money'] * $row['order_limit']) + ((int)($dmshop_item_option['option_money']) * $row['order_limit']);

    // 기타 설정
    $list[$i]['item_code'] = $dmshop_item['item_code']; // 상품코드
    $list[$i]['item_title'] = $dmshop_item['item_title']; // 상품제목
    $list[$i]['option_name'] = $dmshop_item_option['option_name']; // 옵션명
    $list[$i]['option_money'] = $option_money; // 옵션금액 (위에서 메세지를 따로 처리 하였다.)
    $list[$i]['order_item_money'] = $order_item_money; // 옵션포함 상품가격

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_favorite_path = "";
$dmshop_favorite_path = $shop['path']."/skin/favorite/".$dmshop_skin['skin_favorite'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 관심상품 목록";

// 페이지 아이디
$page_id = "favorite";

include_once("./_top.php");
include_once("$dmshop_favorite_path/favorite.php");
include_once("./_bottom.php");
?>