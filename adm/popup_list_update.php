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

        $sql_common = "";
        $sql_common .= " set pop_view = '".addslashes($_POST['pop_view'][$k])."' ";
        $sql_common .= ", pop_position = '".addslashes($_POST['pop_position'][$k])."' ";
        $sql_common .= ", pop_title = '".addslashes($_POST['pop_title'][$k])."' ";
        $sql_common .= ", pop_start = '".addslashes($_POST['pop_start'][$k])."-00' ";
        $sql_common .= ", pop_end = '".addslashes($_POST['pop_end'][$k])."-00' ";

        // 업데이트
        sql_query(" update $shop[popup_table] $sql_common where id = '".addslashes($_POST['popup_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 팝업
        $dmshop_popup = shop_popup(addslashes($_POST['popup_id'][$k]));

        // 원본
        $file_path = $shop['path']."/data/popup/".shop_data_path("u", $dmshop_popup['upload_datetime'])."/".$dmshop_popup['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

        // 팝업 삭제
        sql_query(" delete from $shop[popup_table] where id = '".addslashes($_POST['popup_id'][$k])."' ");

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