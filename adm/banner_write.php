<?php
include_once("./_dmshop.php");
if ($banner_id) { $banner_id = preg_match("/^[0-9]+$/", $banner_id) ? $banner_id : ""; }
$top_id = "2";
$left_id = "6";

if ($m == '') {

    $menu_id = "301";
    $shop['title'] = "배너 생성";

} else {

    $menu_id = "300";
    $shop['title'] = "배너 수정";

}

$colspan = "6";

if ($m == '') {

    $dmshop_banner = array();
    $dmshop_banner['ba_position'] = 0;
    $dmshop_banner['ba_target'] = 0;
    $dmshop_banner['ba_view'] = 1;

}

else if ($m == 'u') {

    if (!$banner_id) {

        alert("배너가 삭제되었거나 존재하지 않습니다.");

    }

    // 배너
    $dmshop_banner = shop_banner($banner_id);

    if (!$dmshop_banner['id']) {

        alert("배너가 삭제되었거나 존재하지 않습니다.");

    }

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

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:110px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '본 배너가 등록될 그룹을 선탱 합니다. 배너 호출시에는 그룹명을 이용합니다.' });
    $(".tip2").simpletip({ content: '관리를 목적으로, 짧막한 배너명을 입력하세요.' });
    $(".tip3").simpletip({ content: '숫자가 높을수록 앞에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우 기본 등록순으로 보여집니다.' });
    $(".tip4").simpletip({ content: '숨김 설정시 설정값만 정장/보관되며, 배너 영역에 출력되지 않습니다.' });
    $(".tip5").simpletip({ content: '첨부 이미지의 가로 세로 크기와 동일하게 입력하세요.' });
    $(".tip6").simpletip({ content: '배너로 이용할 파일을 첨부하세요. (플래시의 경우 플래시파일 자체에서 링크를 만드세요.)' });
    $(".tip7").simpletip({ content: '첨부 이미지 클릭시, 이동할 경로(URL) 입력하세요. (플래시파일의 경우 적용되지 않습니다.)' });
    $(".tip8").simpletip({ content: '클릭시 링크 방식을 선택하세요. (플래시파일의 경우 적용되지 않습니다.)' });

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
function bannerSubmit()
{

    var f = document.formBanner;

    if (f.ba_title.value == '') {

        alert('배너명을 입력하십시오.');
        f.ba_title.focus();
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./banner_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formBanner" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="banner_id" value="<?=text($banner_id)?>" />
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 배너 기본 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">그룹명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="group_id" name="group_id" class="select">
    <option value="">선택</option>
<?
$result = sql_query(" select * from $shop[banner_group_table] order by group_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['group_id'])."'>".text($row['group_id'])."</option>\n";

}
?>
</select>

<script type="text/javascript">
$("#group_id").val("<?=text($dmshop_banner['group_id'])?>");
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
    <td class="subject"><span class="tip2">배너명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ba_title" value="<?=text($dmshop_banner['ba_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
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
    <td><input type="text" name="ba_position" value="<?=text($dmshop_banner['ba_position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
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
    <td class="subject"><span class="tip4">출력설정</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="ba_view" name="ba_view" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
$("#ba_view").val("<?=text($dmshop_banner['ba_view'])?>");
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
    <td colspan="<?=$colspan?>" class="pagetitle">::배너 크기/이미지 첨부 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">배너 크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="ba_width" value="<?=text($dmshop_banner['ba_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="20"></td>
    <td class="tx2">세로</td>
    <td width="5"></td>
    <td><input type="text" name="ba_height" value="<?=text($dmshop_banner['ba_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
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
    <td class="subject"><span class="tip6">첨부 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_banner" class="file" size="35" /></td>
<? if ($m == 'u' && $dmshop_banner['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_banner.php?id=<?=text($dmshop_banner['id'])?>"><span class="source"><?=text($dmshop_banner['upload_source'])?> <span class="filesize">(<?=shop_filesize($dmshop_banner['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_banner" value="1" class="checkbox" /></td>
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
    <td class="subject"><span class="tip7">첨부 이미지 링크</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ba_url" value="<?=text($dmshop_banner['ba_url'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:340px;" /></td>
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
    <td class="subject"><span class="tip8">링크방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="ba_target" name="ba_target" class="select">
    <option value="1">새창</option>
    <option value="0">이동</option>
</select>

<script type="text/javascript">
$("#ba_target").val("<?=text($dmshop_banner['ba_target'])?>");
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
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="bannerSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./banner_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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

<?
include_once("./_bottom.php");
?>