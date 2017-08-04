<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($item_view_id) { $item_view_id = preg_match("/^[0-9]+$/", $item_view_id) ? $item_view_id : ""; }

// 삭제
sql_query(" delete from $shop[item_view_table] where id = '".$item_view_id."' ");
?>
<script type="text/javascript">
$(document).ready(function() {

    scrollboxDataLoad("2", "<?=$page?>", "no");

});
</script>