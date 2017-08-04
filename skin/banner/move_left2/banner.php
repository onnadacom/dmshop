<?
if (!defined('_DMSHOP_')) exit;

$ba_width = 0;
$ba_height = 0;
$max_width = 0;
$move_width = 0;
$html = "";
$k = 0;
for ($i=0; $i<count($list); $i++) {

    $k++;

    $max_width += $list[$i]['ba_width'];

    if ($i == '0') {

        $ba_width = $list[$i]['ba_width'];
        $ba_height = $list[$i]['ba_height'];

    }

    if ($i > '0') {

        $move_width += $list[$i]['ba_width'];

    }

    $html .= "var ".$this_id."_ba_width_".$k." = '".$move_width."';\n";

}
?>
<style type="text/css">
#<?=$this_id?> {clear:both;}
#<?=$this_id?> {position:relative; left:0; top:0; overflow:hidden; width:<?=(int)($ba_width);?>px; height:<?=(int)($ba_height);?>px;}
#<?=$this_id?> .image div {position:absolute; left:0; top:0; width:<?=$max_width?>px;}
#<?=$this_id?> .bg {position:absolute; left:0; bottom:0; width:100%; height:72px; background-color:#000000; display:none;}
#<?=$this_id?> .list {position:absolute; left:0; bottom:9px; width:100%; display:none;}
#<?=$this_id?> .box {position:relative; left:-50%; float:right;}
#<?=$this_id?> ul {position:relative; left:50%; float:left;}
#<?=$this_id?> li {float:left; margin:0 3px;}
#<?=$this_id?> li {line-height:0px; font-size:0px;}
#<?=$this_id?> li img {border:1px solid #000000;}
</style>

<div id="<?=$this_id?>">

<div class="image">
<div><? $k = 0; for ($i=0; $i<count($list); $i++) { $k++; ?><? if ($list[$i]['ba_url']) { ?><a href="<?=$list[$i]['ba_url']?>" target="<?=$list[$i]['target']?>" onclick="bannerClick('<?=$list[$i]['id']?>');"><? } ?><?=shop_banner_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], $list[$i]['ba_width'], $list[$i]['ba_height'], $list[$i]['ba_width'], "");?><? if ($list[$i]['ba_url']) { ?></a><? } ?><? } ?></div>
</div>

<div class="bg"></div>

<div class="list">

    <div class="box"><ul><? $k = 0; for ($i=0; $i<count($list); $i++) { $k++; ?><li name="<?=$k?>"><?=shop_banner_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], 81, 52, "81", "");?></li><? } ?></ul></div>

</div>

</div>

<script type="text/javascript">
<?=$html?>
</script>

<? if ($i) { ?>
<script type="text/javascript">
$(function() {

    $("#<?=$this_id?>").banner({
        num: 1,
        time: <?=$time?>,
        end: <?=$k?>,
        type: 'move_left',
        speed: 500,
        auto: true
    });

});
</script>
<? } ?>