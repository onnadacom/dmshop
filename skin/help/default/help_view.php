<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
body {background-color:#f5f5f5;}
.top_bg {height:45px; background:url('<?=$dmshop_help_path?>/img/top_bg.gif') repeat-x;}
.subject {text-align:center; font-weight:bold; line-height:13px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.text {line-height:14px; font-size:12px; color:#474747; font-family:gulim,굴림;}
.datetime1 {line-height:14px; font-size:12px; color:#777777; font-family:gulim,굴림;}
.datetime2 {line-height:14px; font-size:12px; color:#9d9d9d; font-family:dotum,돋움;}
.user_id {line-height:14px; font-size:12px; color:#7da7d9; font-family:gulim,굴림;}
.user_name {line-height:14px; font-size:12px; color:#333333; font-family:gulim,굴림;}
.help_category {line-height:14px; font-size:12px; color:#027d94; font-family:gulim,굴림;}
.help_code {line-height:14px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.source {text-decoration:underline; line-height:14px; font-size:12px; color:#0000ff; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_help_path?>/img/title2.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td width="20"></td>
    <td>
<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/help_title1.gif"></td>
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
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">접수 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_help['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_help['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">문의유형/대상</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help_category">[<?=shop_help_category($dmshop_help['help_category']);?>]</td>
<? if ($dmshop_help['help_type'] == '1' && $dmshop_help['help_code']) { ?>
    <td width="5"></td>
    <td><a href="#" onclick="orderPopupView('<?=$dmshop_help['help_code']?>'); return false;" class="help_code">주문번호 - <?=$dmshop_help['help_code']?></a></td>
<? } ?>
<? if ($dmshop_help['help_type'] == '2' && $dmshop_help['help_code']) { ?>
    <td width="5"></td>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$dmshop_help['help_code']?>" target="_blank" class="help_code">상품번호 - <?=$dmshop_help['help_code']?></a></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">상담 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="text"><?=text($dmshop_help['subject']);?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">상담 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text"><?=text2($dmshop_help['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='./download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<tr><td colspan="4" height="2" bgcolor="#777777"></td>
</table>
<!-- end //-->

<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/help_title2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<? if ($dmshop_help_reply['id']) { ?>
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
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">답변 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_help_reply['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_help_reply['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="text"><?=text($dmshop_help_reply['subject']);?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">답변 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text"><?=text2($dmshop_help_reply['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help_reply['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='./download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- end //-->
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="100" align="center"><img src="<?=$dmshop_help_path?>/img/help_reply_no.gif"></td>
</tr>
</table>
<? } ?>
    </td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20" bgcolor="#ffffff"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_help_path?>/img/close.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>