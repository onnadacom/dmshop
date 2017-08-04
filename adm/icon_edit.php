<?php
include_once("./_dmshop.php");
if ($icon_id) { $icon_id = preg_match("/^[0-9]+$/", $icon_id) ? $icon_id : ""; }
$shop['title'] = "상품 아이콘 변경";
include_once("$shop[path]/shop.top.php");

$colspan = "9";

if (!$icon_id) {

    alert_close("아이콘이 삭제되었거나 존재하지 않습니다.");

}

// 상품 아이콘
$dmshop_icon = shop_icon_file($icon_id);

if (!$dmshop_icon['id']) {

    alert_close("아이콘이 삭제되었거나 존재하지 않습니다.");

}

// 파일 경로
$file_path = $shop['path']."/data/icon/".shop_data_path("u", $dmshop_icon['datetime'])."/".$dmshop_icon['upload_file'];

// 파일이 있다면
if (file_exists($file_path) && $dmshop_icon['upload_file']) {

    $file_icon = "<img src='".$file_path."'>";

} else {

    $file_icon = "";

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript">
function iconSubmit()
{

    var f = document.formIcon;

    if (f.title.value == '') {

        alert("아이콘명을 입력하세요.");
        f.title.focus();
        return false;

    }

    if (!confirm("변경하시겠습니까?")) {

        return false;

    }

    f.action = "./icon_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle">아이콘 변경</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td class="guide_t">기존의 아이콘 이미지를 변경 합니다. (권장 사이즈 = 가로 40px, 세로 15px 이하)</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="tx1">기존 이미지</span></td>
    <td width="10"></td>
    <td><?=$file_icon?></td>
    <td width="25"></td>
    <td class="tx1">기존 아이콘명</span></td>
    <td width="10"></td>
    <td><input type="text" name="title_ori" value="<?=text($dmshop_icon['title'])?>" class="input" style="width:100px; background-color:#f0f0f0;" readonly /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formIcon" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="u" />
<input type="hidden" name="icon_id" value="<?=$icon_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="100">
    <col width="1">
    <col width="140">
    <col width="1">
    <col width="20">
    <col width="">
    <col width="20">
</colgroup>
<tr height="1">
    <td></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td class="boxtitle">새 이미지</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이콘명</td>
    <td class="bc1"></td>
    <td></td>
    <td class="boxtitle">파일첨부</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="50">
    <td></td>
    <td align="center"><div id="icon_preview" style="width:80px; height:20px; text-align:center;">&nbsp;</div></td>
    <td class="bc1"></td>
    <td align="center"><input type="text" name="title" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:100px;" value="<?=text($dmshop_icon['title'])?>" /></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="file" name="file" class="file" size="35" onchange="shopFile(document.getElementById('icon_preview'), this);" onkeydown="return false" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="iconSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="15"></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인버튼을 클릭하시면 현재 첨부된 모든 이미지가 등록 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>