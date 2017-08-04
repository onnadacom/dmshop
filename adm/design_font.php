<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "401";
$shop['title'] = "기타 폰트 설정";
include_once("./_top.php");

$colspan = "6";

$dmshop_design_font = shop_design_font();
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:180px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".tip1").simpletip({ content: '상품명 폰트를 설정합니다.' });
    $(".tip2").simpletip({ content: '판매가격 폰트를 설정합니다.' });
    $(".tip3").simpletip({ content: '시중가격 폰트를 설정합니다.' });
    $(".tip4").simpletip({ content: '기타 폰트를 설정합니다.' });
    $(".tip5").simpletip({ content: '구분막대 폰트를 설정합니다.' });
    $(".tip6").simpletip({ content: '상품명 폰트를 설정합니다.' });
    $(".tip7").simpletip({ content: '판매가격 폰트를 설정합니다.' });
    $(".tip8").simpletip({ content: '시중가격 폰트를 설정합니다.' });
    $(".tip9").simpletip({ content: '기타 폰트를 설정합니다.' });
    $(".tip10").simpletip({ content: '구분막대 폰트를 설정합니다.' });

});
</script>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();
});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#ct_item_title_font_color, #ct_item_money_font_color, #ct_item_price_font_color, #ct_etc_font_color, #ct_line_font_color, #pl_item_title_font_color, #pl_item_money_font_color, #pl_item_price_font_color, #pl_etc_font_color, #pl_line_font_color').ColorPicker({
    	onSubmit: function(hsb, hex, rgb, el) {
        $(el).val(hex);
        $(el).ColorPickerHide();
        colorPreview(el.id, hex);
        $(el).focus();
    	},
    	onBeforeShow: function () {
    		$(this).ColorPickerSetColor(this.value);
    	},
    	onChange: function (hsb, hex, rgb, el) {
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
        $(this).blur();
    });
});
</script>

<script type="text/javascript">
function colorPreview(id, hex)
{

    var color = "#" + hex;

    document.getElementById(id+"_preview").style.backgroundColor = color;

}
</script>

<script type="text/javascript">
function designSubmit()
{

    var f = document.formDesign;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./design_font_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formDesign" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">기타폰트 설정안내</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">상품 목록, 기획전 목록 등에서 사용되는 폰트를 설정 합니다. (메인, 상품 페이지 등의 폰트는 해당 설정 페이지에서 변경하시기 바랍니다.)<br>아래의 설정된 폰트는 해당 페이지의 스킨이 DM SHOP이 제공하는 기본 스킨일 때 100% 적용되며, 그 외의 스킨에서는 적용이 안될 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품 목록 폰트 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip1">상품명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="ct_item_title_font_family" name="ct_item_title_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#ct_item_title_font_family").val("<?=text($dmshop_design_font['ct_item_title_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="ct_item_title_font_size" name="ct_item_title_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#ct_item_title_font_size").val("<?=text($dmshop_design_font['ct_item_title_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="ct_item_title_font_color" name="ct_item_title_font_color" value="<?=text($dmshop_design_font['ct_item_title_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="ct_item_title_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['ct_item_title_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_title_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_title_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_title_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_title_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_title_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_title_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_title_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_title_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_title_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip2">판매가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="ct_item_money_font_family" name="ct_item_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#ct_item_money_font_family").val("<?=text($dmshop_design_font['ct_item_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="ct_item_money_font_size" name="ct_item_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#ct_item_money_font_size").val("<?=text($dmshop_design_font['ct_item_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="ct_item_money_font_color" name="ct_item_money_font_color" value="<?=text($dmshop_design_font['ct_item_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="ct_item_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['ct_item_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip3">시중가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="ct_item_price_font_family" name="ct_item_price_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#ct_item_price_font_family").val("<?=text($dmshop_design_font['ct_item_price_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="ct_item_price_font_size" name="ct_item_price_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#ct_item_price_font_size").val("<?=text($dmshop_design_font['ct_item_price_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="ct_item_price_font_color" name="ct_item_price_font_color" value="<?=text($dmshop_design_font['ct_item_price_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="ct_item_price_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['ct_item_price_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_price_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_price_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_price_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_price_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_price_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_price_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_item_price_font_through" value="1" class="checkbox" <? if ($dmshop_design_font['ct_item_price_font_through']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_item_price_font_through');">가운데줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip4">기타</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="ct_etc_font_family" name="ct_etc_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#ct_etc_font_family").val("<?=text($dmshop_design_font['ct_etc_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="ct_etc_font_size" name="ct_etc_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#ct_etc_font_size").val("<?=text($dmshop_design_font['ct_etc_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="ct_etc_font_color" name="ct_etc_font_color" value="<?=text($dmshop_design_font['ct_etc_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="ct_etc_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['ct_etc_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_etc_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['ct_etc_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_etc_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_etc_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['ct_etc_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_etc_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="ct_etc_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['ct_etc_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'ct_etc_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip5">구분막대</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="ct_line_font_size" name="ct_line_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#ct_line_font_size").val("<?=text($dmshop_design_font['ct_line_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="ct_line_font_color" name="ct_line_font_color" value="<?=text($dmshop_design_font['ct_line_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="ct_line_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['ct_line_font_color'])?>;"></div></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 기획전 목록 폰트 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip6">상품명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="pl_item_title_font_family" name="pl_item_title_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#pl_item_title_font_family").val("<?=text($dmshop_design_font['pl_item_title_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="pl_item_title_font_size" name="pl_item_title_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#pl_item_title_font_size").val("<?=text($dmshop_design_font['pl_item_title_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="pl_item_title_font_color" name="pl_item_title_font_color" value="<?=text($dmshop_design_font['pl_item_title_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="pl_item_title_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['pl_item_title_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_title_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_title_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_title_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_title_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_title_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_title_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_title_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_title_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_title_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip7">판매가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="pl_item_money_font_family" name="pl_item_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#pl_item_money_font_family").val("<?=text($dmshop_design_font['pl_item_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="pl_item_money_font_size" name="pl_item_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#pl_item_money_font_size").val("<?=text($dmshop_design_font['pl_item_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="pl_item_money_font_color" name="pl_item_money_font_color" value="<?=text($dmshop_design_font['pl_item_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="pl_item_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['pl_item_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip8">시중가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="pl_item_price_font_family" name="pl_item_price_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#pl_item_price_font_family").val("<?=text($dmshop_design_font['pl_item_price_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="pl_item_price_font_size" name="pl_item_price_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#pl_item_price_font_size").val("<?=text($dmshop_design_font['pl_item_price_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="pl_item_price_font_color" name="pl_item_price_font_color" value="<?=text($dmshop_design_font['pl_item_price_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="pl_item_price_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['pl_item_price_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_price_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_price_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_price_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_price_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_price_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_price_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_item_price_font_through" value="1" class="checkbox" <? if ($dmshop_design_font['pl_item_price_font_through']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_item_price_font_through');">가운데줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip9">기타</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="pl_etc_font_family" name="pl_etc_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#pl_etc_font_family").val("<?=text($dmshop_design_font['pl_etc_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="pl_etc_font_size" name="pl_etc_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#pl_etc_font_size").val("<?=text($dmshop_design_font['pl_etc_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="pl_etc_font_color" name="pl_etc_font_color" value="<?=text($dmshop_design_font['pl_etc_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="pl_etc_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['pl_etc_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_etc_font_bold" value="1" class="checkbox" <? if ($dmshop_design_font['pl_etc_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_etc_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_etc_font_italic" value="1" class="checkbox" <? if ($dmshop_design_font['pl_etc_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_etc_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="pl_etc_font_underline" value="1" class="checkbox" <? if ($dmshop_design_font['pl_etc_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'pl_etc_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip10">구분막대</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="pl_line_font_size" name="pl_line_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#pl_line_font_size").val("<?=text($dmshop_design_font['pl_line_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="pl_line_font_color" name="pl_line_font_color" value="<?=text($dmshop_design_font['pl_line_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="pl_line_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_font['pl_line_font_color'])?>;"></div></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="designSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./design_font.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>