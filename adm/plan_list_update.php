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

        $dmshop_plan = shop_plan(addslashes($_POST['plan_id'][$k]));

        $sql_common = "";
        $sql_common .= " set position = '".addslashes($_POST['position'][$k])."' ";
        $sql_common .= ", view = '".addslashes($_POST['view'][$k])."' ";
        $sql_common .= ", title = '".addslashes($_POST['title'][$k])."' ";
        $sql_common .= ", item_width = '".addslashes($_POST['item_width'][$k])."' ";
        $sql_common .= ", item_height = '".addslashes($_POST['item_height'][$k])."' ";
        $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'][$k])."' ";
        $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'][$k])."' ";

        if ($dmshop_plan['thumb_width'] != $_POST['thumb_width'][$k] || $dmshop_plan['thumb_height'] != $_POST['thumb_height'][$k]) {

            $sql_common .= ", thumb_use = '1' ";

        }

        // 업데이트
        sql_query(" update $shop[plan_table] $sql_common where id = '".addslashes($_POST['plan_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        /*--------------------------------
            ## 기획전 ##
        --------------------------------*/

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('plan_top_".addslashes($_POST['plan_id'][$k])."','plan_bottom_".addslashes($_POST['plan_id'][$k])."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[design_file_table] where upload_mode in ('plan_top_".addslashes($_POST['plan_id'][$k])."','plan_bottom_".addslashes($_POST['plan_id'][$k])."') ");

        // 기획전 삭제
        sql_query(" delete from $shop[plan_table] where id = '".addslashes($_POST['plan_id'][$k])."' ");

        /*--------------------------------
            ## 기획전 상품 ##
        --------------------------------*/

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[item_file_table] where upload_mode = 'plan".addslashes($_POST['plan_id'][$k])."' ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[item_file_table] where upload_mode = 'plan".addslashes($_POST['plan_id'][$k])."' ");

        // 기획전 상품 삭제
        sql_query(" delete from $shop[plan_item_table] where plan_id = '".addslashes($_POST['plan_id'][$k])."' ");

        // 메인중앙 기획전 초기화
        sql_query(" update $shop[display_box_list_table] set plan = '0' where plan = '".addslashes($_POST['plan_id'][$k])."' ");

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