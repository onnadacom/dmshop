<?php
include_once("./_dmshop.php");
if ($help_id) { $help_id = preg_match("/^[0-9]+$/", $help_id) ? $help_id : ""; }
if ($help_reply_id) { $help_reply_id = preg_match("/^[0-9]+$/", $help_reply_id) ? $help_reply_id : ""; }

if (!$_POST['help_id']) {

    alert_close("문의가 삭제되었거나 존재하지 않습니다.");

}

// 상품평
$dmshop_help = shop_help($help_id);

if (!$dmshop_help['id']) {

    alert_close("문의가 삭제되었거나 존재하지 않습니다.");

}

if ($m == '') {

    if ($dmshop_help['id'] != $dmshop_help['help_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    if ($dmshop_help['help_count']) {

        alert_close("이미 답변이 등록되었습니다.");

    }

    // common
    $sql_common = "";
    $sql_common .= " set help_id = '".addslashes($_POST['help_id'])."' ";
    $sql_common .= ", user_id = '".addslashes($dmshop_user['user_id'])."' ";
    $sql_common .= ", user_name = '".addslashes($_POST['user_name'])."' ";
    $sql_common .= ", subject = '".addslashes($_POST['subject'])."' ";
    $sql_common .= ", content = '".addslashes($_POST['content'])."' ";

    if ($_POST['datetime']) {

        $sql_common .= ", datetime = '".addslashes($_POST['datetime'])."' ";

    } else {

        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    }

    // insert
    sql_query(" insert into $shop[help_table] $sql_common ");

    $help_id = mysql_insert_id();

    // 질문에 답변수 증가
    sql_query(" update $shop[help_table] set help_count = help_count + 1 where id = '".addslashes($dmshop_help['help_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/help/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // help
    $upload_mode = $help_id;
    include("$shop[path]/upload_help_file.php");

    // 답변안내 SMS
    if ($dmshop_help['help_send_sms'] && $dmshop_help['user_hp']) {

        // sms
        $shop_sms_config = shop_sms_config("help");

        // 사용
        if ($shop_sms_config['sms_use'] && $dmshop_help['user_hp']) {

            $sms_to = $dmshop_help['user_hp'];
            $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

            $sms_message = $shop_sms_config['sms_message'];
            $sms_message = str_replace("[성명]", $dmshop_help['user_name'], $sms_message);
            $sms_message = str_replace("[아이디]", $dmshop_help['user_id'], $sms_message);
            $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
            $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

            // 전송
            shop_sms_send("help", $dmshop_help['user_id'], $sms_to, $sms_from, $sms_message);

            sql_query(" update $shop[help_table] set help_send_sms = '1'where id = '".$help_id."' ");

        }

    }

    // 답변안내 이메일
    if ($dmshop_help['help_send_email'] && $dmshop_help['user_email']) {

        $content = text2($content, 0);

        ob_start();
        include_once ("./help_email_text.php");
        $content = ob_get_contents();
        ob_end_clean();

        $to_email = $dmshop_help['user_email']; // 받는사람
        $title = $dmshop['shop_name']." - 1:1문의 답변이 등록되었습니다."; // 제목
        $from_name = $dmshop['shop_name']; // 보내는사람 이름
        $from_email = $dmshop['ceo_email']; // 보내는사람 이메일

        // 발송
        shop_email_send($to_email, $title, $content, $from_name, $from_email, 1);

        sql_query(" update $shop[help_table] set help_send_email = '1'where id = '".$help_id."' ");

    }

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./help_view.php?help_id={$dmshop_help['help_id']}");

}

else if ($m == 'ru') {

    $sql_common = "";
    $sql_common .= " set user_name = '".addslashes($_POST['user_name'])."' ";
    $sql_common .= ", subject = '".addslashes($_POST['subject'])."' ";
    $sql_common .= ", content = '".addslashes($_POST['content'])."' ";
    $sql_common .= ", help_send_email = '".addslashes($_POST['help_send_email'])."' ";
    $sql_common .= ", help_send_sms = '".addslashes($_POST['help_send_sms'])."' ";
    $sql_common .= ", datetime = '".addslashes($_POST['datetime'])."' ";

    sql_query(" update $shop[help_table] $sql_common where id = '".addslashes($_POST['help_reply_id'])."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/help/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // help
    $upload_mode = $help_reply_id;
    include("$shop[path]/upload_help_file.php");

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    shop_url("./help_view.php?help_id=$help_id");

} else {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>