<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($item_id) { $item_id = preg_match("/^[0-9]+$/", $item_id) ? $item_id : ""; }

// 상품
$dmshop_item = shop_item($item_id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "", "", false, true);

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 스킨
include_once("$dmshop_item_path/reply.php");
?>