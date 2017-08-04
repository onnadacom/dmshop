<?
include_once("./_dmshop.php");

$password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['password']))));

if ($shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>비회원만 이용하실 수 있습니다.</p>", "b");

}

if (!$password) {

    message("<p class='title'>알림</p><p class='text'>비밀번호가 입력되지 않았습니다.</p>", "b");

}

if (!$bbs_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "b");

}

$dmshop_board = shop_board($bbs_id);

if (!$dmshop_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "b");

}

if (!$dmshop_board['bbs_view']) {

    message("<p class='title'>알림</p><p class='text'>접근할 수 없는 게시판입니다.</p>", "b");

}

if (!$dmshop_board['bbs_skin']) {

    message("<p class='title'>알림</p><p class='text'>게시판 스킨이 설정되지 않았습니다.</p>", "b");

}

if (!$article_id) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

$dmshop_article = shop_article($bbs_id, $article_id);

if (!$dmshop_article['id']) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

// 게시물 수정, 게시물 삭제
if ($m == 'article_view' || $m == 'article_edit' || $m == 'article_delete') {

    // 회원이 작성
    if ($dmshop_article['user_id']) {

        message("<p class='title'>알림</p><p class='text'>비회원이 작성한 게시물이 아닙니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    $chk = sql_fetch(" select ar_password from {$shop['article_table']}{$bbs_id} where id = '".$article_id."' and ar_password = '".$password."' ");

    // 있다
    if ($chk['ar_password']) {

        $ss_name = "article_".$bbs_id."_".$article_id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    } else {

        message("<p class='title'>알림</p><p class='text'>비밀번호가 일치하지 않습니다.</p>", "b");

    }

    if ($m == 'article_view') {

        shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    if ($m == 'article_edit') {

        shop_url("./board_write.php?bbs_id={$bbs_id}&article_id={$article_id}&m=u");

    }

    if ($m == 'article_delete') {

        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='content-type' content='text/html; charset=".$shop['charset']."'>";
        echo "<title>article</title>";
        echo "</head>";
        echo "<body>";
        echo "<form method='post' name='formArticle' autocomplete='off'>";
        echo "<input type='hidden' name='m' value='d' />";
        echo "<input type='hidden' name='bbs_id' value='".$bbs_id."' />";
        echo "<input type='hidden' name='article_id' value='".$article_id."' />";
        echo "</form>";
        echo "<script type='text/javascript'> var f = document.formArticle; f.action = './board_write_update.php'; f.submit(); </script>";
        echo "</body>";
        echo "</html>";

    }

}

// 댓글 삭제
else if ($m == 'reply_delete') {

    if (!$reply_id) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    $dmshop_article_reply = shop_article_reply($reply_id);

    if (!$dmshop_article_reply['id']) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    // 회원이 작성
    if ($dmshop_article_reply['user_id']) {

        message("<p class='title'>알림</p><p class='text'>비회원이 작성한 댓글이 아닙니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    $chk = sql_fetch(" select reply_password from $shop[article_reply_table] where id = '".$reply_id."' and reply_password = '".$password."' ");

    // 있다
    if ($chk['reply_password']) {

        $ss_name = "article_reply_".$bbs_id."_".$article_id."_".$reply_id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    } else {

        message("<p class='title'>알림</p><p class='text'>비밀번호가 일치하지 않습니다.</p>", "b");

    }

    if ($m == 'reply_delete') {

        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='content-type' content='text/html; charset=".$shop['charset']."'>";
        echo "<title>article</title>";
        echo "</head>";
        echo "<body>";
        echo "<form method='post' name='formReply' autocomplete='off'>";
        echo "<input type='hidden' name='m' value='d' />";
        echo "<input type='hidden' name='bbs_id' value='".$bbs_id."' />";
        echo "<input type='hidden' name='article_id' value='".$article_id."' />";
        echo "<input type='hidden' name='reply_id' value='".$reply_id."' />";
        echo "</form>";
        echo "<script type='text/javascript'> var f = document.formReply; f.action = './board_reply_update.php'; f.submit(); </script>";
        echo "</body>";
        echo "</html>";

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}
?>