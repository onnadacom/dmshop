<?php
include_once("./_dmshop.php");
if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

if (!$id) {

    alert("파일이 삭제되었거나 존재하지 않습니다.");

}

// 데이터
$file = sql_fetch(" select * from $shop[item_file_table] where id = '$id' ");

if (!$file['upload_file']) {

    alert("파일 정보가 존재하지 않습니다.");

}

// 파일경로
$filepath = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];
$filepath = addslashes($filepath);

// 체크
if (!is_file($filepath) || !file_exists($filepath)) {

    alert("파일이 존재하지 않습니다.");

}

/*
if (preg_match("/^utf/i", $shop[charset]))
    $original = urlencode($file[upload_source]);
else
    $original = $file[upload_source];
*/

if (preg_match("/msie/i", $_SERVER[HTTP_USER_AGENT])) {

    $original = urlencode($file['upload_source']);

} else {

    $original = $file['upload_source'];

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