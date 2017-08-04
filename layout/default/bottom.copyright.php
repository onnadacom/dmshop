<?
if (!defined('_DMSHOP_')) exit;

echo "\n<style type=\"text/css\">\n";
echo ".bottom_copyright .text {\n";
if ($dmshop_bottom['bottom_copyright_font_family']) { echo "font-family:".$dmshop_bottom['bottom_copyright_font_family'].";\n"; }
if ($dmshop_bottom['bottom_copyright_font_size']) { echo "font-size:".$dmshop_bottom['bottom_copyright_font_size']."px;\n"; }
if ($dmshop_bottom['bottom_copyright_font_height']) { echo "line-height:".$dmshop_bottom['bottom_copyright_font_height']."px;\n"; }
if ($dmshop_bottom['bottom_copyright_font_color']) { echo "color:#".$dmshop_bottom['bottom_copyright_font_color'].";\n"; }
if ($dmshop_bottom['bottom_copyright_font_bold']) { echo "font-weight:bold;\n"; } else { echo "font-weight:normal;\n"; }
echo "}\n";

echo ".bottom_copyright td {text-align:".shop_design_align($dmshop_bottom['bottom_copyright_position']).";}\n";

echo "</style>";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bottom_copyright">
<tr>
    <td><p><span class="text">Copyright © <b><?=$dmshop['company_name']?></b> Corp. All Rights Reserved.</span></p></td>
</tr>
</table>