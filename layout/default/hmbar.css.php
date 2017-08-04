<?
if (!defined('_DMSHOP_')) exit;

echo "\n<style type=\"text/css\">\n";

// 자동생성
if ($dmshop_hmbar['hmbar_list_use'] == '1') {

    $dmshop_hmbar_font_file = "";

    $file = shop_design_file("hmbar_font_file");

    if ($file['upload_file']) {

        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        if (file_exists($file_path) && $file['upload_file']) {

            $dmshop_hmbar_font_file = $file_path;

        }

    }

    echo ".dmshop_hmlist a {display:block;}\n";

    // home
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        echo ".dmshop_hmlist a.image1_etc1 {width:".$dmshop_hmlist['image_width']."px; height:".$dmshop_hmlist['image_height']."px; background:url('".shop_text_image($dmshop_hmlist['title'], $dmshop_hmbar_font_file, $dmshop_hmlist['image_width'], $dmshop_hmlist['image_height'], $dmshop_hmbar['hmbar_image1_font_size'], $dmshop_hmbar['hmbar_image1_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_hmlist a.image1_etc1:hover {width:".$dmshop_hmlist['image_width']."px; height:".$dmshop_hmlist['image_height']."px; background:url('".shop_text_image($dmshop_hmlist['title'], $dmshop_hmbar_font_file, $dmshop_hmlist['image_width'], $dmshop_hmlist['image_height'], $dmshop_hmbar['hmbar_image2_font_size'], $dmshop_hmbar['hmbar_image2_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 분류
    $hmlist_category = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_category[$i] = $row;

        echo ".dmshop_hmlist a.image1_category_".$row['id']." {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_hmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_hmbar['hmbar_image1_font_size'], $dmshop_hmbar['hmbar_image1_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_hmlist a.image1_category_".$row['id'].":hover, .dmshop_hmlist a.image1_category_".$row['id']."_hover {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_hmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_hmbar['hmbar_image2_font_size'], $dmshop_hmbar['hmbar_image2_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 게시판
    $hmlist_board = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_board[$i] = $row;

        echo ".dmshop_hmlist a.image1_board_".$row['id']." {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_hmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_hmbar['hmbar_image1_font_size'], $dmshop_hmbar['hmbar_image1_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_hmlist a.image1_board_".$row['id'].":hover, .dmshop_hmlist a.image1_board_".$row['id']."_hover {width:".$row['image_width']."px; height:".$row['image_height']."px; background:url('".shop_text_image($row['title'], $dmshop_hmbar_font_file, $row['image_width'], $row['image_height'], $dmshop_hmbar['hmbar_image2_font_size'], $dmshop_hmbar['hmbar_image2_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

    // 기획전
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        echo ".dmshop_hmlist a.image1_etc2 {width:".$dmshop_hmlist['image_width']."px; height:".$dmshop_hmlist['image_height']."px; background:url('".shop_text_image($dmshop_hmlist['title'], $dmshop_hmbar_font_file, $dmshop_hmlist['image_width'], $dmshop_hmlist['image_height'], $dmshop_hmbar['hmbar_image1_font_size'], $dmshop_hmbar['hmbar_image1_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image1_transparent'], "path")."') no-repeat;}\n";
        echo ".dmshop_hmlist a.image1_etc2:hover {width:".$dmshop_hmlist['image_width']."px; height:".$dmshop_hmlist['image_height']."px; background:url('".shop_text_image($dmshop_hmlist['title'], $dmshop_hmbar_font_file, $dmshop_hmlist['image_width'], $dmshop_hmlist['image_height'], $dmshop_hmbar['hmbar_image2_font_size'], $dmshop_hmbar['hmbar_image2_font_color'], $dmshop_hmbar['hmbar_background_color'], $dmshop_hmbar['hmbar_image2_transparent'], "path")."') no-repeat;}\n";

    }

}

// 직접업로드
else if ($dmshop_hmbar['hmbar_list_use'] == '2') {

    echo ".dmshop_hmlist a {display:block;}\n";

    // home
    $dmshop_hmlist = shop_design_hmlist("etc", "1");

    if ($dmshop_hmlist['id']) {

        $file = shop_design_file("hmlist_image_etc_1_1");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_etc1 {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("hmlist_image_etc_1_2");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_etc1:hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 분류
    $hmlist_category = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_category[$i] = $row;

        $file = shop_design_file("hmlist_image_category_1_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_category_".$row['id']." {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("hmlist_image_category_2_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_category_".$row['id'].":hover, .dmshop_hmlist a.image2_category_".$row['id']."_hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 게시판
    $hmlist_board = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_board[$i] = $row;

        $file = shop_design_file("hmlist_image_board_1_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_board_".$row['id']." {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("hmlist_image_board_2_".$row['menu_id']."");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_board_".$row['id'].":hover, .dmshop_hmlist a.image2_board_".$row['id']."_hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

    // 기획전
    $dmshop_hmlist = shop_design_hmlist("etc", "2");

    if ($dmshop_hmlist['id']) {

        $file = shop_design_file("hmlist_image_etc_2_1");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_etc2 {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

        $file = shop_design_file("hmlist_image_etc_2_2");

        if ($file['upload_file']) {

            echo ".dmshop_hmlist a.image2_etc2:hover {width:".$file['upload_width']."px; height:".$file['upload_height']."px; background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') no-repeat;}\n";

        }

    }

} else {
// text

    // 분류
    $hmlist_category = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' order by position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_category[$i] = $row;

    }

    // 게시판
    $hmlist_board = array();
    $result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' order by position desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $hmlist_board[$i] = $row;

    }

    // 기본
    echo ".dmshop_hmlist a.text {\n";

    echo "\n";
    if ($dmshop_hmbar['hmbar_text1_font_family']) {

        echo "font-family:".$dmshop_hmbar['hmbar_text1_font_family'].";\n";

    }

    if ($dmshop_hmbar['hmbar_text1_font_size']) {

        echo "font-size:".$dmshop_hmbar['hmbar_text1_font_size']."px;\n";

    }

    if ($dmshop_hmbar['hmbar_text1_font_color']) {

        echo "color:#".$dmshop_hmbar['hmbar_text1_font_color'].";\n";

    }

    if ($dmshop_hmbar['hmbar_text1_font_bold']) {

        echo "font-weight:bold;\n";

    } else {

        echo "font-weight:normal;\n";

    }

    if ($dmshop_hmbar['hmbar_text1_font_italic']) {

        echo "font-style:italic;\n";

    } else {

        echo "font-style:normal;\n";

    }
    
    if ($dmshop_hmbar['hmbar_text1_font_underline']) {

        echo "text-decoration:underline;\n";

    } else {

        echo "text-decoration:none;\n";

    }

    echo "}\n";

    // 활성화
    echo ".dmshop_hmlist a.text:hover, .dmshop_hmlist a.hover {\n";

    echo "\n";
    if ($dmshop_hmbar['hmbar_text2_font_family']) {

        echo "font-family:".$dmshop_hmbar['hmbar_text2_font_family'].";\n";

    }

    if ($dmshop_hmbar['hmbar_text2_font_size']) {

        echo "font-size:".$dmshop_hmbar['hmbar_text2_font_size']."px;\n";

    }

    if ($dmshop_hmbar['hmbar_text2_font_color']) {

        echo "color:#".$dmshop_hmbar['hmbar_text2_font_color'].";\n";

    }

    if ($dmshop_hmbar['hmbar_text2_font_bold']) {

        echo "font-weight:bold;\n";

    } else {

        echo "font-weight:normal;\n";

    }

    if ($dmshop_hmbar['hmbar_text2_font_italic']) {

        echo "font-style:italic;\n";

    } else {

        echo "font-style:normal;\n";

    }

    if ($dmshop_hmbar['hmbar_text2_font_underline']) {

        echo "text-decoration:underline;\n";

    } else {

        echo "text-decoration:none;\n";

    }

    echo "}\n";

}

echo ".dmshop_hmlist p {margin:0px; padding:".(int)($dmshop_hmbar['hmbar_margin2'])."px ".(int)($dmshop_hmbar['hmbar_margin1'])."px;}";

echo "</style>\n";
?>