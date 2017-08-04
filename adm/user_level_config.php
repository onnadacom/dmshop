<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "4";
$menu_id = "403";
$shop['title'] = "등급 명칭·아이콘";
include_once("./_top.php");

$colspan = "10";

// 등급
$result = sql_query(" select * from $shop[user_level_table] order by level asc ");
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript">
function checkAll(mode)
{

    $('.form_list .chk_id input').attr('checked', mode);

}

function checkConfirm(msg)
{

    var n = $('.form_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 등급을 선택하세요.");
        return false;

    }

    return true;

}

function checkSave()
{

    var msg = "변경";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "u";

    if (!confirm("선택한 등급을 변경하시겠습니까?")) {

        return false;

    }

    f.action = "./user_level_config_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td width="20"></td>
    <td class="listname">회원 등급별 아이콘·명칭</td>
    <td width="136" align="right"><a href="#" onclick="userPopupLevel(''); return false;"><img src="<?=$shop['image_path']?>/adm/user_level.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formList" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="140">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="200">
</colgroup>
<tr height="1">
    <td></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">등급</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이콘</td>
    <td class="bc1"></td>
    <td class="boxtitle">명칭 및 아이콘 이미지</td>
    <td class="bc1"></td>
    <td class="boxtitle">비고 (권장)</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    if ($list['level'] >= '9') {

        $level = "<span class='level_a' style='color:#ff0000;'>Lv. ".text($list['level'])."</span>";

    } else {

        $level = "<span class='level'>Lv. ".text($list['level'])."</span>";

    }

    $upload_mode = $list['level'];
    $file = shop_user_level_file($upload_mode);

    // 파일 경로
    $file_path = $shop['path']."/data/user_level/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

    // 파일이 있다면
    if (file_exists($file_path) && $file['upload_file']) {

        $file_icon = "<img src='".$file_path."'>";

    } else {

        $file_icon = "&nbsp;";

    }
?>
<input type="hidden" name="level[<?=$i?>]" value="<?=$list['level']?>" />
<tr height="100">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><?=$level?></td>
    <td class="bc1"></td>
    <td align="center"><div id="preview_<?=$list['level']?>" style="width:60px; height:70px; text-align:center; margin:0 auto;"><?=$file_icon?></div></td>
    <td class="bc1"></td>
    <td>
<div style="padding:0 0 0 10px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="name[<?=$i?>]" value="<?=text($list['name'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:198px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="32" onchange="shopFile(document.getElementById('preview_<?=$list['level']?>'), this);" onkeydown="return false;" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_user_level.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td><span class="filedel">첨부이미지 삭제</span></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="help1">- 등급 아이콘의 권장 크기는 가로 60px, 세로 70px 입니다. (JPG, GIF, PNG 사용가능)</span></td>
</tr>
</table>
</div>
    </td>
    <td class="bc1"></td>
    <td align="center"><div style="width:105px; margin:0 auto;"><span class="level_memo"><?=text($list['memo'])?></span></div></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<? } ?>
</table>

<? if ($i && $total_count > $rows) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="90">
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="200">
    <td class="not">데이터가 없습니다.</td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="./user_level_config.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 선택항목의 변동된 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>