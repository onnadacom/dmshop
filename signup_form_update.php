<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($user_nick) { $user_nick = preg_match("/^[A-Za-z0-9_가-힣\x20\-]+$/", $user_nick) ? $user_nick : ""; }
if ($user_birth) { $user_birth = preg_match("/^[0-9]+$/", $user_birth) ? $user_birth : ""; }
if ($user_hp) { $user_hp = preg_match("/^[0-9\-]+$/", $user_hp) ? $user_hp : ""; }
if ($user_tel) { $user_tel = preg_match("/^[0-9\-]+$/", $user_tel) ? $user_tel : ""; }
if ($user_company_tel) { $user_company_tel = preg_match("/^[0-9\-]+$/", $user_company_tel) ? $user_company_tel : ""; }
if ($user_recommend) { $user_recommend = preg_match("/^[A-Za-z0-9_]+$/", $user_recommend) ? $user_recommend : ""; }
if ($user_sex) { $user_sex = preg_match("/^[A-Za-z]+$/", $user_sex) ? $user_sex : ""; }
if ($user_sms) { $user_sms = preg_match("/^[0-9]+$/", $user_sms) ? $user_sms : ""; }
if ($user_zip1) { $user_zip1 = preg_match("/^[0-9]+$/", $user_zip1) ? $user_zip1 : ""; }
if ($user_zip2) { $user_zip2 = preg_match("/^[0-9]+$/", $user_zip2) ? $user_zip2 : ""; }
if ($user_company_zip1) { $user_company_zip1 = preg_match("/^[0-9]+$/", $user_company_zip1) ? $user_company_zip1 : ""; }
if ($user_company_zip2) { $user_company_zip2 = preg_match("/^[0-9]+$/", $user_company_zip2) ? $user_company_zip2 : ""; }
if ($user_mailing) { $user_mailing = preg_match("/^[0-9]+$/", $user_mailing) ? $user_mailing : ""; }
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

$user_id = strtolower(trim(strip_tags(mysql_real_escape_string($user_id))));
$user_jumin = trim(strip_tags(mysql_real_escape_string($user_jumin)));
$user_name = trim(strip_tags(mysql_real_escape_string($user_name)));
$user_birth = trim(strip_tags(mysql_real_escape_string($user_birth)));
$user_sex = trim(strip_tags(mysql_real_escape_string($user_sex)));
$user_recommend = strtolower(trim(strip_tags(mysql_real_escape_string($user_recommend))));
$user_pw_q = trim(strip_tags(mysql_real_escape_string($user_pw_q)));
$user_pw_a = trim(strip_tags(mysql_real_escape_string($user_pw_a)));
$user_nick = trim(strip_tags(mysql_real_escape_string($user_nick)));
$user_hp = trim(strip_tags(mysql_real_escape_string($user_hp)));
$user_sms = trim(strip_tags(mysql_real_escape_string($user_sms)));
$user_tel = trim(strip_tags(mysql_real_escape_string($user_tel)));
$user_zip1 = trim(strip_tags(mysql_real_escape_string($user_zip1)));
$user_zip2 = trim(strip_tags(mysql_real_escape_string($user_zip2)));
$user_addr1 = trim(strip_tags(mysql_real_escape_string($user_addr1)));
$user_addr2 = trim(strip_tags(mysql_real_escape_string($user_addr2)));
$user_company = trim(strip_tags(mysql_real_escape_string($user_company)));
$user_company_tel = trim(strip_tags(mysql_real_escape_string($user_company_tel)));
$user_company_zip1 = trim(strip_tags(mysql_real_escape_string($user_company_zip1)));
$user_company_zip2 = trim(strip_tags(mysql_real_escape_string($user_company_zip2)));
$user_company_addr1 = trim(strip_tags(mysql_real_escape_string($user_company_addr1)));
$user_company_addr2 = trim(strip_tags(mysql_real_escape_string($user_company_addr2)));
$user_email = trim(strip_tags(mysql_real_escape_string($user_email)));
$user_mailing = trim(strip_tags(mysql_real_escape_string($user_mailing)));
$user_homepage = trim(strip_tags(mysql_real_escape_string($user_homepage)));
$user_profile = trim(mysql_real_escape_string($user_profile));
$user_etc1 = trim(strip_tags(mysql_real_escape_string($user_etc1)));
$user_etc2 = trim(strip_tags(mysql_real_escape_string($user_etc2)));
$user_etc3 = trim(strip_tags(mysql_real_escape_string($user_etc3)));
$user_etc4 = trim(strip_tags(mysql_real_escape_string($user_etc4)));
$user_etc5 = trim(strip_tags(mysql_real_escape_string($user_etc5)));

if ($m == 'u' && !$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 회원가입 설정
$dmshop_signup = shop_signup();

if ($m == '' && !$user_id) {

    message("<p class='title'>알림</p><p class='text'>회원 아이디가 입력되지 않았습니다.</p>", "b");

}

if ($m == '' && !$user_pw) {

    message("<p class='title'>알림</p><p class='text'>비밀번호가 입력되지 않았습니다.</p>", "b");

}

if (!$user_pw_q || !$user_pw_a) {

    message("<p class='title'>알림</p><p class='text'>비밀번호 재발급 질문 및 답변이 입력되지 않았습니다.</p>", "b");

}

if (!$user_name) {

    message("<p class='title'>알림</p><p class='text'>성명이 입력되지 않았습니다.</p>", "b");

}

if ($m == '' && $dmshop_signup['user_birth'] == '2' && !$user_birth) {

    message("<p class='title'>알림</p><p class='text'>생년월일이 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_nick'] == '2' && !$user_nick) {

    message("<p class='title'>알림</p><p class='text'>닉네임이 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_hp'] == '2' && !$user_hp || $dmshop_signup['user_hp'] == '3' && !$user_hp) {

    message("<p class='title'>알림</p><p class='text'>휴대폰 번호가 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_tel'] == '2' && !$user_tel) {

    message("<p class='title'>알림</p><p class='text'>일반 전화번호가 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_addr'] == '2' && (!$user_addr1 || !$user_addr2)) {

    message("<p class='title'>알림</p><p class='text'>기본 주소가 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_company'] == '2' && !$user_company) {

    message("<p class='title'>알림</p><p class='text'>직장명이 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_company_tel'] == '2' && !$user_company_tel) {

    message("<p class='title'>알림</p><p class='text'>직장 전화가 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_company_addr'] == '2' && (!$user_company_addr1 || !$user_company_addr2)) {

    message("<p class='title'>알림</p><p class='text'>직장 주소가 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_email'] == '2' && !$user_email) {

    message("<p class='title'>알림</p><p class='text'>이메일이 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_homepage'] == '2' && !$user_homepage) {

    message("<p class='title'>알림</p><p class='text'>홈페이지가 입력되지 않았습니다.</p>", "b");

}

if ($m == '' && $dmshop_signup['user_recommend'] == '2' && !$user_recommend) {

    message("<p class='title'>알림</p><p class='text'>추천인이 입력되지 않았습니다.</p>", "b");

}

if ($dmshop_signup['user_profile'] == '2' && !$user_profile) {

    message("<p class='title'>알림</p><p class='text'>자기소개가 입력되지 않았습니다.</p>", "b");

}

if ($m == '' && $dmshop_signup['user_robot']) {

/*
    // 지엠스팸프리 검사
    include_once("$shop[path]/zmSpamFree/zmSpamFree.php");

    if (!zsfCheck($_POST['robot_key'])) {

        message("<p class='title'>알림</p><p class='text'>자동등록방지 코드가 틀렸습니다.</p>", "b");

    }
*/

}

// 가입
if ($m == '') {

    // 회원
    $user = shop_user($user_id);

    if ($user['user_id']) {

        message("<p class='title'>알림</p><p class='text'>입력하신 아이디는 이미 존재합니다.</p>", "b");

    }

    // 닉네임 검사
    $nick = shop_user_nick($user_nick);

    if ($nick['user_nick']) {

        message("<p class='title'>알림</p><p class='text'>입력하신 닉네임은 이미 존재합니다.</p>", "b");

    }

}

// 수정
if ($m == 'u') {

    // 회원
    if ($shop_user_login) {

        // 폼 체크
        if (!$_POST['form_check']) {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

        if ($dmshop_user['datetime'] != $_POST['form_check']) {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

    // 닉네임 변경
    if ($dmshop_user['user_nick'] != $user_nick) {

        // 닉네임 검사
        $nick = shop_user_nick($user_nick);

        if ($nick['user_nick']) {

            message("<p class='title'>알림</p><p class='text'>입력하신 닉네임은 이미 존재합니다.</p>", "b");

        }

    }

}

$sql_common = "";
$sql_common .= " set user_pw_q = '".$user_pw_q."' ";
$sql_common .= ", user_pw_a = '".$user_pw_a."' ";
$sql_common .= ", user_nick = '".$user_nick."' ";
$sql_common .= ", user_hp = '".$user_hp."' ";
$sql_common .= ", user_sms = '".$user_sms."' ";
$sql_common .= ", user_tel = '".$user_tel."' ";
$sql_common .= ", user_zip1 = '".$user_zip1."' ";
$sql_common .= ", user_zip2 = '".$user_zip2."' ";
$sql_common .= ", user_addr1 = '".$user_addr1."' ";
$sql_common .= ", user_addr2 = '".$user_addr2."' ";
$sql_common .= ", user_company = '".$user_company."' ";
$sql_common .= ", user_company_tel = '".$user_company_tel."' ";
$sql_common .= ", user_company_zip1 = '".$user_company_zip1."' ";
$sql_common .= ", user_company_zip2 = '".$user_company_zip2."' ";
$sql_common .= ", user_company_addr1 = '".$user_company_addr1."' ";
$sql_common .= ", user_company_addr2 = '".$user_company_addr2."' ";
$sql_common .= ", user_email = '".$user_email."' ";
$sql_common .= ", user_mailing = '".$user_mailing."' ";
$sql_common .= ", user_homepage = '".$user_homepage."' ";
$sql_common .= ", user_profile = '".$user_profile."' ";
$sql_common .= ", user_etc1 = '".$user_etc1."' ";
$sql_common .= ", user_etc2 = '".$user_etc2."' ";
$sql_common .= ", user_etc3 = '".$user_etc3."' ";
$sql_common .= ", user_etc4 = '".$user_etc4."' ";
$sql_common .= ", user_etc5 = '".$user_etc5."' ";
$sql_common .= ", user_name = '".$user_name."' ";

if ($m == '') {

    $sql_common .= ", user_id = '".$user_id."' ";
    $sql_common .= ", user_jumin = '".$user_jumin."' ";
    $sql_common .= ", user_birth = '".$user_birth."' ";
    $sql_common .= ", user_sex = '".$user_sex."' ";
    $sql_common .= ", user_recommend = '".$user_recommend."' ";
    $sql_common .= ", user_level = '".$dmshop_signup['user_level']."' ";
    $sql_common .= ", user_login = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login_ip = '".$ip."' ";
    $sql_common .= ", user_ip = '".$ip."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

}

if ($user_pw) {

    $sql_common .= ", user_pw = '".sql_password($user_pw)."' ";

}

// 등록
if ($m == '') {

    // insert
    sql_query(" insert into $shop[user_table] $sql_common ");

    // 추천인 사용
    if ($dmshop_signup['user_recommend'] && $user_recommend) {

        // 추천인 적립금 지급
        shop_cash_insert($user_recommend, (int)($dmshop_signup['user_recommend_cash'] * 1), $user_id." 추천인 적립금 지급", $user_id, $user_id, "recommend");

        // 입력자 적립금 지급
        shop_cash_insert($user_id, (int)($dmshop_signup['user_recommend_insert_cash'] * 1), $user_recommend." 추천인 적립금 지급", $user_id, $user_id, "recommend");

    }

    // 적립금 사용
    if ($dmshop_signup['user_signup_cash']) {

        // 가입 적립금
        shop_cash_insert($user_id, (int)($dmshop_signup['user_cash'] * 1), " 가입축하 적립금 지급", $user_id, $user_id, "signup");

    }

    // 세션
    $ss_name = "signup_".$user_id;

    if (!shop_get_session($ss_name)) {

        shop_set_session($ss_name, true);

    }

    // 회원 세션 생성
    shop_set_session('ss_user_id', $user_id);

    // sms
    $shop_sms_config = shop_sms_config("signup");

    // 사용
    if ($shop_sms_config['sms_use']) {

        $sms_to = $user_hp;
        $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

        $sms_message = $shop_sms_config['sms_message'];
        $sms_message = str_replace("[성명]", $user_name, $sms_message);
        $sms_message = str_replace("[아이디]", $user_id, $sms_message);
        $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
        $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

        // 전송
        shop_sms_send("signup", $user_id, $sms_to, $sms_from, $sms_message);

    }

    // sms
    $shop_sms_config = shop_sms_config("adm_signup");

    // 사용
    if ($shop_sms_config['sms_use']) {

        $sms_to = $dmshop['rec_sms1'].$dmshop['rec_sms2'].$dmshop['rec_sms3'];
        $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

        $sms_message = $shop_sms_config['sms_message'];
        $sms_message = str_replace("[성명]", $user_name, $sms_message);
        $sms_message = str_replace("[아이디]", $user_id, $sms_message);
        $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
        $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

        // 전송
        shop_sms_send("adm_signup", $user_id, $sms_to, $sms_from, $sms_message);

    }

    // 쿠폰 자동지급 (신규가입)
    shop_coupon_auto_make("1", $user_id, "");

    $url = $shop['path']."/signup_result.php";

    shop_url($url);

}

// 수정
else if ($m == 'u') {

    sql_query(" update $shop[user_table] $sql_common where user_id = '".$dmshop_user['user_id']."' ");

    message("<p class='title'>알림</p><p class='text'>회원정보수정을 완료하였습니다.</p>", "", $shop['url']);

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}
?>