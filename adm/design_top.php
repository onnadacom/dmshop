<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "200";
$shop['title'] = "상단 (TOP)";
include_once("./_top.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 상단 설정
$dmshop_top = shop_design_top();

// 메인, 서브 권장설정
if ($dmshop_design['main_width_use'] == '0') { $dmshop_design['main_menu_width'] = shop_split("|", $dmshop_design['main_width'], "0"); $dmshop_design['main_center_width'] = shop_split("|", $dmshop_design['main_width'], "1"); }
if ($dmshop_design['sub_width_use'] == '0') { $dmshop_design['sub_menu_width'] = shop_split("|", $dmshop_design['sub_width'], "0"); $dmshop_design['sub_center_width'] = shop_split("|", $dmshop_design['sub_width'], "1"); }

// 배너 그룹
$banner_group_option = "<option value=''>:: 사용안함 ::</option>";
$result = sql_query(" select * from $shop[banner_group_table] order by group_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $banner_group_option .= "<option value='".text($row['group_id'])."'>".text($row['group_id'])."</option>";

}

// 게시판
$board_option = "<option value=''>:: 사용안함 ::</option>";
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $board_option .= "<option value='".text($row['bbs_id'])."'>".text($row['bbs_title'])."</option>";

}

// 최신글 스킨
$article_skin_option = "";
$skin_array = shop_skin_dir("article");
for ($i=0; $i<count($skin_array); $i++) {

    $article_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 배너 스킨
$banner_skin_option = "";
$skin_array = shop_skin_dir("banner");
for ($i=0; $i<count($skin_array); $i++) {

    $banner_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 상품 검색창 스킨
$searchbox_skin_option = "<option value=''>:: 사용안함 ::</option>";
$skin_array = shop_skin_dir("searchbox");
for ($i=0; $i<count($skin_array); $i++) {

    $searchbox_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 가로메뉴바 스킨
$wmbar_skin_option = "<option value=''>직접 만들기</option>";
$skin_array = shop_skin_dir("wmbar");
for ($i=0; $i<count($skin_array); $i++) {

    $wmbar_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 최신글 정렬조건
$article_sort_option = "";
$article_sort_option .= "<option value='datetime desc'>작성일 내림차순</option>";
$article_sort_option .= "<option value='datetime asc'>작성일 오름차순</option>";
$article_sort_option .= "<option value='ar_hit desc'>조회수 내림차순</option>";
$article_sort_option .= "<option value='ar_hit asc'>조회수 오름차순</option>";
$article_sort_option .= "<option value='ar_reply desc'>댓글수 내림차순</option>";
$article_sort_option .= "<option value='ar_reply asc'>댓글수 오름차순</option>";
$article_sort_option .= "<option value='rand()'>랜덤</option>";

// 배너 정렬방식
$banner_sort_option = "";
$banner_sort_option .= "<option value='ba_datetime desc'>등록일시 내림차순</option>";
$banner_sort_option .= "<option value='ba_datetime asc'>등록일시 오름차순</option>";
$banner_sort_option .= "<option value='ba_position desc'>출력순서 내림차순</option>";
$banner_sort_option .= "<option value='ba_position asc'>출력순서 오름차순</option>";
$banner_sort_option .= "<option value='rand()'>랜덤</option>";

// 롤링횟수
$rolling_limit_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_limit_option .= "<option value='".$i."'>{$i}회</option>";

}

// 롤링시간
$rolling_time_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_time_option .= "<option value='".$i."000'>{$i}초</option>";

}
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

    $(".tip1").simpletip({ content: '상단 레이아웃을 선택합니다.' });
    $(".tip2").simpletip({ content: '배경 이미지를 첨부합니다.' });
    $(".tip3").simpletip({ content: '로고 이미지를 첨부합니다.' });
    $(".tip4").simpletip({ content: '배너A를 설정합니다.' });
    $(".tip5").simpletip({ content: '배너B를 설정합니다.' });
    $(".tip6").simpletip({ content: '게시판 최신글을 설정합니다.' });
    $(".tip7").simpletip({ content: '상품 검색창 스킨을 선택합니다.' });
    $(".tip8").simpletip({ content: '기본 서비스 메뉴를 설정합니다.' });
    $(".tip9").simpletip({ content: '가로 메뉴바를 설정합니다.' });
    $(".tip10").simpletip({ content: '상단 레이아웃 하단부분의 여백을 설정합니다. 지정한 값만큼 하단으로부터 여백이 생깁니다.' });

});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/colorpicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#top_servicemenu1_font_color, #top_servicemenu2_font_color').ColorPicker({
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

    f.action = "./design_top_update.php";
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상단 레이아웃 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">상단 설정정보</td>
    <td class="bc1"></td>
    <td colspan="3">
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
    <td class="layout_text">상단스킨 : <?=shop_design_skin_name($dmshop_skin['skin_main_top']);?></td>
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
    <td class="layout_text">상단스킨 : <?=shop_design_skin_name($dmshop_skin['skin_sub_top']);?></td>
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
    <td class="msg1">메인/서브 디자인 설정의 상단스킨이 ‘직접 만들기’로 선택되어야만 아래의 설정된 구성물이 100% 적용 됩니다.<br>다른 스킨이 선택되어 있을 경우, 해당 스킨의 레이아웃을 따르며, 구성물 전체 또는 일부가 적용되지 않을 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="170">
    <td></td>
    <td class="subject"><span class="tip1">상단 레이아웃</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function topLayoutLayer(id)
{

    $("#top_layout_layer0").hide();
    $("#top_layout_layer1").hide();
    $("#top_layout_layer2").hide();
    $("#top_layout_layer3").hide();

    $("#top_layout_layer"+id).show();

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="130" valign="top">
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:30px;">
<tr>
    <td><input type="radio" name="top_layout" value="0" onclick="topLayoutLayer(this.value);" class="radio" <? if ($dmshop_top['top_layout'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_layout', '0'); topLayoutLayer('0');">소호몰형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="top_layout" value="1" onclick="topLayoutLayer(this.value);" class="radio" <? if ($dmshop_top['top_layout'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_layout', '1'); topLayoutLayer('1');">전문 스토어형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="top_layout" value="2" onclick="topLayoutLayer(this.value);" class="radio" <? if ($dmshop_top['top_layout'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_layout', '2'); topLayoutLayer('2');">종합몰형</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td><input type="radio" name="top_layout" value="3" onclick="topLayoutLayer(this.value);" class="radio" <? if ($dmshop_top['top_layout'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_layout', '3'); topLayoutLayer('3');">오픈마켓형</td>
</tr>
</table>
    </td>
    <td valign="top">
<div id="top_layout_layer0" style="display:<? if ($dmshop_top['top_layout'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30"></td>
    <td><img src="<?=$shop['image_path']?>/adm/top_layout0.gif"></td>
</tr>
</table>
</div>

<div id="top_layout_layer1" style="display:<? if ($dmshop_top['top_layout'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30"></td>
    <td><img src="<?=$shop['image_path']?>/adm/top_layout1.gif"></td>
</tr>
</table>
</div>

<div id="top_layout_layer2" style="display:<? if ($dmshop_top['top_layout'] == '2') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30"></td>
    <td><img src="<?=$shop['image_path']?>/adm/top_layout2.gif"></td>
</tr>
</table>
</div>

<div id="top_layout_layer3" style="display:<? if ($dmshop_top['top_layout'] == '3') { echo "inline"; } else { echo "none"; } ?>;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="160">
    <td width="30"></td>
    <td><img src="<?=$shop['image_path']?>/adm/top_layout3.gif"></td>
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
    <td class="subject"><span class="tip2">상단 배경 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "top_background_image";
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상단 구성물 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">구성물 설정정보</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="msg1">위에서 선택하신 상단 레이아웃의 구성물의 위치에 보여질 로고, 배너, 최신글 등을 세부적으로 설정 합니다.<br>선택하신 상단 레이아웃에 구성물이 없을 경우에는 아래의 설정된 구성물은 불러지지 않습니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">로고</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "top_logo";
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
<tr>
    <td></td>
    <td class="subject"><span class="tip4">배너A</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">그룹 선택</td>
    <td class="select1">
<select id="top_banner1_group" name="top_banner1_group" class="select"><?=$banner_group_option?></select>

<script type="text/javascript">
$("#top_banner1_group").val("<?=text($dmshop_top['top_banner1_group'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">정렬 방식</td>
    <td class="select1">
<select id="top_banner1_sort" name="top_banner1_sort" class="select"><?=$banner_sort_option?></select>

<script type="text/javascript">
$("#top_banner1_sort").val("<?=text($dmshop_top['top_banner1_sort'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="top_banner1_skin" name="top_banner1_skin" class="select"><?=$banner_skin_option?></select>

<script type="text/javascript">
$("#top_banner1_skin").val("<?=text($dmshop_top['top_banner1_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/banner</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 횟수</td>
    <td class="select2">
<select id="top_banner1_rolling_limit" name="top_banner1_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#top_banner1_rolling_limit").val("<?=text($dmshop_top['top_banner1_rolling_limit'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 시간</td>
    <td class="select2">
<select id="top_banner1_rolling_time" name="top_banner1_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#top_banner1_rolling_time").val("<?=text($dmshop_top['top_banner1_rolling_time'])?>");
</script>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip5">배너B</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">그룹 선택</td>
    <td class="select1">
<select id="top_banner2_group" name="top_banner2_group" class="select"><?=$banner_group_option?></select>

<script type="text/javascript">
$("#top_banner2_group").val("<?=text($dmshop_top['top_banner2_group'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">정렬 방식</td>
    <td class="select1">
<select id="top_banner2_sort" name="top_banner2_sort" class="select"><?=$banner_sort_option?></select>

<script type="text/javascript">
$("#top_banner2_sort").val("<?=text($dmshop_top['top_banner2_sort'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="top_banner2_skin" name="top_banner2_skin" class="select"><?=$banner_skin_option?></select>

<script type="text/javascript">
$("#top_banner2_skin").val("<?=text($dmshop_top['top_banner2_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/banner</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 횟수</td>
    <td class="select2">
<select id="top_banner2_rolling_limit" name="top_banner2_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#top_banner2_rolling_limit").val("<?=text($dmshop_top['top_banner2_rolling_limit'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 시간</td>
    <td class="select2">
<select id="top_banner2_rolling_time" name="top_banner2_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#top_banner2_rolling_time").val("<?=text($dmshop_top['top_banner2_rolling_time'])?>");
</script>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip6">게시판 최신글</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시판 선택</td>
    <td class="select1">
<select id="top_article" name="top_article" class="select"><?=$board_option?></select>

<script type="text/javascript">
$("#top_article").val("<?=text($dmshop_top['top_article'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="top_article_skin" name="top_article_skin" class="select"><?=$article_skin_option?></select>

<script type="text/javascript">
$("#top_article_skin").val("<?=text($dmshop_top['top_article_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/article</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 정렬조건</td>
    <td class="select1">
<select id="top_article_sort" name="top_article_sort" class="select"><?=$article_sort_option?></select>

<script type="text/javascript">
$("#top_article_sort").val("<?=text($dmshop_top['top_article_sort'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">표기항목</td>
    <td><input type="checkbox" name="top_article_use0" value="1" class="checkbox" checked onclick="return false;" /></td>
    <td width="5"></td>
    <td class="text1">제목</td>
    <td width="30"></td>
    <td><input type="checkbox" name="top_article_use1" value="1" class="checkbox" <? if ($dmshop_top['top_article_use1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'top_article_use1');">작성일</td>
    <td width="30"></td>
    <td><input type="checkbox" name="top_article_use2" value="1" class="checkbox" <? if ($dmshop_top['top_article_use2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'top_article_use2');">작성자</td>
    <td width="30"></td>
    <td><input type="checkbox" name="top_article_use3" value="1" class="checkbox" <? if ($dmshop_top['top_article_use3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'top_article_use3');">댓글수</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 가로갯수</td>
    <td><input type="text" name="top_article_width" value="<?=text($dmshop_top['top_article_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 세로갯수</td>
    <td><input type="text" name="top_article_height" value="<?=text($dmshop_top['top_article_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip7">상품 검색창</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="top_searchbox_skin" name="top_searchbox_skin" class="select"><?=$searchbox_skin_option?></select>

<script type="text/javascript">
$("#top_searchbox_skin").val("<?=text($dmshop_top['top_searchbox_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/searchbox</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr class="select3">
    <td></td>
    <td class="subject"><span class="tip8">기본 서비스 메뉴</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">기본 폰트</td>
    <td class="text1">글꼴</td>
    <td width="10"></td>
    <td>
<select id="top_servicemenu1_font_family" name="top_servicemenu1_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#top_servicemenu1_font_family").val("<?=text($dmshop_top['top_servicemenu1_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="top_servicemenu1_font_size" name="top_servicemenu1_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#top_servicemenu1_font_size").val("<?=text($dmshop_top['top_servicemenu1_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="top_servicemenu1_font_color" name="top_servicemenu1_font_color" value="<?=text($dmshop_top['top_servicemenu1_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="top_servicemenu1_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_top['top_servicemenu1_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'top_servicemenu1_font_bold');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" name="top_servicemenu1_font_bold" value="1" class="checkbox" <? if ($dmshop_top['top_servicemenu1_font_bold'] == '1') { echo "checked"; } ?> /></td>
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
<select id="top_servicemenu2_font_family" name="top_servicemenu2_font_family" class="select" style="width:65px;"><?=shop_option_font_family();?></select>

<script type="text/javascript">
$("#top_servicemenu2_font_family").val("<?=text($dmshop_top['top_servicemenu2_font_family'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">크기</td>
    <td width="10"></td>
    <td>
<select id="top_servicemenu2_font_size" name="top_servicemenu2_font_size" class="select" style="width:65px;"><?=shop_option_font_size();?></select>

<script type="text/javascript">
$("#top_servicemenu2_font_size").val("<?=text($dmshop_top['top_servicemenu2_font_size'])?>");
</script>
    </td>
    <td width="30"></td>
    <td class="text1">색상</td>
    <td width="5"></td>
    <td class="text1">#</td>
    <td width="10"></td>
    <td><input type="text" id="top_servicemenu2_font_color" name="top_servicemenu2_font_color" value="<?=text($dmshop_top['top_servicemenu2_font_color'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td><div id="top_servicemenu2_font_color_preview" style="width:18px; height:18px; border:1px solid #c8cdd2; background-color:#<?=text($dmshop_top['top_servicemenu2_font_color'])?>;"></div></td>
    <td width="30"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'top_servicemenu2_font_bold');">볼드적용</td>
    <td width="5"></td>
    <td><input type="checkbox" name="top_servicemenu2_font_bold" value="1" class="checkbox" <? if ($dmshop_top['top_servicemenu2_font_bold'] == '1') { echo "checked"; } ?> /></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip9">가로 메뉴바</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td><input type="radio" name="top_menubar_use" value="1" class="radio" <? if ($dmshop_top['top_menubar_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_menubar_use', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="top_menubar_use" value="0" class="radio" <? if ($dmshop_top['top_menubar_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'top_menubar_use', '1');">사용 안함</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="top_menubar_skin" name="top_menubar_skin" class="select"><?=$wmbar_skin_option?></select>

<script type="text/javascript">
$("#top_menubar_skin").val("<?=text($dmshop_top['top_menubar_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/wmbar</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip10">하단 여백</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td><input type="text" name="top_bottom_height" value="<?=text($dmshop_top['top_bottom_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
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
    <td><a href="./design_top.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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