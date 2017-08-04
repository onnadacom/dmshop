<?
if (!defined('_DMSHOP_')) exit;

// 상품 썸네일 사이즈
$thumb_width = "80";
$thumb_height = "80";

if (!$q) {

    $q = "검색어";

}

$query = "";
$query = "검색어";
?>
<script type="text/javascript">
var query = "<?=$query?>";
</script>

<style type="text/css">
#item_preview {position:absolute; z-index:99999; left:0px; top:0px;}

.search_box .input {width:282px; height:16px; border:4px solid #cccccc; padding:5px 5px 4px 5px;}
.search_box .input {font-weight:bold; line-height:16px; font-size:14px; color:#000000; font-family:gulim,굴림;}
.search_box .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:0px;}
.search_box .title {line-height:14px; font-size:12px; color:#555555; font-family:gulim,굴림;}

.search_count .keyword {font-weight:bold; line-height:16px; font-size:14px; color:#ff1800; font-family:gulim,굴림;}
.search_count .count_list {font-weight:bold; line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}

.search_category .home {line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.search_category .off {line-height:14px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.search_category .on {font-weight:bold; line-height:14px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.search_category .title {font-weight:bold; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.search_category .text {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.search_category .input {width:60px; height:17px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.search_category .input {font-weight:bold; line-height:17px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.search_category .subject {line-height:14px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.search_category .count {margin-left:5px; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}

.search_icon .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.search_icon .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}

.search_title .bg1 {width:2px; height:30px; background:url('<?=$dmshop_search_path?>/img/title_bg1.gif') no-repeat;}
.search_title .bg2 {height:30px; background:url('<?=$dmshop_search_path?>/img/title_bg2.gif') repeat-x;}
.search_title .bg3 {width:2px; background:url('<?=$dmshop_search_path?>/img/title_bg3.gif') no-repeat;}
.search_title .count {font-weight:bold; line-height:14px; font-size:11px; color:#555555; font-family:dotum,돋움;}
.search_title .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}

.search_item .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:0px;}
.search_item .text {line-height:16px; font-size:11px; color:#787879; font-family:dotum,돋움;}
.search_item .thumb {border:2px solid #bababa;}
.search_item .thumb:hover {border:2px solid #ffa442;}
.search_item .title {font-family:gulim,굴림; font-size:13px; color:#000000; font-weight:bold; font-style:normal; text-decoration:none; }
.search_item .price {font-family:dotum,돋움; font-size:12px; color:#000000; font-weight:bold; font-style:normal; text-decoration:line-through; }
.search_item .money {font-family:dotum,돋움; font-size:12px; color:#ff0000; font-weight:bold; font-style:normal; text-decoration:none; }
.search_item .etc {letter-spacing:-1px; font-family:dotum; font-size:11px; color:#b8b8b8; font-weight:normal; font-style:normal; text-decoration:none;}
.search_item .etc_line {padding:0 4px; letter-spacing:-1px; font-size:12px; color:#d4d4d4; font-weight:normal; font-style:normal; text-decoration:none;}

.star0 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat;}
.star1 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat 0px -18px;}
.star2 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat 0px -36px;}
.star3 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat 0px -54px;}
.star4 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat 0px -72px;}
.star5 {width:85px; height:18px; background:transparent url('<?=$dmshop_search_path?>/img/reply_star.png') no-repeat 0px -90px;}

.search_not .not {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.search_cart .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}

#color_layer {display:none;}

.color_list td {width:20px; height:18px;}
.color_list a {display:block; width:14px; height:14px; border:1px solid #dddddd;}
.color_list .color_on {border:2px solid #000000;}
.color_list .color0 {width:14px; height:14px; background:url('<?=$dmshop_search_path?>/img/color.gif') no-repeat;}
.color_list .color1 {background-color:#FFFFFF;}
.color_list .color2 {background-color:#F2EAC6;}
.color_list .color3 {background-color:#F8E275;}
.color_list .color4 {background-color:#FA9A4D;}
.color_list .color5 {background-color:#F9A986;}
.color_list .color6 {background-color:#FAACA8;}
.color_list .color7 {background-color:#FC6D99;}
.color_list .color8 {background-color:#FF0000;}
.color_list .color9 {background-color:#AC2424;}
.color_list .color10 {background-color:#A746B1;}
.color_list .color11 {background-color:#C791F1;}
.color_list .color12 {background-color:#A4A6FD;}
.color_list .color13 {background-color:#1D329D;}
.color_list .color14 {background-color:#2CCACD;}
.color_list .color15 {background-color:#9CD8F4;}
.color_list .color16 {background-color:#62854F;}
.color_list .color17 {background-color:#A9CB6C;}
.color_list .color18 {background-color:#CAB775;}
.color_list .color19 {background-color:#815B10;}
.color_list .color20 {background-color:#777777;}
.color_list .color21 {background-color:#000000;}

.percent .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.percent .selectBox-dropdown {width:18px; height:18px;}
.percent .selectBox-dropdown .selectBox-label {padding:0px 5px 0px 5px;}
</style>

<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.star0');
DD_belatedPNG.fix('.star1');
DD_belatedPNG.fix('.star2');
DD_belatedPNG.fix('.star3');
DD_belatedPNG.fix('.star4');
DD_belatedPNG.fix('.star5');
</script>
<![endif]-->

<script type="text/javascript" src="<?=$dmshop_search_path?>/search.js"></script>

<div id="item_data" style="display:none;"></div>
<div id="item_preview" style="display:none;"></div>

<form method="post" name="formItem">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="cart_type" value="" />
<input type="hidden" name="item_id" value="" />
<input type="hidden" name="order_limit" value="" />
<input type="hidden" id="order_option" name="order_option" value="" />
</form>

<form method="get" name="formItemSearch" action="search.php" onSubmit="return itemSearch('');">
<input type="hidden" name="ct_id" value="<?=text($ct_id)?>" />
<input type="hidden" name="sort" value="<?=text($sort)?>" />
<input type="hidden" name="color" value="<?=text($color)?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td bgcolor="#cccccc" height="1" class="none">&nbsp;</td></tr>
<tr><td bgcolor="#ffffff" height="1" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4" class="search_box">
<tr><td height="18"></td></tr>
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="text" name="q" value="<?=text($q)?>" onmouseover=" itemSearchReset();" onfocus="itemSearchReset();" class="input" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$dmshop_search_path?>/img/search.gif" border="0"></td>
    <td width="20"></td>
    <td><input type="checkbox" name="add" value="<?=$add?>" class="checkbox" <? if (($add) && $add != $q) { echo "checked"; } ?> onclick="itemSearchAdd();" /></td>
    <td width="5"></td>
    <td class="title">결과 내 재검색</td>
    <td width="20"></td>
    <td><input type="checkbox" name="cv" value="1" class="checkbox" <? if ($cv) { echo "checked"; } ?> onclick="itemColorView();" /></td>
    <td width="5"></td>
    <td class="title">색상별 보기</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<div id="color_layer" style="display:<? if ($cv) { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td bgcolor="#e0e0e0" height="1" class="none">&nbsp;</td></tr>
<tr><td bgcolor="#ffffff" height="1" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="36">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="color_list">
<tr>
    <td><a href="#" onclick="itemColor(''); return false;" class="color0 <? if (!$color) { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('1'); return false;" class="color1 <? if ($color == '1') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('2'); return false;" class="color2 <? if ($color == '2') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('3'); return false;" class="color3 <? if ($color == '3') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('4'); return false;" class="color4 <? if ($color == '4') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('5'); return false;" class="color5 <? if ($color == '5') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('6'); return false;" class="color6 <? if ($color == '6') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('7'); return false;" class="color7 <? if ($color == '7') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('8'); return false;" class="color8 <? if ($color == '8') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('9'); return false;" class="color9 <? if ($color == '9') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('10'); return false;" class="color10 <? if ($color == '10') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('11'); return false;" class="color11 <? if ($color == '11') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('12'); return false;" class="color12 <? if ($color == '12') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('13'); return false;" class="color13 <? if ($color == '13') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('14'); return false;" class="color14 <? if ($color == '14') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('15'); return false;" class="color15 <? if ($color == '15') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('16'); return false;" class="color16 <? if ($color == '16') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('17'); return false;" class="color17 <? if ($color == '17') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('18'); return false;" class="color18 <? if ($color == '18') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('19'); return false;" class="color19 <? if ($color == '19') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('20'); return false;" class="color20 <? if ($color == '20') { echo "color_on"; } ?>"></a></td>
    <td><a href="#" onclick="itemColor('21'); return false;" class="color21 <? if ($color == '21') { echo "color_on"; } ?>"></a></td>
</tr>
</table>
    </td>
    <td class="percent">
<select id="percent" name="percent" onchange="itemSearch('search');" class="select">
    <option value="">선택</option>
    <option value="5">5%</option>
    <option value="10">10%</option>
    <option value="20">20%</option>
    <option value="30">30%</option>
    <option value="40">40%</option>
    <option value="50">50%</option>
    <option value="60">60%</option>
    <option value="70">70%</option>
    <option value="80">80%</option>
    <option value="90">90%</option>
</select>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<script type="text/javascript">
$(document).ready( function() { $(".percent select").selectBox(); });
</script>

<script type="text/javascript">
<? if ($percent) { ?>document.getElementById("percent").value = "<?=$percent?>";<? } ?>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td bgcolor="#ffffff" height="1" class="none">&nbsp;</td></tr>
<tr><td bgcolor="#555555" height="2" class="none">&nbsp;</td></tr>
</table>

<? if ($q) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_count">
<tr height="40">
    <td class="count_list"><span class="keyword">‘<? if ($add) { echo text($add); } else { echo text($q); }?>’</span> 검색결과 <font color="#555555"><?=number_format($total_category);?></font> 개 카테고리 / <font color="#ff1800"><?=number_format($total_count);?></font> 개 상품</td>
</tr>
</table>
<? } ?>

<!-- 현재위치 표기 start //-->
<div style="border:1px solid #cccccc;" class="search_category">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="33" bgcolor="#f4f4f4">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td class='home'>상품검색</td>";

echo "<td width='20' align='center'><img src='".$dmshop_search_path."/img/arrow.gif'></td>";

if ($ct_id) {

    echo "<td><a href='#' onclick=\"itemCategory(''); return false;\" class='off'>전체</a></td>";

} else {

    echo "<td><a href='#' onclick=\"itemCategory(''); return false;\" class='on'>전체</a></td>";

}

if ($ct_id) {

    if ($dmshop_category['log']) {

        $str = explode("|", $dmshop_category['log']);

        for ($i=0; $i<count($str); $i++) {

            if ($str[$i]) {

                if ($str[$i] == $ct_id) {

                    $class = "on";

                } else {

                    $class = "off";

                }

                echo "<td width='20' align='center'><img src='".$dmshop_search_path."/img/arrow.gif'></td>";
                echo "<td><a href='#' onclick=\"itemCategory('".$str[$i]."'); return false;\" class='".$class."'>".shop_category_name($str[$i])."</a></td>";

            }

        }

    }

}
?>
</tr>
</table>
    </td>
    <td width="300" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="title">가격범위</td>
    <td width="7"></td>
    <td><input type="text" name="m1" value="<?=$m1?>" class="input" /></td>
    <td width="5"></td>
    <td class="text">원 ~</td>
    <td width="5"></td>
    <td><input type="text" name="m2" value="<?=$m2?>" class="input" /></td>
    <td width="5"></td>
    <td class="text">원</td>
    <td width="10"></td>
    <td><input type="image" src="<?=$dmshop_search_path?>/img/search2.gif" border="0"></td>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<!-- 현재위치 표기 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<!-- 하위 카테고리 start //-->
<?
$mod = "5";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_category">
<? for ($i=0; $i<count($category1); $i++) { ?>
<tr height="23">
    <td width="20"></td>
    <td width="200"><a href="#" onclick="itemCategory('<?=$category1[$i]['ct_id']?>'); return false;"><b class="subject"><?=text($category1[$i]['subject'])?></b><span class="count">(<?=number_format($category1[$i]['count']);?>)</span></a></td>
    <td>
<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<?
$shop_category_view = false;
for ($k=0; $k<count($category2[$i]); $k++) {

    $shop_category_view = true;

    if ($k && $k%$mod == '0') {

        echo "</tr><tr height='23'>";

    }

    echo "<td width='20%'><a href='#' onclick=\"itemCategory('".$category2[$i][$k]['ct_id']."'); return false;\"><span class='subject'>".text($category2[$i][$k]['subject'])."</span><span class='count'>(".number_format($category2[$i][$k]['count']).")</span></a></td>";

}

$cnt = $k%$mod;
if ($cnt) {

    for ($k=$cnt; $k<$mod; $k++) {

        echo "<td width='20%'>&nbsp;</td>";

    }

}
?>
</tr>
</table>
<!-- end //-->
    </td>
</tr>
<? } ?>
</table>
<!-- 하위 카테고리 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<!-- 혜택별보기 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_icon">
<tr>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
<td><span class="title">혜택별 보기 : </span></td>
<? for ($i=0; $i<count($icon); $i++) { ?>
<td width="5"></td>
<td><input type="checkbox" name="ic[<?=$i?>]" value="<?=$icon[$i]['id']?>" class="checkbox" <? if ($icon[$i]['checked']) { echo "checked"; } ?> /></td>
<td width="5"></td>
<td><span class="title"><?=$icon[$i]['title']?></span></td>
<? } ?>
<td width="10"></td>
<td><a href="#" onclick="itemSearch('search'); return false;"><img src="<?=$dmshop_search_path?>/img/move.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<!-- 혜택별보기 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e5e5e5" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="35"></td></tr>
</table>

<!-- 버튼 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_btn">
<tr>
    <td class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="itemSearch('1'); return false;"><img src="<?=$dmshop_search_path?>/img/sort1<? if ($sort == '1') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('2'); return false;"><img src="<?=$dmshop_search_path?>/img/sort2<? if ($sort == '2') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('3'); return false;"><img src="<?=$dmshop_search_path?>/img/sort3<? if ($sort == '3') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('4'); return false;"><img src="<?=$dmshop_search_path?>/img/sort4<? if ($sort == '4') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('5'); return false;"><img src="<?=$dmshop_search_path?>/img/sort5<? if ($sort == '5') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('6'); return false;"><img src="<?=$dmshop_search_path?>/img/sort6<? if ($sort == '6') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('7'); return false;"><img src="<?=$dmshop_search_path?>/img/sort7<? if ($sort == '7') { echo "_on"; } ?>.gif" border="0"></a></td>
    <td><img src="<?=$dmshop_search_path?>/img/sort_line.gif"></td>
    <td><a href="#" onclick="itemSearch('8'); return false;"><img src="<?=$dmshop_search_path?>/img/sort8<? if ($sort == '8') { echo "_on"; } ?>.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="200" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<!--[if IE 6]>
<style type="text/css">
.search_btn .select_box {position:relative; overflow:hidden; left:0; top:-1px;}
</style>
<![endif]-->

<style type="text/css">
.search_btn .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.search_btn .selectBox-dropdown {width:60px; height:18px;}
.search_btn .selectBox-dropdown .selectBox-label {padding:0px 5px 0px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() { $(".search_btn select").selectBox(); });
</script>

<div class="select_box">
<select id="rows" name="rows" onchange="itemSearch('search');" class="select">
    <option value="<?=$total_rows?>">상품출력 수</option>
    <option value="20">20개씩 보기</option>
    <option value="40">40개씩 보기</option>
    <option value="60">60개씩 보기</option>
    <option value="80">80개씩 보기</option>
</select>
</div>

<script type="text/javascript">
<? if ($rows) { ?>document.getElementById("rows").value = "<?=$rows?>";<? } ?>
</script></td>
</tr>
</table>
    </td>
</tr>
</table>
<!-- 버튼 end //-->
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<!-- 타이틀 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_title">
<tr>
    <td class="bg1"></td>
    <td class="bg2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center"><img src="<?=$dmshop_search_path?>/img/title1.gif"></td>
</tr>
</table>
    </td>
    <td class="bg3"></td>
</tr>
</table>
<!-- 타이틀 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<!-- 리스트 start //-->
<form method="post" name="formList">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_item">
<?
for ($i=0; $i<count($list); $i++) {

    // 상품 페이지
    $item_link = $shop['path']."/item.php?id=".$list[$i]['item_code'];

    $thumb = "";
    $thumb = shop_item_thumb($list[$i]['id'], "category", "default", $thumb_width, $thumb_height, 2);

    if ($thumb) {

        $img = "<img src='".$thumb."' width='".$thumb_width."' height='".$thumb_height."' border='0'>";

    } else {

        $img = "<img src='".$dmshop_search_path."/img/noimage.gif' border='0'>";

    }

    $reply_score = shop_reply_score_total($list[$i]['id']);
?>
<? if ($i > '0') { ?>
<tr height="1" bgcolor="#e5e5e5"><td colspan="9"></td></tr>
<? } ?>
<input type='hidden' name='item_id[<?=$i?>]' value='<?=$list[$i]['id']?>' />
<tr height="104">
    <td width="20"></td>
    <td width="20" class="chk_id"><input type='checkbox' name='chk_id[]' value='<?=$i?>' class='checkbox' /></td>
    <td width="82"><div class='thumb'><a href='<?=$item_link?>'><?=$img?></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href='<?=$item_link?>' class='title'><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5">
    <td></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href='#' onclick="itemCart('<?=$list[$i]['id']?>'); return false;" class='etc'>장바구니</a></td>
    <td class='etc_line'>|</td>
    <td><a href='#' onclick="itemFavorite('<?=$list[$i]['id']?>'); return false;" class='etc'>보관함</a></td>
    <td class='etc_line'>|</td>
    <td><a href='#' onclick="itemPreview('<?=$list[$i]['item_code']?>'); return false;" class='etc'>미리보기</a></td>
</tr>
</table>

<? if ($reply_score) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div class="star<?=$reply_score?>"></div></td>
</tr>
</table>
<? } ?>
    </td>
    <td width="100">
<?
$icon_view = shop_icon_view($list[$i]['item_icon']);
$icon_view = preg_replace("/(<img)/", "<p>$1", $icon_view);
$icon_view = preg_replace("/(border='0'>)/", "$1</p>", $icon_view);
echo $icon_view;
?>
    </td>
    <td width="100">
<? if ($list[$i]['item_price']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class='price'><?=number_format($list[$i]['item_price']);?>원</span></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class='money'><?=number_format($list[$i]['item_money']);?>원</span></td>
</tr>
</table>
    </td>
    <td width="100">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="8"><img src='<?=$dmshop_search_path?>/img/dot.gif' class='up1'></td>
    <td><span class='text'>재고수량 : <? if ($list[$i]['item_option_use']) { echo number_format(shop_item_option_limit($list[$i]['id'])); } else { echo number_format($list[$i]['item_limit']); } ?></span></td>
</tr>
<tr>
    <td width="8"><img src='<?=$dmshop_search_path?>/img/dot.gif' class='up1'></td>
    <td><span class='text'>판매수량 : <?=number_format(shop_order_limit($list[$i]['id']));?></span></td>
</tr>
<tr>
    <td width="8"><img src='<?=$dmshop_search_path?>/img/dot.gif' class='up1'></td>
    <td><span class='text'>상품평 : <?=number_format($list[$i]['item_reply']);?></span></td>
</tr>
<tr>
    <td width="8"><img src='<?=$dmshop_search_path?>/img/dot.gif' class='up1'></td>
    <td><span class='text'>적립금 : <?=number_format($list[$i]['item_cash']);?> P</span></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
<? } ?>
</table>
</form>
<!-- 리스트 end //-->

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_not">
<tr height="150">
    <td align="center"><span class="not">상품이 없습니다.</span></td>
</tr>
</table>
<? } ?>

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e5e5e5" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_cart">
<tr>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="title">선택한 상품을</span></td>
    <td width="10"></td>
    <td><a href="#" onclick="checkCart(); return false;"><img src="<?=$dmshop_search_path?>/img/item_cart.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="checkFavorite(); return false;"><img src="<?=$dmshop_search_path?>/img/item_favorites.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span class="title">담기</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e5e5e5" class="none">&nbsp;</td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>