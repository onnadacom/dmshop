<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 현재 버전 설정
$shop['version'] = "DM SHOP Ver. 0.99.56";
$shop['version_code'] = 56;
$shop['version_date'] = "2017-02-15";

// 버전 체크
if ($dmshop['version_code'] == $shop['version_code']) {

    alert("현재 최신버전입니다.");

}

/*--------------------------------
    ## START ##
--------------------------------*/

if ($dmshop['version_code'] < 2) {

    sql_query(" ALTER TABLE $shop[config_table] ADD `ssl_use` TINYINT( 4 ) NOT NULL DEFAULT '0' AFTER `domain_type` ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `order_card_percent` INT( 11 ) NOT NULL DEFAULT '0' AFTER `order_escrow_money` ", false);

}

if ($dmshop['version_code'] < 4) {

    sql_query(" ALTER TABLE `$shop[config_table]` ADD `mouse_event` TINYINT( 4 ) NOT NULL DEFAULT '0' AFTER `block_keyword` ", false);

}

if ($dmshop['version_code'] < 10) {

    sql_query(" ALTER TABLE `{$shop[cart_table]}` CHANGE `order_option` `order_option` INT(11) NOT NULL DEFAULT '0' COMMENT '옵션아이디' ", false);
    sql_query(" ALTER TABLE `{$shop[favorite_table]}` CHANGE `order_option` `order_option` INT(11) NOT NULL DEFAULT '0' COMMENT '옵션아이디' ", false);

}

if ($dmshop['version_code'] < 16) {

    sql_query(" ALTER TABLE `{$shop[item_table]}`  ADD `item_delivery` INT(11) NOT NULL DEFAULT '0' COMMENT '배송비' AFTER `item_cash`,  ADD `item_delivery_bunch` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '묶음배송여부' AFTER `item_delivery` ", false);
    sql_query(" ALTER TABLE `{$shop[order_table]}`  ADD `order_delivery_type` TINYINT( 4 ) NOT NULL DEFAULT '0' COMMENT '배송비방식' AFTER `order_delivery_money` , ADD `order_real_delivery` INT( 11 ) NOT NULL DEFAULT '0' COMMENT '실배송비' AFTER `order_delivery_type` ", false);
    sql_query(" update $shop[item_table] set item_delivery = '".$dmshop['delivery_money']."', item_delivery_bunch = '1' ", false);

}

if ($dmshop['version_code'] < 28) {

    sql_query(" ALTER TABLE `{$shop[config_table]}`  ADD `zipcode` TINYINT( 4 ) NOT NULL DEFAULT '0' ", false);

}

if ($dmshop['version_code'] < 32) {

    sql_query(" ALTER TABLE `{$shop[config_table]}`  ADD `syndi_type` TINYINT( 4 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE `{$shop[config_table]}`  ADD `syndi_token` varchar( 255 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] CHANGE `zip1` `zip1` VARCHAR( 10 ) NOT NULL , CHANGE `zip2` `zip2` VARCHAR( 10 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[order_table] CHANGE `order_zip1` `order_zip1` VARCHAR( 10 ) NOT NULL , CHANGE `order_zip2` `order_zip2` VARCHAR( 10 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[order_table] CHANGE `order_rec_zip1` `order_rec_zip1` VARCHAR( 10 ) NOT NULL , CHANGE `order_rec_zip2` `order_rec_zip2` VARCHAR( 10 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[payment_table] CHANGE `user_zip1` `user_zip1` VARCHAR( 10 ) NOT NULL , CHANGE `user_zip2` `user_zip2` VARCHAR( 10 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[user_table] CHANGE `user_zip1` `user_zip1` VARCHAR( 10 ) NOT NULL , CHANGE `user_zip2` `user_zip2` VARCHAR( 10 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[user_table] CHANGE `user_company_zip1` `user_company_zip1` VARCHAR( 10 ) NOT NULL , CHANGE `user_company_zip2` `user_company_zip2` VARCHAR( 10 ) NOT NULL ", false);

}

if ($dmshop['version_code'] < 55) {

    // 소셜 추가
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_naver_id` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_naver_secret` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_kakao_key` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_facebook_id` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_facebook_secret` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_twitter_key` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_twitter_secret` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_google_id` VARCHAR( 100 ) NOT NULL ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_google_secret` VARCHAR( 100 ) NOT NULL ", false);

    sql_query(" ALTER TABLE $shop[config_table] ADD `login_naver_count` INT( 11 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_kakao_count` INT( 11 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_facebook_count` INT( 11 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_twitter_count` INT( 11 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE $shop[config_table] ADD `login_google_count` INT( 11 ) NOT NULL DEFAULT '0' ", false);

    sql_query(" ALTER TABLE $shop[user_table] ADD `social` TINYINT( 4 ) NOT NULL DEFAULT '0' ", false);
    sql_query(" ALTER TABLE $shop[user_table] ADD `social_key` VARCHAR( 100 ) NOT NULL ", false);

}

/*--------------------------------
    ## END ##
--------------------------------*/

// update
sql_query(" update $shop[config_table] set version = '".$shop['version']."', version_code = '".$shop['version_code']."', version_date = '".$shop['version_date']."' ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

alert("업데이트를 완료하였습니다.", "./config_version.php");
?>