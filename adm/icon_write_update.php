<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 파일 업로드 경로
$dir = $shop['path']."/data/icon/".shop_data_path("", "");

// 디렉토리 생성 및 퍼미션 변경
@mkdir("$dir", 0707);
@chmod("$dir", 0707);

// insert
if ($m == '') {

    if ($_POST['list_count']) {

        // 돌려요
        for ($i=0; $i<=$_POST['list_count']; $i++) {

            // 레이어 공개한 것만
            if ($_POST["list".$i."_mode"]) {

                $file_name = "list".$i."_file";

                $tmp_name = $_FILES[$file_name]['tmp_name'];
                $name = $_FILES[$file_name]['name'];
                $size = $_FILES[$file_name]['size'];
                $error = $_FILES[$file_name]['error'];

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

                    if ($upload['image'][2] != '1' && $upload['image'][2] != '2' && $upload['image'][2] != '3') {

                        // 첨부파일 삭제
                        @unlink($dest_file);

                        alert("jpg, gif, png 파일만 업로드 가능합니다.");

                    }

                    $sql_common = "";
                    $sql_common .= " set title = '".addslashes($_POST["list".$i."_title"])."' ";
                    $sql_common .= ", view = '1' ";
                    $sql_common .= ", upload_source = '".addslashes($upload['source'])."' ";
                    $sql_common .= ", upload_file = '".$upload['file']."' ";
                    $sql_common .= ", upload_filesize = '".$upload['size']."' ";
                    $sql_common .= ", upload_width = '".$upload['image'][0]."' ";
                    $sql_common .= ", upload_height = '".$upload['image'][1]."' ";
                    $sql_common .= ", upload_type = '".$upload['image'][2]."' ";
                    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

                    // 등록
                    sql_query(" insert into $shop[icon_file_table] $sql_common ");

                }

            }

        } // end for

    } // end if

    alert_close("등록을 완료하였습니다.");

}

// update
else if ($m == 'u') {

    if (!$_POST['icon_id']) {

        alert("아이콘이 삭제되었거나 존재하지 않습니다.");

    }

    // 상품 아이콘
    $dmshop_icon = shop_icon_file(addslashes($_POST['icon_id']));

    if (!$dmshop_icon['id']) {

        alert("아이콘이 삭제되었거나 존재하지 않습니다.");

    }

    $file_name = "file";
    $file_del = $_POST['file_del'];

    $tmp_name = $_FILES[$file_name]['tmp_name'];
    $name = $_FILES[$file_name]['name'];
    $size = $_FILES[$file_name]['size'];
    $error = $_FILES[$file_name]['error'];

    // 덮거나 삭제라면
    if (is_uploaded_file($tmp_name) || $file_del) {

        // 데이터
        $file = shop_icon_file(addslashes($_POST['icon_id']));

        if ($file['upload_file']) {

            // 파일 경로
            $file_path = $shop['path']."/data/icon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 파일이 있다면
            if (file_exists($file_path) && $file['upload_file']) {

                // 첨부파일 삭제
                @unlink($file_path);

                $sql_common = "";
                $sql_common .= " set title = '' ";
                $sql_common .= ", upload_source = '' ";
                $sql_common .= ", upload_file = '' ";
                $sql_common .= ", upload_filesize = '' ";
                $sql_common .= ", upload_width = '' ";
                $sql_common .= ", upload_height = '' ";
                $sql_common .= ", upload_type = '' ";
                $sql_common .= ", datetime = '' ";

                // update
                sql_query(" update $shop[icon_file_table] $sql_common where id = '".addslashes($_POST['icon_id'])."' ");

            }

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

        if ($upload['image'][2] != '1' && $upload['image'][2] != '2' && $upload['image'][2] != '3') {

            // 첨부파일 삭제
            @unlink($dest_file);

            alert("jpg, gif, png 파일만 업로드 가능합니다.");

        }

        $sql_common = "";
        $sql_common .= " set upload_source = '".addslashes($upload['source'])."' ";
        $sql_common .= ", upload_file = '".$upload['file']."' ";
        $sql_common .= ", upload_filesize = '".$upload['size']."' ";
        $sql_common .= ", upload_width = '".$upload['image'][0]."' ";
        $sql_common .= ", upload_height = '".$upload['image'][1]."' ";
        $sql_common .= ", upload_type = '".$upload['image'][2]."' ";
        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

        // update
        sql_query(" update $shop[icon_file_table] $sql_common where id = '".addslashes($_POST['icon_id'])."' ");

    }

    // update
    sql_query(" update $shop[icon_file_table] set title = '".addslashes($_POST['title'])."' where id = '".addslashes($_POST['icon_id'])."' ");

}

// delete
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[icon_file_table] where id = '".addslashes($_POST['icon_id'])."' ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/icon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[icon_file_table] where id = '".addslashes($_POST['icon_id'])."' ");

} else {

    alert("아이콘이 삭제되었거나 존재하지 않습니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>