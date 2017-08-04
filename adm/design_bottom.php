<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "202";
$shop['title'] = "하단 (BOTTMOM)";
include_once("./_top.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 하단 설정
$dmshop_bottom = shop_design_bottom();

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_bottom['bottom_tag']) { $dmshop_bottom['bottom_tag'] = "<br />"; }

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

    $(".tip1").simpletip({ content: '하단 레이아웃을 선택합니다.' });
    $(".tip2").simpletip({ content: '하단 배경 이미지를 첨부합니다.' });
    $(".tip3").simpletip({ content: '하단 배경 확장 이미지를 첨부합니다.' });
    $(".tip4").simpletip({ content: '로고를 첨부합니다.' });
    $(".tip5").simpletip({ content: '바로가기 링크를 설정합니다.' });
    $(".tip6").simpletip({ content: '쇼핑몰 운영정보를 설정합니다.' });
    $(".tip7").simpletip({ content: '카피라이트를 설정합니다.' });
    $(".tip8").simpletip({ content: '태그를 입력합니다.' });

});
</script>

<script type="text/javascript">
function bottom_information(mode, val)
{

    if (mode == 'family') {

        $(".contents_box .bottom_information .text").css({ 'font-family' : val });

    }

    if (mode == 'size') {

        $(".contents_box .bottom_information .text").css({ 'font-size' : val+'px' });

    }

    if (mode == 'height') {

        $(".contents_box .bottom_information .text").css({ 'line-height' : val+'px' });

    }

    if (mode == 'color') {

        $(".contents_box .bottom_information .text").css({ 'color' : val });

    }

    if (mode == 'bold') {

        if (document.getElementById("bottom_information_font_bold").checked == true) {

            $(".contents_box .bottom_information .text").css({ 'font-weight' : 'bold' });

        } else {

            $(".contents_box .bottom_information .text").css({ 'font-weight' : 'normal' });

        }

    }

    if (mode == 'position') {

        if (val == '0') {

            $(".contents_box .bottom_information td").css({ 'text-align' : 'left' });

        }

        if (val == '1') {

            $(".contents_box .bottom_information td").css({ 'text-align' : 'center' });

        }

        if (val == '2') {

            $(".contents_box .bottom_information td").css({ 'text-align' : 'right' });

        }

    }

}

function bottom_copyright(mode, val)
{

    if (mode == 'family') {

        $(".contents_box .bottom_copyright .text").css({ 'font-family' : val });

    }

    if (mode == 'size') {

        $(".contents_box .bottom_copyright .text").css({ 'font-size' : val+'px' });

    }

    if (mode == 'height') {

        $(".contents_box .bottom_copyright .text").css({ 'line-height' : val+'px' });

    }

    if (mode == 'color') {

        $(".contents_box .bottom_copyright .text").css({ 'color' : val });

    }

    if (mode == 'bold') {

        if (document.getElementById("bottom_copyright_font_bold").checked == true) {

            $(".contents_box .bottom_copyright .text").css({ 'font-weight' : 'bold' });

        } else {

            $(".contents_box .bottom_copyright .text").css({ 'font-weight' : 'normal' });

        }

    }

    if (mode == 'position') {

        if (val == '0') {

            $(".contents_box .bottom_copyright td").css({ 'text-align' : 'left' });

        }

        if (val == '1') {

            $(".contents_box .bottom_copyright td").css({ 'text-align' : 'center' });

        }

        if (val == '2') {

            $(".contents_box .bottom_copyright td").css({ 'text-align' : 'right' });

        }

    }

}
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#bottom_servicemenu1_font_color, #bottom_servicemenu2_font_color, #bottom_information_font_color, #bottom_copyright_font_color').ColorPicker({
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

    if (id == 'bottom_information_font_color') {

        bottom_information('color', color);

    }

    if (id == 'bottom_copyright_font_color') {

        bottom_copyright('color', color);

    }

}
</script>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['url']?>"+"/data/smarteditor/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function designSubmit()
{

    oEditors.getById["bottom_tag"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formDesign;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./design_bottom_update.php";
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
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 하단 레이아웃 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">하단 설정정보</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_main<?=$dmshop_design['main_layout']?>_bottom.gif"></div></td>
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
    <td class="layout_text">하단스킨 : <?=shop_design_skin_name($dmshop_skin['skin_main_bottom']);?></td>
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
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_sub<?=$dmshop_design['sub_layout']?>_bottom.gif"></div></td>
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
    <td class="layout_text">하단스킨 : <?=shop_design_skin_name($dmshop_skin['skin_sub_bottom']);?></td>
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
    <td class="msg1">메인/서브 디자인 설정의 하단스킨이 ‘직접 만들기’로 선택되어야만 아래의 설정된 구성물이 100% 적용 됩니다.<br>다른 스킨이 선택되어 있을 경우, 해당 스킨의 레이아웃을 따르며, 구성물 전체 또는 일부가 적용되지 않을 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="170">
    <td></td>
    <td class="subject"><span class="tip1">하단 레이아웃</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function bottomlayoutLayer(id)
{

    $("#bottom_layout_layer0").hide();
    $("#bottom_layout_layer1").hide();
    $("#bottom_layout_layer2").hide();
    $("#bottom_layout_layer3").hide();

    $("#bottom_layout_layer"+id).show();

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="130" valign="top">
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:30px;">
<tr>
    <td><input type="radio" name="bottom_layout" value="0" onclick="bottomlayoutLayer(this.value);" class="radio" <? if ($dmshop_bottom['bottom_layout'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_layout', '0'); bottomlayoutLayer('0');">소호몰형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="bottom_layout" value="1" onclick="bottomlayoutLayer(this.value);" class="radio" <? if ($dmshop_bottom['bottom_layout'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_layout', '1'); bottomlayoutLayer('1');">전문 스토어형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="bottom_layout" value="2" onclick="bottomlayoutLayer(this.value);" class="radio" <? if ($dmshop_bottom['bottom_layout'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_layout', '2'); bottomlayoutLayer('2');">종합몰형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="bottom_layout" value="3" onclick="bottomlayoutLayer(this.value);" class="radio" <? if ($dmshop_bottom['bottom_layout'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_layout', '3'); bottomlayoutLayer('3');">오픈마켓형</td>
</tr>
</table>
    </td>
    <td valign="top">
<div id="bottom_layout_layer0" style="display:<? if ($dmshop_bottom['bottom_layout'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30" valign="top"></td>
    <td><img src="<?=$shop['image_path']?>/adm/bottom_layout0.gif"></td>
</tr>
</table>
</div>

<div id="bottom_layout_layer1" style="display:<? if ($dmshop_bottom['bottom_layout'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30" valign="top"></td>
    <td><img src="<?=$shop['image_path']?>/adm/bottom_layout1.gif"></td>
</tr>
</table>
</div>

<div id="bottom_layout_layer2" style="display:<? if ($dmshop_bottom['bottom_layout'] == '2') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30" valign="top"></td>
    <td><img src="<?=$shop['image_path']?>/adm/bottom_layout2.gif"></td>
</tr>
</table>
</div>

<div id="bottom_layout_layer3" style="display:<? if ($dmshop_bottom['bottom_layout'] == '3') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30" valign="top"></td>
    <td><img src="<?=$shop['image_path']?>/adm/bottom_layout3.gif"></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">하단 배경 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "bottom_background_image";
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
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">하단 배경 확장 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "bottom_background_image2";
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
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 하단 구성물 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">로고</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "bottom_logo";
$file = shop_design_file($upload_mode);
?>
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
<tr class="select3">
    <td></td>
    <td class="subject"><span class="tip5">바로가기 링크</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시판</td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
// 가로 갯수
$mod = "5";

// 게시판 리스트
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr>\n";

    }

    if ($i%$mod >= '1') {

        echo "<td width='30'></td>";

    }

    echo "<td valign='top'>";
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="25">
    <td><input type="checkbox" id="board_bottom_<?=text($row['bbs_id'])?>" name="board_bottom_<?=text($row['bbs_id'])?>" value="1" class="checkbox" <? if ($row['bottom_view']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheckID('board_bottom_<?=text($row['bbs_id'])?>');"><?=text($row['bbs_title'])?></td>
</tr>
</table>
<?
    echo "</td>";

}

// 나머지 셀을 채운다.
$cnt = $i%$mod;
if ($cnt) {

    for ($i=$cnt; $i<$mod; $i++) {

        if ($i%$mod >= '1') {
    
            echo "<td width='30'></td>";
    
        }

        echo "<td>&nbsp;</td>";

    }

}
?>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">웹페이지</td>
    <td class="text1">
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
// 가로 갯수
$mod = "5";

// 게시판 리스트
$result = sql_query(" select * from $shop[page_table] where page_view = '1' order by page_position desc, page_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr>\n";

    }

    if ($i%$mod >= '1') {

        echo "<td width='30'></td>";

    }

    echo "<td valign='top'>";
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="25">
    <td><input type="checkbox" id="page_bottom_<?=text($row['page_id'])?>" name="page_bottom_<?=text($row['page_id'])?>" value="1" class="checkbox" <? if ($row['bottom_view']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheckID('page_bottom_<?=text($row['page_id'])?>');"><?=text($row['page_title'])?></td>
</tr>
</table>
<?
    echo "</td>";

}

// 나머지 셀을 채운다.
$cnt = $i%$mod;
if ($cnt) {

    for ($i=$cnt; $i<$mod; $i++) {

        if ($i%$mod >= '1') {
    
            echo "<td width='30'></td>";
    
        }

        echo "<td>&nbsp;</td>";

    }

}
?>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">기본 폰트</td>
    <td class="text1">글꼴</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu1_font_family" name="bottom_servicemenu1_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#bottom_servicemenu1_font_family").val("<?=text($dmshop_bottom['bottom_servicemenu1_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu1_font_size" name="bottom_servicemenu1_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#bottom_servicemenu1_font_size").val("<?=text($dmshop_bottom['bottom_servicemenu1_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">행간</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu1_font_height" name="bottom_servicemenu1_font_height" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#bottom_servicemenu1_font_height").val("<?=text($dmshop_bottom['bottom_servicemenu1_font_height'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="bottom_servicemenu1_font_color" name="bottom_servicemenu1_font_color" value="<?=text($dmshop_bottom['bottom_servicemenu1_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="bottom_servicemenu1_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_bottom['bottom_servicemenu1_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'bottom_servicemenu1_font_bold');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" name="bottom_servicemenu1_font_bold" value="1" class="checkbox" <? if ($dmshop_bottom['bottom_servicemenu1_font_bold'] == '1') { echo "checked"; } ?> /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">활성화 폰트</td>
    <td class="text1">글꼴</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu2_font_family" name="bottom_servicemenu2_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#bottom_servicemenu2_font_family").val("<?=text($dmshop_bottom['bottom_servicemenu2_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu2_font_size" name="bottom_servicemenu2_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#bottom_servicemenu2_font_size").val("<?=text($dmshop_bottom['bottom_servicemenu2_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">행간</td>
    <td width="10"></td>
    <td>
<select id="bottom_servicemenu2_font_height" name="bottom_servicemenu2_font_height" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#bottom_servicemenu2_font_height").val("<?=text($dmshop_bottom['bottom_servicemenu2_font_height'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="bottom_servicemenu2_font_color" name="bottom_servicemenu2_font_color" value="<?=text($dmshop_bottom['bottom_servicemenu2_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="bottom_servicemenu2_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_bottom['bottom_servicemenu2_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'bottom_servicemenu2_font_bold');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" name="bottom_servicemenu2_font_bold" value="1" class="checkbox" <? if ($dmshop_bottom['bottom_servicemenu2_font_bold'] == '1') { echo "checked"; } ?> /></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr class="select3">
    <td></td>
    <td class="subject"><span class="tip6">쇼핑몰 운영정보</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">기본 폰트</td>
    <td class="text1">글꼴</td>
    <td width="10"></td>
    <td>
<select id="bottom_information_font_family" name="bottom_information_font_family" class="select" style="width:65px;" onchange="bottom_information('family', this.value);">
<?=shop_option_font_family();?>
</select>

<script type="text/javascript">
$("#bottom_information_font_family").val("<?=text($dmshop_bottom['bottom_information_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="bottom_information_font_size" name="bottom_information_font_size" class="select" style="width:65px;" onchange="bottom_information('size', this.value);">
<?=shop_option_font_size();?>
</select>

<script type="text/javascript">
$("#bottom_information_font_size").val("<?=text($dmshop_bottom['bottom_information_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">행간</td>
    <td width="10"></td>
    <td>
<select id="bottom_information_font_height" name="bottom_information_font_height" class="select" style="width:65px;" onchange="bottom_information('height', this.value);">
<?=shop_option_font_size();?>
</select>

<script type="text/javascript">
$("#bottom_information_font_height").val("<?=text($dmshop_bottom['bottom_information_font_height'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="bottom_information_font_color" name="bottom_information_font_color" value="<?=text($dmshop_bottom['bottom_information_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="bottom_information_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_bottom['bottom_information_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'bottom_information_font_bold'); bottom_information('bold', '');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" id="bottom_information_font_bold" name="bottom_information_font_bold" value="1" class="checkbox" <? if ($dmshop_bottom['bottom_information_font_bold'] == '1') { echo "checked"; } ?> onclick="bottom_information('bold', '');" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">텍스트 정렬</td>
    <td><input type="radio" name="bottom_information_position" value="0" class="radio" <? if ($dmshop_bottom['bottom_information_position'] == '0') { echo "checked"; } ?> onclick="bottom_information('position', '0');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_information_position', '0'); bottom_information('position', '0');">왼쪽 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="bottom_information_position" value="1" class="radio" <? if ($dmshop_bottom['bottom_information_position'] == '1') { echo "checked"; } ?> onclick="bottom_information('position', '1');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_information_position', '1'); bottom_information('position', '1');">가운데 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="bottom_information_position" value="2" class="radio" <? if ($dmshop_bottom['bottom_information_position'] == '2') { echo "checked"; } ?> onclick="bottom_information('position', '2');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_information_position', '2'); bottom_information('position', '2');">오른쪽 정렬</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table width="1000" border="0" cellspacing="0" cellpadding="0">
<tr height="166">
    <td width="30"></td>
    <td width="110" class="text1">미리보기</td>
    <td>
<div style="border:3px solid #e4e4e4; padding:20px;">
<?
include_once("$shop[path]/layout/default/bottom.information.php");
?>
</div>
    </td>
    <td width="30"></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr class="select3">
    <td></td>
    <td class="subject"><span class="tip7">카피라이트</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">기본 폰트</td>
    <td class="text1">글꼴</td>
    <td width="10"></td>
    <td>
<select id="bottom_copyright_font_family" name="bottom_copyright_font_family" class="select" style="width:65px;" onchange="bottom_copyright('family', this.value);">
<?=shop_option_font_family();?>
</select>

<script type="text/javascript">
$("#bottom_copyright_font_family").val("<?=text($dmshop_bottom['bottom_copyright_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="bottom_copyright_font_size" name="bottom_copyright_font_size" class="select" style="width:65px;" onchange="bottom_copyright('size', this.value);">
<?=shop_option_font_size();?>
</select>

<script type="text/javascript">
$("#bottom_copyright_font_size").val("<?=text($dmshop_bottom['bottom_copyright_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">행간</td>
    <td width="10"></td>
    <td>
<select id="bottom_copyright_font_height" name="bottom_copyright_font_height" class="select" style="width:65px;" onchange="bottom_copyright('height', this.value);">
<?=shop_option_font_size();?>
</select>

<script type="text/javascript">
$("#bottom_copyright_font_height").val("<?=text($dmshop_bottom['bottom_copyright_font_height'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="bottom_copyright_font_color" name="bottom_copyright_font_color" value="<?=text($dmshop_bottom['bottom_copyright_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="bottom_copyright_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_bottom['bottom_copyright_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'bottom_copyright_font_bold'); bottom_copyright('bold', '');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" id="bottom_copyright_font_bold" name="bottom_copyright_font_bold" value="1" class="checkbox" <? if ($dmshop_bottom['bottom_copyright_font_bold'] == '1') { echo "checked"; } ?> onclick="bottom_copyright('bold', '');" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="text1">텍스트 정렬</td>
    <td><input type="radio" name="bottom_copyright_position" value="0" class="radio" <? if ($dmshop_bottom['bottom_copyright_position'] == '0') { echo "checked"; } ?> onclick="bottom_copyright('position', '0');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_copyright_position', '0'); bottom_copyright('position', '0');">왼쪽 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="bottom_copyright_position" value="1" class="radio" <? if ($dmshop_bottom['bottom_copyright_position'] == '1') { echo "checked"; } ?> onclick="bottom_copyright('position', '1');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_copyright_position', '1'); bottom_copyright('position', '1');">가운데 정렬</td>
    <td width="30"></td>
    <td><input type="radio" name="bottom_copyright_position" value="2" class="radio" <? if ($dmshop_bottom['bottom_copyright_position'] == '2') { echo "checked"; } ?> onclick="bottom_copyright('position', '2');" /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'bottom_copyright_position', '2'); bottom_copyright('position', '2');">오른쪽 정렬</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table width="1000" border="0" cellspacing="0" cellpadding="0">
<tr height="166">
    <td width="30"></td>
    <td width="110" class="text1">미리보기</td>
    <td>
<div style="border:3px solid #e4e4e4; padding:20px;">
<?
include_once("$shop[path]/layout/default/bottom.copyright.php");
?>
</div>
    </td>
    <td width="30"></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="250">
    <td></td>
    <td class="subject"><span class="tip8">태그</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="bottom_tag" name="bottom_tag" class="textarea1" style="width:98%; height:130px;"><?=text($dmshop_bottom['bottom_tag']);?></textarea></td>
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
    <td><a href="./design_bottom.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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
	elPlaceHolder: "bottom_tag",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<?
include_once("./_bottom.php");
?>