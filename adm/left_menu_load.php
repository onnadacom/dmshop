<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($left_id) { $left_id = preg_match("/^[0-9]+$/", $left_id) ? $left_id : ""; }
if (!$left_id) { exit; }
?>
<script type="text/javascript">
<?
if ($left_id == '2') { ?>
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='100'] b").html("<?=shop_count_order_all();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='101'] b").html("<?=shop_count_order_day();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='200'] b").html("<?=shop_count_order_bank();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='201'] b").html("<?=shop_count_order_prepare();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='202'] b").html("<?=shop_count_order_delivery();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='203'] b").html("<?=shop_count_order_cancel();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='204'] b").html("<?=shop_count_order_exchange();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='205'] b").html("<?=shop_count_order_refund();?>");
<?
}

else if ($left_id == '3') {
?>
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='100'] b").html("<?=shop_count_item();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='200'] b").html("<?=shop_count_plan();?>");
<?
}

else if ($left_id == '4') {
?>
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='100'] b").html("<?=shop_count_help();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='101'] b").html("<?=shop_count_qna();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='102'] b").html("<?=shop_count_reply();?>");
$(".left_menu .tab_view .tab<?=$left_id?>_view .hover a[name='400'] b").html("<?=shop_count_user();?>");
<?
}

else if ($left_id == '5') {
?>

<?
}

else if ($left_id == '6') {
?>

<? }

else if ($left_id == '7') {
?>

<? }

else if ($left_id == '8') {
?>

<? }

else if ($left_id == '9') {
?>

<? }

else if ($left_id == '10') {
?>

<? } else { } ?>
</script>