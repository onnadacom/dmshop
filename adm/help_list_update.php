<?php
include_once("./_dmshop.php");

// 삭제
if ($m == 'd') {

    // 문의
    $dmshop_help = shop_help(addslashes($_POST['help_id']));

    // 답변
    $dmshop_help_reply = shop_help_reply(addslashes($_POST['help_id']));

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[help_file_table] where upload_mode in ('".addslashes($_POST['help_id'])."', '".$dmshop_help_reply['id']."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/help/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[help_file_table] where upload_mode in ('".addslashes($_POST['help_id'])."', '".$dmshop_help_reply['id']."') ");

    // help 삭제
    sql_query(" delete from $shop[help_table] where id = '".addslashes($_POST['help_id'])."' ");

    // help 삭제
    sql_query(" delete from $shop[help_table] where id = '".$dmshop_help_reply['id']."' ");

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 삭제
else if ($m == 'alld') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 상품평
        $dmshop_help = shop_help(addslashes($_POST['help_id'][$k]));

        // 답변
        $dmshop_help_reply = shop_help_reply(addslashes($_POST['help_id'][$k]));

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[help_file_table] where upload_mode in ('".addslashes($_POST['help_id'][$k])."', '".$dmshop_help_reply['id']."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/help/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[help_file_table] where upload_mode in ('".addslashes($_POST['help_id'][$k])."', '".$dmshop_help_reply['id']."') ");

        // help 삭제
        sql_query(" delete from $shop[help_table] where id = '".addslashes($_POST['help_id'][$k])."' ");

        // help 삭제
        sql_query(" delete from $shop[help_table] where id = '".$dmshop_help_reply['id']."' ");

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>