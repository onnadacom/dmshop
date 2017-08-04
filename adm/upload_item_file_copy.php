<?php
if (!defined('_DMSHOP_')) exit;

// 대표이미지로부터 생성

// 상품 파일
$file = shop_item_file($item_id, $upload_mode);

if ($file['upload_file']) {

    // 파일 경로
    $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    // 파일이 있다면
    if (file_exists($file_path) && $file['upload_file']) {

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 삭제
    sql_query(" delete from $shop[item_file_table] where item_id = '".addslashes($item_id)."' and upload_mode = '".addslashes($upload_mode)."' ");

}

// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
$name = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $source['upload_source']);

// 접미사를 붙인 파일명
$upload['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr(md5(uniqid($shop['server_time'])),0,8).'_'.str_replace('%', '', urlencode($name)); 

// 파일 경로
$target_path = $shop['path']."/data/item/".shop_data_path("", "")."/".$upload['file'];

// 원본파일을 복사하고 퍼미션을 변경
@copy("$source_path", "$target_path");
@chmod("$target_path", 0606);

$sql_common = "";
$sql_common .= " set item_id = '".addslashes($item_id)."' ";
$sql_common .= ", upload_mode = '".addslashes($upload_mode)."' ";
$sql_common .= ", upload_source = '".addslashes($source['upload_source'])."' ";
$sql_common .= ", upload_file = '".addslashes($upload['file'])."' ";
$sql_common .= ", upload_filesize = '".$source['upload_filesize']."' ";
$sql_common .= ", upload_width = '".$source['upload_width']."' ";
$sql_common .= ", upload_height = '".$source['upload_height']."' ";
$sql_common .= ", upload_type = '".$source['upload_type']."' ";
$sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

// insert
sql_query(" insert into $shop[item_file_table] $sql_common ");
?>