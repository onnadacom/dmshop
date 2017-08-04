<?php
include_once("./_dmshop.php");

// 삭제
if ($m == 'd') {

    // 상품평
    $dmshop_reply = shop_reply(addslashes($_POST['reply_id']));

    // 답변
    $dmshop_reply_reply = shop_reply_reply(addslashes($_POST['reply_id']));

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[reply_file_table] where upload_mode in ('".addslashes($_POST['reply_id'])."', '".$dmshop_reply_reply['id']."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/reply/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[reply_file_table] where upload_mode in ('".addslashes($_POST['reply_id'])."', '".$dmshop_reply_reply['id']."') ");

    // 상품평 삭제 (답변도 삭제)
    sql_query(" delete from $shop[reply_table] where reply_id = '".addslashes($_POST['reply_id'])."' ");

    // 상품 카운트 감소
    sql_query(" update $shop[item_table] set item_reply = item_reply - 1 where id = '".$dmshop_reply['item_id']."' ");

    // 기획전 카운트 감소
    sql_query(" update $shop[plan_item_table] set item_reply = item_reply - 1 where item_id = '".$dmshop_reply['item_id']."' ");

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
        $dmshop_reply = shop_reply(addslashes($_POST['reply_id'][$k]));

        // 답변
        $dmshop_reply_reply = shop_reply_reply(addslashes($_POST['reply_id'][$k]));

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[reply_file_table] where upload_mode in ('".addslashes($_POST['reply_id'][$k])."', '".$dmshop_reply_reply['id']."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/reply/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[reply_file_table] where upload_mode in ('".addslashes($_POST['reply_id'][$k])."', '".$dmshop_reply_reply['id']."') ");

        // 상품평 삭제 (답변도 삭제)
        sql_query(" delete from $shop[reply_table] where reply_id = '".addslashes($_POST['reply_id'][$k])."' ");

        // 상품 카운트 감소
        sql_query(" update $shop[item_table] set item_reply = item_reply - 1 where id = '".$dmshop_reply['item_id']."' ");

        // 기획전 카운트 감소
        sql_query(" update $shop[plan_item_table] set item_reply = item_reply - 1 where item_id = '".$dmshop_reply['item_id']."' ");

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