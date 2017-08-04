<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "300";
$shop['title'] = "상품 페이지 설정";
include_once("./_top.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 상품페이지 설정
$dmshop_design_item = shop_design_item();

// 메인, 서브 권장설정
if ($dmshop_design['main_width_use'] == '0') { $dmshop_design['main_menu_width'] = shop_split("|", $dmshop_design['main_width'], "0"); $dmshop_design['main_center_width'] = shop_split("|", $dmshop_design['main_width'], "1"); }
if ($dmshop_design['sub_width_use'] == '0') { $dmshop_design['sub_menu_width'] = shop_split("|", $dmshop_design['sub_width'], "0"); $dmshop_design['sub_center_width'] = shop_split("|", $dmshop_design['sub_width'], "1"); }
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

    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '상품페이지의 스킨을 선택합니다.' });
    $(".tip2").simpletip({ content: '상품 구매정보의 표기항목을 설정합니다.' });
    $(".tip3").simpletip({ content: 'SNS SAVE의 표기항목을 설정합니다.' });
    $(".tip4").simpletip({ content: '상품 갤러리의 이미지 갯수를 설정합니다.' });
    $(".tip5").simpletip({ content: '관련상품의 이미지 갯수를 설정합니다.' });
    $(".tip6").simpletip({ content: '사용할 내용 분류탭을 설정합니다.' });
    $(".tip7").simpletip({ content: '상품 요약안내 자동완성을 설정합니다. 설정시 기본 상품등록시 자동으로 채워집니다.' });
    $(".tip8").simpletip({ content: '대표이미지의 상세옵션을 설정합니다.' });
    $(".tip9").simpletip({ content: '상품 갤러리 이미지를 설정합니다.' });
    $(".tip10").simpletip({ content: '관련상품 이미지를 설정합니다.' });
    $(".tip11").simpletip({ content: '상품내용의 이미지 크기를 제한합니다. 설정값 이상의 이미지가 첨부되어있을 경우 자동으로 줄어듭니다.' });
    $(".tip12").simpletip({ content: '상품명 폰트를 설정합니다.' });
    $(".tip13").simpletip({ content: '상품정보 항목 폰트를 설정합니다.' });
    $(".tip14").simpletip({ content: '시중가격 폰트를 설정합니다.' });
    $(".tip15").simpletip({ content: '판매가격 폰트를 설정합니다.' });
    $(".tip16").simpletip({ content: '적립금 폰트를 설정합니다.' });
    $(".tip17").simpletip({ content: '재고수량 폰트를 설정합니다.' });
    $(".tip18").simpletip({ content: '판매수량 폰트를 설정합니다.' });
    $(".tip19").simpletip({ content: '배송비 폰트를 설정합니다.' });
    $(".tip20").simpletip({ content: '주문금액 폰트를 설정합니다.' });
    $(".tip21").simpletip({ content: '관련 상품명 폰트를 설정합니다.' });
    $(".tip22").simpletip({ content: '관련 상품 가격 폰트를 설정합니다.' });
    $(".tip23").simpletip({ content: '요약안내 항목 폰트를 설정합니다.' });
    $(".tip24").simpletip({ content: '요약안내 내용 폰트를 설정합니다.' });
    $(".tip25").simpletip({ content: '도움말 폰트를 설정합니다.' });

});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#image_default1_border_color, #image_default2_border_color, #image_gallery1_border_color, #image_gallery2_border_color, #image_relation1_border_color, #image_relation2_border_color, #item_title_font_color, #item_subtitle_font_color, #item_price_font_color, #item_money_font_color, #item_cash_font_color, #item_limit_font_color, #item_sale_limit_font_color, #item_delivery_money_font_color, #item_total_money_font_color, #item_relation_title_font_color, #item_relation_money_font_color, #item_optiontitle_font_color, #item_optioncontent_font_color, #help_font_color').ColorPicker({
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

    f.action = "./design_item_update.php";
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
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품페이지 스킨·공통 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">상품페이지 설정정보</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_sub<?=$dmshop_design['sub_layout']?>_item.gif"></div></td>
    <td width="20"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_title">서브 디자인 설정</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">레이아웃 : <?=shop_design_layout_name("main", $dmshop_design['sub_layout']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴스킨 : <?=shop_design_skin_name($dmshop_skin['skin_sub_menu']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">전체가로 : <?=(int)($dmshop_design['sub_menu_width'] + $dmshop_design['sub_center_width']);?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <?=text($dmshop_design['sub_menu_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">공통영역 : <b style="color:#f26c4f;"><?=text($dmshop_design['sub_center_width'])?>px</b></td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">상품 페이지는 쇼핑몰 회원에게 상품의 상세정보와 주문, 보관, 장바구니 등의 기능을 제공하는 페이지 입니다.<br>본 상품 페이지 설정 기능을 통하여 등록된 상품을 일관되고 원하는 형태로 보여주실 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip1">상품페이지 스킨</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="select1">
<select id="skin_item" name="skin_item" class="select">
<?
$skin_array = shop_skin_dir("item");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_item").val("<?=text($dmshop_skin['skin_item'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/item</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품페이지 표기항목·기능 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip2">상품 구매정보</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">표기항목</td>
    <td><input type="checkbox" name="buy_use1" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use1');">시중가</td>
    <td width="30"></td>
    <td><input type="checkbox" name="buy_use2" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use2');">판매가</td>
    <td width="30"></td>
    <td><input type="checkbox" name="buy_use3" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use3');">적립금</td>
    <td width="30"></td>
    <td><input type="checkbox" name="buy_use4" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use4'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use4');">재고수량</td>
    <td width="30"></td>
    <td><input type="checkbox" name="buy_use5" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use5'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use5');">판매수량</td>
    <td width="30"></td>
    <td><input type="checkbox" name="buy_use6" value="1" class="checkbox" <? if ($dmshop_design_item['buy_use6'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'buy_use6');">배송비</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip3">SNS SAVE</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">표기항목</td>
    <td><input type="checkbox" name="sns_use1" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use1');">트위터</td>
    <td width="30"></td>
    <td><input type="checkbox" name="sns_use2" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use2');">페이스북</td>
    <td width="30"></td>
    <td><input type="checkbox" name="sns_use3" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use3');">카카오톡</td>
    <td width="30"></td>
    <td><input type="checkbox" name="sns_use4" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use4'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use4');">카카오스토리</td>
    <td width="30"></td>
    <td><input type="checkbox" name="sns_use5" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use5'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use5');">라인</td>
    <td width="30"></td>
    <td><input type="checkbox" name="sns_use6" value="1" class="checkbox" <? if ($dmshop_design_item['sns_use6'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'sns_use6');">SMS</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">상품 갤러리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">이미지 갯수</td>
    <td class="select3">
<select id="item_gallery" name="item_gallery" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}개</option>";

}
?>
</select>

<script type="text/javascript">
$("#item_gallery").val("<?=text($dmshop_design_item['item_gallery'])?>");
</script>
    </td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">관련상품</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">이미지 갯수</td>
    <td class="select3">
<select id="item_relation" name="item_relation" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}개</option>";

}
?>
</select>

<script type="text/javascript">
$("#item_relation").val("<?=text($dmshop_design_item['item_relation'])?>");
</script>
    </td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip6">내용 분류탭</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">표기항목</td>
    <td><input type="checkbox" name="tab_use1" value="1" class="checkbox" <? if ($dmshop_design_item['tab_use1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'tab_use1');">상세정보</td>
    <td width="30"></td>
    <td><input type="checkbox" name="tab_use2" value="1" class="checkbox" <? if ($dmshop_design_item['tab_use2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'tab_use2');">배송안내</td>
    <td width="30"></td>
    <td><input type="checkbox" name="tab_use3" value="1" class="checkbox" <? if ($dmshop_design_item['tab_use3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'tab_use3');">환불규정</td>
    <td width="30"></td>
    <td><input type="checkbox" name="tab_use4" value="1" class="checkbox" <? if ($dmshop_design_item['tab_use4'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'tab_use4');">상품평</td>
    <td width="30"></td>
    <td><input type="checkbox" name="tab_use5" value="1" class="checkbox" <? if ($dmshop_design_item['tab_use5'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'tab_use5');">상품문의</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="180">
    <td></td>
    <td class="subject"><p><span class="tip7">상품 요약안내</span></p><p>자동완성</p></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50" class="tx2">항목1</td>
    <td><input type="text" name="item_option1" value="<?=text($dmshop_design_item['item_option1'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="50"></td>
    <td width="50" class="tx2">항목2</td>
    <td><input type="text" name="item_option2" value="<?=text($dmshop_design_item['item_option2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
<tr><td height="10" colspan="5"></td></tr>
<tr>
    <td width="50" class="tx2">항목3</td>
    <td><input type="text" name="item_option3" value="<?=text($dmshop_design_item['item_option3'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="50"></td>
    <td width="50" class="tx2">항목4</td>
    <td><input type="text" name="item_option4" value="<?=text($dmshop_design_item['item_option4'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
<tr><td height="10" colspan="5"></td></tr>
<tr>
    <td width="50" class="tx2">항목5</td>
    <td><input type="text" name="item_option5" value="<?=text($dmshop_design_item['item_option5'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="50"></td>
    <td width="50" class="tx2">항목6</td>
    <td><input type="text" name="item_option6" value="<?=text($dmshop_design_item['item_option6'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
<tr><td height="10" colspan="5"></td></tr>
<tr>
    <td width="50" class="tx2">항목7</td>
    <td><input type="text" name="item_option7" value="<?=text($dmshop_design_item['item_option7'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="50"></td>
    <td width="50" class="tx2">항목8</td>
    <td><input type="text" name="item_option8" value="<?=text($dmshop_design_item['item_option8'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
<tr><td height="10" colspan="5"></td></tr>
<tr>
    <td width="50" class="tx2">항목9</td>
    <td><input type="text" name="item_option9" value="<?=text($dmshop_design_item['item_option9'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="50"></td>
    <td width="50" class="tx2">항목10</td>
    <td><input type="text" name="item_option10" value="<?=text($dmshop_design_item['item_option10'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품페이지 이지지·썸네일 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip8">대표 이미지</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">이미지 크기</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_default_use" value="0" onfocus="shopElementFocus('formDesign', 'image_default_use', '0');" class="radio" <? if ($dmshop_design_item['image_default_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_default_use', '0');">권장크기</td>
    <td width="10"></td>
    <td class="select1">
<select id="image_default" name="image_default" class="select" onfocus="shopElementFocus('formDesign', 'image_default_use', '0');">
    <option value="280|280">정사각형 비율(소) 280 * 280 px</option>
    <option value="300|300">정사각형 비율(중) 300 * 300 px</option>
    <option value="360|360">정사각형 비율(대) 360 * 360 px</option>
    <option value="0|0">─────────────────</option>
    <option value="187|280">DSLR 세로비율(소) 187 * 280 px</option>
    <option value="200|300">DSLR 세로비율(중) 200 * 300 px</option>
    <option value="240|360">DSLR 세로비율(대) 240 * 360 px</option>
    <option value="0|0">─────────────────</option>
    <option value="280|187">DSLR 가로비율(소) 280 * 187 px</option>
    <option value="300|200">DSLR 가로비율(중) 300 * 200 px</option>
    <option value="360|240">DSLR 가로비율(대) 360 * 240 px</option>
</select>

<script type="text/javascript">
$("#image_default").val("<?=text($dmshop_design_item['image_default'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="image_default_use" value="1" onfocus="shopElementFocus('formDesign', 'image_default_use', '1');" class="radio" <? if ($dmshop_design_item['image_default_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_default_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text1">가로</td>
    <td width="10"></td>
    <td><input type="text" name="image_default_width" value="<?=text($dmshop_design_item['image_default_width'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_default_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="20"></td>
    <td class="text1">세로</td>
    <td width="10"></td>
    <td><input type="text" name="image_default_height" value="<?=text($dmshop_design_item['image_default_height'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_default_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">썸네일 생성</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="thumb_type" value="0" onfocus="shopElementFocus('formDesign', 'thumb_type', '0');" class="radio" <? if ($dmshop_design_item['thumb_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'thumb_type', '0');">ARC (자동비율 조정 + 자르기)</td>
    <td width="30"></td>
    <td><input type="radio" name="thumb_type" value="1" onfocus="shopElementFocus('formDesign', 'thumb_type', '1');" class="radio" <? if ($dmshop_design_item['thumb_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'thumb_type', '1');">자동비율 조정</td>
    <td width="30"></td>
    <td><input type="radio" name="thumb_type" value="2" onfocus="shopElementFocus('formDesign', 'thumb_type', '2');" class="radio" <? if ($dmshop_design_item['thumb_type'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'thumb_type', '2');">원본유지</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스마트 줌</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="smart_zoom" value="1" onfocus="shopElementFocus('formDesign', 'smart_zoom', '0');" class="radio" <? if ($dmshop_design_item['smart_zoom'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'smart_zoom', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="smart_zoom" value="0" onfocus="shopElementFocus('formDesign', 'smart_zoom', '1');" class="radio" <? if ($dmshop_design_item['smart_zoom'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'smart_zoom', '1');">사용안함</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">기본 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_default1_border" name="image_default1_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_default1_border").val("<?=text($dmshop_design_item['image_default1_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_default1_border_color" name="image_default1_border_color" value="<?=text($dmshop_design_item['image_default1_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_default1_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_default1_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">활성 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_default2_border" name="image_default2_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_default2_border").val("<?=text($dmshop_design_item['image_default2_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_default2_border_color" name="image_default2_border_color" value="<?=text($dmshop_design_item['image_default2_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_default2_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_default2_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip9">상품 갤러리 이미지</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">이미지 크기</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_gallery_thumb_use" value="0" onfocus="shopElementFocus('formDesign', 'image_gallery_thumb_use', '0');" class="radio" <? if ($dmshop_design_item['image_gallery_thumb_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_gallery_thumb_use', '0');">권장크기</td>
    <td width="10"></td>
    <td class="select1">
<select id="image_gallery_thumb" name="image_gallery_thumb" class="select" onfocus="shopElementFocus('formDesign', 'image_gallery_thumb_use', '0');">
    <option value="60|60">정사각형 비율 60 * 60 px</option>
    <option value="80|80">정사각형 비율 80 * 80 px</option>
    <option value="100|100">정사각형 비율 100 * 100 px</option>
    <option value="0|0">─────────────────</option>
    <option value="80|53">DSLR 가로비율 80 * 53 px</option>
    <option value="100|67">DSLR 가로비율 100 * 67 px</option>
    <option value="0|0">─────────────────</option>
    <option value="53|80">DSLR 세로비율 53 * 80 px</option>
    <option value="67|100">DSLR 세로비율 67 * 100 px</option>
</select>

<script type="text/javascript">
$("#image_gallery_thumb").val("<?=text($dmshop_design_item['image_gallery_thumb'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="image_gallery_thumb_use" value="1" onfocus="shopElementFocus('formDesign', 'image_gallery_thumb_use', '1');" class="radio" <? if ($dmshop_design_item['image_gallery_thumb_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_gallery_thumb_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text1">가로</td>
    <td width="10"></td>
    <td><input type="text" name="image_gallery_thumb_width" value="<?=text($dmshop_design_item['image_gallery_thumb_width'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_gallery_thumb_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="20"></td>
    <td class="text1">세로</td>
    <td width="10"></td>
    <td><input type="text" name="image_gallery_thumb_height" value="<?=text($dmshop_design_item['image_gallery_thumb_height'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_gallery_thumb_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">기본 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_gallery1_border" name="image_gallery1_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_gallery1_border").val("<?=text($dmshop_design_item['image_gallery1_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_gallery1_border_color" name="image_gallery1_border_color" value="<?=text($dmshop_design_item['image_gallery1_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_gallery1_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_gallery1_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">활성 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_gallery2_border" name="image_gallery2_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_gallery2_border").val("<?=text($dmshop_design_item['image_gallery2_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_gallery2_border_color" name="image_gallery2_border_color" value="<?=text($dmshop_design_item['image_gallery2_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_gallery2_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_gallery2_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip10">관련상품 이미지</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">이미지 크기</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_relation_use" value="0" onfocus="shopElementFocus('formDesign', 'image_relation_use', '0');" class="radio" <? if ($dmshop_design_item['image_relation_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_relation_use', '0');">권장크기</td>
    <td width="10"></td>
    <td class="select1">
<select id="image_relation" name="image_relation" class="select" onfocus="shopElementFocus('formDesign', 'image_relation_use', '0');">
    <option value="60|60">정사각형 비율 60 * 60 px</option>
    <option value="80|80">정사각형 비율 80 * 80 px</option>
    <option value="100|100">정사각형 비율 100 * 100 px</option>
    <option value="0|0">─────────────────</option>
    <option value="80|53">DSLR 가로비율 80 * 53 px</option>
    <option value="100|67">DSLR 가로비율 100 * 67 px</option>
    <option value="0|0">─────────────────</option>
    <option value="53|80">DSLR 세로비율 53 * 80 px</option>
    <option value="67|100">DSLR 세로비율 67 * 100 px</option>
</select>

<script type="text/javascript">
$("#image_relation").val("<?=text($dmshop_design_item['image_relation'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="image_relation_use" value="1" onfocus="shopElementFocus('formDesign', 'image_relation_use', '1');" class="radio" <? if ($dmshop_design_item['image_relation_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_relation_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text1">가로</td>
    <td width="10"></td>
    <td><input type="text" name="image_relation_width" value="<?=text($dmshop_design_item['image_relation_width'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_relation_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="20"></td>
    <td class="text1">세로</td>
    <td width="10"></td>
    <td><input type="text" name="image_relation_height" value="<?=text($dmshop_design_item['image_relation_height'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_relation_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">기본 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_relation1_border" name="image_relation1_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_relation1_border").val("<?=text($dmshop_design_item['image_relation1_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_relation1_border_color" name="image_relation1_border_color" value="<?=text($dmshop_design_item['image_relation1_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_relation1_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_relation1_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">활성 테두리</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_relation2_border" name="image_relation2_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_relation2_border").val("<?=text($dmshop_design_item['image_relation2_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_relation2_border_color" name="image_relation2_border_color" value="<?=text($dmshop_design_item['image_relation2_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_relation2_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['image_relation2_border_color'])?>;"></div></td>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip11">내용 이미지 크기 제한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">가로</td>
    <td width="7"></td>
    <td><input type="text" name="item_image_width" value="<?=text($dmshop_design_item['item_image_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품페이지 글꼴(폰트) 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip12">상품명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_title_font_family" name="item_title_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_title_font_family").val("<?=text($dmshop_design_item['item_title_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_title_font_size" name="item_title_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_title_font_size").val("<?=text($dmshop_design_item['item_title_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_title_font_color" name="item_title_font_color" value="<?=text($dmshop_design_item['item_title_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_title_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_title_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_title_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_title_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_title_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_title_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_title_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_title_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_title_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_title_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_title_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip13">상품정보 항목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_subtitle_font_family" name="item_subtitle_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_subtitle_font_family").val("<?=text($dmshop_design_item['item_subtitle_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_subtitle_font_size" name="item_subtitle_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_subtitle_font_size").val("<?=text($dmshop_design_item['item_subtitle_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_subtitle_font_color" name="item_subtitle_font_color" value="<?=text($dmshop_design_item['item_subtitle_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_subtitle_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_subtitle_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_subtitle_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_subtitle_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_subtitle_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_subtitle_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_subtitle_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_subtitle_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_subtitle_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_subtitle_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_subtitle_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip14">시중가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_price_font_family" name="item_price_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_price_font_family").val("<?=text($dmshop_design_item['item_price_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_price_font_size" name="item_price_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_price_font_size").val("<?=text($dmshop_design_item['item_price_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_price_font_color" name="item_price_font_color" value="<?=text($dmshop_design_item['item_price_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_price_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_price_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_price_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_price_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_price_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_price_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_price_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_price_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_price_font_through" value="1" class="checkbox" <? if ($dmshop_design_item['item_price_font_through']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_price_font_through');">가운데줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip15">판매가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_money_font_family" name="item_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_money_font_family").val("<?=text($dmshop_design_item['item_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_money_font_size" name="item_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_money_font_size").val("<?=text($dmshop_design_item['item_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_money_font_color" name="item_money_font_color" value="<?=text($dmshop_design_item['item_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip16">적립금</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_cash_font_family" name="item_cash_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_cash_font_family").val("<?=text($dmshop_design_item['item_cash_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_cash_font_size" name="item_cash_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_cash_font_size").val("<?=text($dmshop_design_item['item_cash_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_cash_font_color" name="item_cash_font_color" value="<?=text($dmshop_design_item['item_cash_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_cash_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_cash_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_cash_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_cash_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_cash_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_cash_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_cash_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_cash_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_cash_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_cash_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_cash_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip17">재고수량</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_limit_font_family" name="item_limit_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_limit_font_family").val("<?=text($dmshop_design_item['item_limit_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_limit_font_size" name="item_limit_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_limit_font_size").val("<?=text($dmshop_design_item['item_limit_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_limit_font_color" name="item_limit_font_color" value="<?=text($dmshop_design_item['item_limit_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_limit_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_limit_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_limit_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_limit_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_limit_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_limit_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_limit_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_limit_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_limit_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_limit_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_limit_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip18">판매수량</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_sale_limit_font_family" name="item_sale_limit_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_sale_limit_font_family").val("<?=text($dmshop_design_item['item_sale_limit_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_sale_limit_font_size" name="item_sale_limit_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_sale_limit_font_size").val("<?=text($dmshop_design_item['item_sale_limit_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_sale_limit_font_color" name="item_sale_limit_font_color" value="<?=text($dmshop_design_item['item_sale_limit_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_sale_limit_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_sale_limit_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_sale_limit_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_sale_limit_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_sale_limit_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_sale_limit_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_sale_limit_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_sale_limit_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_sale_limit_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_sale_limit_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_sale_limit_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip19">배송비</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_delivery_money_font_family" name="item_delivery_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_delivery_money_font_family").val("<?=text($dmshop_design_item['item_delivery_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_delivery_money_font_size" name="item_delivery_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_delivery_money_font_size").val("<?=text($dmshop_design_item['item_delivery_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_delivery_money_font_color" name="item_delivery_money_font_color" value="<?=text($dmshop_design_item['item_delivery_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_delivery_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_delivery_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_delivery_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_delivery_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_delivery_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_delivery_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_delivery_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_delivery_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_delivery_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_delivery_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_delivery_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip20">주문금액</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_total_money_font_family" name="item_total_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_total_money_font_family").val("<?=text($dmshop_design_item['item_total_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_total_money_font_size" name="item_total_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_total_money_font_size").val("<?=text($dmshop_design_item['item_total_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_total_money_font_color" name="item_total_money_font_color" value="<?=text($dmshop_design_item['item_total_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_total_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_total_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_total_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_total_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_total_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_total_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_total_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_total_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_total_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_total_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_total_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip21">관련 상품명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_relation_title_font_family" name="item_relation_title_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_relation_title_font_family").val("<?=text($dmshop_design_item['item_relation_title_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_relation_title_font_size" name="item_relation_title_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_relation_title_font_size").val("<?=text($dmshop_design_item['item_relation_title_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_relation_title_font_color" name="item_relation_title_font_color" value="<?=text($dmshop_design_item['item_relation_title_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_relation_title_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_relation_title_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_title_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_title_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_title_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_title_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_title_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_title_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_title_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_title_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_title_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip22">관련 상품 가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_relation_money_font_family" name="item_relation_money_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_relation_money_font_family").val("<?=text($dmshop_design_item['item_relation_money_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_relation_money_font_size" name="item_relation_money_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_relation_money_font_size").val("<?=text($dmshop_design_item['item_relation_money_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_relation_money_font_color" name="item_relation_money_font_color" value="<?=text($dmshop_design_item['item_relation_money_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_relation_money_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_relation_money_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_money_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_money_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_money_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_money_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_money_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_money_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_relation_money_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_relation_money_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_relation_money_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip23">요약안내 항목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_optiontitle_font_family" name="item_optiontitle_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_optiontitle_font_family").val("<?=text($dmshop_design_item['item_optiontitle_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_optiontitle_font_size" name="item_optiontitle_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_optiontitle_font_size").val("<?=text($dmshop_design_item['item_optiontitle_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_optiontitle_font_color" name="item_optiontitle_font_color" value="<?=text($dmshop_design_item['item_optiontitle_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_optiontitle_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_optiontitle_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optiontitle_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_optiontitle_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optiontitle_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optiontitle_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_optiontitle_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optiontitle_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optiontitle_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_optiontitle_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optiontitle_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip24">요약안내 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="item_optioncontent_font_family" name="item_optioncontent_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#item_optioncontent_font_family").val("<?=text($dmshop_design_item['item_optioncontent_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="item_optioncontent_font_size" name="item_optioncontent_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#item_optioncontent_font_size").val("<?=text($dmshop_design_item['item_optioncontent_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="item_optioncontent_font_color" name="item_optioncontent_font_color" value="<?=text($dmshop_design_item['item_optioncontent_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="item_optioncontent_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['item_optioncontent_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optioncontent_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['item_optioncontent_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optioncontent_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optioncontent_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['item_optioncontent_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optioncontent_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="item_optioncontent_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['item_optioncontent_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'item_optioncontent_font_underline');">밑줄</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip25">도움말</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td class="select3">
<select id="help_font_family" name="help_font_family" class="select"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#help_font_family").val("<?=text($dmshop_design_item['help_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td class="select2">
<select id="help_font_size" name="help_font_size" class="select"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#help_font_size").val("<?=text($dmshop_design_item['help_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="10"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="help_font_color" name="help_font_color" value="<?=text($dmshop_design_item['help_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="help_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design_item['help_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="help_font_bold" value="1" class="checkbox" <? if ($dmshop_design_item['help_font_bold']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'help_font_bold');">볼드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="help_font_italic" value="1" class="checkbox" <? if ($dmshop_design_item['help_font_italic']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'help_font_italic');">이탤릭</td>
    <td width="30"></td>
    <td><input type="checkbox" name="help_font_underline" value="1" class="checkbox" <? if ($dmshop_design_item['help_font_underline']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'help_font_underline');">밑줄</td>
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
    <td><a href="./design_item.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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