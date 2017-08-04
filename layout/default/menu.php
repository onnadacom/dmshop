<?
if (!defined('_DMSHOP_')) exit;

// 메뉴 설정
$dmshop_menu = shop_design_menu();
?>
<style type="text/css">
<?
// 배경 상단
$file = shop_design_file("menu_background_top");

if ($file['upload_file']) { echo ".menu_top {width:100%; height:".(int)($dmshop_menu['menu_margin_top'])."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

// 배경 기본
$file = shop_design_file("menu_background_default");

if ($file['upload_file']) { echo ".menu_default {padding:0 ".(int)($dmshop_menu['menu_margin_left'])."px 0 ".(int)($dmshop_menu['menu_margin_right'])."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

// 배경 하단
$file = shop_design_file("menu_background_bottom");

if ($file['upload_file']) { echo ".menu_bottom {width:100%; height:".(int)($dmshop_menu['menu_margin_bottom'])."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

// 구성물간 여백
if ($dmshop_menu['menu_margin_side']) { echo ".menu_line {height:".(int)($dmshop_menu['menu_margin_side'])."px;}\n"; }
?>
</style>

<? if ($dmshop_menu['menu_margin_top']) { ?>
<table border="0" cellspacing="0" cellpadding="0" class="menu_top">
<tr>
    <td class="none">&nbsp;</td>
</tr>
</table>
<? } ?>

<div class="menu_default">
<?
$menu_count = 0;
$str = explode(",", $dmshop_menu['menu_list_id']);
for ($i=1; $i<=count($str); $i++) {

    $menu_id = $str[$i];

    if ($menu_id) {

if ($menu_id == '1') {

    if ($dmshop_menu['menu_searchbox_skin']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_searchbox'>".shop_searchbox_skin($dmshop_menu['menu_searchbox_skin'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '2') {

    if ($dmshop_menu['menu_loginbox_skin']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_loginbox'>".shop_loginbox_skin($dmshop_menu['menu_loginbox_skin'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '3') {

    if ($dmshop_menu['menu_menubar_use']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_menubar'>".shop_hmbar_skin($dmshop_menu['menu_menubar_skin'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '4') {

    if ($dmshop_menu['menu_planbox_skin']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_planbox'>".shop_planbox_skin($dmshop_menu['menu_planbox_skin'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '5') {

    if ($dmshop_menu['menu_boardbox_skin']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_boardbox'>".shop_boardbox_skin($dmshop_menu['menu_boardbox_skin'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '6') {

    $file = shop_design_file("menu_help");

    if ($file['upload_file']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_help'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '7') {

    $file = shop_design_file("menu_bank");

    if ($file['upload_file']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_bank'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '8') {

    if ($dmshop_menu['menu_article']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_article'>".shop_article_skin("layout_menu_article", $dmshop_menu['menu_article_skin'], $dmshop_menu['menu_article'], $dmshop_menu['menu_article_width'], $dmshop_menu['menu_article_height'], "", "", "", "", "", $dmshop_menu['menu_article_sort'], 1, $dmshop_menu['menu_article_use1'], $dmshop_menu['menu_article_use2'], $dmshop_menu['menu_article_use3'])."</div>"; /* 레이어ID, 스킨명, 게시판ID, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식, 제목표기, 작성일표기, 작성자표기, 댓글수표기 */

        $menu_count++;

    }

}

else if ($menu_id == '9') {

    if ($dmshop_menu['menu_banner_group']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_banner'>".shop_banner_skin("layout_menu_banner", $dmshop_menu['menu_banner_skin'], $dmshop_menu['menu_banner_group'], "", "1", "1", $dmshop_menu['menu_banner_rolling_limit'], $dmshop_menu['menu_banner_rolling_time'], $dmshop_menu['menu_banner_sort'])."</div>"; /* 레이어ID, 스킨명, 배너그룹ID, 배너ID, 가로갯수, 새로갯수, 롤링횟수, 롤링시간, 정렬방식 */

        $menu_count++;

    }

}

else if ($menu_id == '10') {

    if ($dmshop_menu['menu_tag']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_tag'>".stripslashes($dmshop_menu['menu_tag'])."</div>";

        $menu_count++;

    }

}

else if ($menu_id == '11') {

    $file = shop_design_file("menu_logo");

    if ($file['upload_file']) {

        if ($menu_count && $dmshop_menu['menu_margin_side']) { echo "<div class='menu_line none'>&nbsp;</div>\n"; }

        echo "<div class='menu_logo'><a href='".$shop['url']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</a></div>";

        $menu_count++;

    }

} else {

    // pass

}

    }

}
?>
</div>

<? if ($dmshop_menu['menu_margin_bottom']) { ?>
<table border="0" cellspacing="0" cellpadding="0" class="menu_bottom">
<tr>
    <td class="none">&nbsp;</td>
</tr>
</table>
<? } ?>