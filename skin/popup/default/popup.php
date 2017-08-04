<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.popup {position:absolute; display:none;}
.popup .outside {border:1px solid #dbdbdb; padding:5px;}

.popup .box1 {width:5px; height:5px; background:url('<?=$dmshop_popup_path?>/img/box1.png') no-repeat;}
.popup .box2 {height:4px; background:url('<?=$dmshop_popup_path?>/img/box2.png') repeat-x;}
.popup .box3 {width:5px; height:5px; background:url('<?=$dmshop_popup_path?>/img/box3.png') no-repeat;}
.popup .box4 {width:4px; background:url('<?=$dmshop_popup_path?>/img/box4.png') repeat-y;}
.popup .box5 {width:4px; background:url('<?=$dmshop_popup_path?>/img/box5.png') repeat-y;}
.popup .box6 {width:5px; height:5px; background:url('<?=$dmshop_popup_path?>/img/box6.png') no-repeat;}
.popup .box7 {height:5px; background:url('<?=$dmshop_popup_path?>/img/box7.png') repeat-x;}
.popup .box8 {width:5px; height:5px; background:url('<?=$dmshop_popup_path?>/img/box8.png') no-repeat;}

.popup .boxcolor {background-color:#ffffff;}
.popup .inside {padding:1px 5px 0 1px;}

.popup p.close1 {margin-left:10px;}
.popup p.close1 a {text-decoration:underline; line-height:40px; font-size:12px; color:#787878; font-family:dotum,돋움;}
.popup p.close2 {margin-right:15px; text-decoration:none; line-height:40px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.popup p.close2 a {text-decoration:none; line-height:40px; font-size:12px; color:#000000; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
function popupClose(id, mode)
{

    if (mode == 'cookie') {

        $.cookie('popup_'+id, 'ok', { expires: 1, path: '/' });

    }

    $('#popup_'+id).hide();

}

function popupLoad(id)
{

    if ($.cookie('popup_'+id) != 'ok') {

        $('#popup_'+id).show();

    }

}
</script>

<?
$popup_load = "";
for ($i=0; $i<count($list); $i++) {

    $popup_load .= "popupLoad('".$list[$i]['id']."');";

    $popup_index = (int)(99999 + $list[$i]['pop_position']);

    if ($i == '0') {

        echo "<script type='text/javascript'>var popup_index = '".$popup_index."';</script>\n";

    }
?>
<div id="popup_<?=$list[$i]['id']?>" class="popup" style="z-index:<?=$popup_index?>; left:<?=$list[$i]['pop_left']?>px; top:<?=$list[$i]['pop_top']?>px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="box1"></td>
    <td class="box2"></td>
    <td class="box3"></td>
</tr>
<tr>
    <td class="box4"></td>
    <td class="boxcolor">
<div class="inside" style="width:<?=$list[$i]['pop_width']?>px; height:<?=$list[$i]['pop_height']?>px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
if ($list[$i]['pop_url']) {

    echo "<a href='".shop_http($list[$i]['pop_url'])."' target='".$list[$i]['target']."'>";

}

echo shop_popup_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], $list[$i]['upload_width'], $list[$i]['upload_height'], "", "");

if ($list[$i]['pop_url']) {

    echo "</a>";

}

echo text2($list[$i]['pop_text'], 1);
?>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><p class="close1"><a href="#" onclick="popupClose('<?=$list[$i]['id']?>', 'cookie'); return false;">오늘 하루 이 창을 열지 않음</a></p></td>
    <td width="60" align="right"><p class="close2"><a href="#" onclick="popupClose('<?=$list[$i]['id']?>', 'hide'); return false;">닫기 <img src="<?=$dmshop_popup_path?>/img/close.gif" border="0"></a></p></td>
</tr>
</table>
    </td>
    <td class="box5"></td>
</tr>
<tr>
    <td class="box6"></td>
    <td class="box7"></td>
    <td class="box8"></td>
</tr>
</table>
</div>
<? } ?>

<script type="text/javascript">
$(function() {

    $(".popup").mousedown(function() {

        popup_index = parseInt(popup_index + 1);

        $(this).css({ 'zIndex' : popup_index });

    });

    <?=$popup_load?>

});

$(document).ready(function() {
    $('.popup').draggable({ handle: '.handler' });
});
</script>