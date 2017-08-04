<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 폰트 이미지 캐시
$dir = $shop['path']."/data/text/cache";

// 폰트 이미지 삭제
shop_delete("$dir");

// 디렉토리 생성 및 퍼미션 변경
@mkdir("$dir", 0707);
@chmod("$dir", 0707);

/*------------------------------
    ## 파일 업로드 ##
------------------------------*/

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$upload_mode = "hmbar_default";
include("./upload_design_file.php");

$upload_mode = "hmbar_top";
include("./upload_design_file.php");

$upload_mode = "hmbar_bottom";
include("./upload_design_file.php");

$upload_mode = "hmbar_line";
include("./upload_design_file.php");

$upload_mode = "hmbar_board";
include("./upload_design_file.php");

$upload_mode = "hmbar_font_file";
include("./upload_design_file.php");

$upload_mode = "hmlist_image_etc_1_1";
include("./upload_design_file.php");

$upload_mode = "hmlist_image_etc_1_2";
include("./upload_design_file.php");

$upload_mode = "hmlist_image_etc_2_1";
include("./upload_design_file.php");

$upload_mode = "hmlist_image_etc_2_2";
include("./upload_design_file.php");

$upload_mode = "hmlist_flash";
include("./upload_design_file.php");

/*------------------------------
    ## 업데이트 ##
------------------------------*/

$sql_common = "";
$sql_common .= " set hmbar_width = '".addslashes($_POST['hmbar_width'])."' ";
$sql_common .= ", hmbar_height = '".addslashes($_POST['hmbar_height'])."' ";
$sql_common .= ", hmbar_background_color = '".addslashes($_POST['hmbar_background_color'])."' ";
$sql_common .= ", hmbar_position = '".addslashes($_POST['hmbar_position'])."' ";
$sql_common .= ", hmbar_margin1 = '".addslashes($_POST['hmbar_margin1'])."' ";
$sql_common .= ", hmbar_margin2 = '".addslashes($_POST['hmbar_margin2'])."' ";
$sql_common .= ", hmbar_line_use = '".addslashes($_POST['hmbar_line_use'])."' ";
$sql_common .= ", hmbar_line_color = '".addslashes($_POST['hmbar_line_color'])."' ";
$sql_common .= ", hmbar_list_use = '".addslashes($_POST['hmbar_list_use'])."' ";
$sql_common .= ", hmbar_text1_font_family = '".addslashes($_POST['hmbar_text1_font_family'])."' ";
$sql_common .= ", hmbar_text1_font_size = '".addslashes($_POST['hmbar_text1_font_size'])."' ";
$sql_common .= ", hmbar_text1_font_color = '".addslashes($_POST['hmbar_text1_font_color'])."' ";
$sql_common .= ", hmbar_text1_font_bold = '".addslashes($_POST['hmbar_text1_font_bold'])."' ";
$sql_common .= ", hmbar_text1_font_italic = '".addslashes($_POST['hmbar_text1_font_italic'])."' ";
$sql_common .= ", hmbar_text1_font_underline = '".addslashes($_POST['hmbar_text1_font_underline'])."' ";
$sql_common .= ", hmbar_text2_font_family = '".addslashes($_POST['hmbar_text2_font_family'])."' ";
$sql_common .= ", hmbar_text2_font_size = '".addslashes($_POST['hmbar_text2_font_size'])."' ";
$sql_common .= ", hmbar_text2_font_color = '".addslashes($_POST['hmbar_text2_font_color'])."' ";
$sql_common .= ", hmbar_text2_font_bold = '".addslashes($_POST['hmbar_text2_font_bold'])."' ";
$sql_common .= ", hmbar_text2_font_italic = '".addslashes($_POST['hmbar_text2_font_italic'])."' ";
$sql_common .= ", hmbar_text2_font_underline = '".addslashes($_POST['hmbar_text2_font_underline'])."' ";
$sql_common .= ", hmbar_image1_font_size = '".addslashes($_POST['hmbar_image1_font_size'])."' ";
$sql_common .= ", hmbar_image1_font_color = '".addslashes($_POST['hmbar_image1_font_color'])."' ";
$sql_common .= ", hmbar_image1_transparent = '".addslashes($_POST['hmbar_image1_transparent'])."' ";
$sql_common .= ", hmbar_image2_font_size = '".addslashes($_POST['hmbar_image2_font_size'])."' ";
$sql_common .= ", hmbar_image2_font_color = '".addslashes($_POST['hmbar_image2_font_color'])."' ";
$sql_common .= ", hmbar_image2_transparent = '".addslashes($_POST['hmbar_image2_transparent'])."' ";

// update
sql_query(" update $shop[design_hmbar_table] $sql_common ");

/*------------------------------
    ## 방식 설정 ##
------------------------------*/

if ($_POST['hmbar_list_use'] == '1') {

    $list_menu_code = "image1";

}

else if ($_POST['hmbar_list_use'] == '2') {

    $list_menu_code = "image2";

}

else if ($_POST['hmbar_list_use'] == '3') {

    $list_menu_code = "flash";

} else {
// 0 번

    $list_menu_code = "text";

}

/*------------------------------
    ## HOME ##
------------------------------*/

// 있다면
if ($_POST[$list_menu_code."_etc_menu_1"]) {

    $sql_common = "";
    $sql_common .= " set menu_type = 'etc' ";
    $sql_common .= ", menu_id = '1' ";
    $sql_common .= ", image_width = '".addslashes($_POST['etc_width_1'])."' ";
    $sql_common .= ", image_height = '".addslashes($_POST['etc_height_1'])."' ";
    $sql_common .= ", title = '".addslashes($_POST[$list_menu_code."_etc_menu_1_title"])."' ";

    // 체크
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        sql_query(" update $shop[design_hmlist_table] $sql_common where id = '".$dmshop_hmlist['id']."' ");

    } else {

        sql_query(" insert into $shop[design_hmlist_table] $sql_common ");

    }

} else {
// 삭제

    sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'etc' and menu_id = '1' ");

}

/*------------------------------
    ## 기획전 ##
------------------------------*/

// 있다면
if ($_POST[$list_menu_code."_etc_menu_2"]) {

    $sql_common = "";
    $sql_common .= " set menu_type = 'etc' ";
    $sql_common .= ", menu_id = '2' ";
    $sql_common .= ", image_width = '".addslashes($_POST['etc_width_2'])."' ";
    $sql_common .= ", image_height = '".addslashes($_POST['etc_height_2'])."' ";
    $sql_common .= ", title = '".addslashes($_POST[$list_menu_code."_etc_menu_2_title"])."' ";

    // 체크
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        sql_query(" update $shop[design_hmlist_table] $sql_common where id = '".$dmshop_hmlist['id']."' ");

    } else {

        sql_query(" insert into $shop[design_hmlist_table] $sql_common ");

    }

} else {
// 삭제

    sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'etc' and menu_id = '2' ");

}

/*------------------------------
    ## 분류 ##
------------------------------*/

// 여기선 숨김도 보인다.
$result = sql_query(" select * from $shop[category_table] where category = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 있다면
    if ($_POST[$list_menu_code."_category_menu_".$row['id']]) {

        $sql_common = "";
        $sql_common .= " set menu_type = 'category' ";
        $sql_common .= ", menu_id = '".$row['id']."' ";
        $sql_common .= ", image_width = '".addslashes($_POST["category_width_".$row['id']])."' ";
        $sql_common .= ", image_height = '".addslashes($_POST["category_height_".$row['id']])."' ";
        $sql_common .= ", title = '".addslashes($row['subject'])."' ";
        $sql_common .= ", position = '".$row['position']."' ";

        // 체크
        $dmshop_hmlist = shop_design_hmlist("category", $row['id']);

        if ($dmshop_hmlist['id']) {

            sql_query(" update $shop[design_hmlist_table] $sql_common where id = '".$dmshop_hmlist['id']."' ");

        } else {

            sql_query(" insert into $shop[design_hmlist_table] $sql_common ");

        }

    } else {
    // 삭제

        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'category' and menu_id = '".$row['id']."' ");

    }

    $upload_mode = "hmlist_image_category_1_".$row['id'];
    include("./upload_design_file.php");

    $upload_mode = "hmlist_image_category_2_".$row['id'];
    include("./upload_design_file.php");

}

/*------------------------------
    ## 분류 최적화 ##
------------------------------*/

$result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 분류 체크
    $chk = shop_category($row['menu_id']);

    // 없다
    if (!$chk['id']) {

        // 삭제
        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'category' and menu_id = '".$row['menu_id']."' ");

    }

}

/*------------------------------
    ## 게시판 ##
------------------------------*/

// 여기선 숨김도 보인다.
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 있다면
    if ($_POST[$list_menu_code."_board_menu_".$row['bbs_id']]) {

        $sql_common = "";
        $sql_common .= " set menu_type = 'board' ";
        $sql_common .= ", menu_id = '".$row['bbs_id']."' ";
        $sql_common .= ", image_width = '".addslashes($_POST["board_width_".$row['bbs_id']])."' ";
        $sql_common .= ", image_height = '".addslashes($_POST["board_height_".$row['bbs_id']])."' ";
        $sql_common .= ", title = '".addslashes($row['bbs_title'])."' ";
        $sql_common .= ", position = '".$row['bbs_position']."' ";

        // 체크
        $dmshop_hmlist = shop_design_hmlist("board", $row['bbs_id']);

        if ($dmshop_hmlist['id']) {

            sql_query(" update $shop[design_hmlist_table] $sql_common where id = '".$dmshop_hmlist['id']."' ");

        } else {

            sql_query(" insert into $shop[design_hmlist_table] $sql_common ");

        }

    } else {
    // 삭제

        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'board' and menu_id = '".$row['bbs_id']."' ");

    }

    $upload_mode = "hmlist_image_board_1_".$row['bbs_id'];
    include("./upload_design_file.php");

    $upload_mode = "hmlist_image_board_2_".$row['bbs_id'];
    include("./upload_design_file.php");

}

/*------------------------------
    ## 게시판 최적화 ##
------------------------------*/

$result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 게시판 체크
    $chk = shop_board($row['menu_id']);

    // 없다
    if (!$chk['bbs_id']) {

        // 삭제
        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'board' and menu_id = '".$row['menu_id']."' ");

    }

}

/*------------------------------
    ## 이동 ##
------------------------------*/

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>