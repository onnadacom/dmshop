<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 회원가입 설정
$dmshop_signup = shop_signup();

if (!$_POST['user_id']) {

    alert("회원 아이디가 입력되지 않았습니다.");

}

if ($m == '' && !$_POST['user_pw']) {

    alert("비밀번호가 입력되지 않았습니다.");

}

if (!$_POST['user_pw_q'] || !$_POST['user_pw_a']) {

    alert("비밀번호 재발급 질문 및 답변이 입력되지 않았습니다.");

}

if (!$_POST['user_name']) {

    alert("성명이 입력되지 않았습니다.");

}

if (!$_POST['user_nick']) {

    alert("닉네임이 입력되지 않았습니다.");

}

// 가입
if ($m == '') {

    // 회원
    $user = shop_user($_POST['user_id']);

    if ($user['user_id']) {

        alert("입력하신 아이디는 이미 존재합니다.");

    }

    // 닉네임 검사
    $nick = shop_user_nick($_POST['user_nick']);

    if ($nick['user_nick']) {

        alert("입력하신 닉네임은 이미 존재합니다.");

    }

}

// 수정
if ($m == 'u') {

    // 회원
    $user = shop_user($_POST['user_id']);

    if (!$user['user_id']) {

        alert("존재하지 않는 회원 아이디 입니다.");

    }

    // 닉네임 변경
    if ($user['user_nick'] != $_POST['user_nick']) {

        // 닉네임 검사
        $nick = shop_user_nick($_POST['user_nick']);

        if ($nick['user_nick']) {

            alert("입력하신 닉네임은 이미 존재합니다.");

        }

    }

}

$sql_common = "";
$sql_common .= " set user_name = '".addslashes($_POST['user_name'])."' ";
$sql_common .= ", user_birth = '".addslashes($_POST['user_birth'])."' ";
$sql_common .= ", user_sex = '".addslashes($_POST['user_sex'])."' ";
$sql_common .= ", user_recommend = '".addslashes($_POST['user_recommend'])."' ";
$sql_common .= ", user_pw_q = '".addslashes($_POST['user_pw_q'])."' ";
$sql_common .= ", user_pw_a = '".addslashes($_POST['user_pw_a'])."' ";
$sql_common .= ", user_nick = '".addslashes($_POST['user_nick'])."' ";
$sql_common .= ", user_hp = '".addslashes($_POST['user_hp'])."' ";
$sql_common .= ", user_sms = '".addslashes($_POST['user_sms'])."' ";
$sql_common .= ", user_tel = '".addslashes($_POST['user_tel'])."' ";
$sql_common .= ", user_zip1 = '".addslashes($_POST['user_zip1'])."' ";
$sql_common .= ", user_zip2 = '".addslashes($_POST['user_zip2'])."' ";
$sql_common .= ", user_addr1 = '".addslashes($_POST['user_addr1'])."' ";
$sql_common .= ", user_addr2 = '".addslashes($_POST['user_addr2'])."' ";
$sql_common .= ", user_company = '".addslashes($_POST['user_company'])."' ";
$sql_common .= ", user_company_tel = '".addslashes($_POST['user_company_tel'])."' ";
$sql_common .= ", user_company_zip1 = '".addslashes($_POST['user_company_zip1'])."' ";
$sql_common .= ", user_company_zip2 = '".addslashes($_POST['user_company_zip2'])."' ";
$sql_common .= ", user_company_addr1 = '".addslashes($_POST['user_company_addr1'])."' ";
$sql_common .= ", user_company_addr2 = '".addslashes($_POST['user_company_addr2'])."' ";
$sql_common .= ", user_email = '".addslashes($_POST['user_email'])."' ";
$sql_common .= ", user_mailing = '".addslashes($_POST['user_mailing'])."' ";
$sql_common .= ", user_homepage = '".addslashes($_POST['user_homepage'])."' ";
$sql_common .= ", user_profile = '".addslashes($_POST['user_profile'])."' ";
$sql_common .= ", user_etc1 = '".addslashes($_POST['user_etc1'])."' ";
$sql_common .= ", user_etc2 = '".addslashes($_POST['user_etc2'])."' ";
$sql_common .= ", user_etc3 = '".addslashes($_POST['user_etc3'])."' ";
$sql_common .= ", user_etc4 = '".addslashes($_POST['user_etc4'])."' ";
$sql_common .= ", user_etc5 = '".addslashes($_POST['user_etc5'])."' ";

if ($m == '') {

    $sql_common .= ", user_id = '".addslashes($_POST['user_id'])."' ";
    $sql_common .= ", user_jumin = '".addslashes($_POST['user_jumin'])."' ";
    $sql_common .= ", user_level = '".addslashes($dmshop_signup['user_level'])."' ";
    $sql_common .= ", user_login = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";
    $sql_common .= ", user_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

}

if ($_POST['user_pw']) {

    $sql_common .= ", user_pw = '".sql_password($_POST['user_pw'])."' ";

}

// 등록
if ($m == '') {

    // insert
    sql_query(" insert into $shop[user_table] $sql_common ");

    $url = "user_list.php";
    shop_url($url);

}

// 수정
else if ($m == 'u') {

    // 회원 업데이트
    sql_query(" update $shop[user_table] $sql_common where user_id = '".addslashes($_POST['user_id'])."' ");

    // 적립금 이름 업데이트
    sql_query(" update $shop[cash_table] set user_name = '".addslashes($_POST['user_name'])."' where user_id = '".addslashes($_POST['user_id'])."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>