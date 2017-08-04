<?php
if (!defined('_DMSHOP_')) exit;

// 파일업로드
$file_name = "file_".$upload_mode;
$file_del = $_POST["filedel_".$upload_mode];

$tmp_name = $_FILES[$file_name]['tmp_name'];
$name = $_FILES[$file_name]['name'];
$size = $_FILES[$file_name]['size'];
$error = $_FILES[$file_name]['error'];

// 덮거나 삭제라면
if (is_uploaded_file($tmp_name) || $file_del) {

    // 디자인 파일
    $file = shop_design_file($upload_mode);

    if ($file['upload_file']) {

        // 파일 경로
        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 파일이 있다면
        if (file_exists($file_path) && $file['upload_file']) {

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 삭제
        sql_query(" delete from $shop[design_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

    }

}

if (is_uploaded_file($tmp_name)) {

    $upload['source'] = $name;
    $upload['size'] = $size;

    // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
    $name = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $name);

    // 접미사를 붙인 파일명
    $upload['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr(md5(uniqid($shop['server_time'])),0,8).'_'.str_replace('%', '', urlencode($name)); 

    $dest_file = $dir .'/'. $upload['file'];

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    $error_code = move_uploaded_file($tmp_name, $dest_file) or die($error);

    // 올라간 파일의 퍼미션을 변경합니다.
    @chmod($dest_file, 0606);

    // 파일정보 (이미지)
    $upload['image'] = @getimagesize($dest_file);

/*
    if ($upload['image'][2] != '1' && $upload['image'][2] != '2' && $upload['image'][2] != '3' && $upload['image'][2] != '13') {

        // 첨부파일 삭제
        @unlink($dest_file);

        alert("jpg, gif, png, swf 파일만 업로드 가능합니다.");

    }
*/

    $sql_common = "";
    $sql_common .= " set upload_mode = '".addslashes($upload_mode)."' ";
    $sql_common .= ", upload_source = '".addslashes($upload['source'])."' ";
    $sql_common .= ", upload_file = '".$upload['file']."' ";
    $sql_common .= ", upload_filesize = '".$upload['size']."' ";
    $sql_common .= ", upload_width = '".$upload['image'][0]."' ";
    $sql_common .= ", upload_height = '".$upload['image'][1]."' ";
    $sql_common .= ", upload_type = '".$upload['image'][2]."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[design_file_table] $sql_common ");

}
?>