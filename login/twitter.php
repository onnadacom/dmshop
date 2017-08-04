<?php // 트위터
include_once("./_dmshop.php");
include_once("$shop[path]/lib/curl/Curl.php");
include_once("$shop[path]/lib/Epi/EpiCurl.php");
include_once("$shop[path]/lib/Epi/EpiOAuth.php");
include_once("$shop[path]/lib/Epi/EpiTwitter.php");
if ($oauth_token) { $oauth_token = preg_match("/^[a-zA-Z0-9_\-\/\.\:]+$/", $oauth_token) ? $oauth_token : ""; }
if ($loginmode) { $loginmode = preg_match("/^[a-zA-Z0-9_\-]+$/", $loginmode) ? $loginmode : ""; }

if ($loginmode == 'document') {

    $message_mode = "b";

} else {

    $message_mode = "c";

}

$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");

if (!$dmshop['login_twitter_key']) {

    message("<p class='title'>알림</p><p class='text'>소셜 로그인이 미사용중입니다.</p>", $message_mode);

}

if ($check_login) {

    message("<p class='title'>알림</p><p class='text'>이미 로그인 중입니다.</p>", $message_mode);

}

$consumer_key = $dmshop['login_twitter_key'];
$consumer_secret = $dmshop['login_twitter_secret'];

if (!$consumer_key || !$consumer_secret) {

    exit;

}

if ($oauth_token) {

    if (shop_get_session("twitter_oauth_token") && shop_get_session("twitter_oauth_token") != $oauth_token) {

        unset($_SESSION['twitter_oauth_token']);
        unset($_SESSION['twitter_access_token']);
        unset($_SESSION['twitter_access_secret']);

        url("twitter.php");

    }

    $twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
    $twitterObj->setToken($oauth_token);
    $token = $twitterObj->getAccessToken();
    $twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

    shop_set_session("twitter_oauth_token", $oauth_token);
    shop_set_session("twitter_access_token", $token->oauth_token);
    shop_set_session("twitter_access_secret", $token->oauth_token_secret);

    $twitterInfo= $twitterObj->get_accountVerify_credentials();
    $twitterInfo->response;

    // update
    url("twitter.php");

}

else if (shop_get_session("twitter_oauth_token")) {

    $twitterObj = new EpiTwitter($consumer_key, $consumer_secret, shop_get_session("twitter_access_token"), shop_get_session("twitter_access_secret"));

    $twitterInfo= $twitterObj->get_accountVerify_credentials();
    $twitterInfo->response;

    $social_key = addslashes($twitterInfo->id_str);
    $nick = addslashes($twitterInfo->screen_name);
    $profile = addslashes($twitterInfo->description);
    //$homepage = addslashes($twitterInfo->url);
    $homepage = addslashes("https://twitter.com/".$twitterInfo->screen_name);
    $photo = addslashes($twitterInfo->profile_image_url);
    $user_id = "dmt".(int)($dmshop['login_twitter_count'] + 1);

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

    $chk = sql_fetch(" select * from $shop[user_table] where social = 4 and social_key = '".$social_key."' limit 0, 1 ");

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
        $sql_common .= " set login_twitter_count = login_twitter_count + 1 ";

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
    $sql_common .= " set login_twitter_count = login_twitter_count + 1 ";

    sql_query(" update $shop[config_table] $sql_common ");

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", social_key = '".$social_key."' ";
    $sql_common .= ", social = '4' ";
    $sql_common .= ", user_name = '".$nick."' ";
    $sql_common .= ", user_nick = '".$nick."' ";
    $sql_common .= ", user_level = '".$dmshop_signup['user_level']."' ";
    $sql_common .= ", user_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login = '".$shop['time_ymdhis']."' ";
    $sql_common .= ", user_login_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";

    if ($dmshop_signup['user_profile'] && $profile) {

        $sql_common .= ", user_profile = '".$profile."' ";

    }

    if ($dmshop_signup['user_homepage'] && $homepage) {

        $sql_common .= ", user_homepage = '".$homepage."' ";

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

    $twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
    $url = $twitterObj->getAuthorizationUrl();

    url($url);

}
?>