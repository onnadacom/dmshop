<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "203";
$shop['title'] = "메인중앙 (MAIN)";
include_once("./_top.php");

// php5.3.9 default 1000
$max_input_vars = ini_get('max_input_vars');

if ($max_input_vars && $max_input_vars < 3000) {

    message("<p class='title'>알림</p><p class='text'>php.ini 파일의 max_input_vars 설정이 {$max_input_vars} 입니다.<br />3000 이상으로 값을 늘려야 메인중앙 디자인이 정상작동합니다.<br />웹호스팅, 서버 관리자에게 문의하시기 바랍니다.</p>", "", "", false, false);

}

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 메인, 서브 권장설정
if ($dmshop_design['main_width_use'] == '0') { $dmshop_design['main_menu_width'] = shop_split("|", $dmshop_design['main_width'], "0"); $dmshop_design['main_center_width'] = shop_split("|", $dmshop_design['main_width'], "1"); }
if ($dmshop_design['sub_width_use'] == '0') { $dmshop_design['sub_menu_width'] = shop_split("|", $dmshop_design['sub_width'], "0"); $dmshop_design['sub_center_width'] = shop_split("|", $dmshop_design['sub_width'], "1"); }

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_design['main_tag_top_text']) { $dmshop_design['main_tag_top_text'] = "<br />"; }
//if (!$dmshop_design['main_tag_bottom_text']) { $dmshop_design['main_tag_bottom_text'] = "<br />"; }
?>

<style type="text/css">
.contents_box {min-width:1100px;}

#display_box {background-color:#ffffff;}
#display_box .linecolor {background-color:#d6e2ff; font-size:1px; line-height:1px;}
#display_box .side_title {font-weight:bold; line-height:14px; font-size:11px; color:#95a9d2; font-family:gulim,굴림;}
#display_box .px {line-height:14px; font-size:11px; color:#95a9d2; font-family:gulim,굴림;}
#display_box .tab_title {font-weight:bold; line-height:14px; font-size:12px; color:#9da4b9; font-family:gulim,굴림;}
#display_box .display_title {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
#display_box .display_select {padding:100px 0; line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
#display_box .display_height {height:100%;}
#display_box .display_subject {width:90px; text-align:left; line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
#display_box .display_list {width:270px; margin:0 auto;}
#display_box .display_line {height:1px; background-color:#ececec;}
#display_box .display_line_bg2 {width:471px; background:url('<?=$shop['image_path']?>/adm/display_line_bg2.gif') repeat-y;}
#display_box .display_line_bg3 {width:300px; background:url('<?=$shop['image_path']?>/adm/display_line_bg3.gif') repeat-y;}
#display_box .display_text1 {line-height:14px; font-size:12px; color:#888888; font-family:gulim,굴림;}
#display_box .display_text2 {line-height:14px; font-size:11px; color:#888888; font-family:dotum,돋움;}
#display_box .display_text3 {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
#display_box .display_category {line-height:14px; font-size:12px; color:#0000ff; font-family:gulim,굴림;}
#display_box .display_textarea {padding:5px; border:1px solid #c2c2c2; width:96%; height:200px;}
#display_box .selection_name {line-height:14px; font-size:12px; color:#0000ff; font-family:gulim,굴림;}

#display_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
#display_box .select1 .selectBox-dropdown {width:100px; height:19px;}
#display_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

#display_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
#display_box .select2 .selectBox-dropdown {width:120px; height:19px;}
#display_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

#display_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
#display_box .select3 .selectBox-dropdown {width:30px; height:19px;}
#display_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['smarteditor_data']?>"+"/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function designSubmit()
{

    oEditors.getById["main_tag_top_text"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["main_tag_bottom_text"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formDesign;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./design_main_update.php";
    f.submit();

}

function shopDisplayResize()
{

    var h = $(".contents .view").height() + $(".top_menu").height();

    $(".contents").css( { 'height': h+'px'} );

}

// 디자인 디스플레이박스 아이템 삭제
function displayItemDelete(display_id, display_type, display_list, display_item_id)
{

    if (!confirm("해당 상품을 전시항목에서 삭제 하시겠습니까?")) {

        return false;

    }

    var f = document.formDesign;

    $.post("./design_main_display_item_update.php", {"form_check" : f.form_check.value, "m" : "d", "display_id" : display_id, "display_type" : display_type, "display_list" : display_list, "display_item_id" : display_item_id}, function(data) {

        $("#display"+display_id+"_"+display_type+"_"+display_list+"_item_list").html(data);

    });

}

function displayType(display_id, display_type)
{

    $("#display"+display_id+"_1").hide();
    $("#display"+display_id+"_2").hide();
    $("#display"+display_id+"_3").hide();

    if (display_type == '0') {

        shopDisplayResize();
        return false;

    }

    $("#display"+display_id+"_"+display_type).show();

    shopDisplayResize();

}

function displayList(display_id, display_type, display_list)
{

    $("#display"+display_id+"_"+display_type+"_0").hide();
    $("#display"+display_id+"_"+display_type+"_1").hide();
    $("#display"+display_id+"_"+display_type+"_2").hide();
    $("#display"+display_id+"_"+display_type+"_3").hide();
    $("#display"+display_id+"_"+display_type+"_4").hide();
    $("#display"+display_id+"_"+display_type+"_5").hide();
    $("#display"+display_id+"_"+display_type+"_6").hide();
    $("#display"+display_id+"_"+display_type+"_7").hide();
    $("#display"+display_id+"_"+display_type+"_"+display_list).show();

    shopDisplayResize();

}

function displayCategory(display_id, display_type, display_list)
{

    shopOpen("./design_main_display_category.php?display_id="+display_id+"&display_type="+display_type+"&display_list="+display_list, "displayCategory", "width=800, height=800, scrollbars=yes");

}

function displayItem(display_id, display_type, display_list)
{

    shopOpen("./design_main_display_item.php?display_id="+display_id+"&display_type="+display_type+"&display_list="+display_list, "displayItem", "width=800, height=800, scrollbars=yes");

}

function displayTitle(display_id, display_type, display_list, title_type)
{

    if (title_type == '0') {

        $("#display"+display_id+"_"+display_type+"_"+display_list+"_title_text").show();
        $("#display"+display_id+"_"+display_type+"_"+display_list+"_title_file").hide();

    } else {

        $("#display"+display_id+"_"+display_type+"_"+display_list+"_title_text").hide();
        $("#display"+display_id+"_"+display_type+"_"+display_list+"_title_file").show();

    }

}

function displayBoxLoading(display_id)
{

    $.post("./design_main_display.php", {"display_id" : display_id}, function(data) {

        $("#design_main_display"+display_id).html(data);

    });

}

function displayTypeLoading(display_id, type_id)
{

    $.post("./design_main_display_type"+type_id+".php", {"display_id" : display_id}, function(data) {

        $("#design_main_display"+display_id+"_type"+type_id).html(data);

    });

}
</script>

<div class="contents_box">
<form method="post" name="formDesign" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메인중앙 레이아웃 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">메인중앙 설정정보</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_main<?=$dmshop_design['main_layout']?>_main.gif"></div></td>
    <td width="20"></td>
    <td valign="top">
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
    <td class="layout_text">전체가로 : <?=(int)($dmshop_design['main_menu_width'] + $dmshop_design['main_center_width'] + $dmshop_design['main_mc_width']);?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <?=text($dmshop_design['main_menu_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메인중앙 : <b style="color:#f26c4f;"><?=text($dmshop_design['main_center_width'])?>px</b></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴, 메인중앙간 여백 : <?=text($dmshop_design['main_mc_width'])?>px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">메인 디자인 설정의 메인중앙 스킨이 ‘직접 만들기’로 선택되어야만 아래의 설정 값이 100% 적용 됩니다.<br>다른 스킨이 선택되어 있을 경우, 해당 스킨의 레이아웃을 따르며, 구성물 전체 또는 일부가 적용되지 않을 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메인중앙 상단 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">메인중앙 상단 이미지</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "main_image_top";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
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
<tr>
    <td></td>
    <td class="subject">메인중앙 상단 태그</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table width="790" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="main_tag_top_text" name="main_tag_top_text" class="textarea1" style="width:788px; height:130px;"><?=text($dmshop_design['main_tag_top_text']);?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메인중앙 디스플레이 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">디스플레이 설정정보</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="msg1">디스플레이 설정을 통하여 쇼핑몰 메인 페이지의 메인중앙 영역의 상품, 배너, 이미지, 게시물 등의 구성물을 자유로운 형태로 배치하실 수 있습니다.<br>디스플레이를 생성하실 때에는 <b style="color:#95a9d2;">왼쪽여백 + 사이여백 + 박스가로폭의 합계</b>가 메인중앙의 가로폭 <b style="color:#f26c4f;"><?=text($dmshop_design['main_center_width'])?>px를 초과하지 않도록 주의</b>하시기 바랍니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="display_box"></div>

<script type="text/javascript">
function displayboxLoading()
{

    $.post("./design_main_box.php", {"tmp" : "0"}, function(data) {

        $("#display_box").html(data);

    });

}
</script>

<script type="text/javascript">
$(function() { displayboxLoading(); });
</script>

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
    <td colspan="<?=$colspan?>" class="pagetitle">메인중앙 하단 태그</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject">하단 태그 입력</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table width="790" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="main_tag_bottom_text" name="main_tag_bottom_text" class="textarea1" style="width:788px; height:130px;"><?=text($dmshop_design['main_tag_bottom_text']);?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="39">
    <td></td>
    <td class="subject">하단 이미지</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "main_image_bottom";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
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
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="designSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./design_main.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "main_tag_top_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "main_tag_bottom_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<script type="text/javascript">
$(document).ready(function() { shopTop(); });
</script>

<?
include_once("./_bottom.php");
?>