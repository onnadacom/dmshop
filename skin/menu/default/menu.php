<?
if (!defined('_DMSHOP_')) exit;
?>

<?=shop_loginbox_skin("default"); /* 로그인박스 */ ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr> 
</table>

<?=shop_hmbar_skin("default"); /* 세로메뉴바 */ ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr> 
</table>

<?=shop_planbox_skin("default"); /* 기획전목록 */ ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr> 
</table>

<?=shop_boardbox_skin("talk_review"); /* 게시판목록 */ ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr> 
</table>

<!-- bank start //-->
<script type="text/javascript">
$(document).ready( function() { $(".banking select").selectBox(); });

var bankGo = function(url) {

    if (url == '') {
        return false;
    }

    window.open(url);

};
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_menu_path?>/img/bank_title.gif"></td>
</tr>
</table>

<style type="text/css">
.banking .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.banking .selectBox-dropdown {width:76%; height:19px;}
.banking .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<div style="border:1px solid #e4e4e4; background-color:#fcfcfc; padding:20px 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><img src="<?=$dmshop_menu_path?>/img/bank_code.gif"></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="3"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="banking">
<tr>
    <td>
<div style="padding:5px 0 5px 5px; background-color:#e4e4e4;">
<select id="bankgo" name="bankgo" class="select" onchange="bankGo(this.value);">
    <option value="">은행을 선택하세요.</option>
    <option value="http://www.kbstar.com/">KB국민은행</option>
    <option value="http://www.hanabank.com/">하나은행</option>
    <option value="http://www.nonghyup.com/">농협</option>
    <option value="http://www.wooribank.com/">우리은행</option>
    <option value="http://www.keb.co.kr/">외환은행</option>
    <option value="http://www.kfcc.co.kr/">새마을금고</option>
    <option value="http://www.shinhan.com/">신한은행</option>
    <option value="http://www.scfirstbank.com/">SC제일은행</option>
    <option value="http://www.epostbank.go.kr/">우체국</option>
    <option value="http://www.ibk.co.kr/">기업은행</option>
    <option value="http://www.citibank.co.kr/">씨티은행</option>
    <option value="http://www.kdb.co.kr/">산업은행</option>
</select>
</div>
    </td>
</tr>
</table>
<!-- bank end //-->