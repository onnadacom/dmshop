<?
include_once("./_dmshop.php");
if ($upload_mode) { $upload_mode = preg_match("/^[0-9]+$/", $upload_mode) ? $upload_mode : ""; }

if (!$upload_mode) {

    message("<p class='title'>알림</p><p class='text'>파일이 삭제되었거나 존재하지 않습니다.</p>", "b");

}

$file = shop_help_file($upload_mode);

if (!$file['upload_file']) {

    message("<p class='title'>알림</p><p class='text'>파일 정보가 존재하지 않습니다.</p>", "b");

}

// 관리자가 아니라면 권한 체크를 해준다.
if (!$shop_user_admin) {

    $dmshop_help = shop_help($file['upload_mode']);

    if (!$dmshop_help['id']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 세션 체크
    $ss_name = "help_view_".$dmshop_help['id'];
    if (!shop_get_session($ss_name)) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

}

$filepath = $shop['path']."/data/help/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];
$filepath = addslashes($filepath);

if (!is_file($filepath) || !file_exists($filepath)) {

    message("<p class='title'>알림</p><p class='text'>파일이 존재하지 않습니다.</p>", "b");

}

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