<?
if (!defined('_DMSHOP_')) exit;

$mod = (int)($count_width);
$width = (int)(100 / $count_width)."%";
?>
<div id="<?=$this_id?>" style="clear:both;">
<? for ($n=1; $n<=$rolling_max; $n++) { ?>
<div class="box rolling_<?=$n?>" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<?
$k = 0;
for ($i=$rolling_start[$n]; $i<=$rolling_end[$n]; $i++) {

    $item_link = $shop['path']."/item.php?id=".$list[$i]['item_code'];

    $thumb = "";
    $thumb = shop_item_thumb($list[$i]['id'], "", "default", $thumb_width, $thumb_height, "2");

    if ($thumb) {

        $img = "<img src='".$thumb."'  border='0'>";

    } else {

        $img = "<img src='".$dmshop_showwindow_path."/img/noimage.gif' border='0'>";

    }

    if ($k && $k%$mod == '0') {

        echo "</tr>\n";
        echo "<tr height='20'><td colspan='".(int)(($mod * 2) - 1)."'></td></tr>\n";
        echo "<tr>\n";

    }

    echo "<td width='".$width."' valign='top'>";
    echo "<table width='".$thumb_width."' border='0' cellspacing='0' cellpadding='0' style='table-layout:fixed;'><tr><td>";

    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td style='background-color:#fafafa; width:".$thumb_width."px; height:".$thumb_height."px; text-align:center;'><a href='".$item_link."'>".$img."</a></td></tr></table>";
    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td height='8'></td></tr></table>";
    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td><a href='".$item_link."' style='line-height:16px; font-size:11px; color:#555555; font-family:dotum,돋움;'>".filter1($list[$i]['item_title'], 0, $title_len)."</a></td></tr></table>";
    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td height='4'></td></tr></table>";
    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td><span style='line-height:14px; font-size:11px; color:#ff3c00; font-family:dotum,돋움;'><b>".number_format($list[$i]['item_money'])."</b>원</span></td></tr></table>";
    echo "<table border='0' cellspacing='0' cellpadding='0'><tr><td height='4'></td></tr></table>";

    echo "</td></tr></table>";
    echo "</td>\n";

    $k++;

}

$cnt = $k%$mod;
if ($cnt) {

    for ($k=$cnt; $k<$mod; $k++) {

        echo "<td width='".$thumb_width."'>&nbsp;</td>";

    }

}
?>
</tr>
</table>
</div>
<? } ?>
<? if (count($list) == '0') { ?><p style='text-align:center; line-height:21px; font-size:11px; color:#555555; font-family:dotum,돋움;'>등록된 상품이 없습니다.</p><? } ?>
</div>

<script type="text/javascript">
$(function() {

    $("#<?=$this_id?>").showwindow({
        num: 1,
        time: <?=$time?>,
        end: <?=$rolling_max?>,
        type: 'show',
        speed: 0,
        auto: true
    });

});
</script>