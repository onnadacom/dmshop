<?php
if (!defined('_DMSHOP_')) exit;
?>

<script type="text/javascript">
// 메모등록
function memoSubmit()
{

    var f = document.formMemo;

    if (f.content.value == '') {

        alert("내용을 입력하세요.");
        f.content.focus();
        return false;

    }

    f.m.value = "memo";

    f.action = "./user_manage_update.php";
    f.submit();

}

// 메모삭제
function memoDelete(memo_id)
{

    var f = document.formMemo;

    f.m.value = "memo_delete";
    f.memo_id.value = memo_id;

    f.action = "./user_manage_update.php";
    f.submit();

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 메모작성 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t11.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<form method="post" name="formMemo">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="user_id" value="<?=$user_id?>" />
<input type="hidden" name="memo_id" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">내용입력</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<textarea name="content" class="textarea1" style="width:425px; height:100px;"></textarea>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="memoSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/manage_memo_ok.gif" border="0"></a></td>
</tr>
</table>
</form>
<!-- 메모작성 end //-->

<!-- 메모내역 start //-->
<?
$result = sql_query(" select * from $shop[user_memo_table] where user_id = '".$user_id."' order by id desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}
?>
<? if (count($list)) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t12.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<? } ?>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center"><span class="datetime1"><?=date("Y-m-d", strtotime($list[$i]['datetime']))?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($list[$i]['datetime']))?></span></td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($list[$i]['content'], 0);?> <a href="#" onclick="memoDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_memo_delete.gif" border="0" class="down2"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="4" height="100" align="center" class="not">등록된 메모가 없습니다.</td>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 메모내역 end //-->