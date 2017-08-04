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
        $sql_common .= " set position = '".addslashes($_POST['position'][$k])."' ";
        $sql_common .= ", view = '".addslashes($_POST['view'][$k])."' ";
        $sql_common .= ", title = '".addslashes($_POST['title'][$k])."' ";

        // 업데이트
        sql_query(" update $shop[icon_file_table] $sql_common where id = '".addslashes($_POST['icon_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[icon_file_table] where id = '".addslashes($_POST['icon_id'][$k])."' ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/icon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[icon_file_table] where id = '".addslashes($_POST['icon_id'][$k])."' ");

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