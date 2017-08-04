<?
if (!defined('_DMSHOP_')) exit;

if (!$upload_mode) {

    $upload_mode = "default";

}

// 설정
$dmshop_design_item = shop_design_item();

// 갤러리 썸네일 이미지
if ($dmshop_design_item['image_gallery_thumb_use'] == '0') { $dmshop_design_item['image_gallery_thumb_width'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "0"); $dmshop_design_item['image_gallery_thumb_height'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "1"); } else { $dmshop_design_item['image_gallery_thumb_width'] = $dmshop_design_item['image_gallery_thumb_width']; $dmshop_design_item['image_gallery_thumb_height'] = $dmshop_design_item['image_gallery_thumb_height']; }

// 갯수 지정
$dmshop_design_item['item_gallery'] = 8;

$k = 0;
$gallery_thumb_html = "";
$sql = " select * from $shop[item_file_table] where item_id = '".$dmshop_item['id']."' and (substring(upload_mode,1,7) = 'gallery' or upload_mode = 'default') order by upload_mode asc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $thumb = "";
    $thumb = shop_item_thumb($dmshop_item['id'], $row['upload_mode'], "", $dmshop_design_item['image_gallery_thumb_width'], $dmshop_design_item['image_gallery_thumb_height'], "2");

    if ($thumb) {

        $k++;

        // 원본
        $file_path = $shop['path']."/data/item/".shop_data_path("u", $row['datetime'])."/".$row['upload_file'];

        $gallery_thumb_html .= "<li><img alt='' src='".$thumb."' width='".$dmshop_design_item['image_gallery_thumb_width']."' height='".$dmshop_design_item['image_gallery_thumb_height']."' border='0' name='".$row['upload_mode']."'><div class='none' style='height:10px;'>&nbsp;</div></li>";

    }

}

$gallery_btn = false;

$visible = $k;

if ($visible > $dmshop_design_item['item_gallery']) {

    $visible = $dmshop_design_item['item_gallery'];
    $gallery_btn = true;

}
?>
<style type="text/css">
.bg {height:40px; background:url('<?=$dmshop_item_gallery_path?>/img/top_bg.gif') repeat-x;}
.title {font-weight:bold; line-height:40px; font-size:14px; color:#ffffff; font-family:gulim,굴림;}
body {background:url('<?=$dmshop_item_gallery_path?>/img/right_bg.gif') repeat-y top right;}

#gallery_data {width:750px; height:560px; position:relative; overflow:hidden; text-align:center;}
.gallery_thumb li {list-style:none; font-size:0px; line-height:0px; padding:0px;}
.gallery_thumb li img {border:1px solid #c5c5c5;}
.gallery_thumb li .on {border:1px solid #ff3c00;}
</style>

<div class="gallery">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="bg">
    <td width="10"></td>
    <td class="title">:: <?=$dmshop_item['item_title']?> ::</td>
    <td width="35" valign="top"><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_item_gallery_path?>/img/close_x.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div style="padding:30px;"><div id="gallery_data"></div></div></td>
    <td width="131" valign="top">
<? if ($gallery_btn) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25">
    <td align="center" class="pointer btn_prev"><img src="<?=$dmshop_item_gallery_path?>/img/btn_up.gif"></td>
</tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25"><td></td></tr>
</table>
<? } ?>

<? if ($k) { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="gallery_thumb"><ul><?=$gallery_thumb_html?></ul></div></td>
</tr>
</table>
<? } ?>

<? if ($gallery_btn) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15">
    <td align="center" valign="top" class="pointer btn_next"><img src="<?=$dmshop_item_gallery_path?>/img/btn_down.gif"></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>
</div>

<input type="hidden" id="upload_mode" value="<?=$upload_mode?>" />

<script type="text/javascript">
function loadGallery(id, upload_mode)
{

    var gallery = $("#upload_mode");

    if (upload_mode != gallery.val()) {

        $("img[name='"+gallery.val()+"']").removeClass("on");
        gallery.val(upload_mode);

    }

    $("img[name='"+upload_mode+"']").addClass("on");
    $.post("<?=$dmshop_item_gallery_path?>/gallery_data.php", {"id" : id, "upload_mode" : upload_mode}, function(data) {

        $("#gallery_data").html(data);

    });

}
</script>

<script type="text/javascript">
$(document).ready(function() {

    $(".gallery_thumb").jCarouselLite({
        btnNext: ".gallery .btn_next",
        btnPrev: ".gallery .btn_prev",
        vertical: true,
        circular: false,
        speed: 300,
        visible: <?=(int)($visible);?>
    });

    $(".gallery_thumb img").mouseover(function() {
        loadGallery("<?=$dmshop_item['id']?>", $(this).attr("name"));
        $(this).addClass("on");
    }).mouseout(function(){
        //$(this).removeClass("on");
    });

    loadGallery("<?=$dmshop_item['id']?>", "<?=$upload_mode?>");

});
</script>