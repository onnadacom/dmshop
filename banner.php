<?
include_once("./_dmshop.php");
// 배너 클릭
if ($banner_id) { $banner_id = preg_match("/^[0-9]+$/", $banner_id) ? $banner_id : ""; }

if (!$banner_id) {

    exit;

}

$dmshop_banner = shop_banner($banner_id);

if (!$dmshop_banner['id']) {

    exit;

}

$ss_name = "banner_click_".$banner_id;
if (!shop_get_session($ss_name)) {

    sql_query(" update $shop[banner_table] set ba_click = ba_click + 1 where id = '".$banner_id."' ");

    shop_set_session($ss_name, true);

}
?>