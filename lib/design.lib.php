<?
if (!defined("_DMSHOP_")) exit;

// 디자인
function shop_design()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_table] ");

}

// 첨부 파일
function shop_design_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[design_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// 상품페이지
function shop_design_item()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_item_table] ");

}

// 폰트 설정
function shop_design_font()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_font_table] ");

}

// 이미지 설정
function shop_design_image()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_image_table] ");

}

// 스킨 설정
function shop_design_skin()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_skin_table] ");

}

// TOP
function shop_design_top()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_top_table] ");

}

// BOTTOM
function shop_design_bottom()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_bottom_table] ");

}

// MENU
function shop_design_menu()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_menu_table] ");

}

// WMBAR
function shop_design_wmbar()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_wmbar_table] ");

}

// WMLIST
function shop_design_wmlist($menu_type, $menu_id)
{

    global $shop;

    return sql_fetch(" select * from $shop[design_wmlist_table] where menu_type = '".$menu_type."' and menu_id = '".$menu_id."' ");

}

// HMBAR
function shop_design_hmbar()
{

    global $shop;

    return sql_fetch(" select * from $shop[design_hmbar_table] ");

}

// HMLIST
function shop_design_hmlist($menu_type, $menu_id)
{

    global $shop;

    return sql_fetch(" select * from $shop[design_hmlist_table] where menu_type = '".$menu_type."' and menu_id = '".$menu_id."' ");

}

// 가로메뉴바
function shop_wmbar_skin($skin)
{

    global $shop, $ct_id, $bbs_id, $dmshop_category;

    if ($skin) {

        $k = 0;
        $list = array();

        // 홈
        $row = shop_design_wmlist("etc", "1");
        if ($row['id']) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path'];
            $list[$k]['menu_title'] = $row['title'];
            $list[$k]['menu_hover'] = false;

            $k++;

        }

        // 분류
        $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'category' order by position asc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/list.php?ct_id=".$row['menu_id'];
            $list[$k]['menu_title'] = $row['title'];

            if ($row['menu_id'] == $ct_id || $row['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

                $list[$k]['menu_hover'] = true;

            } else {

                $list[$k]['menu_hover'] = false;

            }

            $k++;

        }

        // 게시판
        $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'board' order by position desc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/board.php?bbs_id=".$row['menu_id'];
            $list[$k]['menu_title'] = $row['title'];

            if ($row['menu_id'] == $bbs_id) {

                $list[$k]['menu_hover'] = true;

            } else {

                $list[$k]['menu_hover'] = false;

            }

            $k++;

        }

        // 기획전
        $row = shop_design_wmlist("etc", "2");
        if ($row['id']) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/plan.php";
            $list[$k]['menu_title'] = $row['title'];
            $list[$k]['menu_hover'] = false;

            $k++;

        }

        $dmshop_wmbar_path = "$shop[path]/skin/wmbar/$skin";

    } else {

        $dmshop_wmbar_path = "$shop[path]/layout/default";

    }

    ob_start();
    include("$dmshop_wmbar_path/wmbar.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

// 세로메뉴바
function shop_hmbar_skin($skin)
{

    global $shop, $ct_id, $bbs_id, $dmshop_category;

    if ($skin) {

        $k = 0;
        $list = array();

        // 홈
        $row = shop_design_hmlist("etc", "1");
        if ($row['id']) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path'];
            $list[$k]['menu_title'] = $row['title'];
            $list[$k]['menu_hover'] = false;

            $k++;

        }

        // 분류
        $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' order by position asc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/list.php?ct_id=".$row['menu_id'];
            $list[$k]['menu_title'] = $row['title'];

            if ($row['menu_id'] == $ct_id || $row['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

                $list[$k]['menu_hover'] = true;

            } else {

                $list[$k]['menu_hover'] = false;

            }

            $k++;

        }

        // 게시판
        $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' order by position desc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/board.php?bbs_id=".$row['menu_id'];
            $list[$k]['menu_title'] = $row['title'];

            if ($row['menu_id'] == $bbs_id) {

                $list[$k]['menu_hover'] = true;

            } else {

                $list[$k]['menu_hover'] = false;

            }

            $k++;

        }

        // 기획전
        $row = shop_design_hmlist("etc", "2");
        if ($row['id']) {

            $list[$k] = $row;
            $list[$k]['menu_link'] = $shop['path']."/plan.php";
            $list[$k]['menu_title'] = $row['title'];
            $list[$k]['menu_hover'] = false;

            $k++;

        }

        $dmshop_hmbar_path = "$shop[path]/skin/hmbar/$skin";

    } else {

        $dmshop_hmbar_path = "$shop[path]/layout/default";

    }

    ob_start();
    include("$dmshop_hmbar_path/hmbar.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

// 메인중앙 첨부파일
function shop_display_box_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[display_box_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// 메인중앙 첨부파일뷰
function shop_display_box_view($datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/display_box/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' style='".$style."' border='0'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' style='".$style."' border='0'>";

    }

    else if (preg_match("/\.(swf)$/i", $file)) {

        return "<script type='text/javascript'>shopFlash('{$source}', '_shop_{$ids}', '$width', '$height', 'transparent');</script>";

    }

    else if (preg_match("/\.(asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3)$/i", $file)) {

        return "<script type='text/javascript'>shopMovie('$source', '_shop_{$ids}', '$width', '$height');</script>";

    } else {

        return false;

    }

}

// box type
function shop_design_box_type($display_id, $display_type)
{

    global $shop;

    return sql_fetch(" select * from $shop[display_box_type_table] where display_id = '".$display_id."' and display_type = '".$display_type."' ");

}

// box list
function shop_design_box_list($display_id, $display_type, $display_list)
{

    global $shop;

    return sql_fetch(" select * from $shop[display_box_list_table] where display_id = '".$display_id."' and display_type = '".$display_type."' and display_list = '".$display_list."' ");

}

// 박스 사이즈
function shop_display_box_size($width, $height)
{

    if (!$width && !$height) {

        return false;

    }

    $data = "";

     if ($width) {

        $data .= " width='".$width."' ";

    }

     if ($height) {

        $data .= " height='".$height."' ";

    }

    return $data;

}

// 레이아웃 명칭
function shop_design_layout_name($type, $id)
{

    if ($type == 'main') {

        if ($id == '0') {

            $name = "메뉴 좌측 기본형";

        }

        else if ($id == '1') {

            $name = "메뉴 우측 기본형";

        }

        else if ($id == '2') {

            $name = "메뉴 제거 오픈형";

        }

        else if ($id == '3') {

            $name = "메뉴 좌측 확장형";

        }

        else if ($id == '4') {

            $name = "메뉴 우측 확장형";

        } else {

            return false;

        }

    } else {

        if ($id == '0') {

            $name = "메뉴 좌측 기본형";

        }

        else if ($id == '1') {

            $name = "메뉴 우측 기본형";

        }

        else if ($id == '2') {

            $name = "메뉴 제거 오픈형";

        }

        else if ($id == '3') {

            $name = "메뉴 좌측 확장형";

        }

        else if ($id == '4') {

            $name = "메뉴 우측 확장형";

        } else {

            return false;

        }

    }

    return $name;

}

// 스킨 명칭
function shop_design_skin_name($skin)
{

    if ($skin) {

        $name = $skin;

    } else {

        $name = "직접 만들기";

    }

    return $name;

}

// 테이블 위치
function shop_design_align($mode)
{

     if ($mode == '0') {

        $data = "left";

    }

     else if ($mode == '1') {

        $data = "center";

    }

     else if ($mode == '2') {

        $data = "right";

    } else {

        $data = "left";

    }

    return $data;

}

// 레이어 위치
function shop_design_position($mode)
{

     if ($mode == '1') {

        return "margin:0 auto;";

    }

     else if ($mode == '2') {

        return "margin-left:auto;";

    } else {

        return false;

    }

}

// 왼쪽메뉴 스킨
function shop_menu_skin($skin="default")
{

    global $shop, $dmshop, $dmshop_design, $shop_user_login;

    $dmshop_menu_path = "$shop[path]/skin/menu/$skin";

    ob_start();
    include("$dmshop_menu_path/menu.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>