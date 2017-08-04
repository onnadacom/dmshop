<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
?>
<div class="calendar_scroll">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$result = sql_query(" select * from $shop[calendar_table] where date = '".$shop['time_ymd']."' order by h1 asc, i1 asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
<? if ($i > '0') { ?>
<tr><td width="4"></td><td colspan="2" height="1" bgcolor="#4c4c4c"></td></tr>
<tr><td colspan="3" height="5"></td></tr>
<? } ?>
<tr>
    <td width="4"></td>
    <td width="50" align="center" valign="top" class="date"><?=date("H:i", strtotime($row['date']." ".$row['h1'].":".$row['i1'].":00"));?></td>
    <td valign="top" class="title"><?=text($row['title']);?></td>
</tr>
<tr><td colspan="3" height="3"></td></tr>
<? } ?>
<? if (!$i) { ?>
<tr height="80">
    <td align="center"><img src="<?=$shop['image_path']?>/adm/calendar_mini_not.gif"></td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
</div>

<script type="text/javascript">
$(function() {
    $('.calendar_scroll').jScrollPane({ showArrows: true });
});
</script>