<?
include_once("./_dmshop.php");

if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($user_jumin1) { $user_jumin1 = preg_match("/^[0-9]+$/", $user_jumin1) ? $user_jumin1 : ""; }
if ($user_jumin2) { $user_jumin2 = preg_match("/^[0-9]+$/", $user_jumin2) ? $user_jumin2 : ""; }
if ($user_email) { $user_email = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $user_email) ? $user_email : ""; }
if ($user_hp1) { $user_hp1 = preg_match("/^[0-9]+$/", $user_hp1) ? $user_hp1 : ""; }
if ($user_hp2) { $user_hp2 = preg_match("/^[0-9]+$/", $user_hp2) ? $user_hp2 : ""; }
if ($user_hp3) { $user_hp3 = preg_match("/^[0-9]+$/", $user_hp3) ? $user_hp3 : ""; }

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
$shop['title'] = $dmshop['shop_name']." - 사용자 정보입력";

// 페이지 아이디
$page_id = "signup_form";

// 가입
if ($m == '') {

    if ($shop_user_login) {

        shop_url($shop['path']);

    }

    if (!$_POST['check1'] || !$_POST['check2']) {

        message("<p class='title'>알림</p><p class='text'>이용약관 및 개인정보 취급방침에 동의하지 않았습니다.</p>", "b");

    }

    // 주민번호 사용
    if ($dmshop_signup['user_real_check'] == '1' || $dmshop_signup['user_real_check'] == '4') {

        // 이름, 주민번호
        if ($user_name && $user_jumin1 && $user_jumin2) {

            // 주민 암호화
            $user_jumin = sql_password($user_jumin1.$user_jumin2);

            // 동일 주민 체크
            $row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_jumin = '".$user_jumin."' ");

            // 존재
            if ($row['cnt']) {

                message("<p class='title'>알림</p><p class='text'>이미 동일한 주민등록번호로 가입되어 있습니다.</p>", "b");

            }

            // 주민번호 7번째 자리의 규칙 ########################
            // 1800년대: 남자 9, 여자 0
            // 1900년대: 남자 1, 여자 2
            // 2000년대: 남자 3, 여자 4
            // 2100년대: 남자 5, 여자 6
            // 외국인 등록번호: 남자 7, 여자 8

            // 주민등록번호 두번째의 한자리 숫자
            $y = substr($user_jumin2, 0, 1);

            // 성별은 F, M 으로 나눈다.
            // 주민등록번호의 7번째 자리가 홀수이면 남자(Male), 짝수이면 여자(Female)
            $user_sex = $y % 2 == 0 ? "F" : "M";

            if ($y == '9' || $y == '0') {

                $user_birth = "18" . $user_jumin1;

            }

            else if ($y == '1' || $y == '2') {

                $user_birth = "19" . $user_jumin1;

            }

            else if ($y == '3' || $y == '4') {

                $user_birth = "20" . $user_jumin1;

            }

            else if ($y == '5' || $y == '6') {

                $user_birth = "21" . $user_jumin1;

            } else {

                $user_birth = "xx" . $user_jumin1;

            }

            // 생년월일
            $user_birth1 = substr($user_birth,0,4);
            $user_birth2 = substr($user_birth,4,2);
            $user_birth3 = substr($user_birth,6,2);

        } else {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

    // 이메일
    else if ($dmshop_signup['user_real_check'] == '2') {

        // 이름, 이메일
        if ($user_name && $user_email) {

            // 동일 이메일 체크
            $row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_email = '".$user_email."' ");

            // 존재
            if ($row['cnt']) {

                message("<p class='title'>알림</p><p class='text'>이미 동일한 이메일로 가입되어 있습니다.</p>", "b");

            }

            // 이메일
            $user_email = $user_email;
            $user_email1 = shop_split("@", $user_email, "0");
            $user_email2 = shop_split("@", $user_email, "1");

        } else {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

    // 휴대폰
    else if ($dmshop_signup['user_real_check'] == '3') {

        // 이름, 휴대폰
        if ($user_name && $user_hp1 && $user_hp2 && $user_hp3) {

            // 동일 휴대폰 체크
            $row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_hp = '".$user_hp1."-".$user_hp2."-".$user_hp3."' ");

            // 존재
            if ($row['cnt']) {

                message("<p class='title'>알림</p><p class='text'>이미 동일한 휴대폰 번호로 가입되어 있습니다.</p>", "b");

            }

            // 휴대폰
            $user_hp = $user_hp1."-".$user_hp2."-".$user_hp3;
            $user_hp1 = $user_hp1;
            $user_hp2 = $user_hp2;
            $user_hp3 = $user_hp3;

        } else {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    } else {

        // 미인증

    }

}

// 수정
else if ($m == 'u') {

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

    // 휴대폰
    if ($dmshop_user['user_hp']) {

        $user_hp = $dmshop_user['user_hp'];
        $user_hp1 = shop_split("-", $dmshop_user['user_hp'], "0");
        $user_hp2 = shop_split("-", $dmshop_user['user_hp'], "1");
        $user_hp3 = shop_split("-", $dmshop_user['user_hp'], "2");

    }

    // 일반전화
    if ($dmshop_user['user_tel']) {

        $user_tel = $dmshop_user['user_tel'];
        $user_tel1 = shop_split("-", $dmshop_user['user_tel'], "0");
        $user_tel2 = shop_split("-", $dmshop_user['user_tel'], "1");
        $user_tel3 = shop_split("-", $dmshop_user['user_tel'], "2");

    }

    // 직장전화
    if ($dmshop_user['user_company_tel']) {

        $user_company_tel = $dmshop_user['user_company_tel'];
        $user_company_tel1 = shop_split("-", $dmshop_user['user_company_tel'], "0");
        $user_company_tel2 = shop_split("-", $dmshop_user['user_company_tel'], "1");
        $user_company_tel3 = shop_split("-", $dmshop_user['user_company_tel'], "2");

    }

    // 이메일
    if ($dmshop_user['user_email']) {

        $user_email = $dmshop_user['user_email'];
        $user_email1 = shop_split("@", $dmshop_user['user_email'], "0");
        $user_email2 = shop_split("@", $dmshop_user['user_email'], "1");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

include_once("./_top.php");
include_once("$dmshop_signup_path/signup_form.php");
include_once("./_bottom.php");
?>