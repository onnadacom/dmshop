<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "6";

if ($m == '') {

    $menu_id = "201";
    $shop['title'] = "웹페이지 생성";

} else {

    $menu_id = "200";
    $shop['title'] = "웹페이지 수정";

}

$colspan = "6";

if ($m == '') {

    $dmshop_page = array();
    $dmshop_page['page_position'] = "0";
    $dmshop_page['page_view'] = "1";
    $dmshop_page['page_text_top'] = "";
    $dmshop_page['page_text_bottom'] = "";

    $shop['title'] = "페이지 등록";

}

else if ($m == 'u') {

    if (!$page_id) {

        alert("페이지가 삭제되었거나 존재하지 않습니다.");

    }

    // 페이지
    $dmshop_page = shop_page($page_id);

    if (!$dmshop_page['page_id']) {

        alert("페이지가 삭제되었거나 존재하지 않습니다.");

    }

    $shop['title'] = "페이지 수정";

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

include_once("./_top.php");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select2 select").selectBox();

    $(".tip1").simpletip({ content: '페이지 아이디는 본 페이지의 주소로 활용되며, 중복될 수 없습니다.' });
    $(".tip2").simpletip({ content: '페이지명은 메뉴바에도 표기되므로, 짧막한 표준명칭 사용을 권장 합니다.' });
    $(".tip3").simpletip({ content: '숫자가 높을수록 앞에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우 기본 등록순으로 보여집니다.' });
    $(".tip4").simpletip({ content: '메뉴출력을 숨김으로 설정하면, 메뉴바 상에서 보여지지 않습니다.' });
    $(".tip5").simpletip({ content: '페이지에 보여질 본문내용을 입력합니다.' });
    $(".tip6").simpletip({ content: '페이지의 상단부분에 보여질 이미지를 첨부합니다.' });
    $(".tip7").simpletip({ content: '페이지의 상단부분에 보여질 내용을 입력합니다.' });
    $(".tip8").simpletip({ content: '페이지의 하단부분에 보여질 내용을 입력합니다.' });
    $(".tip9").simpletip({ content: '페이지의 하단부분에 보여질 이미지를 첨부합니다.' });
    $(".tip10").simpletip({ content: '직접 제작한 상단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_top.php' });
    $(".tip11").simpletip({ content: '직접 제작한 하단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_bottom.php' });

    shopTop();

});
</script>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['smarteditor_data']?>"+"/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function pageSubmit()
{

    oEditors.getById["page_text_content"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["page_text_top"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["page_text_bottom"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formPage;

    if (f.page_id.value == '') {

        alert('페이지 아이디를 입력하십시오.');
        f.page_id.focus();
        return false;

    }

    if (f.page_title.value == '') {

        alert('페이지명을 입력하십시오.');
        f.page_title.focus();
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./page_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formPage" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 페이지 기본 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">페이지 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="hidden" id="page_id_chk" name="page_id_chk" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="page_id" name="page_id" value="<?=$page_id?>" maxlength="20" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="pageidCheck(); return false;"><img src="<?=$shop['image_path']?>/adm/check.gif" border="0"></a></td>
    <td width="13"></td>
    <td class="help1"><span id="page_id_msg">아이디는 본 페이지의 주소로 활용되며, 중복될 수 없습니다.</span></td>
</tr>
</table>

<script type="text/javascript">
$("#page_id_chk").val("");

function pageidCheck()
{

    var page_id = $("#page_id").val();

    if (!page_id) {

        alert("페이지 아이디를 입력하세요.");
        $("#page_id").focus();
        return false;

    }

    $.post("./page_id_check.php", {"page_id" : page_id}, function(data) {

        $("#dmshop_update").html(data);

    });

}
</script>
<? } else { ?>
<input type="hidden" name="page_id" value="<?=$page_id?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=$page_id?></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/page.php?page_id=<?=$page_id?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0" align="absmiddle"></a></td>
</tr>
</table>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">페이지명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="page_title" value="<?=text($dmshop_page['page_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">출력순서</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="page_position" value="<?=text($dmshop_page['page_position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">메뉴출력</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="page_view" name="page_view" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
$("#page_view").val("<?=$dmshop_page['page_view']?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 페이지 이미지/내용 입력 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="510">
    <td></td>
    <td class="subject"><span class="tip5">본문 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="page_text_content" name="page_text_content" class="textarea1" style="width:788px; height:400px;"><?=text($dmshop_page['page_text_content']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 페이지 상단/하단 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">상단 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "page_top_".$page_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_top" class="file" size="35" /></td>
<? if ($m == 'u' && $file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_top" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject"><span class="tip7">상단 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="page_text_top" name="page_text_top" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_page['page_text_top']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject"><span class="tip8">하단 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="page_text_bottom" name="page_text_bottom" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_page['page_text_bottom']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip9">하단 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "page_bottom_".$page_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_bottom" class="file" size="35" /></td>
<? if ($m == 'u' && $file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_bottom" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상단/하단 파일 개별설정 (전문가용) ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">TOP 파일 경로</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="page_include_top" value="<?=text($dmshop_page['page_include_top'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">BOTTOM 파일 경로</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="page_include_bottom" value="<?=text($dmshop_page['page_include_bottom'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
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
    <td><a href="#" onclick="pageSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./page_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 현재의 설정값이 적용 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "page_text_content",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "page_text_top",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "page_text_bottom",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<?
include_once("./_bottom.php");
?>