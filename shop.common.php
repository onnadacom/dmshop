<?php
error_reporting(E_ALL ^ E_NOTICE); header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"'); if (!isset($set_time_limit)) { $set_time_limit = 0; } @set_time_limit($set_time_limit);
if (isset($HTTP_POST_VARS) && !isset($_POST)) { $_POST = &$HTTP_POST_VARS; $_GET = &$HTTP_GET_VARS; $_SERVER = &$HTTP_SERVER_VARS; $_COOKIE = &$HTTP_COOKIE_VARS; $_ENV = &$HTTP_ENV_VARS; $_FILES = &$HTTP_POST_FILES; if (!isset($_SESSION)) { $_SESSION = &$HTTP_SESSION_VARS; } }
if (!get_magic_quotes_gpc()) {
if (is_array($_GET)) { while (list($k, $v) = each($_GET)) { if (is_array($_GET[$k])) { while (list($k2, $v2) = each($_GET[$k])) { if (is_array($_GET[$k][$k2])){ while (list($k3, $v3) = each($_GET[$k][$k2])) { $_GET[$k][$k2][$k3] = addslashes($v3); } } else { $_GET[$k][$k2] = addslashes($v2); } } @reset($_GET[$k]); } else { $_GET[$k] = addslashes($v); } } @reset($_GET); }
if (is_array($_POST)) { while (list($k, $v) = each($_POST)) { if (is_array($_POST[$k])) { while (list($k2, $v2) = each($_POST[$k])) { if (is_array($_POST[$k][$k2])){ while (list($k3, $v3) = each($_POST[$k][$k2])) { $_POST[$k][$k2][$k3] = addslashes($v3); } } else { $_POST[$k][$k2] = addslashes($v2); } } @reset($_POST[$k]); } else { $_POST[$k] = addslashes($v); } } @reset($_POST); }
if (is_array($_COOKIE)) { while (list($k, $v) = each($_COOKIE)) { if (is_array($_COOKIE[$k])) { while (list($k2, $v2) = each($_COOKIE[$k])) { $_COOKIE[$k][$k2] = addslashes($v2); } @reset($_COOKIE[$k]); } else { $_COOKIE[$k] = addslashes($v); } } @reset($_COOKIE); }
if (is_array($_SERVER)) { while (list($k, $v) = each($_SERVER)) { if (is_array($_SERVER[$k])) { while (list($k2, $v2) = each($_SERVER[$k])) { $_SERVER[$k][$k2] = addslashes($v2); } @reset($_SERVER[$k]); } else { $_SERVER[$k] = addslashes($v); } } @reset($_SERVER); }
if (is_array($_SESSION)) { while (list($k, $v) = each($_SESSION)) { if (is_array($_SESSION[$k])) { while (list($k2, $v2) = each($_SESSION[$k])) { $_SESSION[$k][$k2] = addslashes($v2); } @reset($_SESSION[$k]); } else { $_SESSION[$k] = addslashes($v); } } @reset($_SESSION); }
}

// 파라미터 체크
function parameter_check($data) 
{

    if (empty($data)) { return $data; }
    if (is_array($data)) { foreach($data as $key => $value) { $data[$key] = parameter_check($value); } return $data; }

    $data = str_replace("\x", "", $data);
    $data = str_replace("?..", "", $data);
    $data = str_replace("=..", "", $data);
    $data = str_replace("&..", "", $data);
    $data = str_replace("=//", "", $data);
    $data = str_replace("../bin", "", $data);
    $data = str_replace("../boot", "", $data);
    $data = str_replace("../dev", "", $data);
    $data = str_replace("../etc", "", $data);
    $data = str_replace("../home", "", $data);
    $data = str_replace("../home2", "", $data);
    $data = str_replace("../lib", "", $data);
    $data = str_replace("../misc", "", $data);
    $data = str_replace("../mnt", "", $data);
    $data = str_replace("../net", "", $data);
    $data = str_replace("../opt", "", $data);
    $data = str_replace("../proc", "", $data);
    $data = str_replace("../root", "", $data);
    $data = str_replace("../sbin", "", $data);
    $data = str_replace("../selinux", "", $data);
    $data = str_replace("../srv", "", $data);
    $data = str_replace("../sys", "", $data);
    $data = str_replace("../usr", "", $data);
    $data = str_replace("../var", "", $data);

    return $data;

}

$_GET = parameter_check($_GET);
$_POST = parameter_check($_POST);

$ext_arr = array('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST', 'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS'); $ext_cnt = count($ext_arr); for ($i=0; $i<$ext_cnt; $i++) { if (isset($_GET[$ext_arr[$i]])) { unset($_GET[$ext_arr[$i]]); } }

@extract($_GET);
@extract($_POST);
@extract($_SERVER); 

if ($m) { $m = preg_match("/^[가-힣a-zA-Z0-9_\-%\.\/ ]+$/", $m) ? $m : ""; }
if ($page_id) { $page_id = @preg_match("/^[a-zA-Z0-9_\-]+$/", $page_id) ? $page_id : ""; }
if ($ct_id) { $ct_id = @preg_match("/^[a-zA-Z0-9_\-]+$/", $ct_id) ? $ct_id : ""; }
if ($page) { $page = preg_match("/^[0-9]+$/", $page) ? $page : ""; }
if ($id) { $id = preg_match("/^[a-zA-Z0-9_\-,]+$/", $id) ? $id : ""; }
if ($sort) { $sort = preg_match("/^[a-zA-Z0-9_ ]+$/", $sort) ? $sort : ""; }
if ($rows) { $rows = preg_match("/^[0-9]+$/", $rows) ? $rows : ""; }
if ($liststyle) { $liststyle = preg_match("/^[a-zA-Z0-9_\-]+$/", $liststyle) ? $liststyle : ""; }
if ($m) { $m = preg_match("/^[a-zA-Z0-9_]+$/", $m) ? $m : ""; }
if ($f) { $f = preg_match("/^[a-zA-Z0-9_\-]+$/", $f) ? $f : ""; }
if ($q) { $q = preg_match("/^[가-힣a-zA-Z0-9_\-%\.\/ ]+$/", $q) ? $q : ""; }
if ($bbs_id) { $bbs_id = @preg_match("/^[a-zA-Z0-9_\-]+$/", $bbs_id) ? $bbs_id : ""; }
if ($article_id) { $article_id = @preg_match("/^[0-9]+$/", $article_id) ? $article_id : ""; }
if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }
if ($bbs_category) { $bbs_category = preg_match("/^[가-힣a-zA-Z0-9_\-%\.,\/\& ]+$/", $bbs_category) ? $bbs_category : ""; }

$shop = array();
$dmshop = array();
$dmshop_user = array();
$dmshop_item = array();

if ($_GET['shop_path'] || $_POST['shop_path'] || $_COOKIE['shop_path']) { unset($_GET['shop_path']); unset($_POST['shop_path']); unset($_COOKIE['shop_path']); unset($shop_path); } if (!$shop_path || preg_match("/:\/\//", $shop_path)) { die("shop_path error"); } $shop['path'] = $shop_path; unset($shop_path);

include_once("{$shop['path']}/shop.config.php");
include_once("{$shop['path']}/shop.common.php");
include_once("{$shop['path']}/lib/system.lib.php");
include_once("{$shop['path']}/lib/shop.lib.php");
include_once("{$shop['path']}/lib/pay.lib.php");
include_once("{$shop['path']}/lib/payment.lib.php");
include_once("{$shop['path']}/lib/cash.lib.php");
include_once("{$shop['path']}/lib/coupon.lib.php");
include_once("{$shop['path']}/lib/board.lib.php");
include_once("{$shop['path']}/lib/page.lib.php");
include_once("{$shop['path']}/lib/user.lib.php");
include_once("{$shop['path']}/lib/design.lib.php");
include_once("{$shop['path']}/lib/paging.lib.php");
include_once("{$shop['path']}/lib/banner.lib.php");
include_once("{$shop['path']}/lib/popup.lib.php");
include_once("{$shop['path']}/lib/visit.lib.php");
include_once("{$shop['path']}/lib/login.lib.php");
include_once("{$shop['path']}/lib/search.lib.php");
include_once("{$shop['path']}/lib/scrollbox.lib.php");
include_once("{$shop['path']}/lib/count.lib.php");
include_once("{$shop['path']}/lib/syndi.lib.php");

// shop.config.php
if (!$shop['url']) { $shop['url'] = 'http://' . $_SERVER['HTTP_HOST']; $dir = dirname($HTTP_SERVER_VARS["PHP_SELF"]); if (!file_exists("shop.config.php")) { $dir = dirname($dir); } $cnt = substr_count($shop['path'], ".."); for ($i=2; $i<=$cnt; $i++) { $dir = dirname($dir); } $shop['url'] .= $dir; } $shop['url'] = strtr($shop['url'], "\\", "/"); $shop['url'] = preg_replace("/\/$/", "", $shop['url']);

// database
$database_file = "shop.database.php";

if (file_exists("$shop[path]/$database_file")) {
//if (is_dir("$shop[path]/install")) die("<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>install 디렉토리를 삭제하세요.");
include_once("$shop[path]/$database_file");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
if (!$select_db) { die("<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>데이터베이스 접속이 원활하지 않습니다."); }
} else { shop_url("install/"); }
unset($mysql_);

ini_set("session.use_trans_sid", 0);
ini_set("url_rewriter.tags","");

include_once("$shop[path]/lib/session.lib.php");
session_set_save_handler("shop_session_open", "shop_session_close", "shop_session_read", "shop_session_write", "shop_session_destroy", "shop_session_clean"); 
if (isset($SESSION_CACHE_LIMITER)) { @session_cache_limiter($SESSION_CACHE_LIMITER); } else { @session_cache_limiter("no-cache, must-revalidate"); }

// dmshop
$dmshop = sql_fetch(" select * from $shop[config_table] ");

ini_set("session.cache_expire", 180);
ini_set("session.gc_maxlifetime", 10800);
ini_set("session.gc_probability", 1);
ini_set("session.gc_divisor", 100);

session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", $dmshop['cookie_domain']);
@session_start();
if ($_REQUEST['PHPSESSID'] && $_REQUEST['PHPSESSID'] != session_id()) { shop_url("{$shop['path']}/signout.php"); }

if ($url) { $url = preg_replace("/\"/i", "", $url); $url = preg_replace("/'/i", "", $url); }

if (isset($url)) {

    $urlencode = urlencode($url);

} else {

    $urlencode = urlencode('http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

}

if ($_SESSION['ss_user_id']) {

    $dmshop_user = shop_user($_SESSION['ss_user_id']);

    if (!$dmshop_user['user_id']) {

        session_unset();
        session_destroy();

        shop_url($shop['url']);

    }

    // 탈퇴, 차단시각이 있다면
    if ($dmshop_user['user_leave_datetime'] != '0000-00-00 00:00:00' || $dmshop_user['user_block_datetime'] != '0000-00-00 00:00:00') {

        session_unset();
        session_destroy();

        shop_url($shop['url']);

    }

    if (substr($dmshop_user['user_login'],0,10) != $shop['time_ymd']) {

        sql_query(" update $shop[user_table] set user_login = '".$shop['time_ymdhis']."', user_login_ip = '".$_SERVER['REMOTE_ADDR']."' where user_id = '".$dmshop_user['user_id']."' ");

    }

}

// 초기화
$shop_user_login = false;
$shop_user_admin = false;
$shop_user_guest = false;

// 회원
if ($dmshop_user['user_id']) {

    $shop_user_login = true;

    if ($dmshop_user['user_level'] >= '9') {

        // 관리자
        $shop_user_admin = true;

    }

} else {
// 비회원

    $shop_user_guest = true;

    $dmshop_user['user_level'] = "1";

}

// 스킨경로 초기화
$dmshop_article_path = "";
$dmshop_banner_path = "";
$dmshop_board_path = "";
$dmshop_boardbox_path = "";
$dmshop_bottom_path = "";
$dmshop_cancel_path = "";
$dmshop_cart_path = "";
$dmshop_cash_path = "";
$dmshop_category_path = "";
$dmshop_coupon_path = "";
$dmshop_email_path = "";
$dmshop_exchange_path = "";
$dmshop_favorite_path = "";
$dmshop_find_path = "";
$dmshop_help_path = "";
$dmshop_hmbar_path = "";
$dmshop_item_path = "";
$dmshop_item_gallery_path = "";
$dmshop_item_preview_path = "";
$dmshop_loginbox_path = "";
$dmshop_main_path = "";
$dmshop_menu_path = "";
$dmshop_mypage_path = "";
$dmshop_order_path = "";
$dmshop_order_address_path = "";
$dmshop_order_delivery_path = "";
$dmshop_order_guest_path = "";
$dmshop_order_list_path = "";
$dmshop_order_option_path = "";
$dmshop_order_view_path = "";
$dmshop_payment_path = "";
$dmshop_plan_path = "";
$dmshop_planbox_path = "";
$dmshop_popup_path = "";
$dmshop_refund_path = "";
$dmshop_scrollbox_path = "";
$dmshop_search_path = "";
$dmshop_searchbox_path = "";
$dmshop_showwindow_path = "";
$dmshop_signin_path = "";
$dmshop_signup_path = "";
$dmshop_sms_path = "";
$dmshop_top_path = "";
$dmshop_wmbar_path = "";
$dmshop_zip_path = "";

// 기타 초기화
$scrollbox_top = "";

// 스킨 설정
$dmshop_skin = shop_design_skin();

// 레이아웃 경로
$dmshop_layout_path = "";
$dmshop_layout_path = $shop['path']."/layout/default";
$layout_column = ""; // 레이아웃 메인,서브 구분 컬럼 초기화
$layout_auto_set = ""; // 레이아웃 강제설정 초기화

// 스마트에디터 이미지업로드 경로 지정
$shop['smarteditor_data'] = $shop['url']."/data/smarteditor";

// sms lib
include_once("{$shop['path']}/lib/sms.lib.php");

if ($page_id != 'block') {

    $dmshop_block_ip = explode("\n", $dmshop['block_ip']);
    for ($i=0; $i<count($dmshop_block_ip); $i++) {

        $dmshop_block_ip[$i] = trim(str_replace(".", "\.", $dmshop_block_ip[$i]));

        if (preg_match("/^($dmshop_block_ip[$i])$/", $_SERVER['REMOTE_ADDR'])) {

            shop_url($shop['path']."/rejection.php");

        }

    }

}

// 모바일
$shop['mobile_path'] = $shop['path']."/m";
$shop['mobile_url'] = $shop['url']."/m";

// ssl 보안인증서 사용
if ($dmshop['ssl_use']) {

    $shop['https_url'] = "https://".$_SERVER['HTTP_HOST'];
    $shop['url'] = "https://".$_SERVER['HTTP_HOST'];
    $shop['mobile_url'] = $shop['url']."/m";

} else {

    $shop['https_url'] = "http://".$_SERVER['HTTP_HOST'];

}

$check_touch = false;
if (preg_match("/(Mobile|Android)/", $_SERVER['HTTP_USER_AGENT'])) { $check_touch = true; }
?>