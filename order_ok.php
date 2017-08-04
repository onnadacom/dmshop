<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 스킨이 없다.
if (!$dmshop_skin['skin_order']) {

    message("<p class='title'>알림</p><p class='text'>주문페이지 스킨이 설정되지 않았습니다.</p>", "", $shop['path']);

}

// 주문번호가 없다
if (!$order_code) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문 세션확인
$ss_name = "order_".$order_code;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>만료된 페이지입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문완료 세션확인
$ss_name = "order_ok_".$order_code;

if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

}

// 비회원
if (!$shop_user_login) {

    $guest_id = "";
    $guest_id = shop_get_cookie("dmshop_cart");

    if (!$guest_id) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

    }

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where order_code = '".$order_code."' and user_id = '".$dmshop_user['user_id']."' ";

} else {

    $sql_search = " where order_code = '".$order_code."' and guest_id = '".addslashes($guest_id)."' ";

}

// 주문내역
$list = array();
$result = sql_query(" select * from $shop[order_table] $sql_search order by id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 첫번째 데이터만 변수로 저장 (공통 정보를 사용하기 위해)
    if ($i == '0') {

        $dmshop_order = $row;

    }

    if ($row['option_money'] > '0') {

        $option_money = " (+".number_format($row['option_money'])."원)";

    }

    else if ($row['option_money'] < '0') {

        $option_money = " (".number_format($row['option_money'])."원)";

    } else {

        $option_money = "";

    }

    $list[$i]['option_money'] = $option_money; // 옵션금액

}

if (!$i) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문결제 스킨 경로
$dmshop_order_path = "";
$dmshop_order_path = $shop['path']."/skin/order/".$dmshop_skin['skin_order'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 주문확인";

// 페이지 아이디
$page_id = "order_ok";

include_once("./_top.php");
include_once("$dmshop_order_path/order_ok.php");
include_once("./_bottom.php");
?>