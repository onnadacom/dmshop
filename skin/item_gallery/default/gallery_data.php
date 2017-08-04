<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($id) { $id = preg_match("/^[a-zA-Z0-9]+$/", $id) ? $id : ""; }
if ($upload_mode) { $upload_mode = preg_match("/^[a-zA-Z0-9_]+$/", $upload_mode) ? $upload_mode : ""; }

$file = shop_item_file($id, $upload_mode);

$upload_file = "";
if ($file['upload_file']) {

    // 파일 경로
    $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    // 파일이 있다면
    if (file_exists($file_path) && $file['upload_file']) {

        $upload_file = $file_path;

    } else {

        $upload_file = "";

    }

}

$layer_width = 750;
$layer_height = 560;

if ($upload_file) {

    echo "<img src='".$upload_file."' id='image_default'>";

} else {

    echo "<img src='' id='image_default'>";

}
?>
<script type="text/javascript">
$(document).ready(function() {

    var image = $("#image_default");

<? if ($file['upload_width'] > $file['upload_height']) { ?>
    if (<?=$file['upload_width']?> > <?=$layer_width?>) {

        image.animate( { 'width': '<?=$layer_width?>px'}, 100 );

    }
<? } ?>

<? if ($file['upload_width'] <= $file['upload_height']) { ?>
    if (<?=$file['upload_height']?> > <?=$layer_height?>) {

        image.animate( { 'height': '<?=$layer_height?>px'}, 100 );

    }
<? } ?>

});
</script>