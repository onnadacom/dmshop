<?php
include_once("./_dmshop.php");

// 삭제
if ($m == 'd') {

    // 상품문의
    $dmshop_qna = shop_qna(addslashes($_POST['qna_id']));

    // 답변
    $dmshop_qna_reply = shop_qna_reply(addslashes($_POST['qna_id']));

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[qna_file_table] where upload_mode in ('".addslashes($_POST['qna_id'])."', '".$dmshop_qna_reply['id']."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/qna/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[qna_file_table] where upload_mode in ('".addslashes($_POST['qna_id'])."', '".$dmshop_qna_reply['id']."') ");

    // qna 삭제
    sql_query(" delete from $shop[qna_table] where id = '".addslashes($_POST['qna_id'])."' ");

    // qna 삭제
    sql_query(" delete from $shop[qna_table] where id = '".$dmshop_qna_reply['id']."' ");

    // 상품 카운트 감소
    sql_query(" update $shop[item_table] set item_qna = item_qna - 1 where id = '".$dmshop_qna['item_id']."' ");

    // 기획전 카운트 감소
    sql_query(" update $shop[plan_item_table] set item_qna = item_qna - 1 where item_id = '".$dmshop_qna['item_id']."' ");

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

        // 상품문의
        $dmshop_qna = shop_qna(addslashes($_POST['qna_id'][$k]));

        // 답변
        $dmshop_qna_reply = shop_qna_reply(addslashes($_POST['qna_id'][$k]));

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[qna_file_table] where upload_mode in ('".addslashes($_POST['qna_id'][$k])."', '".$dmshop_qna_reply['id']."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/qna/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[qna_file_table] where upload_mode in ('".addslashes($_POST['qna_id'][$k])."', '".$dmshop_qna_reply['id']."') ");

        // qna 삭제
        sql_query(" delete from $shop[qna_table] where id = '".addslashes($_POST['qna_id'][$k])."' ");

        // qna 삭제
        sql_query(" delete from $shop[qna_table] where id = '".$dmshop_qna_reply['id']."' ");

        // 상품 카운트 감소
        sql_query(" update $shop[item_table] set item_qna = item_qna - 1 where id = '".$dmshop_qna['item_id']."' ");

        // 기획전 카운트 감소
        sql_query(" update $shop[plan_item_table] set item_qna = item_qna - 1 where item_id = '".$dmshop_qna['item_id']."' ");

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