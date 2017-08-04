<?
include_once("./_dmshop.php");

// 관리자
if (!$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>관리자로 로그인하여주세요.</p>", "c");

}

if (!$bbs_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

$dmshop_board = shop_board($bbs_id);

if (!$dmshop_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "c");

}

if (!$dmshop_board['bbs_skin']) {

    message("<p class='title'>알림</p><p class='text'>게시판 스킨이 설정되지 않았습니다.</p>", "c");

}

if ($article_id) {

    $chk_id = "0";
    $chk_article_id[$chk_id] = $article_id;

}

$n = 0;
$list = array();
for ($i=0; $i<count($chk_id); $i++) {

    $k = $chk_id[$i];

    if ($bbs_id && $chk_article_id[$k]) {

        $dmshop_article = shop_article($bbs_id, $chk_article_id[$k]);

        if ($dmshop_article['id']) {

            $list[$n] = $dmshop_article;
            $list[$n]['ar_title'] = text(stripslashes($dmshop_article['ar_title']));
            $list[$n]['ar_name'] = text($dmshop_article['ar_name']);

            $n++;

        }

    }

}

$dmshop_board_option = "";
$result = sql_query(" select * from $shop[board_table] where bbs_id != '".$bbs_id."' order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_board_option .= "<option value='".$row['bbs_id']."'>".$row['bbs_title']." (".$row['bbs_id'].")</option>\n";

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

// 타이틀 제목
$shop['title'] = "게시물 이동";

// 페이지 아이디
$page_id = $bbs_id;

include_once("./shop.top.php");
include_once("$dmshop_board_path/move.php");
include_once("./shop.bottom.php");
?>