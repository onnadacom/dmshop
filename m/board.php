<?php
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

        shop_url("$shop[mobile_url]/signin.php?url={$urlencode}");

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

            shop_url("$shop[mobile_url]/signin.php?url={$urlencode}");

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

                message("<p class='title'>알림</p><p class='text'>내가 쓴 비밀글이 아니거나, PC버전에서만 열람이 가능합니다.</p>", "b");

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

include_once("./_top.php");
?>
<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>
<?
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

    $board_pages = shop_paging_board("5", $page, $total_page, "?bbs_id=".$bbs_id."&amp;bbs_category=".$bbs_category."&amp;f=".$f."&amp;q=".$q."&amp;page=");

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
?>
<style type="text/css">
.board_list .input {height:19px; border:1px solid #d5d5d5; padding:0px 3px 0px 3px;}
.board_list .input {line-height:19px; font-size:14px; color:#414141; font-family:gulim,굴림;}

.board_list .category_title {width:40px; text-align:center; line-height:30px; font-size:13px; color:#787878; font-family:dotum,돋움;}

.board_list .ar_category a {margin-left:10px; line-height:40px; font-size:14px; color:#9e9e9e; font-family:gulim,굴림;}
.board_list .ar_title {height:40px; overflow:hidden; width:100%; overflow:hidden; text-overflow:ellipsis; word-break:break-all;}
.board_list .ar_title a {display:block; padding:0 10px; line-height:40px; font-size:14px; color:#3a3a3a; font-family:gulim,굴림;}
.board_list .not {text-align:center; line-height:14px; font-size:14px; color:#787878; font-family:gulim,굴림;}


.board_view .btn_text {line-height:16px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .btn_line {width:16px; text-align:center; line-height:16px; font-size:10px; color:#efefef; font-family:dotum,돋움;}
.board_view .ic_prev {position:relative; overflow:hidden; left:0; top:-2px; margin-right:4px;}
.board_view .ic_next {position:relative; overflow:hidden; left:0; top:-2px; margin-right:4px;}
.board_view .category_line {width:17px; text-align:center; line-height:35px; font-size:11px; color:#bebebe; font-family:dotum,돋움;}
.board_view .ar_category {line-height:35px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.board_view .ar_title p {margin:9px 0 7px 0; font-weight:bold; line-height:18px; font-size:13px; color:#444444; font-family:gulim,굴림;}
.board_view .ar_title .ic_answer {position:relative; overflow:hidden; left:0; top:2px; margin:0 10px 0 0px;}
.board_view .ar_title .ic_new_time {margin-left:5px;}
.board_view .ar_title .ic_hit_time {margin-left:5px;}
.board_view .ar_title .ic_secret {position:relative; overflow:hidden; left:0; top:2px; margin-left:5px;}
.board_view .name_title {line-height:30px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.board_view .name_line {width:16px; text-align:center; line-height:30px; font-size:10px; color:#efefef; font-family:dotum,돋움;}
.board_view .ar_name {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ar_date {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ar_hit {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ic_file {position:relative; overflow:hidden; left:0; top:3px; margin-right:5px;}
.board_view .upload_source {line-height:30px; font-size:12px; color:#2800bb; font-family:gulim,굴림;}
.board_view .upload_filesize {line-height:30px; font-size:12px; color:#9274ff; font-family:dotum,돋움;}

#article_content {padding:15px 10px 50px 10px;}
#article_content {line-height:160%; font-size:12px; color:#000000; font-family:dotum,돋움;}
#article_content p {margin-top:0px; margin-bottom:0px;}
</style>
<? if ($article_id) { ?>

<script type="text/javascript">
function articleDelete()
{

    var f = document.formView;

    f.m.value = "d";

    if (confirm("게시물을 삭제하시겠습니까?")) {

        f.action = "./board_write_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<? if ($shop_user_admin) { ?>
<script type="text/javascript">
function articleMove()
{

    shopOpen("./board_move.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>","board_move","width=650, height=650, scrollbars=1");

}
</script>
<? } ?>

<form method="post" name="formView" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="<?=$article_id?>" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<? ob_start(); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_view">
<tr>
    <td valign="top" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$dmshop_article['href']?>"><img src="<?=$dmshop_board_path?>/img/btn_list.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
<?
$article_button = ob_get_contents();
ob_end_flush();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="7"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bebebe" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_view">
<tr bgcolor="#fdfdfd">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td class="ar_category"><?=$dmshop_article['ar_category']?></td>
    <td class="category_line">|</td>
<? } ?>
    <td class="ar_title"><p><?=$dmshop_article['ic_answer']?><?=$dmshop_article['ar_title']?><?=$dmshop_article['ic_secret']?><?=$dmshop_article['ic_new_time']?><?=$dmshop_article['ic_hit_time']?></p></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="name_title">작성자</td>
    <td width="5"></td>
    <td class="ar_name"><?=$dmshop_article['name']?></td>
    <td class="name_line">|</td>
    <td class="name_title">작성일시</td>
    <td width="5"></td>
    <td class="ar_date"><?=date("Y-m-d H:i", strtotime($dmshop_article['datetime']));?></td>
    <td class="name_line">|</td>
    <td class="name_title">조회</td>
    <td width="5"></td>
    <td class="ar_hit"><?=number_format($dmshop_article['ar_hit']);?></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<?
$n = 0;
$article_file_view = "";
for ($i=0; $i<count($article_file); $i++) {

    $n++;

    // 이미지, 플래시, 동영상, 음악파일은 본문에 노출!
    if (preg_match("/\.(jp[e]?g|gif|png|swf|asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3)$/i", $article_file[$i]['upload_file'])) { $article_file_view .= "<p>".shop_article_file_view($bbs_id, $article_file[$i]['datetime'], $article_file[$i]['upload_file'], $article_file[$i]['upload_width'], $article_file[$i]['upload_height'], $dmshop_board['bbs_view_image'], "")."<br /></p>"; }
?>
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="name_title">첨부파일<? if (count($article_file) > '1') { echo " #".$n; } ?></td>
    <td width="10"></td>
    <td><img src="<?=$dmshop_board_path?>/img/ic_file.gif" class="ic_file"><a href="./download_article.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>&id=<?=$article_file[$i]['id']?>"><span class="upload_source"><?=filter1($article_file[$i]['upload_source']);?> <span class="upload_filesize">(<?=shop_filesize($article_file[$i]['upload_filesize'])?>)</span></a></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="300">
    <td valign="top"><div id="article_content"><?=$article_file_view?><?=$dmshop_article['ar_content']?></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<?=$article_button?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

<script type="text/javascript">
window.onload=function() { shopResizeImage(<?=$dmshop_board['bbs_view_image']?>); }
</script>

<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td width="300">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="category_title">분류</td>
    <td class="category">
<select id="bbs_category" name="bbs_category" class="select" onchange="document.location.href='./board.php?bbs_id=<?=$bbs_id?>&bbs_category='+this.value;">
    <option value="">전체</option>
<?
$row = explode("|", $dmshop_board['bbs_category']);
for ($i=0; $i<count($row); $i++) {

    echo "<option value='".$row[$i]."'>".$row[$i]."</option>";

}
?>
</select>

<script type="text/javascript">
<? if ($bbs_category) { ?>document.getElementById("bbs_category").value = "<?=$bbs_category?>";<? } ?>
</script>
    </td>
</tr>
</table>
    </td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr><td height="1" bgcolor="#dedede"></td></tr>
<!-- notice start //-->
<? for ($i=0; $i<count($notice); $i++) { ?>
<tr <? if ($article_id && $notice[$i]['id'] == $article_id) { echo "style='background-color:#f2f8fa;';"; } ?>>
    <td class="ar_title"><a href="<?=$notice[$i]['href']?>" title="<?=$notice[$i]['ar_title']?>"><?=shop_text_cut($notice[$i]['ar_title'], $dmshop_board['bbs_sub_len'], "…");?></a></td>
</tr>
<tr><td height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
<!-- notice end //-->
<? for ($i=0; $i<count($list); $i++) { ?>
<tr <? if ($article_id && $list[$i]['id'] == $article_id) { echo "style='background-color:#f2f8fa;';"; } ?>>
    <td class="ar_title"><a href="<?=$list[$i]['href']?>" title="<?=$list[$i]['ar_title']?>"><?=shop_text_cut($list[$i]['ar_title'], $dmshop_board['bbs_sub_len'], "…");?><?=$list[$i]['ic_secret']?></a></td>
</tr>
<tr><td height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
<? if (!count($list)) { ?>
<tr height="200">
    <td  class="not">등록된 게시물이 없습니다.</td>
</tr>
<tr><td  height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr height="40">
    <td><?=$board_pages?></td>
<? if ($dmshop_board['btn_write']) { ?>
    <td width="75"><a href="./board_write.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_write.gif" border="0"></a></td>
    <td width="10"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
<tr height="20"><td></td></tr>
</table>

<form method="get" name="formSearch" action="board.php" onSubmit="return articleSearch();" autocomplete="off">
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="ar_category" value="<?=$ar_category?>" />
<table border="0" cellspacing="0" cellpadding="0" class="board_list auto">
<tr>
    <td class="search">
<select id="f" name="f" class="select">
    <option value="ar_title">제목</option>
    <option value="ar_content">내용</option>
    <option value="ar_name">작성자</option>
    <option value="user_id">아이디</option>
</select>

<script type="text/javascript">
<? if ($f) { ?>document.getElementById("f").value = "<?=$f?>";<? } ?>
</script>

<script type="text/javascript">$(document).ready( function() { $(".board_list .search select").selectBox(); });</script>
    </td>
    <td width="3"></td>
    <td><input type="text" name="q" value="<?=$q?>" class="input" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$dmshop_board_path?>/img/btn_search.gif" border="0" /></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

<script type="text/javascript">
function articleSearch()
{
    return true;

}
</script>




<?
}

include_once("./_bottom.php");
?>