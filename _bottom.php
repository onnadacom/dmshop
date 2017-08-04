<?
if (!defined('_DMSHOP_')) exit;

// 스크롤
if ($dmshop_skin['skin_sub_scrollbox']) { $scrollbox_top = (int)($dmshop_design['sub_scrollbox_top']); echo shop_scrollbox_skin($dmshop_skin['skin_sub_scrollbox']); }

include_once("$dmshop_layout_path/layout.bottom.php");
include_once("$shop[path]/shop.bottom.php");
?>