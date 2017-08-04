<?php
include_once("./_dmshop.php");

if (!$_POST['qna_id']) {

    alert_close("상품문의가 삭제되었거나 존재하지 않습니다.");

}

// 상품문의
$dmshop_qna = shop_qna(addslashes($qna_id));

if (!$dmshop_qna['id']) {

    alert_close("상품문의가 삭제되었거나 존재하지 않습니다.");

}

// 상품
$dmshop_item = shop_item($dmshop_qna['item_id']);

if ($m == '') {

    if ($dmshop_qna['id'] != $dmshop_qna['qna_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    if ($dmshop_qna['qna_count']) {

        alert_close("이미 답변이 등록되었습니다.");

    }

    // common
    $sql_common = "";
    $sql_common .= " set item_id = '".$dmshop_item['id']."' ";
    $sql_common .= ", category1 = '".$dmshop_item['category1']."' ";
    $sql_common .= ", category2 = '".$dmshop_item['category2']."' ";
    $sql_common .= ", category3 = '".$dmshop_item['category3']."' ";
    $sql_common .= ", category4 = '".$dmshop_item['category4']."' ";
    $sql_common .= ", qna_id = '".addslashes($_POST['qna_id'])."' ";
    $sql_common .= ", user_id = '".addslashes($dmshop_user['user_id'])."' ";
    $sql_common .= ", qna_name = '".addslashes($_POST['qna_name'])."' ";
    $sql_common .= ", qna_password = '".addslashes($dmshop_user['qna_password'])."' ";
    $sql_common .= ", qna_title = '".addslashes($_POST['qna_title'])."' ";
    $sql_common .= ", qna_content = '".addslashes($_POST['qna_content'])."' ";
    $sql_common .= ", qna_ip = '".addslashes($_SERVER['REMOTE_ADDR'])."' ";

    if ($_POST['datetime']) {

        $sql_common .= ", datetime = '".addslashes($_POST['datetime'])."' ";

    } else {

        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    }

    // insert
    sql_query(" insert into $shop[qna_table] $sql_common ");

    $qna_id = "";
    $qna_id = mysql_insert_id();

    // 상품문의 카운트 증가
    sql_query(" update $shop[qna_table] set qna_count = qna_count + 1 where id = '".$dmshop_qna['qna_id']."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/qna/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // qna
    $upload_mode = $qna_id;
    include("$shop[path]/upload_qna_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./qna_view.php?qna_id={$dmshop_qna['qna_id']}");

}

else if ($m == 'u') {

    if ($dmshop_qna['id'] != $dmshop_qna['qna_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    $sql_common = "";
    $sql_common .= " set datetime = '".addslashes($_POST['datetime'])."' ";
    $sql_common .= ", qna_name = '".addslashes($_POST['qna_name'])."' ";
    $sql_common .= ", qna_category = '".addslashes($_POST['qna_category'])."' ";
    $sql_common .= ", qna_title = '".addslashes($_POST['qna_title'])."' ";
    $sql_common .= ", qna_content = '".addslashes($_POST['qna_content'])."' ";

    sql_query(" update $shop[qna_table] $sql_common where id = '".addslashes($_POST['qna_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/qna/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // qna
    $upload_mode = $qna_id;
    include("$shop[path]/upload_qna_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    if ($dmshop_qna['qna_count']) {

        shop_url("./qna_view.php?qna_id=$qna_id");

    } else {

        shop_url("./qna_write.php?qna_id=$qna_id");

    }

}

else if ($m == 'ru') {

    $sql_common = "";
    $sql_common .= " set datetime = '".addslashes($_POST['datetime'])."' ";
    $sql_common .= ", qna_name = '".addslashes($_POST['qna_name'])."' ";
    $sql_common .= ", qna_title = '".addslashes($_POST['qna_title'])."' ";
    $sql_common .= ", qna_content = '".addslashes($_POST['qna_content'])."' ";

    sql_query(" update $shop[qna_table] $sql_common where id = '".addslashes($_POST['qna_reply_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/qna/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // qna
    $upload_mode = addslashes($qna_reply_id);
    include("$shop[path]/upload_qna_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./qna_view.php?qna_id=$qna_id");

} else {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>