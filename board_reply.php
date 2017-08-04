<?
if (!defined('_DMSHOP_')) exit;

// 댓글쓰기 버튼
$dmshop_board['btn_reply_write'] = false;
if ($dmshop_user['user_level'] >= $dmshop_board['bbs_reply_level']) {

    $dmshop_board['btn_reply_write'] = true;

}

$list = array();
$result = sql_query(" select * from $shop[article_reply_table] where bbs_id = '".$bbs_id."' and article_id = '".$article_id."' order by datetime asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 수정 버튼
    $list[$i]['btn_edit'] = false;
    $list[$i]['btn_delete'] = false;
    if ($row['user_id'] && $dmshop_user['user_id'] == $row['user_id'] || !$row['user_id'] || $shop_user_admin) {

        $list[$i]['btn_edit'] = true;
        $list[$i]['btn_delete'] = true;

    }

    // 작성자, 제목, 내용
    $list[$i]['name'] = text($row['reply_name']);
    $list[$i]['content'] = text2($row['reply_content'], 0);

    // 작성자
    if ($dmshop_board['bbs_name']) {

        $list[$i]['name'] = shop_article_privacy($list[$i]['name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

    } else {
    // 아이디

        if ($row['user_id']) {

            $list[$i]['name'] = shop_article_privacy($row['user_id'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

        } else {

            $list[$i]['name'] = shop_article_privacy($list[$i]['name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

        }

    }

    // 관리자면
    if ($shop_user_admin) {

        // userview
        $list[$i]['name'] = shop_userview($list[$i]['user_id'], $list[$i]['name'], $list[$i]['ar_email'], $list[$i]['ar_homepage'], $list[$i]['name']);

    }

}

if ($shop_user_login) {

    // 작성자
    if ($dmshop_board['bbs_name']) {

        // 회원 정보로
        if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick']) {

            $dmshop_user['write_name'] = text($dmshop_user['user_nick']);

        } else {

            $dmshop_user['write_name'] = text($dmshop_user['user_name']);

        }

    } else {
    // 아이디

        if ($dmshop_article['user_id']) {

            $dmshop_user['write_name'] = text($dmshop_user['user_id']);

        } else {

            $dmshop_user['write_name'] = text($dmshop_user['user_name']);

        }

    }

}

include_once("$dmshop_board_path/reply.php");
?>