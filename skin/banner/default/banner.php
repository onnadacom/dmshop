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

    if ($k && $k%$mod == '0') {

        echo "</tr>";
        echo "<tr>";

    }

    echo "<td width='".$width."' valign='top'>";

    if ($list[$i]['ba_url']) {

        echo "<a href='".$list[$i]['ba_url']."' target='".$list[$i]['target']."' onclick=\"bannerClick('".$list[$i]['id']."');\">";

    }

    echo shop_banner_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], $list[$i]['ba_width'], $list[$i]['ba_width'], "", "");

    if ($list[$i]['ba_url']) {

        echo "</a>";

    }

    echo "</td>";

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
</div>

<? if ($i) { ?>
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
<? } ?>