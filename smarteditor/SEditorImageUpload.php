<?
include_once("./_dmshop.php");
if ($id) { $id = preg_match("/^[a-zA-Z0-9_\-]+$/", $id) ? $id : ""; }

$upload_max_filesize = ini_get('upload_max_filesize');

// 파일 업로드 경로
$dir = $shop['path']."/data/smarteditor/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

$file_upload_msg = "";
$tmp_file = $_FILES['update_image']['tmp_name'];
$filename = $_FILES['update_image']['name'];
$filesize = $_FILES['update_image']['size'];

// 서버에 설정된 값보다 큰파일을 업로드 한다면
if ($filename) {

    if ($_FILES[update_image][error][$i] == 1) {

        $file_upload_msg .= "\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n";
        continue;

    }

    else if ($_FILES[update_image][error][$i] != 0) {

        $file_upload_msg .= "\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n";
        continue;

    }

}

if (is_uploaded_file($tmp_file)) {

    $upload['source'] = $filename;
    $upload['filesize'] = $filesize;

    // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

    shuffle($chars_array);
    $shuffle = implode("", $chars_array);

    $upload['file'] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

    $dest_file = $dir .'/'. $upload['file'];

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['file']['error']);

    // 올라간 파일의 퍼미션을 변경합니다.
    @chmod($dest_file, 0606);

    // 파일정보 (이미지)
    $upload['image'] = @getimagesize($dest_file);

    if ($upload['image'][2] != '1' && $upload['image'][2] != '2' && $upload['image'][2] != '3') {

        // 첨부파일 삭제
        @unlink($dest_file);

        alert("jpg, gif, png 파일만 업로드 가능합니다.");

    }

}
?>
<script type="text/javascript">
parent.parent.smarteditorImageAdd("<?=$id?>", "<?=$shop['time_ymd']?>", "<?=$upload['file']?>");
</script>

<script type="text/javascript">
parent.parent.oEditors.getById["<?=$id?>"].exec("SE_TOGGLE_IMAGEUPLOAD_LAYER");
</script>