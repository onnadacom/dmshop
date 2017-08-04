<?php
include_once("./_dmshop.php");
if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }
if ($reply_reply_id) { $reply_reply_id = preg_match("/^[0-9]+$/", $reply_reply_id) ? $reply_reply_id : ""; }

if (!$_POST['reply_id']) {

    alert_close("상품평이 삭제되었거나 존재하지 않습니다.");

}

// 상품평
$dmshop_reply = shop_reply(addslashes($reply_id));

if (!$dmshop_reply['id']) {

    alert_close("상품평이 삭제되었거나 존재하지 않습니다.");

}

// 상품
$dmshop_item = shop_item($dmshop_reply['item_id']);

if ($m == '') {

    if ($dmshop_reply['id'] != $dmshop_reply['reply_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    if ($dmshop_reply['reply_count']) {

        alert_close("이미 답변이 등록되었습니다.");

    }

    // common
    $sql_common = "";
    $sql_common .= " set item_id = '".$dmshop_item['id']."' ";
    $sql_common .= ", category1 = '".$dmshop_item['category1']."' ";
    $sql_common .= ", category2 = '".$dmshop_item['category2']."' ";
    $sql_common .= ", category3 = '".$dmshop_item['category3']."' ";
    $sql_common .= ", category4 = '".$dmshop_item['category4']."' ";
    $sql_common .= ", reply_id = '".addslashes($_POST['reply_id'])."' ";
    $sql_common .= ", user_id = '".addslashes($dmshop_user['user_id'])."' ";
    $sql_common .= ", reply_name = '".addslashes($_POST['reply_name'])."' ";
    $sql_common .= ", reply_password = '".addslashes($dmshop_user['reply_password'])."' ";
    $sql_common .= ", reply_title = '".addslashes($_POST['reply_title'])."' ";
    $sql_common .= ", reply_content = '".addslashes($_POST['reply_content'])."' ";
    $sql_common .= ", reply_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";

    if ($_POST['datetime']) {

        $sql_common .= ", datetime = '".addslashes($_POST['datetime'])."' ";

    } else {

        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    }

    // insert
    sql_query(" insert into $shop[reply_table] $sql_common ");

    $reply_id = mysql_insert_id();

    // 상품평 카운트 증가
    sql_query(" update $shop[reply_table] set reply_count = reply_count + 1 where id = '".$dmshop_reply['reply_id']."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/reply/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // reply
    $upload_mode = $reply_id;
    include("$shop[path]/upload_reply_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./reply_view.php?reply_id={$dmshop_reply['reply_id']}");

}

else if ($m == 'u') {

    if ($dmshop_reply['id'] != $dmshop_reply['reply_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    $sql_common = "";
    $sql_common .= " set datetime = '".addslashes($_POST['datetime'])."' ";
    $sql_common .= ", reply_name = '".addslashes($_POST['reply_name'])."' ";
    $sql_common .= ", reply_score = '".addslashes($_POST['reply_score'])."' ";
    $sql_common .= ", reply_title = '".addslashes($_POST['reply_title'])."' ";
    $sql_common .= ", reply_content = '".addslashes($_POST['reply_content'])."' ";

    sql_query(" update $shop[reply_table] $sql_common where id = '".addslashes($_POST['reply_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/reply/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // reply
    $upload_mode = addslashes($reply_id);
    include("$shop[path]/upload_reply_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    if ($dmshop_reply['reply_count']) {

        shop_url("./reply_view.php?reply_id=$reply_id");

    } else {

        shop_url("./reply_write.php?reply_id=$reply_id");

    }

}

else if ($m == 'ru') {

    $sql_common = "";
    $sql_common .= " set datetime = '".addslashes($_POST['datetime'])."' ";
    $sql_common .= ", reply_name = '".addslashes($_POST['reply_name'])."' ";
    $sql_common .= ", reply_title = '".addslashes($_POST['reply_title'])."' ";
    $sql_common .= ", reply_content = '".addslashes($_POST['reply_content'])."' ";

    sql_query(" update $shop[reply_table] $sql_common where id = '".addslashes($_POST['reply_reply_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/reply/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // reply
    $upload_mode = $reply_reply_id;
    include("$shop[path]/upload_reply_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./reply_view.php?reply_id=$reply_id");

} else {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>