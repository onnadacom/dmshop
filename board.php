<?
include_once("./_dmshop.php");

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

if ($dmshop_board['bbs_list_level'] > '1') {

    if ($shop_user_login) {

        if ($dmshop_user['user_level'] < $dmshop_board['bbs_list_level']) {

            message("<p class='title'>알림</p><p class='text'>접근할 수 없는 게시판입니다.</p>", "b");

        }

    } else {

        shop_url("$shop[path]/signin.php?url={$urlencode}");

    }

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_board['bbs_title'];

// 페이지 아이디
$page_id = $bbs_id;

$article_href = "";
if ($bbs_category) {

    $article_href .= "&amp;bbs_category=".urlencode($bbs_category);

}

if ($q) {

    $article_href .= "&amp;f=".$f;
    $article_href .= "&amp;q=".$q;

}

if ($page && $page > '1') {

    $article_href .= "&amp;page=".$page;

}

// 글쓰기 버튼
$dmshop_board['btn_write'] = false;
if ($dmshop_user['user_level'] >= $dmshop_board['bbs_write_level']) {

    $dmshop_board['btn_write'] = true;

}

// 뷰
if ($article_id) {

    $dmshop_article = shop_article($bbs_id, $article_id);

    if (!$dmshop_article['id']) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "board.php?bbs_id={$bbs_id}");

    }

    if ($dmshop_board['bbs_read_level'] > '1') {

        if ($shop_user_login) {

            if ($dmshop_user['user_level'] < $dmshop_board['bbs_read_level']) {

                message("<p class='title'>알림</p><p class='text'>열람할 권한이 없습니다.</p>", "b");

            }

        } else {

            shop_url("$shop[path]/signin.php?url={$urlencode}");

        }

    }

    // 비밀글
    if ($dmshop_article['ar_secret']) {

        // 답글
        $dmshop_article_answer = "";
        if ($dmshop_article['id'] != $dmshop_article['ar_id']) {

            // 원글
            $dmshop_article_answer = shop_article($bbs_id, $dmshop_article['ar_id']);

        }

        // 비회원
        $shop_article_session = false;
        if (!$dmshop_article['user_id'] && !$shop_user_login || !$dmshop_article_answer['user_id'] && !$shop_user_login) {

            $ss_name = "article_".$bbs_id."_".$article_id;
            $ss_name2 = "article_".$bbs_id."_".$dmshop_article['ar_id'];

            if (shop_get_session($ss_name) || shop_get_session($ss_name2)) {

                $shop_article_session = true;

            } else {

                shop_url("./board_password.php?m=article_view&bbs_id={$bbs_id}&article_id={$article_id}");

            }

        }

        // 관리자
        if ($shop_user_admin) {

            // pass

        }

        // 내글
        else if ($dmshop_article['user_id'] && $dmshop_user['user_id'] == $dmshop_article['user_id'] || $dmshop_article_answer['user_id'] && $dmshop_user['user_id'] == $dmshop_article_answer['user_id']) {

            // pass

        }

        // 비회원 (세션이 있다면)
        else if (!$dmshop_article['user_id'] && $shop_article_session || !$dmshop_article_answer['user_id'] && $shop_article_session) {

            // pass

        } else {

            message("<p class='title'>알림</p><p class='text'>열람할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

        }

    }

    $ss_name = "article_view_".$bbs_id."_".$article_id;

    if (!shop_get_session($ss_name)) {

        shop_set_session($ss_name, true);

        // 조회수 증가
        sql_query(" update {$shop['article_table']}{$bbs_id} set ar_hit = ar_hit + 1 where id = '".$article_id."' ");

    }

    // 링크
    $dmshop_article['href'] = "board.php?bbs_id=".$bbs_id.$article_href;

    // 이전글 다음글을 위한 쿼리
    $sql_search = "";

    if ($bbs_category) {

        $sql_search .= " and ar_category = '".$bbs_category."' ";

    }

    if ($f && $q) {

        if ($f == 'ar_title' || $f == 'ar_content' || $f == 'ar_name' || $f == 'user_id') {

            $sql_search .= " and INSTR(".$f.", '".$q."') ";

        }

    }

    // 이전글, 다음글
    $dmshop_article_prev = sql_fetch(" select * from {$shop['article_table']}{$bbs_id} where id > '".$article_id."' $sql_search order by id asc ");
    $dmshop_article_next = sql_fetch(" select * from {$shop['article_table']}{$bbs_id} where id < '".$article_id."' $sql_search order by id desc ");
    $dmshop_article['href_prev'] = "";
    $dmshop_article['href_prev'] = "";
    if ($dmshop_article_prev['id']) { $dmshop_article['href_prev'] = "board.php?bbs_id=".$bbs_id."&amp;article_id=".$dmshop_article_prev['id'].$article_href; }
    if ($dmshop_article_next['id']) { $dmshop_article['href_next'] = "board.php?bbs_id=".$bbs_id."&amp;article_id=".$dmshop_article_next['id'].$article_href; }

    // 수정 버튼
    $dmshop_board['btn_edit'] = false;
    $dmshop_board['btn_delete'] = false;
    if ($dmshop_article['user_id'] && $dmshop_user['user_id'] == $dmshop_article['user_id'] || !$dmshop_article['user_id'] && $ss_name || $shop_user_admin) {

        $dmshop_board['btn_edit'] = true;
        $dmshop_board['btn_delete'] = true;

    }

    // 답글 버튼
    $dmshop_board['btn_answer'] = false;
    if ($dmshop_article['id'] == $dmshop_article['ar_id'] && $dmshop_user['user_level'] >= $dmshop_board['bbs_answer_level']) {

        $dmshop_board['btn_answer'] = true;

        // 비밀글은 운영자만 가능하도록 막는다
        if ($dmshop_article['ar_secret'] && !$shop_user_admin) {

            $dmshop_board['btn_answer'] = false;

        }

    }

    // 작성자, 제목, 내용
    $dmshop_article['ar_category'] = text($dmshop_article['ar_category']);
    $dmshop_article['ar_name'] = text($dmshop_article['ar_name']);
    $dmshop_article['ar_title'] = text($dmshop_article['ar_title']);
    $dmshop_article['ar_content'] = text2($dmshop_article['ar_content'], 1);
    $dmshop_article['ar_content'] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 alt=\"\" name=\"shopResizeImage[]\" onclick=\"shopImageView(this);\" style=\"cursor:pointer;\" \\2 \\3", $dmshop_article['ar_content']);

    // 작성자
    if ($dmshop_board['bbs_name']) {

        $dmshop_article['name'] = shop_article_privacy($dmshop_article['ar_name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

    } else {
    // 아이디

        if ($dmshop_article['user_id']) {

            $dmshop_article['name'] = shop_article_privacy($dmshop_article['user_id'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

        } else {

            $dmshop_article['name'] = shop_article_privacy($dmshop_article['ar_name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

        }

    }

    // 관리자면
    if ($shop_user_admin) {

        // userview
        $dmshop_article['name'] = shop_userview($dmshop_article['user_id'], $dmshop_article['name'], $dmshop_article['ar_email'], $dmshop_article['ar_homepage'], $dmshop_article['name']);

    }

    $dmshop_article['ic_new_time'] = "";
    if ($dmshop_board['bbs_new_time']) {

        if ($dmshop_article['datetime'] >= date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop_board['bbs_new_time'] * 3600))) {

            $dmshop_article['ic_new_time'] = "<img src='".$dmshop_board_path."/img/ic_new_time.gif' border='0' class='ic_new_time'>";

        }

    }

    $dmshop_article['ic_hit_time'] = "";
    if ($dmshop_board['bbs_hit_time']) {

        if ($dmshop_article['ar_hit'] >= $dmshop_board['bbs_hit_time']) {

            $dmshop_article['ic_hit_time'] = "<img src='".$dmshop_board_path."/img/ic_hit_time.gif' border='0' class='ic_hit_time'>";

        }

    }

    $dmshop_article['ic_answer'] = "";
    if ($dmshop_article['id'] != $dmshop_article['ar_id']) {

        $dmshop_article['ic_answer'] = "<img src='".$dmshop_board_path."/img/ic_answer.gif' border='0' class='ic_answer'>";

    }

    $dmshop_article['ic_secret'] = "";
    if ($dmshop_article['ar_secret']) {

        $dmshop_article['ic_secret'] = "<img src='".$dmshop_board_path."/img/ic_secret.gif' border='0' class='ic_secret'>";

    }

    // 파일
    $article_file = array();
    $result = sql_query(" select * from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$article_id."_') order by upload_mode asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $article_file[$i] = $row;

    }

}

if ($dmshop_board['bbs_include_top']) { include($dmshop_board['bbs_include_top']); } else { include_once("./_top.php"); }
?>
<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>
<? if ($shop_user_admin) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div style="border:1px solid #b4d9e0; background-color:#e2fdff; text-align:center; padding:4px 0 3px 0;"><a href="<?=$shop['path']?>/adm/board_write.php?m=u&amp;bbs_id=<?=$bbs_id?>"><span style="font-weight:bold; line-height:14px; font-size:12px; color:#027d94; font-family:dotum,돋움;">관리자 권한으로 본 게시판을 수정 합니다.</span></a></div></td>
</tr>
<tr><td height="10"></td></tr>
</table>
<? } ?>
<?
// top 이미지
$file = shop_design_file("board_top_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

// top 내용
if ($dmshop_board['bbs_text_top']) { echo "<div>".stripslashes($dmshop_board['bbs_text_top'])."</div>"; }

// 뷰
if ($article_id) {

    @include_once("$dmshop_board_path/view.top.php");
    include_once("$dmshop_board_path/view.php");
    @include_once("$dmshop_board_path/view.bottom.php");

}

// 리스트
if (!$article_id || $dmshop_board['bbs_view_list']) {

    $sql_search = " where ar_notice = '0' ";

    if ($bbs_category) {

        $sql_search .= " and ar_category = '".$bbs_category."' ";

    }

    if ($f && $q) {

        if ($f == 'ar_title' || $f == 'ar_content' || $f == 'ar_name' || $f == 'user_id') {

            $sql_search .= " and INSTR(".$f.", '".$q."') ";

        }

    }

    $cnt = sql_fetch(" select count(*) as cnt from {$shop['article_table']}{$bbs_id} $sql_search ");

    $total_count = $cnt['cnt'];

    $rows = (int)($dmshop_board['bbs_rows']);

    $total_page  = ceil($total_count / $rows);

    if (!$page) {

        $page = 1;

    }

    $from_record = ($page - 1) * $rows;

    $board_pages = shop_paging_board("10", $page, $total_page, "?bbs_id=".$bbs_id."&amp;bbs_category=".$bbs_category."&amp;f=".$f."&amp;q=".$q."&amp;page=");

    $sort = $dmshop_board['bbs_order'];

    if (!$sort) {

        $sort = "ar_id desc";

    }

    // 공지
    $notice = array();

    // 검색이 아닐 때, 공지가 있다.
    if (!$bbs_category && !$q && $dmshop_board['bbs_notice']) {

        $result = sql_query(" select * from {$shop['article_table']}{$bbs_id} where ar_notice = '1' order by ar_id desc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $notice[$i] = $row;

            $notice[$i]['href'] = "board.php?bbs_id=".$bbs_id."&amp;article_id=".$row['id'].$article_href;

            $notice[$i]['name'] = text($row['ar_name']);
            $notice[$i]['ar_name'] = text($row['ar_name']);
            $notice[$i]['ar_title'] = text($row['ar_title']);
            $notice[$i]['ar_category'] = text($row['ar_category']);

            $notice[$i]['ic_new_time'] = "";
            if ($dmshop_board['bbs_new_time']) {

                if ($row['datetime'] >= date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop_board['bbs_new_time'] * 3600))) {

                    $notice[$i]['ic_new_time'] = "<img src='".$dmshop_board_path."/img/ic_new_time.gif' border='0' class='ic_new_time'>";

                }

            }

            $notice[$i]['ic_hit_time'] = "";
            if ($dmshop_board['bbs_hit_time']) {

                if ($row['ar_hit'] >= $dmshop_board['bbs_hit_time']) {

                    $notice[$i]['ic_hit_time'] = "<img src='".$dmshop_board_path."/img/ic_hit_time.gif' border='0' class='ic_hit_time'>";

                }

            }

            if ($row['ar_notice']) {

                $notice[$i]['number'] = "<img src='".$dmshop_board_path."/img/ic_notice.gif' border='0' class='ic_notice'>";

            }

            $notice[$i]['ic_secret'] = "";
            if ($row['ar_secret']) {

                $notice[$i]['ic_secret'] = "<img src='".$dmshop_board_path."/img/ic_secret.gif' border='0' class='ic_secret'>";

            }

        }

    }

    // 일반
    $list = array();
    $result = sql_query(" select * from {$shop['article_table']}{$bbs_id} $sql_search order by $sort limit $from_record, $rows ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

        // 링크
        $list[$i]['href'] = "board.php?bbs_id=".$bbs_id."&amp;article_id=".$row['id'].$article_href;

        // 번호
        $list[$i]['number'] = $total_count - ($page - 1) * $rows - $i;

        // 작성자, 제목, 내용
        $list[$i]['name'] = text($row['ar_name']);
        $list[$i]['ar_name'] = text($row['ar_name']);
        $list[$i]['ar_title'] = text($row['ar_title']);
        $list[$i]['ar_category'] = text($row['ar_category']);

        // 작성자
        if ($dmshop_board['bbs_name']) {

            $list[$i]['name'] = shop_article_privacy($list[$i]['ar_name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

        } else {
        // 아이디

            if ($row['user_id']) {

                $list[$i]['name'] = shop_article_privacy($row['user_id'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

            } else {

                $list[$i]['name'] = shop_article_privacy($list[$i]['ar_name'], $dmshop_board['bbs_privacy'], $dmshop_board['bbs_name']);

            }

        }

        // 관리자면
        if ($shop_user_admin) {

            // userview
            $list[$i]['name'] = shop_userview($list[$i]['user_id'], $list[$i]['name'], $list[$i]['ar_email'], $list[$i]['ar_homepage'], $list[$i]['name']);

        }

        $list[$i]['ic_new_time'] = "";
        if ($dmshop_board['bbs_new_time']) {

            if ($row['datetime'] >= date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop_board['bbs_new_time'] * 3600))) {

                $list[$i]['ic_new_time'] = "<img src='".$dmshop_board_path."/img/ic_new_time.gif' border='0' class='ic_new_time'>";

            }

        }

        $list[$i]['ic_hit_time'] = "";
        if ($dmshop_board['bbs_hit_time']) {

            if ($row['ar_hit'] >= $dmshop_board['bbs_hit_time']) {

                $list[$i]['ic_hit_time'] = "<img src='".$dmshop_board_path."/img/ic_hit_time.gif' border='0' class='ic_hit_time'>";

            }

        }

        $list[$i]['ic_answer'] = "";
        if ($row['id'] != $row['ar_id']) {

            $list[$i]['ic_answer'] = "<img src='".$dmshop_board_path."/img/ic_answer.gif' border='0' class='ic_answer'>";

        }

        $list[$i]['ic_secret'] = "";
        if ($row['ar_secret']) {

            $list[$i]['ic_secret'] = "<img src='".$dmshop_board_path."/img/ic_secret.gif' border='0' class='ic_secret'>";

        }

    }

    include_once("$dmshop_board_path/list.php");

}

// bottom 내용
if ($dmshop_board['bbs_text_bottom']) { echo "<div>".stripslashes($dmshop_board['bbs_text_bottom'])."</div>"; }

// bottom 이미지
$file = shop_design_file("board_bottom_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

if ($dmshop_board['bbs_include_bottom']) { include($dmshop_board['bbs_include_bottom']); } else { include_once("./_bottom.php"); }
?>