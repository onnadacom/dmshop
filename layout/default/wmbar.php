<?
if (!defined('_DMSHOP_')) exit;

// 가로메뉴바 설정
$dmshop_wmbar = shop_design_wmbar();

// 자동생성
include_once("$shop[path]/lib/text.lib.php");

// 가로메뉴바 css
include_once("$shop[path]/layout/default/wmbar.css.php");
?>
<table width="<?=$dmshop_wmbar['wmbar_width']?>" height="<?=$dmshop_wmbar['wmbar_height']?>" border="0" cellspacing="0" cellpadding="0">
<tr>
<?
//********** 좌측모서리 start ********** //
$file = shop_design_file("wmbar_left");

if ($file['upload_file']) {

    echo "<td width='".$file['upload_width']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</td>\n";

}
//********** 좌측모서리 end ********** //

//********** 배경 start ********** //
$dmshop_wmbar_default_image = "";
$dmshop_wmbar_default = false;

$file = shop_design_file("wmbar_default");

if ($file['upload_file']) {

    $dmshop_wmbar_default_image = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    if (file_exists($dmshop_wmbar_default_image) && $file['upload_file']) {

        $dmshop_wmbar_default = true;

    }

}

// 백그라운드
if ($dmshop_wmbar_default) {

    echo "<td style=\"background:url('".$dmshop_wmbar_default_image."') repeat;\">\n";

}

// 컬러
else if ($dmshop_wmbar['wmbar_background_color']) {

    echo "<td bgcolor='#".$dmshop_wmbar['wmbar_background_color']."'>\n";

} else{
// 없다

    echo "<td>\n";

}
//********** 배경 end ********** //

//********** 라인 start ********** //
$wmbar_line = "";

// 이미지
if ($dmshop_wmbar['wmbar_line_use'] == '1') {

    $file = shop_design_file("wmbar_line");

    if ($file['upload_file']) {

        $wmbar_line .= "<td style='padding:0 ".$dmshop_wmbar['wmbar_margin']."px;'>";
        $wmbar_line .= shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);
        $wmbar_line .= "</td>\n";

    }

} else {
// 색상

    $wmbar_line .= "<td style='padding:0 ".$dmshop_wmbar['wmbar_margin']."px;'>";
    $wmbar_line .= "<div style='background-color:#".$dmshop_wmbar['wmbar_line_color']."; width:1px; height:20px; margin:0 auto;'></div>";
    $wmbar_line .= "</td>\n";

}

//********** 라인 end ********** //

//********** 메뉴 start ********** //
echo "<table border='0' cellspacing='0' cellpadding='0' class='dmshop_wmlist auto' align='".shop_design_align($dmshop_wmbar['wmbar_position'])."'>\n<tr>\n";

// 라인
$wmbar_line_view = false;

// 자동생성
if ($dmshop_wmbar['wmbar_list_use'] == '1') {

    // 홈
    $dmshop_wmlist = shop_design_wmlist("etc", "1");

    if ($dmshop_wmlist['id']) {

        echo "<td><a href='".$shop['url']."' class='image1_etc1'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($wmlist_category); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/list.php?ct_id=".$wmlist_category[$i]['menu_id']."' class='image1_category_".$wmlist_category[$i]['id'];

        // hover
        if ($wmlist_category[$i]['menu_id'] == $ct_id || $wmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " image1_category_".$wmlist_category[$i]['id']."_hover";

        }

        echo "'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 게시판
    for ($i=0; $i<count($wmlist_board); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/board.php?bbs_id=".$wmlist_board[$i]['menu_id']."' class='image1_board_".$wmlist_board[$i]['id'];

        // hover
        if ($wmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " image1_board_".$wmlist_board[$i]['id']."_hover";

        }

        echo "'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 기획전
    $dmshop_wmlist = shop_design_wmlist("etc", "2");

    if ($dmshop_wmlist['id']) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/plan.php' class='image1_etc2'></a></td>\n";

        $wmbar_line_view = true;

    }

}

// 직접업로드
else if ($dmshop_wmbar['wmbar_list_use'] == '2') {

    // 홈
    $dmshop_wmlist = shop_design_wmlist("etc", "1");

    if ($dmshop_wmlist['id']) {

        echo "<td><a href='".$shop['url']."' class='image2_etc1'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($wmlist_category); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/list.php?ct_id=".$wmlist_category[$i]['menu_id']."' class='image2_category_".$wmlist_category[$i]['id'];

        // hover
        if ($wmlist_category[$i]['menu_id'] == $ct_id || $wmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " image2_category_".$wmlist_category[$i]['id']."_hover";

        }

        echo "'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 게시판
    for ($i=0; $i<count($wmlist_board); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/board.php?bbs_id=".$wmlist_board[$i]['menu_id']."' class='image2_board_".$wmlist_board[$i]['id'];

        // hover
        if ($wmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " image2_board_".$wmlist_board[$i]['id']."_hover";

        }

        echo "'></a></td>\n";

        $wmbar_line_view = true;

    }

    // 기획전
    $dmshop_wmlist = shop_design_wmlist("etc", "2");

    if ($dmshop_wmlist['id']) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/plan.php' class='image2_etc2'></a></td>\n";

        $wmbar_line_view = true;

    }

}

// flash
else if ($dmshop_wmbar['wmbar_list_use'] == '3') {

    $file = shop_design_file("wmlist_flash");

    if ($file['upload_file']) {

        echo "<td>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</td>\n";

    }

} else {
// text

    // 홈
    $dmshop_wmlist = shop_design_wmlist("etc", "1");

    if ($dmshop_wmlist['id']) {

        echo "<td><a href='".$shop['url']."' class='text'>".$dmshop_wmlist['title']."</a></td>\n";

        $wmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($wmlist_category); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/list.php?ct_id=".$wmlist_category[$i]['menu_id']."' class='text";

        // hover
        if ($wmlist_category[$i]['menu_id'] == $ct_id || $wmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " hover";

        }

        echo "'>".$wmlist_category[$i]['title']."</a></td>\n";

        $wmbar_line_view = true;

    }

    // 게시판
    for ($i=0; $i<count($wmlist_board); $i++) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/board.php?bbs_id=".$wmlist_board[$i]['menu_id']."' class='text";

        // hover
        if ($wmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " hover";

        }

        echo "'>".$wmlist_board[$i]['title']."</a></td>\n";

        $wmbar_line_view = true;

    }

    // 기획전
    $dmshop_wmlist = shop_design_wmlist("etc", "2");

    if ($dmshop_wmlist['id']) {

        if ($wmbar_line_view) { echo $wmbar_line; }

        echo "<td><a href='".$shop['url']."/plan.php' class='text'>".$dmshop_wmlist['title']."</a></td>\n";

        $wmbar_line_view = true;

    }

}

echo "</tr>\n</table>\n";
//********** 메뉴 end ********** //

echo "</td>\n";

//********** 우측모서리 start ********** //
$file = shop_design_file("wmbar_right");

if ($file['upload_file']) {

    echo "<td width='".$file['upload_width']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</td>\n";

}
//********** 우측모서리 end ********** //
?>
</tr>
</table>