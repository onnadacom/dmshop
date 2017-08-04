<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$bbs_id) {

    echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#ff0000'>게시판 아이디가 입력되지 않았습니다.</font>\";</script>";
    exit;

}

if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $bbs_id)) {

    echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#ff0000'>게시판 아이디는 영문, 숫자, _ 문자, 20자 이내로만 가능합니다.</font>\";</script>";
    exit;

}

// 첨부파일이 af_ 으로 시작되기 때문에 막아야 한다.
if (preg_match("/(af_)$/i", $bbs_id)) {

    echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#ff0000'>af_ 문자를 사용하실 수 없습니다.</font>\";</script>";
    exit;

}

if ($bbs_id == 'file' || $bbs_id == 'reply' || $bbs_id == 'good' || $bbs_id == 'down') {

    echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#ff0000'>사용할 수 없는 게시판 아이디입니다.</font>\";</script>";
    exit;

}

// 게시판
$dmshop_board = shop_board($bbs_id);

// 존재
if ($dmshop_board['bbs_id']) {

    echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#ff0000'>".$bbs_id." 아이디는 이미 존재합니다.</font>\";</script>";
    exit;

}

echo "<script type=\"text/javascript\">document.getElementById(\"bbs_id_chk\").value = \"1\";document.getElementById(\"bbs_id_msg\").innerHTML = \"<font color='#0000ff'>중복된 아이디가 없습니다. 다음단계로 진행하세요.</font>\";</script>";
exit;
?>