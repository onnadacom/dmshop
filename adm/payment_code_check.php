<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if (!$pay_code) {

    echo "<script type=\"text/javascript\">$(\"#pay_code_chk\").val(\"\");$(\"#pay_code_msg\").html(\"<font color='#ff0000'>결제코드가 입력되지 않았습니다.</font>\");</script>";
    exit;

}

if ($pay_code) { $pay_code = preg_match("/^[a-zA-Z0-9]+$/", $pay_code) ? $pay_code : ""; }

if (!$pay_code) {

    echo "<script type=\"text/javascript\">$(\"#pay_code_chk\").val(\"\");$(\"#pay_code_msg\").html(\"<font color='#ff0000'>결제코드는 대소문자, 숫자만 가능합니다.</font>\");</script>";
    exit;

}

$dmshop_payment = shop_payment_code($pay_code);

// 중복코드가 있다면
if ($dmshop_payment['id']) {

    echo "<script type=\"text/javascript\">$(\"#pay_code_chk\").val(\"\");$(\"#pay_code_msg\").html(\"<font color='#ff0000'>".$pay_code." 결제코드는 이미 존재합니다.</font>\");</script>";
    exit;

}

// 동일 주문번호 체크
$chk = shop_order($pay_code);

// 겹치는게 있다
if ($chk['id']) {

    echo "<script type=\"text/javascript\">$(\"#pay_code_chk\").val(\"\");$(\"#pay_code_msg\").html(\"<font color='#ff0000'>".$pay_code." 결제코드는 주문번호에 사용됨으로 사용하실 수 없습니다.</font>\");</script>";
    exit;

}

echo "<script type=\"text/javascript\">$(\"#pay_code_chk\").val(\"1\");$(\"#pay_code_msg\").html(\"<font color='#0000ff'>중복된 코드가 없습니다. 다음단계로 진행하세요.</font>\");</script>";
exit;
?>