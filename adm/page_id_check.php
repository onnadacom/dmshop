<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$page_id) {

    echo "<script type=\"text/javascript\">document.getElementById(\"page_id_chk\").value = \"\";document.getElementById(\"page_id_msg\").innerHTML = \"<font color='#ff0000'>아이디가 입력되지 않았습니다.</font>\";</script>";
    exit;

}

if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $page_id)) {

    echo "<script type=\"text/javascript\">document.getElementById(\"page_id_chk\").value = \"\";document.getElementById(\"page_id_msg\").innerHTML = \"<font color='#ff0000'>아이디는 영문, 숫자, _ 문자, 20자 이내로만 가능합니다.</font>\";</script>";
    exit;

}

// 페이지
$dmshop_page = shop_page($page_id);

// 존재
if ($dmshop_page['page_id']) {

    echo "<script type=\"text/javascript\">document.getElementById(\"page_id_chk\").value = \"\";document.getElementById(\"page_id_msg\").innerHTML = \"<font color='#ff0000'>".$page_id." 아이디는 이미 존재합니다.</font>\";</script>";
    exit;

}

echo "<script type=\"text/javascript\">document.getElementById(\"page_id_chk\").value = \"1\";document.getElementById(\"page_id_msg\").innerHTML = \"<font color='#0000ff'>중복된 아이디가 없습니다. 다음단계로 진행하세요.</font>\";</script>";
exit;
?>