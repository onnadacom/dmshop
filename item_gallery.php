<?
include_once("./_dmshop.php");

if ($id) { $id = preg_match("/^[a-zA-Z0-9]+$/", $id) ? $id : ""; }
if ($upload_mode) { $upload_mode = preg_match("/^[a-zA-Z0-9_]+$/", $upload_mode) ? $upload_mode : ""; }

// 아이디가 없다.
if (!$id) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

// 상품
$dmshop_item = shop_item_code($id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

// 숨김
if ($dmshop_item['item_use'] == '3') {

    message("<p class='title'>알림</p><p class='text'>판매중인 상품이 아닙니다.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_item_gallery']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "c");

}

// 스킨 경로
$dmshop_item_gallery_path = "";
$dmshop_item_gallery_path = $shop['path']."/skin/item_gallery/".$dmshop_skin['skin_item_gallery'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

// 페이지 아이디
$page_id = "item_gallery";

include_once("./shop.top.php");
include_once("$dmshop_item_gallery_path/item_gallery.php");
include_once("./shop.bottom.php");
?>