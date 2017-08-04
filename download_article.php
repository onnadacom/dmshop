<?
include_once("./_dmshop.php");
if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

if (!$id || !$bbs_id) {

    message("<p class='title'>알림</p><p class='text'>파일이 삭제되었거나 존재하지 않습니다.</p>", "b");

}

$dmshop_board = shop_board($bbs_id);

if (!$dmshop_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "b");

}

// 다운권한
if ($dmshop_board['bbs_download_level'] > '1') {

    if ($shop_user_login) {

        if ($dmshop_user['user_level'] < $dmshop_board['bbs_download_level']) {

            message("<p class='title'>알림</p><p class='text'>다운로드할 권한이 없습니다.</p>", "b");

        }

    } else {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

    }

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

$file = shop_article_file_id($id);

if (!$file['upload_file']) {

    message("<p class='title'>알림</p><p class='text'>파일 정보가 존재하지 않습니다.</p>", "b");

}

$filepath = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];
$filepath = addslashes($filepath);

if (!is_file($filepath) || !file_exists($filepath)) {

    message("<p class='title'>알림</p><p class='text'>파일이 존재하지 않습니다.</p>", "b");

}

@include_once("$dmshop_board_path/download_article.php");

// 다운로드수 증가
sql_query(" update $shop[article_file_table] set upload_download = upload_download + 1 where id = '".$id."' ");

/*
if (preg_match("/^utf/i", $shop[charset]))
    $original = urlencode($file[upload_source]);
else
    $original = $file[upload_source];
*/

if (preg_match("/msie/i", $_SERVER[HTTP_USER_AGENT])) {

    $original = addslashes(urlencode($file['upload_source']));

} else {

    $original = addslashes($file['upload_source']);

}

if (preg_match("/msie/i", $_SERVER[HTTP_USER_AGENT]) && preg_match("/5\.5/", $_SERVER[HTTP_USER_AGENT])) {

    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");

} else {

    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");

}

header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen("$filepath", "rb");

while(!feof($fp)) {

    echo fread($fp, 100*1024);
    flush();

}

fclose ($fp);
flush();
?>