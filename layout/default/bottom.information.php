<?
if (!defined('_DMSHOP_')) exit;

echo "\n<style type=\"text/css\">\n";
echo ".bottom_information .text {\n";
if ($dmshop_bottom['bottom_information_font_family']) { echo "font-family:".$dmshop_bottom['bottom_information_font_family'].";\n"; }
if ($dmshop_bottom['bottom_information_font_size']) { echo "font-size:".$dmshop_bottom['bottom_information_font_size']."px;\n"; }
if ($dmshop_bottom['bottom_information_font_height']) { echo "line-height:".$dmshop_bottom['bottom_information_font_height']."px;\n"; }
if ($dmshop_bottom['bottom_information_font_color']) { echo "color:#".$dmshop_bottom['bottom_information_font_color'].";\n"; }
if ($dmshop_bottom['bottom_information_font_bold']) { echo "font-weight:bold;\n"; } else { echo "font-weight:normal;\n"; }
echo "}\n";

echo ".bottom_information .bline {margin:0 5px; font-size:11px; color:#cccccc; font-family:dotum,돋움;}\n";
echo ".bottom_information td {text-align:".shop_design_align($dmshop_bottom['bottom_information_position']).";}\n";

echo "</style>\n";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bottom_information">
<tr>
    <td>
<p><span class="text">회사명 : <?=$dmshop['company_name']?></span><span class="bline">|</span><span class="text">사업자 등록번호 : <?=$dmshop['company_number1']?></span><span class="bline">|</span><span class="text">통신판매업 신고번호 : <?=$dmshop['company_number2']?></span></p>
<p><span class="text">대표 : <?=$dmshop['ceo_name']?></span> <a href="mailto:<?=$dmshop['ceo_email']?>"><img src="<?=$shop['path']?>/layout/default/img/email.gif" border="0" class="down1"></a><span class="bline">|</span><span class="text">개인정보관리 책임자 : <?=$dmshop['admin_name']?></span> <a href="mailto:<?=$dmshop['admin_email']?>"><img src="<?=$shop['path']?>/layout/default/img/email.gif" border="0" class="down1"></a><span class="bline">|</span><span class="text">주소 : <?=$dmshop['addr1']?> <?=$dmshop['addr2']?></span></p>
<p><span class="text">대표전화 : <?=$dmshop['number1']?>-<?=$dmshop['number2']?>-<?=$dmshop['number3']?></span><? if ($dmshop['fax1'] && $dmshop['fax2'] && $dmshop['fax3']) { ?><span class="bline">|</span><span class="text">팩스 : <?=$dmshop['fax1']?>-<?=$dmshop['fax2']?>-<?=$dmshop['fax3']?></span><? } ?></p>
    </td>
</tr>
</table>