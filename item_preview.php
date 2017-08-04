<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($id) { $id = preg_match("/^[a-zA-Z0-9]+$/", $id) ? $id : ""; }

// 아이디가 없다.
if (!$id) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "", "", false, true);

}

// 상품
$dmshop_item = shop_item_code($id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "", "", false, true);

}

// 숨김
if ($dmshop_item['item_use'] == '3') {

    message("<p class='title'>알림</p><p class='text'>판매중인 상품이 아닙니다.</p>", "", "", false, true);

}

// 스킨이 없다.
if (!$dmshop_skin['skin_item_preview']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "", "", false, true);

}

// 스킨 경로
$dmshop_item_preview_path = "";
$dmshop_item_preview_path = $shop['path']."/skin/item_preview/".$dmshop_skin['skin_item_preview'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

// 페이지 아이디
$page_id = "item_preview";

include_once("./shop.top.php");
include_once("$dmshop_item_preview_path/item_preview.php");
include_once("./shop.bottom.php");
?>