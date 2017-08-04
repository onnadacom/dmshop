<?
if (!defined('_DMSHOP_')) exit;

$loginbox_user_id = "아이디";
$loginbox_user_pw = "비밀번호";
?>
<style type="text/css">
/* 로그인 */
.skin_loginbox_default .input {width:98px; height:19px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.skin_loginbox_default .input {line-height:19px; font-size:12px; color:#848689; font-family:gulim,굴림;}
.skin_loginbox_default .title {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.skin_loginbox_default .id {background:url('<?=$dmshop_loginbox_path?>/img/id.gif') no-repeat; background-color:#ffffff;}
.skin_loginbox_default .pw {background:url('<?=$dmshop_loginbox_path?>/img/pw.gif') no-repeat; background-color:#ffffff;}

.skin_loginbox_default .signup {font-weight:bold; line-height:14px; font-size:11px; color:#555555; font-family:dotum,돋움;}
.skin_loginbox_default .find {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .line {padding:0 4px; line-height:14px; font-size:11px; color:#cccccc; font-family:dotum,돋움;}

.skin_loginbox_default .social {padding-bottom:5px;}
.skin_loginbox_default .social ul {font-size:0; text-align:center;}
.skin_loginbox_default .social ul li {display:inline-block; vertical-align:top; margin-left:2px;}
.skin_loginbox_default .social ul li:first-child {margin-left:0;}
.skin_loginbox_default .social ul li.login-naver,
.skin_loginbox_default .social ul li.login-kakao,
.skin_loginbox_default .social ul li.login-facebook,
.skin_loginbox_default .social ul li.login-twitter,
.skin_loginbox_default .social ul li.login-google {width:30px; height:30px; background:url('<?=$dmshop_loginbox_path?>/img/social.png') no-repeat; background-size:150px 60px; cursor:pointer;}
.skin_loginbox_default .social ul li.login-naver {background-position:0 0;}
.skin_loginbox_default .social ul li.login-naver:hover {background-position:0 -30px;}
.skin_loginbox_default .social ul li.login-kakao {background-position:-30px 0;}
.skin_loginbox_default .social ul li.login-kakao:hover {background-position:-30px -30px;}
.skin_loginbox_default .social ul li.login-facebook {background-position:-60px 0;}
.skin_loginbox_default .social ul li.login-facebook:hover {background-position:-60px -30px;}
.skin_loginbox_default .social ul li.login-twitter {background-position:-90px 0;}
.skin_loginbox_default .social ul li.login-twitter:hover {background-position:-90px -30px;}
.skin_loginbox_default .social ul li.login-google {background-position:-120px 0;}
.skin_loginbox_default .social ul li.login-google:hover {background-position:-120px -30px;}
</style>
<script type="text/javascript">
$(document).ready( function() {

    // 소셜로그인
    $('.login-naver').click(function() {

        naverLogin();

    });

    $('.login-kakao').click(function() {

        kakaoLogin();

    });

    $('.login-facebook').click(function() {

        facebookLogin();

    });

    $('.login-twitter').click(function() {

        twitterLogin();

    });

    $('.login-google').click(function() {

        googleLogin();

    });

});

function loginboxFocusIn(i)
{

    (i).style.border = "1px solid #027d94";
    (i).style.padding = "1px 3px 0px 3px";

}

function loginboxFocusOut(i)
{

    (i).style.border = "1px solid #cccccc";
    (i).style.padding = "1px 3px 0px 3px";

}

function leftLogin()
{

    var f = document.formLeftLogin;

    if (f.user_id.value == '<?=$loginbox_user_id?>') {

        f.user_id.value = "";

    }

    if (f.user_pw.value == '<?=$loginbox_user_pw?>') {

        f.user_pw.value = "";

    }

    if (!f.user_id.value) {

        alert("아이디를 입력하십시오."); 
        f.user_id.focus();
        return false;

    }

    if (!f.user_pw.value) {

        alert("비밀번호를 입력하십시오."); 
        f.user_pw.focus();
        return false;

    }

}

function leftLoginFocus(mode, name)
{

    var f = document.formLeftLogin;

    if (mode == 'in') {

        if (name == 'user_id') {

            f.user_id.className = "input";

        }

        if (name == 'user_pw') {

            f.user_pw.className = "input";

        }

    } else {

        if (name == 'user_id' && f.user_id.value == '') {

            f.user_id.className = "input id";

        }

        if (name == 'user_pw' && f.user_pw.value == '') {

            f.user_pw.className = "input pw";

        }

    }

}

function leftLoginLoad()
{

    var f = document.formLeftLogin;

    f.user_id.className = "input";
    f.user_id.value = "<?=$user_id_save?>";
    f.user_pw.value = "";

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_loginbox_default">
<tr>
    <td>
<div style="border:1px solid #cccccc;">
<form method="post" name="formLeftLogin" action="<?=$shop['https_url']?>/signin_update.php" onSubmit="return leftLogin('');" autocomplete="off">
<input type="hidden" name="url" value="<?=text($urlencode)?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="1" bgcolor="#ffffff"></td>
    <td bgcolor="#f4f4f4">
<div style="padding:9px 14px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="22">
    <td><input type="text" name="user_id" value="" onfocus="loginboxFocusIn(this); leftLoginFocus('in', 'user_id');" onblur="loginboxFocusOut(this); leftLoginFocus('out', 'user_id');" class="input id" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="3"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="password" name="user_pw" value="" onfocus="loginboxFocusIn(this); leftLoginFocus('in', 'user_pw');" onblur="loginboxFocusOut(this); leftLoginFocus('out', 'user_pw');" class="input pw" /></td>
</tr>
</table>
    </td>
    <td width="5"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="22">
    <td><input type="checkbox" name="user_id_save" value="1" class="checkbox" <?=$user_id_save_checked?> /></td>
    <td width="3"></td>
    <td><span class="title">ID저장</span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="3"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="image" src="<?=$dmshop_loginbox_path?>/img/login.gif" border="0"></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>

<div class="social">
<ul>
<? if ($dmshop['login_naver_id']) { ?>
<li class="login-naver" title="네이버"></li>
<? } ?>
<? if ($dmshop['login_kakao_key']) { ?>
<li class="login-kakao" title="카카오톡"></li>
<? } ?>
<? if ($dmshop['login_facebook_id']) { ?>
<li class="login-facebook" title="페이스북"></li>
<? } ?>
<? if ($dmshop['login_twitter_key']) { ?>
<li class="login-twitter" title="트위터"></li>
<? } ?>
<? if ($dmshop['login_google_id']) { ?>
<li class="login-google" title="구글"></li>
<? } ?>
</ul>
</div>
    </td>
    <td width="1" bgcolor="#eaeaea"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eaeaea" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="1" bgcolor="#ffffff"></td>
    <td bgcolor="#f4f4f4">
<div style="padding:6px 14px 4px 14px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['https_url']?>/signup.php" class="signup">회원가입</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/find_id.php" class="find">아이디</a></td>
    <td><p class="find">/</p></td>
    <td><a href="<?=$shop['https_url']?>/find_pw.php" class="find">비밀번호 찾기</a></td>
</tr>
</table>
</div>
    </td>
    <td width="1" bgcolor="#eaeaea"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eaeaea" class="none">&nbsp;</td></tr>
</table>
</form>
</div>
    </td>
</tr>
</table>

<script type="text/javascript">
setTimeout("leftLoginLoad();", 100);
</script>