<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$item_code) {

    echo "<script type='text/javascript'>alert('상품코드가 입력되지 않았습니다.');</script>";
    exit;

}

if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9]+$/", $item_code) ? $item_code : ""; }

if (!$item_code) {

    echo "<script type='text/javascript'>alert('상품코드는 대소문자, 숫자만 가능합니다.');</script>";
    exit;

}

// 상품
$dmshop_item = shop_item_code($item_code);

// 중복코드가 있다면
if ($dmshop_item['id']) {

    echo "<script type='text/javascript'>alert('".$item_code." 상품코드는 이미 존재합니다.');</script>";
    exit;

}

echo "<script type=\"text/javascript\">document.getElementById(\"item_code_chk\").value = \"1\";document.getElementById(\"item_code_msg\").innerHTML = \"<font color='#0000ff'>중복된 코드가 없습니다. 다음단계로 진행하세요.</font>\";</script>";
exit;
?>