<?
if (!defined("_DMSHOP_")) exit;

// 회원가입 설정
function shop_signup()
{

    global $shop;

    return sql_fetch(" select * from $shop[signup_table] ");

}

// 회원
function shop_user($user_id)
{

    global $shop;

    return sql_fetch(" select * from $shop[user_table] where user_id = '".addslashes($user_id)."' ");

}

// 유저 레이어
function shop_userview($user_id, $user_name="", $user_email="", $user_homepage="", $view_text="")
{

    global $shop;

    $user_email = base64_encode($user_email);
    $user_homepage = shop_http($user_homepage);

    $user_name = preg_replace("/\&#039;/", "", $user_name);
    $user_name = preg_replace("/\'/", "", $user_name);
    $user_name = preg_replace("/\"/", "&#034;", $user_name);

    if ($user_id) {

        return "<a href=\"#\" onclick=\"showUserView(this, '$user_id', '$user_name', '$user_email', '$user_homepage'); return false;\">{$view_text}</a>";

    } else {

        return text($view_text);

    }

}

// 닉네임 검사
function shop_user_nick($user_nick)
{

    global $shop;

    return sql_fetch(" select * from $shop[user_table] where user_nick = '".addslashes($user_nick)."' ");

}

// 등급명
function shop_user_level($user_level)
{

    global $shop;

    if (!$user_level) {

        return "탈퇴한 회원";

    }

    $data = sql_fetch(" select * from $shop[user_level_table] where level = '".addslashes($user_level)."' ");

    if ($data['name']) {

        return text($data['name']);

    } else {

        return false;

    }

}

// 등급 파일
function shop_user_level_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[user_level_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// 아이디 출력
function shop_user_id($user_id, $user_leave_datetime)
{

    if (!$user_id) {

        return false;

    }

    if ($user_leave_datetime == '0000-00-00 00:00:00') {

        return $user_id;

    } else {

        return "<font style='text-decoration:line-through; color:#ff0000;'>{$user_id}</font>";

    }

}

// 회원 성별
function shop_user_sex($user_sex)
{

    if ($user_sex == 'M') {

        $data = "남성";

    }

    else if ($user_sex == 'F') {

        $data = "여성";

    } else {

        $data = "기타";

    }

    return $data;

}

// 회원탈퇴
function shop_user_leave($user_id)
{

    global $shop;

    if (!$user_id) {

        return false;

    }

    $user = shop_user($user_id);

    if (!$user['user_id']) {

        return false;

    }

    // 이미 탈퇴하였다면
    if ($user['user_leave_datetime'] != '0000-00-00 00:00:00') {

        return false;

    }

    // 부운영자는 탈퇴불가
    if ($user['user_level'] >= '9') {

        return false;

    }

    $sql_common = "";
    $sql_common .= " set user_level = '0' ";
    $sql_common .= ", user_pw = '' ";
    $sql_common .= ", user_pw_q = '' ";
    $sql_common .= ", user_pw_a = '' ";
    $sql_common .= ", user_jumin = '' "; // 지정기간 보존, 재가입 요청시 가입페이지에서 초기화 한다.
    //$sql_common .= ", user_name = '' ";
    $sql_common .= ", user_nick = '' ";
    $sql_common .= ", user_birth = '' ";
    $sql_common .= ", user_sex = '' ";
    $sql_common .= ", user_hp = '' ";
    $sql_common .= ", user_sms = '' ";
    $sql_common .= ", user_tel = '' ";
    $sql_common .= ", user_email = '' ";
    $sql_common .= ", user_mailing = '0' ";
    $sql_common .= ", user_homepage = '' ";
    $sql_common .= ", user_recommend = '' ";
    $sql_common .= ", user_profile = '' ";
    $sql_common .= ", user_zip1 = '' ";
    $sql_common .= ", user_zip2 = '' ";
    $sql_common .= ", user_addr1 = '' ";
    $sql_common .= ", user_addr2 = '' ";
    $sql_common .= ", user_company = '' ";
    $sql_common .= ", user_company_tel = '' ";
    $sql_common .= ", user_company_zip1 = '' ";
    $sql_common .= ", user_company_zip2 = '' ";
    $sql_common .= ", user_company_addr1 = '' ";
    $sql_common .= ", user_company_addr2 = '' ";
    $sql_common .= ", user_etc1 = '' ";
    $sql_common .= ", user_etc2 = '' ";
    $sql_common .= ", user_etc3 = '' ";
    $sql_common .= ", user_etc4 = '' ";
    $sql_common .= ", user_etc5 = '' ";
    $sql_common .= ", social_key = '' ";
    $sql_common .= ", user_leave_datetime = '".$shop['time_ymdhis']."' ";

    sql_query(" update $shop[user_table] $sql_common where user_id = '".$user_id."' ");

    return true;

}

// 로그인 타입
function shop_login_type($login_type)
{

    if ($login_type == '0') {

        $data = "실패";

    }

    else if ($login_type == '1') {

        $data = "성공";

    } else {

        $data = "기타";

    }

    return $data;

}

// 이용약관
function shop_service()
{

    global $shop;

    return sql_fetch(" select * from $shop[service_table] ");

}
?>