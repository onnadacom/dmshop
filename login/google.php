<?php // 구글
include_once("./_dmshop.php");
include_once("$shop[path]/lib/curl/Curl.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
if ($code) { $code = preg_match("/^[a-zA-Z0-9_\-\/\.]+$/", $code) ? $code : ""; }
if ($loginmode) { $loginmode = preg_match("/^[a-zA-Z0-9_\-]+$/", $loginmode) ? $loginmode : ""; }

if ($loginmode == 'document') {

    $message_mode = "b";

} else {

    $message_mode = "c";

}

$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");

if (!$dmshop['login_google_id']) {

    message("<p class='title'>알림</p><p class='text'>소셜 로그인이 미사용중입니다.</p>", $message_mode);

}

if ($check_login) {

    message("<p class='title'>알림</p><p class='text'>이미 로그인 중입니다.</p>", $message_mode);

}

if ($code) {

    $curl = new Curl();
    $curl->post('https://accounts.google.com/o/oauth2/token', array(
        'code' => $code,
        'client_id' => addslashes($dmshop['login_google_id']),
        'client_secret' => addslashes($dmshop['login_google_secret']),
        'redirect_uri' => implode('', array($shop['url']."/login/google.php")),
        'grant_type' => 'authorization_code',
    ));

    if ($curl->error) {

        echo $curl->response->error."<br />";
        echo $curl->response->error_description."<br />";
        exit;

    }

    shop_set_session("google_access_token", $curl->response->access_token);

    url("google.php");

}

else if (shop_get_session("google_access_token") && $m != 're') {

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/json');
    $curl->setHeader('Authorization', 'OAuth ' . shop_get_session("google_access_token"));
    $curl->get('https://www.googleapis.com/plus/v1/people/me');

    if ($curl->error) {

        message("<p class='title'>알림</p><p class='text'>오류코드 : ".text($curl->response->error->code)."<br />오류내용 : ".text($curl->response->error->message)."</p>", $message_mode);

    }

    $social_key = addslashes($curl->response->id);
    $nick = addslashes($curl->response->displayName);
    $email = addslashes($curl->response->emails[0]->value);
    //$homepage = addslashes($curl->response->tagline);
    $homepage = addslashes($curl->response->url);
    $photo = addslashes($curl->response->image->url);
    $gender = addslashes($curl->response->gender);
    $user_id = "dmg".(int)($dmshop['login_google_count'] + 1);

    if (!$social_key) {

        message("<p class='title'>알림</p><p class='text'>오류가 발생하였습니다. 다시 시도하여주시기 바랍니다.</p>", $message_mode);

    }

    if (!$nick) {

        $nick = $user_id;

    }

    $check_blocknick = false;
    $row = explode(",", $dmshop['block_keyword']);
    for ($i=0; $i<count($row); $i++) {

        if (trim($row[$i]) == $nick) {

            $check_blocknick = true;

        }

    }

    if ($check_blocknick) {

        $nick = $user_id;

    }

    $chk = sql_fetch(" select * from $shop[user_table] where social = 5 and social_key = '".$social_key."' limit 0, 1 ");

    if ($chk['user_id']) {

        if ($chk['user_leave_datetime'] != '0000-00-00 00:00:00') {

            message("<p class='title'>알림</p><p class='text'>탈퇴한 아이디입니다.</p>", $message_mode);

        }

        if ($chk['user_block_datetime'] != '0000-00-00 00:00:00') {

            message("<p class='title'>알림</p><p class='text'>정지된 아이디입니다.</p>", $message_mode);

        }

        $sql_common = "";
        $sql_common .= " set user_id = '".addslashes($chk['user_id'])."' ";
        $sql_common .= ", login_ip = '".trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])))."' ";
        $sql_common .= ", login_type = '1' ";
        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

        sql_query(" insert into $shop[user_login_table] $sql_common ");

        shop_set_session('ss_user_id', addslashes($chk['user_id']));

        if (shop_get_session('loginmode') == 'document') {

            $url = shop_get_session('redirect_uri');

            if ($url) {

                url(urldecode($url));

            } else {

                url($shop['url']."/");

            }

        } else {

            echo "<script type='text/javascript'>";
            echo "opener.loginOk();";
            echo "window.close();";
            echo "</script>";

        }

        exit;

    }

    $chk = sql_fetch(" select * from $shop[user_table] where user_id = '".$user_id."' limit 0, 1 ");

    if ($chk['user_id']) {

        $sql_common = "";
        $sql_common .= " set login_google_count = login_google_count + 1 ";

        sql_query(" update $shop[config_table] $sql_common ");

        message("<p class='title'>알림</p><p class='text'>장애가 발생하였습니다. 다시 시도하여주시기 바랍니다.</p>", $message_mode);

    }

    $chk = sql_fetch(" select * from $shop[user_table] where user_nick = '".$nick."' limit 0, 1 ");

    if ($chk['user_id']) {

        $nick = $nick.rand(10,99);

        $chk = sql_fetch(" select * from $shop[user_table] where user_nick = '".$nick."' limit 0, 1 ");

        if ($chk['user_id']) {

            message("<p class='title'>알림</p><p class='text'>장애가 발생하였습니다. 다시 시도하여주시기 바랍니다.</p>", $message_mode);

        }

    }

    $sql_common = "";
    $sql_common .= " set login_google_count = login_google_count + 1 ";

    sql_query(" update $shop[config_table] $sql_common ");

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", social_key = '".$social_key."' ";
    $sql_common .= ", social = '5' ";
    $sql_common .= ", user_name = '".$nick."' ";
    $sql_common .= ", user_nick = '".$nick."' ";
    $sql_common .= ", user_level = '".$dmshop_signup['user_level']."' ";
    $sql_common .= ", user_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";

    if ($dmshop_signup['user_email'] && $email) {

        $sql_common .= ", user_email = '".$email."' ";

    }

    if ($dmshop_signup['user_homepage'] && $homepage) {

        $sql_common .= ", user_homepage = '".$homepage."' ";

    }

    if ($dmshop_signup['user_sex'] && ($gender == 'male' || $gender == 'female')) {

        if ($gender == 'male') {

            $sql_common .= ", user_sex = 'M' ";

        }

        else if ($gender == 'female') {

            $sql_common .= ", user_sex = 'F' ";

        }

    }

    sql_query(" insert into $shop[user_table] $sql_common ");

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", login_ip = '".trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])))."' ";
    $sql_common .= ", login_type = '1' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    sql_query(" insert into $shop[user_login_table] $sql_common ");

    shop_set_session('ss_user_id', $user_id);

    // 적립금 사용
    if ($dmshop_signup['user_signup_cash']) {

        // 가입 적립금
        shop_cash_insert($user_id, (int)($dmshop_signup['user_cash'] * 1), " 가입축하 적립금 지급", $user_id, $user_id, "signup");

    }

    // 쿠폰 자동지급 (신규가입)
    shop_coupon_auto_make("1", $user_id, "");

    if (shop_get_session('loginmode') == 'document') {

        $url = shop_get_session('redirect_uri');

        if ($url) {

            url(urldecode($url));

        } else {

            url($shop['url']."/");

        }

    } else {

        echo "<script type='text/javascript'>";
        echo "opener.loginOk();";
        echo "window.close();";
        echo "</script>";

    }

    exit;

} else {

    unset($_SESSION['ss_user_id']);
    unset($_SESSION['loginmode']);
    unset($_SESSION['redirect_uri']);

    if ($url) {

        shop_set_session("loginmode", addslashes($loginmode));
        shop_set_session("redirect_uri", addslashes($url));

    }

    $curl = new Curl();
    $curl->get('https://accounts.google.com/o/oauth2/auth', array(
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'redirect_uri' => implode('', array($shop['url']."/login/google.php")),
        'response_type' => 'code',
        'client_id' => addslashes($dmshop['login_google_id']),
        'approval_prompt' => 'force'
    ));

    $url = $curl->responseHeaders['Location'];
    url($url);

}
?>