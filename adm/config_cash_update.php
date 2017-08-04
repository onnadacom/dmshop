<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($_POST['check1']) {

    sql_query(" update $shop[signup_table] set user_signup_cash = '".addslashes($_POST['user_signup_cash'])."', user_cash = '".addslashes($_POST['user_cash'])."' ");

}

if ($_POST['check2']) {

    sql_query(" update $shop[config_table] set birth_cash_use = '".addslashes($_POST['birth_cash_use'])."', birth_cash = '".addslashes($_POST['birth_cash'])."' ");

}

if ($_POST['check3']) {

    sql_query(" update $shop[config_table] set order_first_use = '".addslashes($_POST['order_first_use'])."', order_first_cash = '".addslashes($_POST['order_first_cash'])."' ");

}

if ($_POST['check4']) {

    sql_query(" update $shop[config_table] set order_cash_use = '".addslashes($_POST['order_cash_use'])."' ");

}

if ($_POST['check5']) {

    sql_query(" update $shop[config_table] set article_cash_use = '".addslashes($_POST['article_cash_use'])."' ");

}

if ($_POST['check6']) {

    sql_query(" update $shop[config_table] set reply_cash_use = '".addslashes($_POST['reply_cash_use'])."' ");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>