<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.signin_box .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signin_box .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signin_box .line {line-height:40px; font-size:11px; color:#efefef; font-family:dotum,돋움;}

.signin_box .input {width:138px; height:21px; border:2px solid #c9c9c9; padding:0px 5px 0px 5px;}
.signin_box .input {font-weight:bold; line-height:21px; font-size:13px; color:#3a3a3a; font-family:gulim,굴림;}

.signin_box .id_save {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}

.signin_box .social {padding:10px 0 5px 0;}
.signin_box .social ul {font-size:0; text-align:center;}
.signin_box .social ul li {display:inline-block; vertical-align:top; margin-left:2px;}
.signin_box .social ul li:first-child {margin-left:0;}
.signin_box .social ul li.login-naver,
.signin_box .social ul li.login-kakao,
.signin_box .social ul li.login-facebook,
.signin_box .social ul li.login-twitter,
.signin_box .social ul li.login-google {width:60px; height:60px; background:url('<?=$dmshop_signin_path?>/img/social.png') no-repeat; cursor:pointer;}
.signin_box .social ul li.login-naver {background-position:0 0;}
.signin_box .social ul li.login-naver:hover {background-position:0 -60px;}
.signin_box .social ul li.login-kakao {background-position:-60px 0;}
.signin_box .social ul li.login-kakao:hover {background-position:-60px -60px;}
.signin_box .social ul li.login-facebook {background-position:-120px 0;}
.signin_box .social ul li.login-facebook:hover {background-position:-120px -60px;}
.signin_box .social ul li.login-twitter {background-position:-180px 0;}
.signin_box .social ul li.login-twitter:hover {background-position:-180px -60px;}
.signin_box .social ul li.login-google {background-position:-240px 0;}
.signin_box .social ul li.login-google:hover {background-position:-240px -60px;}
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

function signinFocusIn(i)
{

    (i).style.border = "2px solid #027d94";
    (i).style.padding = "0px 5px 0px 5px";

}

function signinFocusOut(i)
{

    (i).style.border = "2px solid #c9c9c9";
    (i).style.padding = "0px 5px 0px 5px";

}

function signinSubmit()
{

    var f = document.formSignin;

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
</script>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signin_box">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_signin_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/signin.php' class='off'>로그인</a></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="55">
    <td><img src="<?=$dmshop_signin_path?>/img/message1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signin_box">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff; padding:40px 0 40px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<form method="post" name="formSignin" action="<?=$shop['https_url']?>/signin_update.php" onSubmit="return signinSubmit();" autocomplete="off">
<input type="hidden" name="url" value="<?=text($url)?>" />
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="25">
    <td align="right"><img src="<?=$dmshop_signin_path?>/img/id.gif"></td>
    <td width="10"></td>
    <td><input type="text" name="user_id" value="<?=text($user_id_save)?>" onfocus="signinFocusIn(this);" onblur="signinFocusOut(this);" class="input" /></td>
</tr>
<tr><td colspan="3" height="5"></td></tr>
<tr height="25">
    <td align="right"><img src="<?=$dmshop_signin_path?>/img/pw.gif"></td>
    <td width="10"></td>
    <td><input type="password" name="user_pw" onfocus="signinFocusIn(this);" onblur="signinFocusOut(this);" class="input" /></td>
</tr>
</table>
    </td>
    <td width="5"></td>
    <td valign="top"><input type="image" src="<?=$dmshop_signin_path?>/img/login.gif" border="0" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="40">
    <td><a href="<?=$shop['https_url']?>/find_id.php"><img src="<?=$dmshop_signin_path?>/img/find_id.gif" border="0"></a></td>
    <td width="30" class="line" align="center">|</td>
    <td><a href="<?=$shop['https_url']?>/find_pw.php"><img src="<?=$dmshop_signin_path?>/img/find_pw.gif" border="0"></a></td>
    <td width="25"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="user_id_save" value="1" class="checkbox" <?=$user_id_save_checked?> /></td>
    <td width="3"></td>
    <td><span class="id_save">ID저장</span></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

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

<script type="text/javascript">
var f = document.formSignin;
f.user_id.focus();
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signin_path?>/img/signup_message.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="<?=$shop['https_url']?>/signup.php"><img src="<?=$dmshop_signin_path?>/img/signup.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="30"></td>
    <td><?=shop_banner_skin("signin", "cols", "signin", "", "1", "1", "", "", "rand()"); /* 레이어ID, 스킨명, 배너그룹ID, 배너ID, 가로갯수, 새로갯수, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>