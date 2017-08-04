<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.help_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.help_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.help_title .b1 {margin-top:6px;}
.help_title .b2 {margin-top:7px;}
.help_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.help_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.help_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.help_all .bg {height:44px; background:url('<?=$dmshop_help_path?>/img/title_bg.gif') repeat-x;}
.help_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.help_all .date {line-height:18px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.help_all .time {line-height:18px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.help_all .category {text-align:center; line-height:16px; font-size:12px; color:#639942; font-family:gulim,굴림;}
.help_all .subject {margin-left:10px; line-height:16px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.help_all .help_reply {text-align:center; font-weight:bold; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}

.help_all .dot {height:1px; background:url('<?=$dmshop_help_path?>/img/dot.gif') repeat-x;}

.help_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_help_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_help_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/help_list.php' class='off'>1:1문의 내역</a></td>";
?>
</tr>
</table>
    </td>
</tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_title">
<tr>
    <td width="9"></td>
    <td width="113" valign="top"><img src="<?=$dmshop_help_path?>/img/t0.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">1:1문의로 작성하신 내용과, 답변을 확인하실 수 있습니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_all">
<colgroup>
    <col width="120">
    <col width="2">
    <col width="140">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="120">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>문의일시</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>문의유형</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>제목</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>답변여부</b></td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="65">
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td align="center"><span class="date"><?=date("Y-m-d", strtotime($list[$i]['datetime']));?></span><br><span class="time"><?=date("H시 i분", strtotime($list[$i]['datetime']));?></span></td>
</tr>
</table>
    </td>
    <td></td>
    <td class="category">[<?=shop_help_category($list[$i]['help_category']);?>]</td>
    <td></td>
    <td><a href="#" onclick="orderPopupHelpView('<?=$list[$i]['id']?>'); return false;" class="subject"><?=filter1($list[$i]['subject']);?></a></td>
    <td></td>
    <td class="help_reply">
<?
if ($list[$i]['help_count']) {

    $dmshop_help_reply = shop_help_reply($list[$i]['help_id']);

    echo "답변완료";

} else {

    echo "접수중";

}
?>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_help_path?>/img/help_no.gif"></td></tr>
<? } ?>
<tr><td colspan="7" height="1" bgcolor="#dddddd"></td></tr>
<tr height="46">
    <td colspan="7" align="right"><a href="#" onclick="orderPopupHelp(); return false;"><img src="<?=$dmshop_help_path?>/img/btn_write.gif" border="0"></a></td>
</tr>
<tr><td colspan="7" height="2" bgcolor="#dddddd"></td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>