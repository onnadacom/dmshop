<?php
if (!defined('_DMSHOP_')) exit;
?>
<!-- 가입정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t0.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">아이디</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="user_id"><?=$user_id?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">성명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="user_name"><?=text($user['user_name'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">생년월일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_birth']) { ?><?=date("Y년 m월 d일", strtotime($user['user_birth']));?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">성별</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_sex']) { ?><?=shop_user_sex($user['user_sex']);?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">닉네임</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_nick'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">휴대폰 번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_hp'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">일반 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">기본 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_zip1']) { ?><span class="zip">(우: <?=text($user['user_zip1'])?><?=text($user['user_zip2'])?>)</span> <?=text($user['user_addr1'])?> <?=text($user['user_addr2'])?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">직장명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_company'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">직장 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_company_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">직장 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_company_zip1']) { ?><span class="zip">(우: <?=text($user['user_company_zip1'])?><?=text($user['user_company_zip2'])?>)</span> <?=text($user['user_company_addr1'])?> <?=text($user['user_company_addr2'])?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">이메일 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_email'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">홈페이지</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="<?=shop_http(text($user['user_homepage']));?>" target="_blank" class="tx2"><?=text($user['user_homepage'])?></a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">추천인</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_recommend'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">자기소개</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($user['user_profile'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 가입정보 end //-->