<?
if (!defined('_DMSHOP_')) exit;

// 세로메뉴바 설정
$dmshop_hmbar = shop_design_hmbar();

// 자동생성
include_once("$shop[path]/lib/text.lib.php");

// 세로메뉴바 css
include_once("$shop[path]/layout/default/hmbar.css.php");

$filetop['upload_height'] = 0;
$filebottom['upload_height'] = 0;

$filetop = shop_design_file("hmbar_top");
$filebottom = shop_design_file("hmbar_bottom");
$fileboard = shop_design_file("hmbar_board");

// 세로사이즈 설정 (상,하단 모서리 사이즈를 빼준다)
$dmshop_hmbar['hmbar_height'] = (int)($dmshop_hmbar['hmbar_height'] - ($filetop['upload_height'] + $filebottom['upload_height']));
?>
<table width="<?=$dmshop_hmbar['hmbar_width']?>" border="0" cellspacing="0" cellpadding="0">
<?
//********** 상단모서리 start ********** //
if ($filetop['upload_file']) {

    echo "<tr><td width='".$filetop['upload_width']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $filetop['datetime'])."/".$filetop['upload_file'], $filetop['upload_width'], $filetop['upload_height'])."</td></tr>\n";

}
//********** 상단모서리 end ********** //

//********** 배경 start ********** //
$dmshop_hmbar_default_image = "";
$dmshop_hmbar_default = false;

$file = shop_design_file("hmbar_default");

if ($file['upload_file']) {

    $dmshop_hmbar_default_image = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    if (file_exists($dmshop_hmbar_default_image) && $file['upload_file']) {

        $dmshop_hmbar_default = true;

    }

}

echo "<tr height='".$dmshop_hmbar['hmbar_height']."'>";

// 백그라운드
if ($dmshop_hmbar_default) {

    echo "<td valign='top' style=\"background:url('".$dmshop_hmbar_default_image."') repeat;\">\n";

}

// 컬러
else if ($dmshop_hmbar['hmbar_background_color']) {

    echo "<td valign='top' bgcolor='#".$dmshop_hmbar['hmbar_background_color']."'>\n";

} else{
// 없다

    echo "<td valign='top'>\n";

}
//********** 배경 end ********** //

//********** 라인 start ********** //
$hmbar_line = "";

// 이미지
if ($dmshop_hmbar['hmbar_line_use'] == '1') {

    $file = shop_design_file("hmbar_line");

    if ($file['upload_file']) {

        $hmbar_line .= "<tr><td>";
        $hmbar_line .= shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);
        $hmbar_line .= "</td></tr>\n";

    }

} else {
// 색상

    $hmbar_line .= "<tr><td>";
    $hmbar_line .= "<div style='border-top:1px solid #".$dmshop_hmbar['hmbar_line_color']."; width:100%; height:1px; margin:0 auto; line-height:0px; font-size:0px;'></div>";
    $hmbar_line .= "</td></tr>\n";

}

//********** 라인 end ********** //

//********** 메뉴 start ********** //
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class='dmshop_hmlist'>\n";

// 라인
$hmbar_line_view = false;

// 자동생성
if ($dmshop_hmbar['hmbar_list_use'] == '1') {

    // 홈
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."' class='image1_etc1'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($hmlist_category); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/list.php?ct_id=".$hmlist_category[$i]['menu_id']."' class='image1_category_".$hmlist_category[$i]['id'];

        // hover
        if ($hmlist_category[$i]['menu_id'] == $ct_id || $hmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " image1_category_".$hmlist_category[$i]['id']."_hover";

        }

        echo "'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 게시판 타이틀
    if ($fileboard['upload_file']) {

        echo "<tr><td>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $fileboard['datetime'])."/".$fileboard['upload_file'], $fileboard['upload_width'], $fileboard['upload_height'])."</td></tr>\n";

    }

    // 게시판
    for ($i=0; $i<count($hmlist_board); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/board.php?bbs_id=".$hmlist_board[$i]['menu_id']."' class='image1_board_".$hmlist_board[$i]['id'];

        // hover
        if ($hmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " image1_board_".$hmlist_board[$i]['id']."_hover";

        }

        echo "'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 기획전
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/plan.php' class='image1_etc2'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

}

// 직접업로드
else if ($dmshop_hmbar['hmbar_list_use'] == '2') {

    // 홈
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."' class='image2_etc1'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($hmlist_category); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/list.php?ct_id=".$hmlist_category[$i]['menu_id']."' class='image2_category_".$hmlist_category[$i]['id'];

        // hover
        if ($hmlist_category[$i]['menu_id'] == $ct_id || $hmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " image2_category_".$hmlist_category[$i]['id']."_hover";

        }

        echo "'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 게시판 타이틀
    if ($fileboard['upload_file']) {

        echo "<tr><td>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $fileboard['datetime'])."/".$fileboard['upload_file'], $fileboard['upload_width'], $fileboard['upload_height'])."</td></tr>\n";

    }

    // 게시판
    for ($i=0; $i<count($hmlist_board); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/board.php?bbs_id=".$hmlist_board[$i]['menu_id']."' class='image2_board_".$hmlist_board[$i]['id'];

        // hover
        if ($hmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " image2_board_".$hmlist_board[$i]['id']."_hover";

        }

        echo "'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 기획전
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/plan.php' class='image2_etc2'></a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

}

// flash
else if ($dmshop_hmbar['hmbar_list_use'] == '3') {

    $file = shop_design_file("hmlist_flash");

    if ($file['upload_file']) {

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</td></tr>\n";

    }

} else {
// text

    // 홈
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/' class='text'>".$dmshop_hmlist['title']."</a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 분류
    for ($i=0; $i<count($hmlist_category); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/list.php?ct_id=".$hmlist_category[$i]['menu_id']."' class='text";

        // hover
        if ($hmlist_category[$i]['menu_id'] == $ct_id || $hmlist_category[$i]['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

            echo " hover";

        }

        echo "'>".$hmlist_category[$i]['title']."</a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 게시판 타이틀
    if ($fileboard['upload_file']) {

        echo "<tr><td>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $fileboard['datetime'])."/".$fileboard['upload_file'], $fileboard['upload_width'], $fileboard['upload_height'])."</td></tr>\n";

    }

    // 게시판
    for ($i=0; $i<count($hmlist_board); $i++) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/board.php?bbs_id=".$hmlist_board[$i]['menu_id']."' class='text";

        // hover
        if ($hmlist_board[$i]['menu_id'] == $bbs_id) {

            echo " hover";

        }

        echo "'>".$hmlist_board[$i]['title']."</a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

    // 기획전
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        echo $hmbar_line;

        echo "<tr><td align='".shop_design_align($dmshop_hmbar['hmbar_position'])."'><p><a href='".$shop['url']."/plan.php' class='text'>".$dmshop_hmlist['title']."</a></p></td></tr>\n";

        $hmbar_line_view = true;

    }

}

echo "</table>\n";
//********** 메뉴 end ********** //

echo "</td></tr>\n";

//********** 하단모서리 start ********** //
if ($filebottom['upload_file']) {

    echo "<tr><td>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $filebottom['datetime'])."/".$filebottom['upload_file'], $filebottom['upload_width'], $filebottom['upload_height'])."</td></tr>\n";

}
//********** 하단모서리 end ********** //
?>
</table>