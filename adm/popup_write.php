<?php
include_once("./_dmshop.php");
if ($popup_id) { $popup_id = preg_match("/^[0-9]+$/", $popup_id) ? $popup_id : ""; }
$top_id = "2";
$left_id = "6";

if ($m == '') {

    $menu_id = "401";
    $shop['title'] = "팝업창 생성";

} else {

    $menu_id = "400";
    $shop['title'] = "팝업창 수정";

}

$colspan = "6";

if ($m == '') {

    $dmshop_popup = array();
    $dmshop_popup['pop_view'] = 1;
    $dmshop_popup['pop_position'] = 0;
    $dmshop_popup['pop_start'] = $shop['time_ymdhis'];
    $dmshop_popup['pop_end'] = $shop['time_ymdhis'];
    $dmshop_popup['pop_width'] = "";
    $dmshop_popup['pop_height'] = "";
    $dmshop_popup['pop_left'] = "";
    $dmshop_popup['pop_top'] = "";
    $dmshop_popup['pop_target'] = 1;

}

else if ($m == 'u') {

    if (!$popup_id) {

        alert("팝업창이 삭제되었거나 존재하지 않습니다.");

    }

    // 팝업창
    $dmshop_popup = shop_popup($popup_id);

    if (!$dmshop_popup['id']) {

        alert("팝업창이 삭제되었거나 존재하지 않습니다.");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_popup['pop_text']) { $dmshop_popup['pop_text'] = "<br />"; }

include_once("./_top.php");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select4 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select4 .selectBox-dropdown {width:8px; height:19px;}
.contents_box .select4 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select4 select").selectBox();

    $(".tip1").simpletip({ content: '팝업창의 타이틀에 표기되며, 짧막한 표준명칭 사용을 권장 합니다.' });
    $(".tip2").simpletip({ content: '사용여부를 미사용으로 설정하면, 쇼핑몰 상에서 보여지지 않습니다.' });
    $(".tip3").simpletip({ content: '팝업창을 2개 이상 띄울 경우, 출력순서가 높을수록 위에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우, 생성일순 출력' });
    $(".tip4").simpletip({ content: '팝업창이 지정된 기간에 노출됩니다.' });
    $(".tip5").simpletip({ content: '첨부 이미지를 통한 팝업창 생성시, 첨부 이미지의 가로 세로 크기와 동일하게 입력' });
    $(".tip6").simpletip({ content: '팝업창 위치를 지정합니다.' });
    $(".tip7").simpletip({ content: '팝업창에 보여질 파일을 첨부합니다.' });
    $(".tip8").simpletip({ content: '첨부 이미지 클릭시 이동할 경로(URL) 입력' });
    $(".tip9").simpletip({ content: '첨부 이미지 클릭시 링크 방식을 선택합니다.' });
    $(".tip10").simpletip({ content: '팝업창에 보여질 내용을 입력합니다.' });

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
function popupSave()
{

    oEditors.getById["pop_text"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formPopup;

    if (f.pop_title.value == '') {

        alert('팝업창명을 입력하세요.');
        f.pop_title.focus();
        return false;

    }

    if (f.pop_width.value == '') {

        alert('팝업창 크기를 입력하세요.');
        f.pop_width.focus();
        return false;

    }

    if (f.pop_height.value == '') {

        alert('팝업창 크기를 입력하세요.');
        f.pop_height.focus();
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./popup_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formPopup" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="popup_id" value="<?=$popup_id?>" />
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 팝업 기본 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">팝업창명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="pop_title" value="<?=text($dmshop_popup['pop_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
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
    <td class="subject"><span class="tip2">사용여부</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="pop_view" name="pop_view" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
$("#pop_view").val("<?=$dmshop_popup['pop_view']?>");
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
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">출력순서</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="pop_position" value="<?=text($dmshop_popup['pop_position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
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
    <td class="subject"><span class="tip4">노출기간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="select4">
<tr>
    <td><input type="text" id="pop_start" name="pop_start" value="<?=date("Y-m-d", strtotime($dmshop_popup['pop_start']));?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:70px;" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('pop_start'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="5"></td>
    <td>
<select id="pop_start_h" name="pop_start_h" class="select">
<?
for ($i=0; $i<=23; $i++) {

    $k = sprintf("%02d" , $i);

    echo "<option value='".$k."'>".$k."</option>\n";

}
?>
</select>
<script type="text/javascript">$("#pop_start_h").val("<?=date("H", strtotime($dmshop_popup['pop_start']));?>");</script>
    </td>
    <td width="5"></td>
    <td class="tx2">시</td>
    <td width="5"></td>
    <td>
<select id="pop_start_i" name="pop_start_i" class="select">
<?
for ($i=0; $i<=59; $i++) {

    $k = sprintf("%02d" , $i);

    echo "<option value='".$k."'>".$k."</option>\n";

}
?>
</select>
<script type="text/javascript">$("#pop_start_i").val("<?=date("i", strtotime($dmshop_popup['pop_start']));?>");</script>
    </td>
    <td width="5"></td>
    <td class="tx2">분</td>
    <td width="55" align="center" class="tx2">부터 ~</td>
    <td><input type="text" id="pop_end" name="pop_end" value="<?=date("Y-m-d", strtotime($dmshop_popup['pop_end']));?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:70px;" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('pop_end'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="5"></td>
    <td>
<select id="pop_end_h" name="pop_end_h" class="select">
<?
for ($i=0; $i<=23; $i++) {

    $k = sprintf("%02d" , $i);

    echo "<option value='".$k."'>".$k."</option>\n";

}
?>
</select>
<script type="text/javascript">$("#pop_end_h").val("<?=date("H", strtotime($dmshop_popup['pop_end']));?>");</script>
    </td>
    <td width="5"></td>
    <td class="tx2">시</td>
    <td width="5"></td>
    <td>
<select id="pop_end_i" name="pop_end_i" class="select">
<?
for ($i=0; $i<=59; $i++) {

    $k = sprintf("%02d" , $i);

    echo "<option value='".$k."'>".$k."</option>\n";

}
?>
</select>
<script type="text/javascript">$("#pop_end_i").val("<?=date("i", strtotime($dmshop_popup['pop_end']));?>");</script>
    </td>
    <td width="5"></td>
    <td class="tx2">분</td>
    <td width="10"></td>
    <td class="tx2">까지</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 팝업창 크기/이미지 첨부 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">팝업창 크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="pop_width" value="<?=text($dmshop_popup['pop_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="20"></td>
    <td class="tx2">세로</td>
    <td width="5"></td>
    <td><input type="text" name="pop_height" value="<?=text($dmshop_popup['pop_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
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
    <td class="subject"><span class="tip6">팝업창 위치</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">브라우저 좌측 상단으로 부터</td>
    <td width="15"></td>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="pop_left" value="<?=text($dmshop_popup['pop_left'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="20"></td>
    <td class="tx2">세로</td>
    <td width="5"></td>
    <td><input type="text" name="pop_top" value="<?=text($dmshop_popup['pop_top'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="15"></td>
    <td class="tx2">이동</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">첨부 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_popup" class="file" size="35" /></td>
<? if ($m == 'u' && $dmshop_popup['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_popup.php?id=<?=$dmshop_popup['id']?>"><span class="source"><?=text($dmshop_popup['upload_source'])?> <span class="filesize">(<?=shop_filesize($dmshop_popup['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_popup" value="1" class="checkbox" /></td>
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
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">첨부 이미지 링크</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="pop_url" value="<?=text($dmshop_popup['pop_url'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:340px;" /></td>
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
    <td class="subject"><span class="tip9">링크방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="pop_target" name="pop_target" class="select">
    <option value="1">새창</option>
    <option value="0">이동</option>
</select>

<script type="text/javascript">$("#pop_target").val("<?=text($dmshop_popup['pop_target'])?>");</script>
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 팝업창 내용 입력 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="510">
    <td></td>
    <td class="subject"><span class="tip10">본문 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="pop_text" name="pop_text" class="textarea1" style="width:788px; height:400px;"><?=text($dmshop_popup['pop_text']);?></textarea></td>
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
    <td><a href="#" onclick="popupSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./popup_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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
	elPlaceHolder: "pop_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<?
include_once("./_bottom.php");
?>