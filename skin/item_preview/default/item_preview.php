<?
if (!defined('_DMSHOP_')) exit;

// 설정
$dmshop_design_item = shop_design_item();

// 대표 이미지
if ($dmshop_design_item['image_default_use'] == '0') { $dmshop_design_item['image_default_width'] = shop_split("|", $dmshop_design_item['image_default'], "0"); $dmshop_design_item['image_default_height'] = shop_split("|", $dmshop_design_item['image_default'], "1"); } else { $dmshop_design_item['image_default_width'] = $dmshop_design_item['image_default_width']; $dmshop_design_item['image_default_height'] = $dmshop_design_item['image_default_height']; }

// 스타일 처리
echo "\n<style type=\"text/css\">\n";

// 상품명
echo ".item_information .item_title {";
if ($dmshop_design_item['item_title_font_family']) { echo "font-family:".$dmshop_design_item['item_title_font_family'].";"; }
if ($dmshop_design_item['item_title_font_size']) { echo "font-size:".$dmshop_design_item['item_title_font_size']."px;"; }
if ($dmshop_design_item['item_title_font_color']) { echo "color:#".$dmshop_design_item['item_title_font_color'].";"; }
if ($dmshop_design_item['item_title_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_title_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_title_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 상품정보 항목(서브타이틀)
echo ".item_information .item_subtitle {width:100px; min-width:100px;";
if ($dmshop_design_item['item_subtitle_font_family']) { echo "font-family:".$dmshop_design_item['item_subtitle_font_family'].";"; }
if ($dmshop_design_item['item_subtitle_font_size']) { echo "font-size:".$dmshop_design_item['item_subtitle_font_size']."px;"; }
if ($dmshop_design_item['item_subtitle_font_color']) { echo "color:#".$dmshop_design_item['item_subtitle_font_color'].";"; }
if ($dmshop_design_item['item_subtitle_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_subtitle_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_subtitle_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 시중가격
echo ".item_information .item_price {";
if ($dmshop_design_item['item_price_font_family']) { echo "font-family:".$dmshop_design_item['item_price_font_family'].";"; }
if ($dmshop_design_item['item_price_font_size']) { echo "font-size:".$dmshop_design_item['item_price_font_size']."px;"; }
if ($dmshop_design_item['item_price_font_color']) { echo "color:#".$dmshop_design_item['item_price_font_color'].";"; }
if ($dmshop_design_item['item_price_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_price_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_price_font_underline']) { echo "text-decoration:line-through;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 판매가격
echo ".item_information .item_money {";
if ($dmshop_design_item['item_money_font_family']) { echo "font-family:".$dmshop_design_item['item_money_font_family'].";"; }
if ($dmshop_design_item['item_money_font_size']) { echo "font-size:".$dmshop_design_item['item_money_font_size']."px;"; }
if ($dmshop_design_item['item_money_font_color']) { echo "color:#".$dmshop_design_item['item_money_font_color'].";"; }
if ($dmshop_design_item['item_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 적립금
echo ".item_information .item_cash {";
if ($dmshop_design_item['item_cash_font_family']) { echo "font-family:".$dmshop_design_item['item_cash_font_family'].";"; }
if ($dmshop_design_item['item_cash_font_size']) { echo "font-size:".$dmshop_design_item['item_cash_font_size']."px;"; }
if ($dmshop_design_item['item_cash_font_color']) { echo "color:#".$dmshop_design_item['item_cash_font_color'].";"; }
if ($dmshop_design_item['item_cash_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_cash_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_cash_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 재고수량
echo ".item_information .item_limit {";
if ($dmshop_design_item['item_limit_font_family']) { echo "font-family:".$dmshop_design_item['item_limit_font_family'].";"; }
if ($dmshop_design_item['item_limit_font_size']) { echo "font-size:".$dmshop_design_item['item_limit_font_size']."px;"; }
if ($dmshop_design_item['item_limit_font_color']) { echo "color:#".$dmshop_design_item['item_limit_font_color'].";"; }
if ($dmshop_design_item['item_limit_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_limit_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_limit_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 판매수량
echo ".item_information .item_sale_limit {";
if ($dmshop_design_item['item_sale_limit_font_family']) { echo "font-family:".$dmshop_design_item['item_sale_limit_font_family'].";"; }
if ($dmshop_design_item['item_sale_limit_font_size']) { echo "font-size:".$dmshop_design_item['item_sale_limit_font_size']."px;"; }
if ($dmshop_design_item['item_sale_limit_font_color']) { echo "color:#".$dmshop_design_item['item_sale_limit_font_color'].";"; }
if ($dmshop_design_item['item_sale_limit_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_sale_limit_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_sale_limit_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 배송비
echo ".item_information .item_delivery_money {";
if ($dmshop_design_item['item_delivery_money_font_family']) { echo "font-family:".$dmshop_design_item['item_delivery_money_font_family'].";"; }
if ($dmshop_design_item['item_delivery_money_font_size']) { echo "font-size:".$dmshop_design_item['item_delivery_money_font_size']."px;"; }
if ($dmshop_design_item['item_delivery_money_font_color']) { echo "color:#".$dmshop_design_item['item_delivery_money_font_color'].";"; }
if ($dmshop_design_item['item_delivery_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_delivery_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_delivery_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 주문금액
echo ".item_information .item_total_money {";
if ($dmshop_design_item['item_total_money_font_family']) { echo "font-family:".$dmshop_design_item['item_total_money_font_family'].";"; }
if ($dmshop_design_item['item_total_money_font_size']) { echo "font-size:".$dmshop_design_item['item_total_money_font_size']."px;"; }
if ($dmshop_design_item['item_total_money_font_color']) { echo "color:#".$dmshop_design_item['item_total_money_font_color'].";"; }
if ($dmshop_design_item['item_total_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_total_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_total_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 관련 상품명
echo ".relation_box .item_relation_title {";
if ($dmshop_design_item['item_relation_title_font_family']) { echo "font-family:".$dmshop_design_item['item_relation_title_font_family'].";"; }
if ($dmshop_design_item['item_relation_title_font_size']) { echo "font-size:".$dmshop_design_item['item_relation_title_font_size']."px;"; }
if ($dmshop_design_item['item_relation_title_font_color']) { echo "color:#".$dmshop_design_item['item_relation_title_font_color'].";"; }
if ($dmshop_design_item['item_relation_title_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_relation_title_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_relation_title_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 관련 상품 가격
echo ".relation_box .item_relation_money {";
if ($dmshop_design_item['item_relation_money_font_family']) { echo "font-family:".$dmshop_design_item['item_relation_money_font_family'].";"; }
if ($dmshop_design_item['item_relation_money_font_size']) { echo "font-size:".$dmshop_design_item['item_relation_money_font_size']."px;"; }
if ($dmshop_design_item['item_relation_money_font_color']) { echo "color:#".$dmshop_design_item['item_relation_money_font_color'].";"; }
if ($dmshop_design_item['item_relation_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_relation_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_relation_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 요약안내 항목
echo ".item_information .item_optiontitle {width:30%; padding:5px 0;";
if ($dmshop_design_item['item_optiontitle_font_family']) { echo "font-family:".$dmshop_design_item['item_optiontitle_font_family'].";"; }
if ($dmshop_design_item['item_optiontitle_font_size']) { echo "font-size:".$dmshop_design_item['item_optiontitle_font_size']."px;"; }
if ($dmshop_design_item['item_optiontitle_font_color']) { echo "color:#".$dmshop_design_item['item_optiontitle_font_color'].";"; }
if ($dmshop_design_item['item_optiontitle_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_optiontitle_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_optiontitle_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 요약안내 라인
echo ".item_information .item_optionline {text-align:center; width:5%;";
if ($dmshop_design_item['item_optiontitle_font_family']) { echo "font-family:".$dmshop_design_item['item_optiontitle_font_family'].";"; }
if ($dmshop_design_item['item_optiontitle_font_size']) { echo "font-size:".$dmshop_design_item['item_optiontitle_font_size']."px;"; }
if ($dmshop_design_item['item_optiontitle_font_color']) { echo "color:#".$dmshop_design_item['item_optiontitle_font_color'].";"; }
echo "}\n";

// 요약안내 내용
echo ".item_information .item_optioncontent {width:65%; padding:5px 0;";
if ($dmshop_design_item['item_optioncontent_font_family']) { echo "font-family:".$dmshop_design_item['item_optioncontent_font_family'].";"; }
if ($dmshop_design_item['item_optioncontent_font_size']) { echo "font-size:".$dmshop_design_item['item_optioncontent_font_size']."px;"; }
if ($dmshop_design_item['item_optioncontent_font_color']) { echo "color:#".$dmshop_design_item['item_optioncontent_font_color'].";"; }
if ($dmshop_design_item['item_optioncontent_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_optioncontent_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_optioncontent_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 도움말
echo ".item_information .help {";
if ($dmshop_design_item['help_font_family']) { echo "font-family:".$dmshop_design_item['help_font_family'].";"; }
if ($dmshop_design_item['help_font_size']) { echo "font-size:".$dmshop_design_item['help_font_size']."px;"; }
if ($dmshop_design_item['help_font_color']) { echo "color:#".$dmshop_design_item['help_font_color'].";"; }
if ($dmshop_design_item['help_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['help_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['help_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

echo "</style>\n";
?>
<style type="text/css">
#item_preview_box {width:760px; border:2px solid #555555; background-color:#f5f5f5;}
#item_preview .preview_title {font-weight:bold; line-height:40px; font-size:14px; color:#ffffff; font-family:gulim,굴림;}
#item_preview .box {background-color:#ffffff; padding:20px;}
#item_preview .option_title {font-weight:bold; line-height:14px; font-size:12px; color:#555555; font-family:dotum,돋움;}
#item_preview .option_line {height:1px; background:url('<?=$dmshop_item_preview_path?>/img/option_line.gif') repeat-x;}
#item_preview .option_name {line-height:14px; font-size:12px; color:#9e9e9e; font-family:dotum,돋움;}
#item_preview .option_limit {line-height:14px; font-size:12px; color:#787878; font-family:gulim,굴림;}
</style>

<div id="item_preview_box" class="item_information">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="handler move">
<tr height="40" bgcolor="#555555">
    <td width="10"></td>
    <td class="preview_title">:: 미리보기 ::</td>
    <td width="35" valign="top"><a href="#" onclick="itemPreviewClose(); return false;"><img src="<?=$dmshop_item_preview_path?>/img/close_x.gif" border="0"></a></td>
</tr>
</table>

<div class="box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="<?=$dmshop_design_item['image_default_width']?>" valign="top">
<!-- 상품 이미지 start //-->
<?
$thumb = shop_item_thumb($dmshop_item['id'], "default", "", $dmshop_design_item['image_default_width'], $dmshop_design_item['image_default_height'], shop_thumb_type($dmshop_design_item['thumb_type']));

if (!$thumb) {

    $thumb = $dmshop_item_preview_path."/img/noimage.gif";

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td style="text-align:center;"><img src="<?=$thumb?>"></td>
</tr>
</table>
<!-- 상품 이미지 end //-->
    </td>
    <td width="50"></td>
    <td valign="top">
<!-- 상품 정보 박스 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="item_title"><?=$dmshop_item['item_title']?></td>
</tr>
</table>

<? if ($dmshop_item['item_icon']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_icon_view($dmshop_item['item_icon'])?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?>
<tr height="30">
    <td class="item_subtitle">시중가 :</td>
    <td class="item_price"><?=number_format($dmshop_item['item_price']);?></td>
</tr>
<? } ?>
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?><tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr><? } ?>
<? if ($dmshop_design_item['buy_use2']) { ?>
<tr height="30">
    <td class="item_subtitle">판매가 :</td>
    <td class="item_money"><?=number_format($dmshop_item['item_money']);?> 원</td>
</tr>
<tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr>
<? } ?>
<? if ($dmshop_design_item['buy_use3'] && $dmshop_item['item_cash']) { ?>
<tr height="30">
    <td class="item_subtitle">적립금 :</td>
    <td class="item_cash"><?=number_format($dmshop_item['item_cash']);?> P</td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>

<div style="background-color:#fdfdfd;">
<? if ($dmshop_design_item['buy_use4']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="item_subtitle">재고수량</td>
<? if ($dmshop_item['item_option_use']) { ?>
    <td class="help"><span id="item_option_limit_view">옵션별 재고수량 참고</span></td>
<? } else { ?>
    <td class="item_limit"><?=number_format($dmshop_item['item_limit']);?>개</td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use5']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="item_subtitle">판매수량</td>
    <td class="item_sale_limit"><?=number_format(shop_order_limit($dmshop_item['id']));?>개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use6']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="item_subtitle">배송비</td>
<? if ($dmshop_item['item_delivery']) { ?>
    <td class="item_delivery_money"><?=number_format($dmshop_item['item_delivery']);?>원</td>
<? if ($dmshop_item['item_delivery_bunch']) { ?>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
<? } else { ?>
    <td class="item_delivery_money"><?=number_format($dmshop['delivery_money']);?>원</td>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_item['item_option1_text'] || $dmshop_item['item_option2_text'] || $dmshop_item['item_option3_text'] || $dmshop_item['item_option4_text'] || $dmshop_item['item_option5_text'] || $dmshop_item['item_option6_text'] || $dmshop_item['item_option7_text'] || $dmshop_item['item_option8_text'] || $dmshop_item['item_option9_text'] || $dmshop_item['item_option10_text']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #e5e5e5;">
<div style="padding:5px 10px 3px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
for ($i=1; $i<=10; $i++) {

if ($dmshop_item["item_option".$i."_text"]) {
?>
<? if ($i > '1') { ?>
<tr height="1" bgcolor="#f2f2f2"><td colspan="3"></td></tr>
<? } ?>
<tr height="22">
    <td class="item_optiontitle" align="right"><?=$dmshop_item["item_option".$i]?></td>
    <td class="item_optionline">:</td>
    <td class="item_optioncontent"><?=$dmshop_item["item_option".$i."_text"]?></td>
</tr>
<?
    }

}
?>
</table>
</div>
</div>
    </td>
</tr>
</table>
<? } ?>
<!-- 상품 정보 박스 end //-->
    </td>
</tr>
</table>

<?
// 상품 옵션 사용
if ($dmshop_item['item_option_use']) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #e5e5e5;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" align="center" bgcolor="#fafafa" class="option_title">옵션별 재고수량</td>
    <td width="1" bgcolor="#e5e5e5"></td>
    <td>
<div style="height:77px; overflow:auto; overflow-x:hidden; position:relative; padding:0 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$sql = " select * from $shop[item_option_table] where item_id = '".$dmshop_item['id']."' and option_mode = '1' order by option_position asc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    
    if ($row['id']) {

        if ($i > '0') {

            echo "<tr class='option_line'><td></td></tr>";

        }

        echo "<tr height='25'><td>";
        echo "<span class='option_name'>".$row['option_name']." : </span>";
        echo "<span class='option_limit'>".$row['option_limit']."개</span>";
        echo "</td></tr>";

    }

}
?>
</table>
</div>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
<? } ?>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="./item.php?id=<?=$id?>"><img src="<?=$dmshop_item_preview_path?>/img/item_page.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="itemPreviewClose(); return false;"><img src="<?=$dmshop_item_preview_path?>/img/close.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $("#item_preview").draggable({ handle: '.handler' });

    var win = $(window);
    var layer = $("#item_preview");

    // 열어야 사이즈 계산이 된다?
    layer.show();

    var box = $("#item_preview_box");

    var layerLeft = (win.scrollLeft() + (win.width() / 2)) - (box.width() / 2);
    var layerTop = (win.scrollTop() + (win.height() / 2)) - (box.height() / 2);

    layer.css( { 'left': layerLeft+'px', 'top': layerTop+'px', 'opacity' : '1.0'} );

});

function itemPreviewClose()
{

    $("#item_preview").hide();

}
</script>