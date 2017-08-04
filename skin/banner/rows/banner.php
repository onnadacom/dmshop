<?
if (!defined('_DMSHOP_')) exit;
?>
<div id="<?=$this_id?>" style="clear:both;">
<? $k = 0; for ($i=0; $i<count($list); $i++) { $k++; ?><div style="clear:both;"><? if ($list[$i]['ba_url']) { ?><a href="<?=$list[$i]['ba_url']?>" target="<?=$list[$i]['target']?>" onclick="bannerClick('<?=$list[$i]['id']?>');"><? } ?><?=shop_banner_view($list[$i]['upload_datetime'], $list[$i]['upload_file'], $list[$i]['ba_width'], $list[$i]['ba_width'], "", "");?><? if ($list[$i]['ba_url']) { ?></a><? } ?></div><? } ?>
</div>