<?php
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
body {background-color:#f5f5f5;}
.bg {height:40px; background:url('<?=$dmshop_zip_path?>/img/bg.gif') repeat-x;}
.line {height:1px; background:url('<?=$dmshop_zip_path?>/img/line.gif') repeat-x;}

.t1 {font-weight:bold; line-height:37px; font-size:14px; color:#ffffff; font-family:gulim,굴림;}
.t2 {font-weight:bold; line-height:15px; font-size:13px; color:#808080; font-family:gulim,굴림;}
.t3 {line-height:16px; font-size:12px; color:#7d7d7d; font-family:gulim,굴림;}
.t4 {font-weight:bold; line-height:15px; font-size:13px; color:#333333; font-family:gulim,굴림;}
.t5 {text-align:center; line-height:33px; font-size:11px; color:#959595; font-family:gulim,굴림;}
.t6 {text-align:center; font-weight:bold; line-height:90px; font-size:13px; color:#808080; font-family:gulim,굴림;}

.zip {text-align:center; font-weight:bold; line-height:20px; font-size:13px; color:#7d7d7d; font-family:gulim,굴림;}
.title {width:50px; background-color:#999999; text-align:center; line-height:20px; font-size:11px; color:#ffffff; font-family:gulim,굴림;}
.addr {text-align:center; font-weight:bold; line-height:20px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.addr:hover {color:#409dae;}
.addr2 {text-align:center; line-height:20px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.addr2:hover {color:#409dae;}

.not {text-align:center;}
.not {font-weight:bold; line-height:21px; font-size:13px; color:#808080; font-family:gulim,굴림;}

.input {width:170px; height:20px; border:2px solid #c9c9c9; padding:0px 5px 0px 5px;}
.input {font-weight:bold; line-height:20px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.idselect .select {line-height:22px; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.idselect .selectBox-dropdown {width:70px; height:23px;}
.idselect .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".idselect select").selectBox();
});

function zipFocus1(i)
{

    (i).style.border = "2px solid #409dae";
    (i).style.padding = "0px 5px 0px 5px";

}

function zipFocus2(i)
{

    (i).style.border = "2px solid #c9c9c9";
    (i).style.padding = "0px 5px 0px 5px";

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="bg">
    <td width="15"></td>
    <td width="6"><img src="<?=$dmshop_zip_path?>/img/arrow.gif" class="up2"></td>
    <td width="10"></td>
    <td><span class="t1">우편번호 찾기</span></td>
</tr>
</table>

<form name="formZip" method="post" action="zip.php" autocomplete="off">
<input type="hidden" name="form_name" value="<?=filter1($form_name)?>" />
<input type="hidden" name="form_zip1" value="<?=filter1($form_zip1)?>" />
<input type="hidden" name="form_zip2" value="<?=filter1($form_zip2)?>" />
<input type="hidden" name="form_addr1" value="<?=filter1($form_addr1)?>" />
<input type="hidden" name="form_addr2" value="<?=filter1($form_addr2)?>" />

<div style="padding:20px; background-color:#ffffff;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_zip_path?>/img/ic.gif"></td>
    <td width="10"></td>
<? if ($dmshop['zipcode'] == 1) { ?>
    <td><p class="t2">찾으시는 주소의 동(읍/면/리)의 이름 또는 도로명주소(새주소)를 입력하세요.</p><p class="t3">예:) 논현동, 교하읍, 영암리 (두글자 이상)</p></td>
<? } else { ?>
    <td><p class="t2">찾으시는 주소의 동(읍/면/리)을 입력하세요.</p><p class="t3">예:) 논현동, 교하읍, 영암리 (두글자 이상)</p></td>
<? } ?>
</tr>
</table>



<table border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="width:380px; padding:10px 20px; border:1px solid #e5e5e5; background-color:#f4f4f4; margin:0 auto;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($dmshop['zipcode'] == 1) { ?>
    <td class="idselect">
<select id="id" name="id" class="select">
    <option value="1">서울특별시</option>
    <option value="2">경기도</option>
    <option value="3">인천광역시</option>
    <option value="4">부산광역시</option>
    <option value="5">대전광역시</option>
    <option value="6">대구광역시</option>
    <option value="7">울산광역시</option>
    <option value="8">세종특별자치시</option>
    <option value="9">광주광역시</option>
    <option value="10">강원도</option>
    <option value="11">충청북도</option>
    <option value="12">충청남도</option>
    <option value="13">경상북도</option>
    <option value="14">경상남도</option>
    <option value="15">전라북도</option>
    <option value="16">전라남도</option>
    <option value="17">제주특별자치도</option>
</select>
<script type="text/javascript">
<? if ($id) { ?>document.getElementById("id").value = "<?=$id?>";<? } ?>
</script>
    </td>
    <td width="5"></td>
<? } else { ?>
    <td class="t4">동(읍/면/리) 입력</td>
    <td width="10"></td>
<? } ?>
    <td><input type="text" name="q" value="<?=$q?>" onFocus="zipFocus1(this);" onBlur="zipFocus2(this);" class="input" /></td>
    <td width="5"></td>
    <td><input type="image" src="<?=$dmshop_zip_path?>/img/search.gif" border="0" /></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_zip_path?>/img/arrow2.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_zip_path?>/img/title.gif"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<? if ($q) { ?>
<? if (count($list)) { ?>

<? if ($dmshop['zipcode'] == 1) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<? for ($i=0; $i<count($list); $i++) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="2" height="10"></td></tr>
<tr>
    <td width="80" class="zip"><?=filter1($list[$i]['zip1'])?></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="title">도로명</td>
    <td width="8"></td>
    <td><a href="#" onclick="zipAdd('<?=filter1($list[$i]['zip1'])?>', '<?=filter1($list[$i]['zip2'])?>', '<?=filter1($list[$i]['addr'])?>'); return false;" class="addr"><?=filter1($list[$i]['addr'])?></a></td>
</tr>
<tr><td colspan="3" height="1"></td></tr>
<tr>
    <td class="title">지번</td>
    <td width="8"></td>
    <td><a href="#" onclick="zipAdd('<?=filter1($list[$i]['zip1'])?>', '<?=filter1($list[$i]['zip2'])?>', '<?=filter1($list[$i]['addr2'])?>'); return false;" class="addr2"><?=filter1($list[$i]['addr2'])?></a></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="10"></td></tr>
<tr><td colspan="2" height="1" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
<? } ?>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr height="21">
    <td width="95" class="zip"><?=filter1($list[$i]['zip1'])?>-<?=filter1($list[$i]['zip2'])?></td>
    <td><a href="#" onclick="zipAdd('<?=filter1($list[$i]['zip1'])?>', '<?=filter1($list[$i]['zip2'])?>', '<?=filter1($list[$i]['addr'])?>'); return false;" class="addr"><?=filter1($list[$i]['full_addr'])?></a></td>
</tr>
<? } ?>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t5">검색결과에서 원하는 주소를 클릭하세요.</td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="not">입력하신 주소를 바탕으로한 우편번호를 찾을 수 없습니다.<br>다시 한번 정확히 입력해 주시기 바랍니다.</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t5">검색결과에서 원하는 주소를 클릭하세요.</td>
</tr>
</table>
<? } ?>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t6">입력창에 주소명칭을 입력하고 검색버튼을 눌러주세요.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="t5">검색결과에서 원하는 주소를 클릭하세요.</td></tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

</div>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<script type="text/javascript">
function zipAdd(zip1, zip2, addr1)
{

    var obj = opener.document.<?=filter1($form_name)?>;

    obj.<?=filter1($form_zip1)?>.value  = zip1;
    obj.<?=filter1($form_zip2)?>.value  = zip2;
    obj.<?=filter1($form_addr1)?>.value = addr1;

    obj.<?=filter1($form_addr2)?>.focus();
    window.close();

}
</script>