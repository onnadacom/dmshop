<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "100";
$shop['title'] = "메인 디자인 설정";
include_once("./_top.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .selectBox-dropdown {width:170px; height:19px;}
.contents_box .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .layout_off {border:3px solid #e4e4e4; cursor:pointer;}
.contents_box .layout_on {border:3px solid #018598; cursor:pointer;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box select").selectBox();

    $(".tip1").simpletip({ content: '쇼핑몰 메인페이지 레이아웃(메뉴 배치)을 선택합니다.' });
    $(".tip2").simpletip({ content: '메인페이지의 상단, 메뉴, 메인중앙, 하단 스킨을 선택합니다.' });
    $(".tip3").simpletip({ content: '메인 페이지 정렬 방식을 설정합니다.' });
    $(".tip4").simpletip({ content: '메뉴 및 메인 중앙의 전체 가로폭을 선택합니다.' });
    $(".tip5").simpletip({ content: '메인페이지의 배경화면 이미지를 첨부 및 설정합니다.' });
    $(".tip6").simpletip({ content: '메인페이지의 배경화면 색상을 설정합니다.' });
    $(".tip7").simpletip({ content: '메인페이지의 스크롤박스 스킨을 선택합니다.' });

});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#main_background_color').ColorPicker({
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

    f.action = "./design_layout_main_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formDesign" enctype="multipart/form-data" autocomplete="off">
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
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메인 레이아웃·스킨 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject"><span class="tip0">메인 디자인 안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 8px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="msg1">
메인 페이지는 홈페이지 접속시 보여지는 첫화면을 말 합니다. 메인 페이지는 레이아웃과 각 영역에 ‘스킨’ 또는 ‘직접 만들기’의 조합을 통해 생성 됩니다.<br>
중상급 개발자는 스킨을 직접 코딩/수정하여 이용하시면, 보다 자유로운 구성과 연출이 가능합니다.<br>
- 직접 만들기 : 좌측 메뉴의 ‘직접 만들기’를 직접 제작하신 개별 디자인을 각각의 영역에 적용 합니다.<br>
- 스킨명 선택 : FTP의 ‘설치 디렉토리’에 설치된 스킨 디자인을 각각의 영역에 적용 합니다.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;제작 방식에 따라 직접 만들기의 설정값이 연동되는 스킨이 제공 되기도 합니다.
    </td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject"><span class="tip1">메인 레이아웃</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_layout">
<tr height="232">
    <td width="33%">
<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('0');">
<tr>
    <td><div name="0" class="layout_off"><img src="<?=$shop['image_path']?>/adm/layout_main0.gif"></div></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('0');">
<tr>
    <td><input type="radio" name="main_layout" value="0" class="radio" <? if ($dmshop_design['main_layout'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1"><?=shop_design_layout_name("main", "0");?></td>
</tr>
</table>
    </td>
    <td width="34%" style="border-left:1px solid #ececec; border-right:1px solid #ececec;">
<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('1');">
<tr>
    <td><div name="1" class="layout_off"><img src="<?=$shop['image_path']?>/adm/layout_main1.gif"></div></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('1');">
<tr>
    <td><input type="radio" name="main_layout" value="1" class="radio" <? if ($dmshop_design['main_layout'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1"><?=shop_design_layout_name("main", "1");?></td>
</tr>
</table>
    </td>
    <td width="33%">
<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('2');">
<tr>
    <td><div name="2" class="layout_off"><img src="<?=$shop['image_path']?>/adm/layout_main2.gif"></div></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('2');">
<tr>
    <td><input type="radio" name="main_layout" value="2" class="radio" <? if ($dmshop_design['main_layout'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1"><?=shop_design_layout_name("main", "2");?></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#ececec"></td></tr>
<tr height="232">
    <td width="33%">
<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('3');">
<tr>
    <td><div name="3" class="layout_off"><img src="<?=$shop['image_path']?>/adm/layout_main3.gif"></div></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('3');">
<tr>
    <td><input type="radio" name="main_layout" value="3" class="radio" <? if ($dmshop_design['main_layout'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1"><?=shop_design_layout_name("main", "3");?></td>
</tr>
</table>
    </td>
    <td width="34%" style="border-left:1px solid #ececec; border-right:1px solid #ececec;">
<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('4');">
<tr>
    <td><div name="4" class="layout_off"><img src="<?=$shop['image_path']?>/adm/layout_main4.gif"></div></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto" onclick="mainLayout('4');">
<tr>
    <td><input type="radio" name="main_layout" value="4" class="radio" <? if ($dmshop_design['main_layout'] == '4') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1"><?=shop_design_layout_name("main", "4");?></td>
</tr>
</table>
    </td>
    <td width="33%"></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="160">
    <td></td>
    <td class="subject"><span class="tip2">메인 스킨</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60" class="text1">상단</td>
    <td>
<select id="skin_main_top" name="skin_main_top" class="select">
    <option value="">직접 만들기</option>
<?
$skin_array = shop_skin_dir("top");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_main_top").val("<?=text($dmshop_skin['skin_main_top'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/top</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="60" class="text1">메뉴</td>
    <td>
<select id="skin_main_menu" name="skin_main_menu" class="select">
    <option value="">직접 만들기</option>
<?
$skin_array = shop_skin_dir("menu");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_main_menu").val("<?=text($dmshop_skin['skin_main_menu'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/menu</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="60" class="text1">메인중앙</td>
    <td>
<select id="skin_main" name="skin_main" class="select">
    <option value="">직접 만들기</option>
<?
$skin_array = shop_skin_dir("main");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_main").val("<?=text($dmshop_skin['skin_main'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/main</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="60" class="text1">하단</td>
    <td>
<select id="skin_main_bottom" name="skin_main_bottom" class="select">
    <option value="">직접 만들기</option>
<?
$skin_array = shop_skin_dir("bottom");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_main_bottom").val("<?=text($dmshop_skin['skin_main_bottom'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/bottom</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메인 크기·배경 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">페이지 정렬</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="main_body_position" value="0" class="radio" <? if ($dmshop_design['main_body_position'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'main_body_position', '0');">왼쪽 정렬</td>
    <td width="20"></td>
    <td><input type="radio" name="main_body_position" value="1" class="radio" <? if ($dmshop_design['main_body_position'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'main_body_position', '1');">가운데 정렬</td>
    <td width="20"></td>
    <td><input type="radio" name="main_body_position" value="2" class="radio" <? if ($dmshop_design['main_body_position'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'main_body_position', '2');">오른쪽 정렬</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">메인 가로 폭</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="main_width_use" value="0" class="radio" <? if ($dmshop_design['main_width_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_width_use', '0');">권장크기</td>
    <td width="10"></td>
    <td>
<select id="main_width" name="main_width" class="select" onclick="shopElementFocus('formDesign', 'main_width_use', '0');">
    <option value="160|830">메뉴 160px / 메인중앙 830px</option>
    <option value="180|810">메뉴 180px / 메인중앙 810px</option>
    <option value="200|790">메뉴 200px / 메인중앙 790px</option>
    <option value="250|740">메뉴 250px / 메인중앙 740px</option>
    <option value="300|690">메뉴 300px / 메인중앙 690px</option>
</select>

<script type="text/javascript">
$("#main_width").val("<?=text($dmshop_design['main_width'])?>");
</script>
    </td>
    <td width="30"></td>
    <td><input type="radio" name="main_width_use" value="1" onclick="shopElementFocus('formDesign', 'main_width_use', '1');" class="radio" <? if ($dmshop_design['main_width_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_width_use', '1');">임의크기</td>
    <td width="20"></td>
    <td class="text2">메뉴</td>
    <td width="5"></td>
    <td><input type="text" name="main_menu_width" value="<?=text($dmshop_design['main_menu_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" onclick="shopElementFocus('formDesign', 'main_width_use', '1');" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px  / 메인중앙</td>
    <td width="5"></td>
    <td><input type="text" name="main_center_width" value="<?=text($dmshop_design['main_center_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" onclick="shopElementFocus('formDesign', 'main_width_use', '1');" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">메뉴, 메인중앙간 여백</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="main_mc_width" value="<?=text($dmshop_design['main_mc_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="90">
    <td></td>
    <td class="subject"><span class="tip5">메인 배경 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "main_background_image";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="main_background_image_type" value="0" class="radio" <? if ($dmshop_design['main_background_image_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_background_image_type', '0');">반복 없음</td>
    <td width="20"></td>
    <td><input type="radio" name="main_background_image_type" value="1" class="radio" <? if ($dmshop_design['main_background_image_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_background_image_type', '1');">가로 반복</td>
    <td width="20"></td>
    <td><input type="radio" name="main_background_image_type" value="2" class="radio" <? if ($dmshop_design['main_background_image_type'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_background_image_type', '2');">세로 반복</td>
    <td width="20"></td>
    <td><input type="radio" name="main_background_image_type" value="3" class="radio" <? if ($dmshop_design['main_background_image_type'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_background_image_type', '3');">가로세로 반복</td>
    <td width="20"></td>
    <td><input type="radio" name="main_background_image_type" value="4" class="radio" <? if ($dmshop_design['main_background_image_type'] == '4') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'main_background_image_type', '4');">고정</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">메인 배경 색상</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="main_background_color" name="main_background_color" value="<?=text($dmshop_design['main_background_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="main_background_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_design['main_background_color'])?>;"></div></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">스크롤박스</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_main_scrollbox" name="skin_main_scrollbox" class="select">
<option value=''>:: 사용안함 ::</option>
<?
$skin_array = shop_skin_dir("scrollbox");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_main_scrollbox").val("<?=text($dmshop_skin['skin_main_scrollbox'])?>");
</script>
    </td>
    <td width="20"></td>
    <td class="text2">상단으로부터 높이</td>
    <td width="5"></td>
    <td><input type="text" name="main_scrollbox_top" value="<?=text($dmshop_design['main_scrollbox_top'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
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
    <td><a href="./design_layout_main.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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

<script type="text/javascript">
function mainLayout(id)
{

    shopElementFocus('formDesign', 'main_layout', id);

    $(".main_layout div[name='0']").removeClass("layout_on");
    $(".main_layout div[name='1']").removeClass("layout_on");
    $(".main_layout div[name='2']").removeClass("layout_on");
    $(".main_layout div[name='3']").removeClass("layout_on");
    $(".main_layout div[name='4']").removeClass("layout_on");
    $(".main_layout div[name='5']").removeClass("layout_on");

    $(".main_layout div[name='"+id+"']").addClass("layout_on");

}

mainLayout(<?=text($dmshop_design['main_layout'])?>);
</script>

<?
include_once("./_bottom.php");
?>