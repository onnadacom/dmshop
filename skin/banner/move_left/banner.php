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
#<?=$this_id?> .list {position:absolute; left:0; bottom:0px; width:100%;}
#<?=$this_id?> .btn_left {cursor:pointer; position:absolute; left:15px; top:<?=(int)((($ba_height - 35) * 0.5) - 30);?>px; width:30px; height:60px;}
#<?=$this_id?> .btn_right {cursor:pointer; position:absolute; right:15px; top:<?=(int)((($ba_height - 35) * 0.5) - 30);?>px; width:30px; height:60px;}
#<?=$this_id?> .bg1 {width:8px; height:35px; background:url('<?=$dmshop_banner_path?>/img/bg1.png') no-repeat; float:left;}
#<?=$this_id?> .bg2 {width:<?=(int)($ba_width - 16);?>px; height:35px; background:url('<?=$dmshop_banner_path?>/img/bg2.png') repeat-x; float:left;}
#<?=$this_id?> .bg3 {width:8px; height:35px; background:url('<?=$dmshop_banner_path?>/img/bg3.png') no-repeat; float:right;}

#<?=$this_id?> ul {padding:0px; margin:0px;}
#<?=$this_id?> li {height:35px; float:left; line-height:0px; font-size:0px; cursor:pointer;}

#<?=$this_id?> .btn1 {width:49px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat;}
#<?=$this_id?> .btn1_hover {width:49px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat 0 -35px;}
#<?=$this_id?> .btn2 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -49px 0;}
#<?=$this_id?> .btn2_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -49px -35px;}
#<?=$this_id?> .btn3 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -99px 0;}
#<?=$this_id?> .btn3_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -99px -35px;}
#<?=$this_id?> .btn4 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -149px 0;}
#<?=$this_id?> .btn4_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -149px -35px;}
#<?=$this_id?> .btn5 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -199px 0;}
#<?=$this_id?> .btn5_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -199px -35px;}
#<?=$this_id?> .btn6 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -249px 0;}
#<?=$this_id?> .btn6_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -249px -35px;}
#<?=$this_id?> .btn7 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -299px 0;}
#<?=$this_id?> .btn7_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -299px -35px;}
#<?=$this_id?> .btn8 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -349px 0;}
#<?=$this_id?> .btn8_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -349px -35px;}
#<?=$this_id?> .btn9 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -399px 0;}
#<?=$this_id?> .btn9_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -399px -35px;}
#<?=$this_id?> .btn10 {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -449px 0;}
#<?=$this_id?> .btn10_hover {width:50px; background:url('<?=$dmshop_banner_path?>/img/btn.png') no-repeat -449px -35px;}
</style>

<!--[if IE 6]>
<script type="text/javascript">
DD_belatedPNG.fix('#<?=$this_id?> .bg1');
DD_belatedPNG.fix('#<?=$this_id?> .bg2');
DD_belatedPNG.fix('#<?=$this_id?> .bg3');
DD_belatedPNG.fix('#<?=$this_id?> .png');
DD_belatedPNG.fix('#<?=$this_id?> .btn1');
DD_belatedPNG.fix('#<?=$this_id?> .btn2');
DD_belatedPNG.fix('#<?=$this_id?> .btn3');
DD_belatedPNG.fix('#<?=$this_id?> .btn4');
DD_belatedPNG.fix('#<?=$this_id?> .btn5');
DD_belatedPNG.fix('#<?=$this_id?> .btn6');
DD_belatedPNG.fix('#<?=$this_id?> .btn7');
DD_belatedPNG.fix('#<?=$this_id?> .btn8');
DD_belatedPNG.fix('#<?=$this_id?> .btn9');
DD_belatedPNG.fix('#<?=$this_id?> .btn10');
</script>
<![endif]-->

<div id="<?=$this_id?>">

<div class="image">
<div><? $k = 0; for ($i=0; $i<count($list); $i++) { $k++; ?><? if ($list[$i]['ba_url']) { ?><a href="<?=$list[$i]['ba_url']?>" target="<?=$list[$i]['target']?>" onclick="bannerClick('<?=$list[$i]['id']?>');"><? } ?><?=shop_banner_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], $list[$i]['ba_width'], $list[$i]['ba_height'], $list[$i]['ba_width'], "");?><? if ($list[$i]['ba_url']) { ?></a><? } ?><? } ?></div>
</div>

<div class="btn_left"><img src="<?=$dmshop_banner_path?>/img/left.png" border="0" class="png"></div>
<div class="btn_right"><img src="<?=$dmshop_banner_path?>/img/right.png" border="0" class="png"></div>

<div class="list">

    <div class="bg1"></div>
    <div class="bg2"><ul><? $k = 0; for ($i=0; $i<count($list); $i++) { $k++; ?><li name="<?=$k?>" class="btn btn<?=$k?>"></li><? } ?></ul></div>
    <div class="bg3"></div>

</div>

</div>

<script type="text/javascript">
<?=$html?>
</script>

<? if ($i) { ?>
<script type="text/javascript">
$(function() {

    $("#<?=$this_id?> li[name='1']").addClass("btn1_hover");

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