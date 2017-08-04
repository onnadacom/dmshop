<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$user_id) {

    echo "<script type=\"text/javascript\">$(\"#user_id_chk\").val(\"\");$(\"#user_id_msg\").html(\"<font color='#ff0000'>회원아이디가 입력되지 않았습니다.</font>\");</script>";
    exit;

}

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

if (!$user_id) {

    echo "<script type=\"text/javascript\">$(\"#user_id_chk\").val(\"\");$(\"#user_id_msg\").html(\"<font color='#ff0000'>회원아이디는 대소문자, 숫자만 가능합니다.</font>\");</script>";
    exit;

}

$user = shop_user($user_id);

// 없다면
if (!$user['user_id']) {

    echo "<script type=\"text/javascript\">$(\"#user_id_chk\").val(\"\");$(\"#user_id_msg\").html(\"<font color='#ff0000'>{$user_id} 아이디가 존재하지 않습니다.</font>\");</script>";
    exit;

}

// 휴대폰
if ($user['user_hp']) {

    $user_hp = $user['user_hp'];
    $user_hp1 = shop_split("-", $user['user_hp'], "0");
    $user_hp2 = shop_split("-", $user['user_hp'], "1");
    $user_hp3 = shop_split("-", $user['user_hp'], "2");

}

// 일반전화
if ($user['user_tel']) {

    $user_tel = $user['user_tel'];
    $user_tel1 = shop_split("-", $user['user_tel'], "0");
    $user_tel2 = shop_split("-", $user['user_tel'], "1");
    $user_tel3 = shop_split("-", $user['user_tel'], "2");

}

echo "<script type=\"text/javascript\">\n";
echo "$(\"#user_id_chk\").val(\"1\");";
echo "$(\"#user_id_msg\").html(\"<font color='#0000ff'>{$user_id} 아이디가 확인되었습니다.</font>\");";
echo "$(\"#user_name\").val(\"".text($user['user_name'])."\");";
echo "$(\"#user_zip1\").val(\"".text($user['user_zip1'])."\");";
echo "$(\"#user_zip2\").val(\"".text($user['user_zip2'])."\");";
echo "$(\"#user_addr1\").val(\"".text($user['user_addr1'])."\");";
echo "$(\"#user_addr2\").val(\"".text($user['user_addr2'])."\");";
echo "$(\"#user_hp1\").selectBox('value', '".text($user_hp1)."');\n";
echo "$(\"#user_hp2\").val(\"".text($user_hp2)."\");";
echo "$(\"#user_hp3\").val(\"".text($user_hp3)."\");";
echo "$(\"#user_tel1\").selectBox('value', '".text($user_tel1)."');\n";
echo "$(\"#user_tel2\").val(\"".text($user_tel2)."\");";
echo "$(\"#user_tel3\").val(\"".text($user_tel3)."\");";
echo "$(\"#user_email\").val(\"".text($user['user_email'])."\");";
echo "</script>";
exit;
?>