<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // update
    if ($m == 'u') {

        $dmshop_category = shop_category(addslashes($_POST['category_id'][$k]));

        $sql_common = "";
        $sql_common .= " set view = '".addslashes($_POST['view'][$k])."' ";
        $sql_common .= ", subject = '".addslashes($_POST['subject'][$k])."' ";
        $sql_common .= ", item_width = '".addslashes($_POST['item_width'][$k])."' ";
        $sql_common .= ", item_height = '".addslashes($_POST['item_height'][$k])."' ";
        $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'][$k])."' ";
        $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'][$k])."' ";

        if ($dmshop_category['thumb_width'] != addslashes($_POST['thumb_width'][$k]) || $dmshop_category['thumb_height'] != addslashes($_POST['thumb_height'][$k])) {

            $sql_common .= ", thumb_use = '1' ";

        }

        // 업데이트
        sql_query(" update $shop[category_table] $sql_common where id = '".addslashes($_POST['category_id'][$k])."' ");

        // 가로메뉴 업데이트
        sql_query(" update $shop[design_wmlist_table] set title = '".addslashes($_POST['subject'][$k])."' where menu_type = 'category' and menu_id = '".addslashes($_POST['category_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('category_top_".addslashes($_POST['category_id'][$k])."','category_bottom_".addslashes($_POST['category_id'][$k])."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[design_file_table] where upload_mode in ('category_top_".addslashes($_POST['category_id'][$k])."','category_bottom_".addslashes($_POST['category_id'][$k])."') ");

        // 분류 삭제
        sql_query(" delete from $shop[category_table] where id = '".addslashes($_POST['category_id'][$k])."' ");

        // 가로메뉴 삭제
        sql_query(" delete from $shop[design_wmlist_table] where menu_type = 'category' and menu_id = '".addslashes($_POST['category_id'][$k])."' ");

        // 세로메뉴 삭제
        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'category' and menu_id = '".addslashes($_POST['category_id'][$k])."' ");

        // 메인중앙 분류 초기화
        sql_query(" update $shop[display_box_list_table] set category = '0' where category = '".addslashes($_POST['category_id'][$k])."' ");

    } else {

        // pass

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>