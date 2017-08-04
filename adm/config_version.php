<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "101";
$shop['title'] = "솔루션 업데이트";
include_once("./_top.php");

$colspan = "6";
?>
<style type="text/css">
.contents_box {min-width:1100px;}
.contents_box .etc {line-height:24px; font-size:12px; color:#414141; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function configSave()
{

    var f = document.formVersion;

    if (!confirm("업데이트 하시겠습니까?")) {

        return false;

    }

    f.action = "./config_version_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formVersion" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 버전정보·업데이트 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">현재 버전</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text($dmshop['version'])?></td>
    <td width="5"></td>
    <td class="text3">(배포일 : <?=date("Y년 m월 d일", strtotime($dmshop['version_date']));?>)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">최신 버전</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://download.dmshopkorea.com/" target="_blank"><img src="<?=$shop['image_path']?>/adm/download.gif" border="0"></a></td>
    <td width="10"></td>
    <td class="text3">솔루션의 최신버전을 확인하고 다운로드 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">업데이트 적용</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="configSave(); return false;"><img src="<?=$shop['image_path']?>/adm/update.gif" border="0"></a></td>
    <td width="10"></td>
    <td class="text3">솔루션의 최신버전을 확인하고 다운로드 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject">업데이트 안내</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="etc">
DM SHOP은 업데이트를 통하여, 시스템 및 보안기능 강화와 추가적인 새로은 기능을 제공 받으실 수 있습니다.<br>
업데이트 파일은 무상으로 다운로드 받으실 수 있으나, 설치는 아래의 설치방법을 통해 개별적으로 직접 진행하셔야 합니다.<br>
만일 사내에 개발자가 없거나, 직접 업데이트를 못하시는 분들은 초기 쇼핑몰 구축업체 또는 외부 개발자분들께 의뢰하시기 바랍니다.
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
<tr>
    <td class="etc">
<b>::: 업데이트 전 참고사항 :::</b><br>
1. 현재 자신이 운영중인 DM SHOP의 현재버전과  최신버전을 확인 합니다.<br>
2. 최신버전의 버전정보(Ver. x)가 현재버전의 버전정보 보다 (1)이 높다면 바로 설치를 진행 합니다.<br>
&nbsp;&nbsp;&nbsp;&nbsp;단, 버전정보가 (2)이상 높다면 반드시 중간버전의 업데이트 파일을 순서대로 모두 설치하시기 바랍니다.
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
<tr>
    <td class="etc">
<b>::: 업데이트 방법 안내 :::</b><br>
1. 업데이트를 진행하시기 전, 만일의 사태에 대비하여 현재 운영중인 쇼핑몰의 파일과 DB를 모두 백업 합니다.<br>
2. 백업이 완료되면 DM SHOP 배포사이트의 자료실을 방문하여 업데이트 버전을 확인/다운로드 합니다.<br>
3. 다운 받으신 업데이트 파일의 압축을 풀고, 개발내역서를 참고하여 변경된 파일을 FTP프로그램을 통해 각각의 디렉토리에 업로드 합니다.<br>
4. 업로드가 완료되면, 본 페이지의 업데이트 적용 버튼을 클릭 하시면, 업데이트가 자동진행 됩니다.<br>
5. 업데이트가 완료되면 시스템이 정상 작동 되는지 개별적으로 체크 합니다.
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
<tr>
    <td class="etc">
<b>::: 주의사항 :::</b><br>
1. 업데이트 완료 메시지가 출력될 때 까지는 브라우져 창을 닫거나, 페이지 이동을 하지 마시기 바랍니다.<br>
2. 개별적으로 커스터마이징된 파일을 업데이트 후, 초기화 될 수 있으므로 전문가의 도움을 요청하시기 바랍니다.<br>
3. 솔루션 배포처(DM SHOP)는 개별적인 업데이트 진행으로 인해 발생되는 문제에 대해서는 책임을 지지 않습니다.
    </td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>