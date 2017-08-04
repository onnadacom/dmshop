<?php
include_once("./_dmshop.php");

if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 폼 체크
if (!$_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 소셜이 아닐 때
if (!$dmshop_user['social']) {

    if (!$_POST['tmp_user_pw']) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 비밀번호 체크
    $row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_id = '".$dmshop_user['user_id']."' and user_pw = '".sql_password($_POST['tmp_user_pw'])."' ");

    // 없다면
    if (!$row['cnt']) {

        message("<p class='title'>알림</p><p class='text'>페이지가 만료되었습니다. 처음부터 다시 이용하시기 바랍니다.</p>", "b");

    }

}

$sql_common = "";
$sql_common .= " set user_leave = '".trim(strip_tags(mysql_real_escape_string($_POST['user_leave'])))."' ";
$sql_common .= ", user_leave_memo = '".trim(mysql_real_escape_string($_POST['user_leave_memo']))."' ";

sql_query(" update $shop[user_table] $sql_common where user_id = '".$dmshop_user['user_id']."' ");

shop_user_leave($dmshop_user['user_id']);

// shop.common.php 에서 탈퇴한 회원은 세션해제를 처리하기 때문에 메세지만 띄운다.
message("<p class='title'>알림</p><p class='text'>회원탈퇴가 정상적으로 완료 되었습니다. 그동안 “{$dmshop['shop_name']}”을 이용해 주셔서 감사합니다.</p>", "", $shop['path']);
?>