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
        $sql_common .= " set group_id = '".addslashes($_POST['group_id'][$k])."' ";
        $sql_common .= ", ba_position = '".addslashes($_POST['ba_position'][$k])."' ";
        $sql_common .= ", ba_view = '".addslashes($_POST['ba_view'][$k])."' ";
        $sql_common .= ", ba_title = '".addslashes($_POST['ba_title'][$k])."' ";

        // 업데이트
        sql_query(" update $shop[banner_table] $sql_common where id = '".addslashes($_POST['banner_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 배너
        $dmshop_banner = shop_banner(addslashes($_POST['banner_id'][$k]));

        // 원본
        $file_path = $shop['path']."/data/banner/".shop_data_path("u", $dmshop_banner['upload_datetime'])."/".$dmshop_banner['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

        // 배너 삭제
        sql_query(" delete from $shop[banner_table] where id = '".addslashes($_POST['banner_id'][$k])."' ");

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