<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($level) { $level = preg_match("/^[0-9]+$/", $level) ? $level : ""; }

if ($level) {

    $data = sql_fetch(" select count(*) as total_count from $shop[user_table] where user_level = '$level' ");

} else {

    $data = sql_fetch(" select count(*) as total_count from $shop[user_table] where user_level >= '2' ");

}
?>
<script type="text/javascript">
$("#sms_member").html("<?=number_format($data['total_count']);?>");
</script>