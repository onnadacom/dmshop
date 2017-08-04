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

    // set
    $sql_common = "";
    $sql_common .= " set name = '".addslashes($_POST['name'][$k])."' ";

    // 업데이트
    sql_query(" update $shop[user_level_table] $sql_common where level = '".addslashes($_POST['level'][$k])."' ");

    // 파일경로
    $dir = $shop['path']."/data/user_level/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 아이콘
    $upload_mode = addslashes($_POST['level'][$k]);
    include("./upload_user_level_file.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>