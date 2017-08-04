<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "204";
$shop['title'] = "가로 메뉴바 (WMBAR)";
include_once("./_top.php");
include_once("$shop[path]/lib/text.lib.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 가로메뉴바 설정
$dmshop_wmbar = shop_design_wmbar();

// 메인, 서브 권장설정
if ($dmshop_design['main_width_use'] == '0') { $dmshop_design['main_menu_width'] = shop_split("|", $dmshop_design['main_width'], "0"); $dmshop_design['main_center_width'] = shop_split("|", $dmshop_design['main_width'], "1"); }
if ($dmshop_design['sub_width_use'] == '0') { $dmshop_design['sub_menu_width'] = shop_split("|", $dmshop_design['sub_width'], "0"); $dmshop_design['sub_center_width'] = shop_split("|", $dmshop_design['sub_width'], "1"); }
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .tapeline_bg {background:url('<?=$shop['image_path']?>/adm/tapeline_bg.gif') repeat;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".tip1").simpletip({ content: '가로 메뉴바가 적용된 모습입니다.' });
    $(".tip2").simpletip({ content: '가로 메뉴바의 크기를 설정합니다.' });
    $(".tip3").simpletip({ content: '가로 메뉴바의 배경이미지를 첨부합니다.' });
    $(".tip4").simpletip({ content: '가로 메뉴바의 배경 색상을 입력합니다.' });
    $(".tip5").simpletip({ content: '가로 메뉴바 속의 메뉴 버튼의 정렬방식을 선택합니다.' });
    $(".tip6").simpletip({ content: '메뉴 버튼간의 좌우여백을 입력합니다.' });
    $(".tip7").simpletip({ content: '메뉴 버튼간의 구분막대를 설정합니다.' });
    $(".tip8").simpletip({ content: '버튼 제작방식을 선택합니다.' });

    $(".tip8_100").simpletip({ content: '메뉴 버튼의 기본 폰트를 설정합니다.' });
    $(".tip8_101").simpletip({ content: '메뉴 버튼의 활성화 폰트를 설정합니다.' });
    $(".tip8_102").simpletip({ content: '가로 메뉴바에 보여질 메뉴 버튼을 설정합니다.' });

    $(".tip8_200").simpletip({ content: '이미지 버튼으로 사용할 폰트를 첨부합니다.' });
    $(".tip8_201").simpletip({ content: '메뉴 버튼의 기본 폰트를 설정합니다.' });
    $(".tip8_202").simpletip({ content: '메뉴 버튼의 활성화 폰트를 설정합니다.' });
    $(".tip8_203").simpletip({ content: '가로 메뉴바에 보여질 메뉴 버튼을 설정합니다.' });

    $(".tip8_300").simpletip({ content: '가로 메뉴바에 보여질 메뉴 버튼을 설정합니다.' });

    $(".tip8_400").simpletip({ content: '가로 메뉴바에 사용할 플래시 파일을 첨부합니다.' });

});
</script>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select1 select").selectBox();
});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#wmbar_background_color, #wmbar_line_color, #wmbar_text1_font_color, #wmbar_text2_font_color, #wmbar_image1_font_color, #wmbar_image2_font_color').ColorPicker({
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

    f.action = "./design_wmbar_update.php";
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
    <col width="">
</colgroup>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="4" class="pagetitle">:: 가로 메뉴바 레이아웃 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">상단 설정정보</td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_main<?=$dmshop_design['main_layout']?>_top.gif"></div></td>
    <td width="20"></td>
    <td width="200" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_title">메인 디자인 설정</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">레이아웃 : <?=shop_design_layout_name("main", $dmshop_design['main_layout']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">매뉴스킨 : <?=shop_design_skin_name($dmshop_skin['skin_main_menu']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">전체가로 : <b style="color:#f26c4f;"><?=(int)($dmshop_design['main_menu_width'] + $dmshop_design['main_center_width'] + $dmshop_design['main_mc_width']);?>px</b></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <?=text($dmshop_design['main_menu_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메인중앙 : <?=text($dmshop_design['main_center_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴, 메인중앙간 여백 : <?=text($dmshop_design['main_mc_width'])?>px</td>
</tr>
</table>
    </td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_sub<?=$dmshop_design['sub_layout']?>_top.gif"></div></td>
    <td width="20"></td>
    <td width="200" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_title">서브 디자인 설정</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">레이아웃 : <?=shop_design_layout_name("sub", $dmshop_design['sub_layout']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴스킨 : <?=shop_design_skin_name($dmshop_skin['skin_sub_menu']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">전체가로 : <b style="color:#f26c4f;"><?=(int)($dmshop_design['sub_menu_width'] + $dmshop_design['sub_center_width'] + $dmshop_design['sub_mc_width']);?>px</b></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <?=text($dmshop_design['sub_menu_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">공통영역 : <?=text($dmshop_design['sub_center_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴, 공통영역간 여백 : <?=text($dmshop_design['sub_mc_width'])?>px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">메인/서브 디자인 설정의 상단영역 내에 포함될 가로 메뉴바를 생성합니다. (가로 메뉴바의 크기는 상단영역의 가로크기를 초과하지 않도록 주의 하세요.)<br>상단스킨이 ‘직접 만들기’로 선택하시면 아래의 설정된 가로 메뉴바가 100% 적용되며, 다른 스킨 선택시에는 전체 또는 일부가 지원되지 않을 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><p><span class="tip1">미리보기</span></p><p>(설정 저장시 적용)</p></td>
    <td class="bc1"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tapeline_bg" valign="top">
<table class="tapeline" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20" class="tapeline2" style="min-width:20px;"></td>
    <td width="50" style="min-width:50px;"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="70"></td></tr>
</table>

<?=shop_wmbar_skin("");?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="70"></td></tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">메뉴바 크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1">가로크기</td>
    <td width="10"></td>
    <td><input type="text" name="wmbar_width" value="<?=text($dmshop_wmbar['wmbar_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="30"></td>
    <td class="text1">세로크기</td>
    <td width="10"></td>
    <td><input type="text" name="wmbar_height" value="<?=text($dmshop_wmbar['wmbar_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject"><span class="tip3"><p>가로 메뉴바</p><p>배경 이미지</p></span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">기본 백그라운드</td>
    <td>
<?
$upload_mode = "wmbar_default";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">좌측 모서리</td>
    <td>
<?
$upload_mode = "wmbar_left";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">우측 모서리</td>
    <td>
<?
$upload_mode = "wmbar_right";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">배경 색상</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_background_color" name="wmbar_background_color" value="<?=text($dmshop_wmbar['wmbar_background_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_background_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_background_color'])?>;"></div></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">메뉴버튼 정렬</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="wmbar_position" value="0" class="radio" <? if ($dmshop_wmbar['wmbar_position'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_position', '0');">왼쪽 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_position" value="1" class="radio" <? if ($dmshop_wmbar['wmbar_position'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_position', '1');">가운데 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_position" value="2" class="radio" <? if ($dmshop_wmbar['wmbar_position'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_position', '2');">오른쪽 정렬</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">메뉴버튼간 좌우여백</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2" align="right">좌/우 각각</td>
    <td width="10"></td>
    <td><input type="text" name="wmbar_margin" value="<?=text($dmshop_wmbar['wmbar_margin'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="tx2">px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip7">메뉴버튼간 구분막대</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<script type="text/javascript">
function wmbarLineLayer(mode)
{

    if (mode == '0') {

        $("#wmbar_line_color_layer").show();
        $("#wmbar_line_image_layer").hide();

    } else {

        $("#wmbar_line_color_layer").hide();
        $("#wmbar_line_image_layer").show();

    }

}
</script>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td><input type="radio" name="wmbar_line_use" value="0" onclick="wmbarLineLayer('0');" class="radio" <? if ($dmshop_wmbar['wmbar_line_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_line_use', '0'); wmbarLineLayer('0');">색상라인</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_line_use" value="1" onclick="wmbarLineLayer('1');" class="radio" <? if ($dmshop_wmbar['wmbar_line_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_line_use', '1'); wmbarLineLayer('1');">이미지</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td>
<div id="wmbar_line_color_layer" style="display:<? if ($dmshop_wmbar['wmbar_line_use'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_line_color" name="wmbar_line_color" value="<?=text($dmshop_wmbar['wmbar_line_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_line_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_line_color'])?>;"></div></td>
</tr>
</table>
</div>

<div id="wmbar_line_image_layer" style="display:<? if ($dmshop_wmbar['wmbar_line_use'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<?
$upload_mode = "wmbar_line";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
</div>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 가로 메뉴바 버튼 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">버튼 제작안내</td>
    <td class="bc1"></td>
    <td></td>
    <td class="msg1">위에서 선택하신 가로 메뉴바에 들어갈 버튼을 생성 합니다. 버튼 제작 방식은 총 4가지로 원하는 방식을 선택하시면 됩니다.<br>버튼의 좌우 순서는 관리자모드의 ‘상품·메뉴’ > ‘상품분류 생성·관리’ 페이지에서 변경하실 수 있습니다.</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">버튼 제작 방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function wmbarBtnClick(mode)
{

    if (mode == '0') {

        $("#wmbar_list_text").show();
        $("#wmbar_list_image1").hide();
        $("#wmbar_list_image2").hide();
        $("#wmbar_list_flash").hide();

    }

    if (mode == '1') {

        $("#wmbar_list_text").hide();
        $("#wmbar_list_image1").show();
        $("#wmbar_list_image2").hide();
        $("#wmbar_list_flash").hide();

    }

    if (mode == '2') {

        $("#wmbar_list_text").hide();
        $("#wmbar_list_image1").hide();
        $("#wmbar_list_image2").show();
        $("#wmbar_list_flash").hide();

    }

    if (mode == '3') {

        $("#wmbar_list_text").hide();
        $("#wmbar_list_image1").hide();
        $("#wmbar_list_image2").hide();
        $("#wmbar_list_flash").show();

    }

}
</script>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="wmbar_list_use" value="0" onclick="wmbarBtnClick('0');" class="radio" <? if ($dmshop_wmbar['wmbar_list_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_list_use', '0'); wmbarBtnClick('0');">텍스트 버튼</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_list_use" value="1" onclick="wmbarBtnClick('1');" class="radio" <? if ($dmshop_wmbar['wmbar_list_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_list_use', '1'); wmbarBtnClick('1');">이미지 버튼(자동생성)</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_list_use" value="2" onclick="wmbarBtnClick('2');" class="radio" <? if ($dmshop_wmbar['wmbar_list_use'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_list_use', '2'); wmbarBtnClick('2');">이미지 버튼(직접등록)</td>
    <td width="30"></td>
    <td><input type="radio" name="wmbar_list_use" value="3" onclick="wmbarBtnClick('3');" class="radio" <? if ($dmshop_wmbar['wmbar_list_use'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formDesign', 'wmbar_list_use', '3'); wmbarBtnClick('3');">플래시 네비게이션(직접등록)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="wmbar_list_text" style="display:<? if ($dmshop_wmbar['wmbar_list_use'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="select1">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_100">기본 폰트</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td>
<select id="wmbar_text1_font_family" name="wmbar_text1_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#wmbar_text1_font_family").val("<?=text($dmshop_wmbar['wmbar_text1_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td>
<select id="wmbar_text1_font_size" name="wmbar_text1_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#wmbar_text1_font_size").val("<?=text($dmshop_wmbar['wmbar_text1_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="5"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_text1_font_color" name="wmbar_text1_font_color" value="<?=text($dmshop_wmbar['wmbar_text1_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_text1_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_text1_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text1_font_bold" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text1_font_bold'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text1_font_bold');"><b>볼드</b></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text1_font_italic" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text1_font_italic'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text1_font_italic');"><i>이탤릭</i></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text1_font_underline" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text1_font_underline'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text1_font_underline');"><u>밑줄</u></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_101">활성화 폰트</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">글꼴</td>
    <td width="10"></td>
    <td>
<select id="wmbar_text2_font_family" name="wmbar_text2_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#wmbar_text2_font_family").val("<?=text($dmshop_wmbar['wmbar_text2_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td>
<select id="wmbar_text2_font_size" name="wmbar_text2_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#wmbar_text2_font_size").val("<?=text($dmshop_wmbar['wmbar_text2_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="5"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_text2_font_color" name="wmbar_text2_font_color" value="<?=text($dmshop_wmbar['wmbar_text2_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_text2_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_text2_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text2_font_bold" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text2_font_bold'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text2_font_bold');"><b>볼드</b></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text2_font_italic" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text2_font_italic'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text2_font_italic');"><i>이탤릭</i></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_text2_font_underline" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_text2_font_underline'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_text2_font_underline');"><u>밑줄</u></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip8_102">표기항목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<tr bgcolor="#f5f5f5" height="30">
    <td width="1" bgcolor="#ececec"></td>
    <td width="60" class="tx2" align="center">표기</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">메뉴명</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">기본 폰트</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">활성화 폰트</td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "1");
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="text_etc_menu_1" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="text_etc_menu_1_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (홈)</td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text1_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text1_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text1_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text1_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text1_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text1_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text1_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($dmshop_wmlist['title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text2_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text2_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text2_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text2_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text2_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text2_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text2_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($dmshop_wmlist['title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[category_table] where category = '1' and view = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("category", $row['id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="text_category_menu_<?=$row['id']?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=text($row['subject'])?></td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text1_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text1_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text1_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text1_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text1_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text1_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text1_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($row['subject']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text2_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text2_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text2_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text2_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text2_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text2_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text2_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($row['subject']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("board", $row['bbs_id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="text_board_menu_<?=text($row['bbs_id'])?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=text($row['bbs_title'])?></td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text1_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text1_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text1_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text1_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text1_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text1_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text1_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($row['bbs_title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text2_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text2_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text2_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text2_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text2_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text2_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text2_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($row['bbs_title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "2");
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="text_etc_menu_2" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="text_etc_menu_2_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (기획전)</td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text1_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text1_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text1_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text1_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text1_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text1_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text1_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text1_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($dmshop_wmlist['title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
    <td align="center">
<?
echo "<span style=\"";

echo "line-height:1em;";

if ($dmshop_wmbar['wmbar_text2_font_family']) {

    echo "font-family:".text($dmshop_wmbar['wmbar_text2_font_family']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_size']) {

    echo "font-size:".text($dmshop_wmbar['wmbar_text2_font_size'])."px;";

}

if ($dmshop_wmbar['wmbar_text2_font_color']) {

    echo "color:#".text($dmshop_wmbar['wmbar_text2_font_color']).";";

}

if ($dmshop_wmbar['wmbar_text2_font_bold']) {

    echo "font-weight:bold;";

}

if ($dmshop_wmbar['wmbar_text2_font_italic']) {

    echo "font-style:italic;";

}

if ($dmshop_wmbar['wmbar_text2_font_underline']) {

    echo "text-decoration:underline;";

}

echo "\">";

echo text($dmshop_wmlist['title']);

echo "</span>";
?>
    </td>
    <td bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="wmbar_list_image1" style="display:<? if ($dmshop_wmbar['wmbar_list_use'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="select1">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_200">폰트파일 첨부</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "wmbar_font_file";
$file = shop_design_file($upload_mode);

$font_file = "";
if ($file['upload_file']) {

    $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    if (file_exists($file_path) && $file['upload_file']) {

        $font_file = $file_path;

    }

}
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : TTF (폰트파일 확장자)</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_201">기본 폰트</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td>
<select id="wmbar_image1_font_size" name="wmbar_image1_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#wmbar_image1_font_size").val("<?=text($dmshop_wmbar['wmbar_image1_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="5"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_image1_font_color" name="wmbar_image1_font_color" value="<?=text($dmshop_wmbar['wmbar_image1_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_image1_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_image1_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_image1_transparent" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_image1_transparent']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_image1_transparent');">배경색상 적용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_202">활성화 폰트</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">크기</td>
    <td width="10"></td>
    <td>
<select id="wmbar_image2_font_size" name="wmbar_image2_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#wmbar_image2_font_size").val("<?=text($dmshop_wmbar['wmbar_image2_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="tx2">색상</td>
    <td width="5"></td>
    <td class="tx2">#</td>
    <td width="10"></td>
    <td><input type="text" id="wmbar_image2_font_color" name="wmbar_image2_font_color" value="<?=text($dmshop_wmbar['wmbar_image2_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="wmbar_image2_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_wmbar['wmbar_image2_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td><input type="checkbox" name="wmbar_image2_transparent" value="1" class="checkbox" <? if ($dmshop_wmbar['wmbar_image2_transparent']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formDesign', 'wmbar_image2_transparent');">배경색상 적용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip8_203">표기항목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
<tr bgcolor="#f5f5f5" height="30">
    <td width="1" bgcolor="#ececec"></td>
    <td width="60" class="tx2" align="center">표기</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">메뉴명</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">폰트 이미지 크기</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">미리보기 (기폰폰트)</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">미리보기 (활성화 폰트)</td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "1");
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image1_etc_menu_1" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="image1_etc_menu_1_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (홈)</td>
    <td width="1" bgcolor="#ececec"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1" align="right">가로</td>
    <td width="5"></td>
    <td><input type="text" name="etc_width_1" value="<?=text($dmshop_wmlist['image_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="10"></td>
    <td class="text1">세로</td>
    <td width="5"></td>
    <td><input type="text" name="etc_height_1" value="<?=text($dmshop_wmlist['image_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($dmshop_wmlist['title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($dmshop_wmlist['title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[category_table] where category = '1' and view = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("category", $row['id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image1_category_menu_<?=$row['id']?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=$row['subject']?></td>
    <td width="1" bgcolor="#ececec"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1" align="right">가로</td>
    <td width="5"></td>
    <td><input type="text" name="category_width_<?=$row['id']?>" value="<?=text($dmshop_wmlist['image_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="10"></td>
    <td class="text1">세로</td>
    <td width="5"></td>
    <td><input type="text" name="category_height_<?=$row['id']?>" value="<?=text($dmshop_wmlist['image_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($row['subject'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($row['subject'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("board", $row['bbs_id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image1_board_menu_<?=text($row['bbs_id'])?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=text($row['bbs_title'])?></td>
    <td width="1" bgcolor="#ececec"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1" align="right">가로</td>
    <td width="5"></td>
    <td><input type="text" name="board_width_<?=text($row['bbs_id'])?>" value="<?=text($dmshop_wmlist['image_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="10"></td>
    <td class="text1">세로</td>
    <td width="5"></td>
    <td><input type="text" name="board_height_<?=text($row['bbs_id'])?>" value="<?=text($dmshop_wmlist['image_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($row['bbs_title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($row['bbs_title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "2");
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image1_etc_menu_2" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="image1_etc_menu_2_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (기획전)</td>
    <td width="1" bgcolor="#ececec"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1" align="right">가로</td>
    <td width="5"></td>
    <td><input type="text" name="etc_width_2" value="<?=text($dmshop_wmlist['image_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
    <td width="10"></td>
    <td class="text1">세로</td>
    <td width="5"></td>
    <td><input type="text" name="etc_height_2" value="<?=text($dmshop_wmlist['image_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:23px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($dmshop_wmlist['title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image1_font_size'], $dmshop_wmbar['wmbar_image1_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image1_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
    <td><div style="padding:10px;"><?=shop_text_image($dmshop_wmlist['title'], $font_file, $dmshop_wmlist['image_width'], $dmshop_wmlist['image_height'], $dmshop_wmbar['wmbar_image2_font_size'], $dmshop_wmbar['wmbar_image2_font_color'], $dmshop_wmbar['wmbar_background_color'], $dmshop_wmbar['wmbar_image2_transparent'], "");?></div></td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="11" height="1" bgcolor="#ececec"></td></tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="wmbar_list_image2" style="display:<? if ($dmshop_wmbar['wmbar_list_use'] == '2') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="40">
    <td></td>
    <td class="subject"><span class="tip8_300">표기항목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<tr bgcolor="#f5f5f5" height="30">
    <td width="1" bgcolor="#ececec"></td>
    <td width="60" class="tx2" align="center">표기</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">메뉴명</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">기본 이미지 등록</td>
    <td width="1" bgcolor="#ececec"></td>
    <td width="200" class="tx2" align="center">활성화 이미지 등록</td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "1");
?>
<tr height="30">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image2_etc_menu_1" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="image2_etc_menu_1_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (홈)</td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_etc_1_1";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_etc_1_2";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[category_table] where category = '1' and view = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("category", $row['id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image2_category_menu_<?=$row['id']?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=text($row['subject'])?></td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_category_1_".$row['id'];
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_category_2_".$row['id'];
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
// 숨김은 제외
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_wmlist = shop_design_wmlist("board", $row['bbs_id']);
?>
<tr height="60">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image2_board_menu_<?=text($row['bbs_id'])?>" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td class="tx2" align="center"><?=text($row['bbs_title'])?></td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_board_1_".text($row['bbs_id']);
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_board_2_".text($row['bbs_id']);
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
<? } ?>
<?
$dmshop_wmlist = shop_design_wmlist("etc", "2");
?>
<tr height="30">
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="checkbox" name="image2_etc_menu_2" value="1" class="checkbox" <? if ($dmshop_wmlist['id']) { echo "checked"; } ?> /></td>
    <td bgcolor="#ececec"></td>
    <td align="center"><input type="text" name="image2_etc_menu_2_title" value="<?=text($dmshop_wmlist['title'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /> (기획전)</td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_etc_2_1";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
    <td>
<div style="padding:10px;">
<?
$upload_mode = "wmlist_image_etc_2_2";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="12" /></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="1" bgcolor="#ececec"></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#ececec"></td></tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="wmbar_list_flash" style="display:<? if ($dmshop_wmbar['wmbar_list_use'] == '3') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8_400">플래시 파일 첨부</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "wmlist_flash";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : SWF</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="designSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./design_wmbar.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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