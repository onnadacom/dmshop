<?
if (!defined('_DMSHOP_')) exit;
// 하단
?>
<style type="text/css">
.skin_bottom_default .service_menu a {text-decoration:none; display:block; height:40px;}
.skin_bottom_default .service_menu a.about {width:104px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_about_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.about:hover {width:104px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_about_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.service {width:141px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_service_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.service:hover {width:141px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_service_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.privacy {width:150px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_privacy_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.privacy:hover {width:150px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_privacy_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.nospam {width:160px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_nospam_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.nospam:hover {width:160px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_nospam_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.notice {width:106px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_notice_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.notice:hover {width:106px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_notice_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.qna {width:117px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_qna_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.qna:hover {width:117px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_qna_on.gif') repeat-x;}
.skin_bottom_default .service_menu a.faq {width:130px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_faq_off.gif') repeat-x;}
.skin_bottom_default .service_menu a.faq:hover {width:130px; background:url('<?=$dmshop_bottom_path?>/img/service_menu_faq_on.gif') repeat-x;}

.skin_bottom_default .bottom_banner a {text-decoration:none; display:block; height:70px;}
.skin_bottom_default .bottom_banner a.banner01 {width:176px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner01_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner01:hover {width:176px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner01_on.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner02 {width:162px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner02_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner02:hover {width:162px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner02_on.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner03 {width:136px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner03_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner03:hover {width:136px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner03_on.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner04 {width:162px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner04_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner04:hover {width:162px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner04_on.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner05 {width:151px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner05_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner05:hover {width:151px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner05_on.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner06 {width:158px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner06_off.gif') repeat-x;}
.skin_bottom_default .bottom_banner a.banner06:hover {width:158px; background:url('<?=$dmshop_bottom_path?>/img/bottorm_banner06_on.gif') repeat-x;}

.skin_bottom_default .copyright .text {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.skin_bottom_default .copyright .line {line-height:11px; font-size:11px; color:#d0d0d0; font-family:dotum,돋움;}
.skin_bottom_default .copyright .info {line-height:14px; font-size:11px; color:#565656; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_bottom_default">
<tr height="40" bgcolor="#ffffff">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="service_menu auto">
<tr>
    <td><a href="<?=$shop['url']?>/page.php?page_id=about" class="about"></a></td>
    <td><a href="<?=$shop['url']?>/page.php?page_id=service" class="service"></a></td>
    <td><a href="<?=$shop['url']?>/page.php?page_id=privacy" class="privacy"></a></td>
    <td><a href="<?=$shop['url']?>/page.php?page_id=nospam" class="nospam"></a></td>
    <td><a href="<?=$shop['url']?>/board.php?bbs_id=notice" class="notice"></a></td>
    <td><a href="<?=$shop['url']?>/board.php?bbs_id=qna" class="qna"></a></td>
    <td><a href="<?=$shop['url']?>/board.php?bbs_id=faq" class="faq"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_bottom_default">
<tr bgcolor="#fafafa">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="bottom_banner auto">
<tr>
    <td><a href="http://www.dmshopkorea.com/" target="_blank" class="banner01"></a></td>
    <td><a href="http://www.koreacb.com/" target="_blank" class="banner02"></a></td>
    <td><a href="http://www.kcp.co.kr/alpa.escrow.info.do" target="_blank" class="banner03"></a></td>
    <td><a href="http://www.kcp.co.kr/payment.service.info.do" target="_blank" class="banner04"></a></td>
    <td><a href="http://www.taxsave.go.kr/" target="_blank" class="banner05"></a></td>
    <td><a href="http://www.ftc.go.kr/" target="_blank" class="banner06"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<?
// 직접만들기(하단)의 로고를 출력합니다.
$file = shop_design_file("bottom_logo");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_bottom_default">
<tr class="copyright">
<? if ($file['upload_file']) { ?>
    <td width="<?=(int)($file['upload_width'])?>" valign="top"><a href="<?=$shop['url']?>" onfocus="this.blur();"><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></a></td>
<? } ?>
    <td valign="bottom">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="text">회사명 : <?=$dmshop['company_name']?></span></td>
    <td width="4"></td>
    <td><span class="line">|</span></td>
    <td width="4"></td>
    <td><span class="text">사업자 등록번호 : <?=$dmshop['company_number1']?></span></td>
    <td width="4"></td>
    <td><span class="line">|</span></td>
    <td width="4"></td>
    <td><span class="text">통신판매업 신고번호 : <?=$dmshop['company_number2']?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="text">대표 : <?=$dmshop['ceo_name']?></span></td>
    <td width="2"></td>
    <td><a href="mailto:<?=$dmshop['ceo_email']?>"><img src="<?=$dmshop_bottom_path?>/img/email.gif" border="0"></a></td>
    <td width="4"></td>
    <td><span class="line">|</span></td>
    <td width="4"></td>
    <td><span class="text">개인정보관리 책임자 : <?=$dmshop['admin_name']?></span></td>
    <td width="2"></td>
    <td><a href="mailto:<?=$dmshop['admin_email']?>"><img src="<?=$dmshop_bottom_path?>/img/email.gif" border="0"></a></td>
    <td width="4"></td>
    <td><span class="line">|</span></td>
    <td width="4"></td>
    <td><span class="text">주소 : <?=$dmshop['addr1']?> <?=$dmshop['addr2']?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="text">대표전화 : <?=$dmshop['number1']?>-<?=$dmshop['number2']?>-<?=$dmshop['number3']?></span></td>
    <td width="4"></td>
    <td><span class="line">|</span></td>
    <td width="4"></td>
    <td><span class="text">팩스 : <?=$dmshop['fax1']?>-<?=$dmshop['fax2']?>-<?=$dmshop['fax3']?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="11"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="right">
<tr>
    <td><span class="info">Copyright ⓒ <b><?=$dmshop['company_name']?></b> Corp. All Rights Reserved. </span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>