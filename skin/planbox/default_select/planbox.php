<?
if (!defined("_DMSHOP_")) exit;
// 기획전박스
?>
<style type="text/css">
.skin_planbox_default.title_bg {height:36px; background:url('<?=$dmshop_planbox_path?>/img/title_bg.gif') repeat-x;}
.skin_planbox_default .bottom_bg {height:5px; background:url('<?=$dmshop_planbox_path?>/img/bottom_bg.gif') repeat-x;}

.skin_planbox_default .select {line-height: 1.5; font-size:12px; color:#9e9e9e; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.skin_planbox_default .selectBox-dropdown {width:150px; height:19px;}
.skin_planbox_default .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".skin_planbox_default select").selectBox();
});

function planboxGo(id)
{

    if (id == '') {
        return false;
    }

    document.location.href = "<?=$shop['path']?>/plan.php?pl_id="+id;

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default title_bg">
<tr>
    <td align="center"><img src="<?=$dmshop_planbox_path?>/img/title.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<tr>
    <td width="5"></td>
    <td>
<?
$option = "";
for ($i=0; $i<count($list); $i++) {

    $option .= "<option value='".$list[$i]['id']."'>".$list[$i]['title']."</option>";

}
?>
<select id="skin_planbox_default" name="skin_planbox_default" onchange="planboxGo(this.value);">
<? if ($i) { ?>
<option value="">기획전명을 선택하세요.</option>
<? } else { ?>
<option value="">진행중인 기획전이 없습니다.</option>
<? } ?>
<?=$option?>
</select>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<tr><td class="bottom_bg none">&nbsp;</td></tr>
</table>

<script type="text/javascript">
<? if ($pl_id && $option) { ?>$("#skin_planbox_default").val("<?=$pl_id?>");<? } ?>
</script>