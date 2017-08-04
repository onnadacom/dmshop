<?
include_once("./_dmshop.php");

// 타이틀 제목
$shop['title'] = $dmshop['shop_name'];

// 페이지 아이디
$page_id = "main";

if ($dmshop_skin['skin_main']) { $dmshop_main_path = $shop['path']."/skin/main/".$dmshop_skin['skin_main']; } else { $dmshop_main_path = $dmshop_layout_path; }
if ($dmshop_skin['skin_main_top']) { $dmshop_top_path = $shop['path']."/skin/top/".$dmshop_skin['skin_main_top']; } else { $dmshop_top_path = $dmshop_layout_path; }
if ($dmshop_skin['skin_main_menu']) { $dmshop_menu_path = $shop['path']."/skin/menu/".$dmshop_skin['skin_main_menu']; } else { $dmshop_menu_path = $dmshop_layout_path; }
if ($dmshop_skin['skin_main_bottom']) { $dmshop_bottom_path = $shop['path']."/skin/bottom/".$dmshop_skin['skin_main_bottom']; } else { $dmshop_bottom_path = $dmshop_layout_path; }

include_once("$shop[path]/shop.top.php");
include_once("$dmshop_layout_path/layout.top.php");
include_once("$dmshop_main_path/main.php");

// 스크롤
if ($dmshop_skin['skin_main_scrollbox']) { $scrollbox_top = (int)($dmshop_design['main_scrollbox_top']); echo shop_scrollbox_skin($dmshop_skin['skin_main_scrollbox']); }

// 팝업
if ($dmshop_skin['skin_popup']) { echo shop_popup_skin($dmshop_skin['skin_popup']); }

include_once("$dmshop_layout_path/layout.bottom.php");
include_once("$shop[path]/shop.bottom.php");
?>