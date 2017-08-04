<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($item_id) { $item_id = preg_match("/^[0-9]+$/", $item_id) ? $item_id : ""; }

// 상품의 첫번째 옵션
$dmshop_item_option = sql_fetch(" select * from $shop[item_option_table] where item_id = '".$item_id."' and option_mode = '1' order by option_position asc ");

// 있을 때
if ($dmshop_item_option['id']) {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('order_option').value = \"".$dmshop_item_option['id']."\";";
    echo "</script>";
    exit;

} else {
// 없다면

    echo "<script type='text/javascript'>";
    echo "document.getElementById('order_option').value = \"\";";
    echo "</script>";
    exit;

}
?>