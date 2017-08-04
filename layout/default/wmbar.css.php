<?
if (!defined('_DMSHOP_')) exit;

echo "\n<style type=\"text/css\">\n";

// 자동생성
if ($dmshop_wmbar['wmbar_list_use'] == '1') {

    $dmshop_wmbar_font_file = "";

    $file = shop_design_file("wmbar_font_file");

    if ($file['upload_file']) {

        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        if (file_exists($file_path) && $file['upload_file']) {

            $dmshop_wmbar_font_file = $file_path;

        }

    }

    echo ".dmshop_wmlist a {display:block;}\n";

    // home
    $dmshop_wmlist = shop_design_wmlist("etc", "1");

    if ($dmshop_wmlist['id']) {

        echo ".dmshop_wmlist a.image1_etc1 {width:".$dmshop_wmlist['image_width']."px; height:".$dmshop_wmlist['image_height']."px; background:url('".shop_text_image($dmshop_wmlist['title'], $dmshop_wmbar_font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_wmlist a.image1_etc1:hover {width:".$dmshop_wmlist['image_width']."px; height:".$dmshop_wmlist['image_height']."px; background:url('".shop_text_image($dmshop_wmlist['title'], $dmshop_wmbar_font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 분류
    $wmlist_category = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_category[$i] = $row;

        echo ".dmshop_wmlist a.image1_category_".$row['id']." {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_wmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_wmlist a.image1_category_".$row['id'].":hover, .dmshop_wmlist a.image1_category_".$row['id']."_hover {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_wmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 게시판
    $wmlist_board = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_board[$i] = $row;

        echo ".dmshop_wmlist a.image1_board_".$row['id']." {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_wmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_wmlist a.image1_board_".$row['id'].":hover, .dmshop_wmlist a.image1_board_".$row['id']."_hover {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_wmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 기획전
    $dmshop_wmlist = shop_design_wmlist("etc", "2");

    if ($dmshop_wmlist['id']) {

        echo ".dmshop_wmlist a.image1_etc2 {width:".$dmshop_wmlist['image_width']."px; height:".$dmshop_wmlist['image_height']."px; background:url('".shop_text_image($dmshop_wmlist['title'], $dmshop_wmbar_font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_wmlist a.image1_etc2:hover {width:".$dmshop_wmlist['image_width']."px; height:".$dmshop_wmlist['image_height']."px; background:url('".shop_text_image($dmshop_wmlist['title'], $dmshop_wmbar_font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

}

// 직접업로드
else if ($dmshop_wmbar['wmbar_list_use'] == '2') {

    echo ".dmshop_wmlist a {display:block;}\n";

    // home
    $dmshop_wmlist = shop_design_wmlist("etc", "1");

    if ($dmshop_wmlist['id']) {

        $file = shop_design_file("wmlist_image_etc_1_1");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_etc1 {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("wmlist_image_etc_1_2");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_etc1:hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 분류
    $wmlist_category = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_category[$i] = $row;

        $file = shop_design_file("wmlist_image_category_1_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_category_".$row['id']." {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("wmlist_image_category_2_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_category_".$row['id'].":hover, .dmshop_wmlist a.image2_category_".$row['id']."_hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 게시판
    $wmlist_board = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_board[$i] = $row;

        $file = shop_design_file("wmlist_image_board_1_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_board_".$row['id']." {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("wmlist_image_board_2_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_board_".$row['id'].":hover, .dmshop_wmlist a.image2_board_".$row['id']."_hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 기획전
    $dmshop_wmlist = shop_design_wmlist("etc", "2");

    if ($dmshop_wmlist['id']) {

        $file = shop_design_file("wmlist_image_etc_2_1");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_etc2 {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("wmlist_image_etc_2_2");

        if ($file['upload_file']) {

            echo ".dmshop_wmlist a.image2_etc2:hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

} else {
// text

    // 분류
    $wmlist_category = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_category[$i] = $row;

    }

    // 게시판
    $wmlist_board = array();
    $result = sql_query(" select * from $shop[design_wmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $wmlist_board[$i] = $row;

    }

    // 기본
    echo ".dmshop_wmlist a.text {\n";

    echo "\n";
    if ($dmshop_wmbar['wmbar_text1_font_family']) {

        echo "font-family:".$dmshop_wmbar['wmbar_text1_font_family'].";\n";

    }

    if ($dmshop_wmbar['wmbar_text1_font_size']) {

        echo "font-size:".$dmshop_wmbar['wmbar_text1_font_size']."px;\n";

    }

    if ($dmshop_wmbar['wmbar_text1_font_color']) {

        echo "color:#".$dmshop_wmbar['wmbar_text1_font_color'].";\n";

    }

    if ($dmshop_wmbar['wmbar_text1_font_bold']) {

        echo "font-weight:bold;\n";

    } else {

        echo "font-weight:normal;\n";

    }

    if ($dmshop_wmbar['wmbar_text1_font_italic']) {

        echo "font-style:italic;\n";

    } else {

        echo "font-style:normal;\n";

    }

    if ($dmshop_wmbar['wmbar_text1_font_underline']) {

        echo "text-decoration:underline;\n";

    } else {

        echo "text-decoration:none;\n";

    }

    echo "}\n";

    // 활성화
    echo ".dmshop_wmlist a.text:hover, .dmshop_wmlist a.hover {\n";

    echo "\n";
    if ($dmshop_wmbar['wmbar_text2_font_family']) {

        echo "font-family:".$dmshop_wmbar['wmbar_text2_font_family'].";\n";

    }

    if ($dmshop_wmbar['wmbar_text2_font_size']) {

        echo "font-size:".$dmshop_wmbar['wmbar_text2_font_size']."px;\n";

    }

    if ($dmshop_wmbar['wmbar_text2_font_color']) {

        echo "color:#".$dmshop_wmbar['wmbar_text2_font_color'].";\n";

    }

    if ($dmshop_wmbar['wmbar_text2_font_bold']) {

        echo "font-weight:bold;\n";

    } else {

        echo "font-weight:normal;\n";

    }

    if ($dmshop_wmbar['wmbar_text2_font_italic']) {

        echo "font-style:italic;\n";

    } else {

        echo "font-style:normal;\n";

    }

    if ($dmshop_wmbar['wmbar_text2_font_underline']) {

        echo "text-decoration:underline;\n";

    } else {

        echo "text-decoration:none;\n";

    }

    echo "}\n";

}

echo "</style>\n";
?>