<?php
include_once("./_dmshop.php");

if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 소셜이 아닐 때
if (!$dmshop_user['social']) {

    if (!$_POST['user_pw']) {

        message("<p class='title'>알림</p><p class='text'>비밀번호를 입력하세요.</p>", "b");

    }

    // 비밀번호 체크
    $row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_id = '".$dmshop_user['user_id']."' and user_pw = '".sql_password($_POST['user_pw'])."' ");

    // 없다면
    if (!$row['cnt']) {

        message("<p class='title'>알림</p><p class='text'>비밀번호가 일치하지 않습니다.</p>", "b");

    }

}

// 스킨이 없다.
if (!$dmshop_skin['skin_mypage']) {

    message("<p class='title'>알림</p><p class='text'>마이페이지 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_signup']) {

    message("<p class='title'>알림</p><p class='text'>회원가입 스킨이 설정되지 않았습니다.</p>", "b");

}

// 회원가입
$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 회원가입 스킨 경로
$dmshop_signup_path = "";
$dmshop_signup_path = $shop['path']."/skin/signup/".$dmshop_skin['skin_signup'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 회원 탈퇴";

// 페이지 아이디
$page_id = "signup_leave";

// 패스워드 임시 저장
$tmp_user_pw = $_POST['user_pw'];

include_once("./_top.php");
include_once("$dmshop_signup_path/signup_leave.php");
include_once("./_bottom.php");
?>