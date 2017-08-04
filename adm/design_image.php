<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "400";
$shop['title'] = "기타 이미지 설정";
include_once("./_top.php");

$colspan = "6";

$dmshop_image = shop_design_image();
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:180px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '상품목록 이미지의 공통 크기를 설정합니다.' });
    $(".tip2").simpletip({ content: '이미지 썸네일 생성 방식을 설정합니다.' });
    $(".tip3").simpletip({ content: '이미지 기본 테두리를 설정합니다.' });
    $(".tip4").simpletip({ content: '이미지 활성 테두리를 설정합니다.' });
    $(".tip5").simpletip({ content: '기획전 목록의 공통 썸네일 크기를 설정합니다.' });
    $(".tip6").simpletip({ content: '이미지 썸네일 생성 방식을 설정합니다.' });
    $(".tip7").simpletip({ content: '이미지 기본 테두리를 설정합니다.' });
    $(".tip8").simpletip({ content: '이미지 활성 테두리를 설정합니다.' });

});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#image_category1_border_color, #image_category2_border_color, #image_plan1_border_color, #image_plan2_border_color').ColorPicker({
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

    f.action = "./design_image_update.php";
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
    <td class="subject">기타 이미지 설정안내</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">상품 목록, 기획전 목록 등에서 사용되는 이미지를 설정 합니다. (메인, 상품 페이지 등의 이미지는 해당 설정 페이지에서 변경하시기 바랍니다.)<br>아래의 설정된 이미지는 해당 페이지의 스킨이 DM SHOP이 제공하는 기본 스킨일 때 100% 적용되며, 그 외의 스킨에서는 적용이 안될 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품 목록 이미지 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">공통크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_category_use" value="0" onfocus="shopElementFocus('formDesign', 'image_category_use', '0');" class="radio" <? if ($dmshop_image['image_category_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_category_use', '0');">권장크기</td>
    <td width="10"></td>
    <td class="select1">
<select id="image_category" name="image_category" class="select" onfocus="shopElementFocus('formDesign', 'image_category_use', '0');">
    <option value="80|80">정사각형 비율(소) 80 * 80 px</option>
    <option value="120|120">정사각형 비율(중) 120 * 120 px</option>
    <option value="140|140">정사각형 비율(대) 140 * 140 px</option>
    <option value="160|160">정사각형 비율(대) 160 * 160 px</option>
    <option value="200|200">정사각형 비율(대) 200 * 200 px</option>
    <option value="0|0">─────────────────</option>
    <option value="80|120">DSLR 세로비율(소) 80 * 120 px</option>
    <option value="107|160">DSLR 세로비율(중) 107 * 160 px</option>
    <option value="200|300">DSLR 세로비율(대) 200 * 300 px</option>
    <option value="0|0">─────────────────</option>
    <option value="120|80">DSLR 가로비율(소) 120 * 80 px</option>
    <option value="160|107">DSLR 가로비율(중) 160 * 107 px</option>
    <option value="300|200">DSLR 가로비율(대) 300 * 200 px</option>
</select>

<script type="text/javascript">
$("#image_category").val("<?=text($dmshop_image['image_category'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="image_category_use" value="1" onfocus="shopElementFocus('formDesign', 'image_category_use', '1');" class="radio" <? if ($dmshop_image['image_category_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'image_category_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text1">가로</td>
    <td width="10"></td>
    <td><input type="text" name="image_category_width" value="<?=text($dmshop_image['image_category_width'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_category_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="20"></td>
    <td class="text1">세로</td>
    <td width="10"></td>
    <td><input type="text" name="image_category_height" value="<?=text($dmshop_image['image_category_height'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_category_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="30"></td>
    <td><input type="checkbox" name="image_category_all" value="1" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="checkbox" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'image_category_all');">동시 적용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">썸네일 생성</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_category_thumb_type" value="0" onfocus="shopElementFocus('formDesign', 'image_category_thumb_type', '0');" class="radio" <? if ($dmshop_image['image_category_thumb_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_category_thumb_type', '0');">ARC (자동비율 조정 + 자르기)</td>
    <td width="30"></td>
    <td><input type="radio" name="image_category_thumb_type" value="1" onfocus="shopElementFocus('formDesign', 'image_category_thumb_type', '1');" class="radio" <? if ($dmshop_image['image_category_thumb_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_category_thumb_type', '1');">자동비율 조정</td>
    <td width="30"></td>
    <td><input type="radio" name="image_category_thumb_type" value="2" onfocus="shopElementFocus('formDesign', 'image_category_thumb_type', '2');" class="radio" <? if ($dmshop_image['image_category_thumb_type'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_category_thumb_type', '2');">원본유지</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">기본 테두리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_category1_border" name="image_category1_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_category1_border").val("<?=text($dmshop_image['image_category1_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_category1_border_color" name="image_category1_border_color" value="<?=text($dmshop_image['image_category1_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_category1_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_image['image_category1_border_color'])?>;"></div></td>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">활성 테두리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_category2_border" name="image_category2_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_category2_border").val("<?=text($dmshop_image['image_category2_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_category2_border_color" name="image_category2_border_color" value="<?=text($dmshop_image['image_category2_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_category2_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_image['image_category2_border_color'])?>;"></div></td>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 기획전 목록 이미지 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">공통 썸네일 크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_plan_use" value="0" onfocus="shopElementFocus('formDesign', 'image_plan_use', '0');" class="radio" <? if ($dmshop_image['image_plan_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_plan_use', '0');">권장크기</td>
    <td width="10"></td>
    <td class="select1">
<select id="image_plan" name="image_plan" class="select" onfocus="shopElementFocus('formDesign', 'image_plan_use', '0');">
    <option value="80|80">정사각형 비율(소) 80 * 80 px</option>
    <option value="120|120">정사각형 비율(중) 120 * 120 px</option>
    <option value="140|140">정사각형 비율(대) 140 * 140 px</option>
    <option value="160|160">정사각형 비율(대) 160 * 160 px</option>
    <option value="200|200">정사각형 비율(대) 200 * 200 px</option>
    <option value="0|0">─────────────────</option>
    <option value="80|120">DSLR 세로비율(소) 80 * 120 px</option>
    <option value="107|160">DSLR 세로비율(중) 107 * 160 px</option>
    <option value="200|300">DSLR 세로비율(대) 200 * 300 px</option>
    <option value="0|0">─────────────────</option>
    <option value="120|80">DSLR 가로비율(소) 120 * 80 px</option>
    <option value="160|107">DSLR 가로비율(중) 160 * 107 px</option>
    <option value="300|200">DSLR 가로비율(대) 300 * 200 px</option>
</select>

<script type="text/javascript">
$("#image_plan").val("<?=text($dmshop_image['image_plan'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="image_plan_use" value="1" onfocus="shopElementFocus('formDesign', 'image_plan_use', '1');" class="radio" <? if ($dmshop_image['image_plan_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'image_plan_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text1">가로</td>
    <td width="10"></td>
    <td><input type="text" name="image_plan_width" value="<?=text($dmshop_image['image_plan_width'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_plan_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="20"></td>
    <td class="text1">세로</td>
    <td width="10"></td>
    <td><input type="text" name="image_plan_height" value="<?=text($dmshop_image['image_plan_height'])?>" onfocus="shopInfocus1(this); shopElementFocus('formDesign', 'image_plan_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="30"></td>
    <td><input type="checkbox" name="image_plan_all" value="1" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="checkbox" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'image_plan_all');">동시 적용</td>
    <td width="10"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">썸네일 생성</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="image_plan_thumb_type" value="0" onfocus="shopElementFocus('formDesign', 'image_plan_thumb_type', '0');" class="radio" <? if ($dmshop_image['image_plan_thumb_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_plan_thumb_type', '0');">ARC (자동비율 조정 + 자르기)</td>
    <td width="30"></td>
    <td><input type="radio" name="image_plan_thumb_type" value="1" onfocus="shopElementFocus('formDesign', 'image_plan_thumb_type', '1');" class="radio" <? if ($dmshop_image['image_plan_thumb_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_plan_thumb_type', '1');">자동비율 조정</td>
    <td width="30"></td>
    <td><input type="radio" name="image_plan_thumb_type" value="2" onfocus="shopElementFocus('formDesign', 'image_plan_thumb_type', '2');" class="radio" <? if ($dmshop_image['image_plan_thumb_type'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'image_plan_thumb_type', '2');">원본유지</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">기본 테두리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_plan1_border" name="image_plan1_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_plan1_border").val("<?=text($dmshop_image['image_plan1_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_plan1_border_color" name="image_plan1_border_color" value="<?=text($dmshop_image['image_plan1_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_plan1_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_image['image_plan1_border_color'])?>;"></div></td>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">활성 테두리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
    <td class="text1">두께</td>
    <td width="10"></td>
    <td class="select3">
<select id="image_plan2_border" name="image_plan2_border" class="select">
<option value="">:: 사용안함 ::</option>
<?
for ($i=1; $i<=5; $i++) {

    echo "<option value='".$i."'>{$i}px</option>";

}
?>
</select>

<script type="text/javascript">
$("#image_plan2_border").val("<?=text($dmshop_image['image_plan2_border'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="image_plan2_border_color" name="image_plan2_border_color" value="<?=text($dmshop_image['image_plan2_border_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="image_plan2_border_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_image['image_plan2_border_color'])?>;"></div></td>
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
    <td><a href="./design_image.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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