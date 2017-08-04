<?php
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 게시판 ##
--------------------------------*/

// 게시판
function shop_board($bbs_id)
{

    global $shop;

    if ($bbs_id) { $bbs_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $bbs_id) ? $bbs_id : ""; }

    if (!$bbs_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[board_table] where bbs_id = '$bbs_id' ");

}

// 게시물
function shop_article($bbs_id, $article_id)
{

    global $shop;

    if ($bbs_id) { $bbs_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $bbs_id) ? $bbs_id : ""; }
    if ($article_id) { $article_id = preg_match("/^[0-9]+$/", $article_id) ? $article_id : ""; }

    if (!$bbs_id || !$article_id) {

        return false;

    }

    return sql_fetch(" select * from {$shop['article_table']}{$bbs_id} where id = '".$article_id."' ");

}

// 새글
function shop_article_today($bbs_id)
{

    global $shop;

    if ($bbs_id) { $bbs_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $bbs_id) ? $bbs_id : ""; }

    if (!$bbs_id) {

        return false;

    }

    $data = sql_fetch(" select count(*) as total_count from {$shop['article_table']}{$bbs_id} where substring(datetime,1,10) = '".$shop['time_ymd']."' ");

    return (int)($data['total_count']);

}

// 프라이버시
function shop_article_privacy($name, $bbs_privacy, $bbs_name)
{

    $text = shop_text($name);

    if (!$text) {

        return false;

    }

    $length = $bbs_privacy;

    if (!$length) {

        return $text;

    }

    $c = 0;
    $n = 0;
    $cut = 0;
    $data = "";
    for ($i=0; $i<strlen($text); $i++) {

        $cut++;

        $ord = ord($text[$i]);

        if ($ord < '128') {

            $c++;

        } else {

            $n++;

            if ($n == '3') {

                $c++;
                $n = 0;

            }

        }

        if ($c >= $length && !$data) {

            $data = substr($text, 0, $cut);

        }

    }

    if (!$data) {

        return $text;

    }

    $suffix = "";
    for ($i=0; $i<($c - $length); $i++) {

        $suffix .= "*";

    }

    return $data.$suffix;

}

// 첨부 파일
function shop_article_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[article_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// 첨부 파일 (아이디)
function shop_article_file_id($id)
{

    global $shop;

    if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

    if (!$id) {

        return false;

    }

    return sql_fetch(" select * from $shop[article_file_table] where id = '$id' ");

}

// file 뷰
function shop_article_file_view($bbs_id, $datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    } else {

        return false;

    }

}

// 댓글
function shop_article_reply($reply_id)
{

    global $shop;

    if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }

    if (!$reply_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[article_reply_table] where id = '".$reply_id."' ");

}

// 최신글 스킨 출력
function shop_article_skin($this_id, $skin, $bbs_id, $count_width, $count_height, $thumb_width, $thumb_height, $title_len, $rolling, $time, $order, $use_title, $use_date, $use_user, $use_reply)
{

    global $shop, $display, $display_id, $display_type, $display_list;

    $sql_search = " where id = ar_id ";

    if (!$rolling) {

        $rolling = 1;

    }

    if (!$time) {

        $time = 0;

    }

    if (!$count_width) {

        $count_width = 1;

    }

    if (!$count_height) {

        $count_height = 1;

    }

    $count = (int)($count_width * $count_height);
    $limit = (int)($count_width * $count_height * $rolling);

    $list = array();
    $k = 0;
    $n = 0;

    $list = array();
    $result = sql_query(" select * from {$shop['article_table']}{$bbs_id} $sql_search order by $order limit 0, $limit ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $k++;

        // 1개일 때
        if ($k == '1') {

            $n++;
            $rolling_max = $n;

            // 시작점 지정
            $rolling_start[$n] = $i;

        }

        // 도달
        if ($k >= $count) {

            // 리셋
            $k = 0;

        }

        // 종료점 지정
        $rolling_end[$n] = $i;

        $list[$i] = $row;
        $list[$i]['ar_name'] = text($row['ar_name']);

    }

    if (!$rolling_max) {

        $rolling_max = 0;

    }

    $dmshop_article_path = "$shop[path]/skin/article/$skin";

    ob_start();
    include("$dmshop_article_path/article.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

// 게시판목록 스킨 출력
function shop_boardbox_skin($skin="default")
{

    global $shop, $bbs_id, $display, $display_id, $display_type, $display_list;

    // 숨김은 제외
    $list = array();
    $result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

    $dmshop_boardbox_path = "$shop[path]/skin/boardbox/$skin";

    ob_start();
    include("$dmshop_boardbox_path/boardbox.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>