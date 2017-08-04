<?
include_once("./_dmshop.php");

// 관리자
if (!$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>관리자로 로그인하여주세요.</p>", "c");

}

if ($shop_user_login) {

    // 폼 체크
    if (!$_POST['form_check']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    if ($dmshop_user['datetime'] != $_POST['form_check']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

}

if (!$bbs_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

if (!$target_bbs_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

$dmshop_board = shop_board($bbs_id);

if (!$dmshop_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

$dmshop_target_board = shop_board($target_bbs_id);

if (!$dmshop_target_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

for ($i=0; $i<count($chk_id); $i++) {

    $k = $chk_id[$i];

    if ($chk_article_id[$k]) {

        $dmshop_article = shop_article($bbs_id, $chk_article_id[$k]);

        if ($dmshop_article['id']) {

            $sql_common = "";
            $sql_common .= " set user_id = '".$dmshop_article['user_id']."' ";
            $sql_common .= ", ar_name = '".trim(strip_tags(mysql_real_escape_string($dmshop_article['ar_name'])))."' ";
            $sql_common .= ", ar_email = '".trim(strip_tags(mysql_real_escape_string($dmshop_article['ar_email'])))."' ";
            $sql_common .= ", ar_homepage = '".trim(strip_tags(mysql_real_escape_string($dmshop_article['ar_homepage'])))."' ";
            $sql_common .= ", ar_password = '".$dmshop_article['ar_password']."' ";
            $sql_common .= ", ar_notice = '".$dmshop_article['ar_notice']."' ";
            $sql_common .= ", ar_secret = '".$dmshop_article['ar_secret']."' ";
            $sql_common .= ", ar_category = '".trim(strip_tags(mysql_real_escape_string($dmshop_article['ar_category'])))."' ";
            $sql_common .= ", ar_title = '".trim(mysql_real_escape_string($dmshop_article['ar_title']))."' ";
            $sql_common .= ", ar_content = '".mysql_real_escape_string($dmshop_article['ar_content'])."' ";
            $sql_common .= ", ar_ip = '".trim(strip_tags(mysql_real_escape_string($dmshop_article['ar_ip'])))."' ";
            $sql_common .= ", ar_hit = '".$dmshop_article['ar_hit']."' ";
            $sql_common .= ", ar_reply = '".$dmshop_article['ar_reply']."' ";
            $sql_common .= ", datetime = '".$dmshop_article['datetime']."' ";

            // insert
            sql_query(" insert into {$shop['article_table']}{$target_bbs_id} $sql_common ");

            $article_id = mysql_insert_id();

            // 아이디 저장
            sql_query(" update {$shop['article_table']}{$target_bbs_id} set ar_id = '".$article_id."' where id = '".$article_id."' ");

            // 카운트 증가
            sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count + 1 where bbs_id = '".$target_bbs_id."' ");

            // 댓글 변경
            sql_query(" update $shop[article_reply_table] set bbs_id = '".$target_bbs_id."', article_id = '".$article_id."' where bbs_id = '".$bbs_id."' and article_id = '".$dmshop_article['id']."' ");

            // 첨부파일
            $filenum = 0;
            $result = sql_query(" select * from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$dmshop_article['id']."_') order by id asc ");
            for ($n=0; $file=sql_fetch_array($result); $n++) {

                $filenum++;

                // 폴더생성
                $dir = $shop['path']."/data/article/".$target_bbs_id."/".shop_data_path("u", $file['datetime']);

                @mkdir("$dir", 0707);
                @chmod("$dir", 0707);

                // 원본, 대상
                $file_path1 = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];
                $file_path2 = $shop['path']."/data/article/".$target_bbs_id."/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

                // 파일 변경
                @rename("$file_path1", "$file_path2");

                // 첨부파일 변경
                sql_query(" update $shop[article_file_table] set upload_mode = 'af_".$target_bbs_id."_".$article_id."_".$filenum."' where id = '".$file['id']."' ");

            }

            // 게시물 삭제
            sql_query(" delete from {$shop['article_table']}{$bbs_id} where id = '".$dmshop_article['id']."' ");

            // 카운트 감소
            sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count - 1, bbs_reply_count = bbs_reply_count - ".(int)($dmshop_article['ar_reply'])." where bbs_id = '".$bbs_id."' ");

        }

    }

}

//echo "<script type='text/javascript'>opener.location.reload();</script>";
message("<p class='title'>알림</p><p class='text'>이동을 완료하였습니다.</p>", "c");
?>