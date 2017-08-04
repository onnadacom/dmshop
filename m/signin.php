<?php
include_once("./_dmshop.php");

// 로그인
if ($shop_user_login) {

    shop_url("$shop[mobile_url]");

}

// 아이디 자동저장
$user_id_save = "";
$user_id_save = shop_get_cookie("user_id_save");

if ($user_id_save) {

    $user_id_save = filter1($user_id_save);
    $user_id_save_checked = "checked";

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 로그인";
include_once("./_top.php");
?>
<style type="text/css">
.conts .main {padding:5px 10px 10px 10px;}
.conts .main .text {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

.conts .main .input {width:110px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.conts .main .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.conts .main .step {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.conts .main .help {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

.conts .social {padding:10px 0 5px 0;}
.conts .social ul {font-size:0;}
.conts .social ul li {display:inline-block; vertical-align:top; margin-left:2px;}
.conts .social ul li:first-child {margin-left:0;}
.conts .social ul li.login-naver,
.conts .social ul li.login-kakao,
.conts .social ul li.login-facebook,
.conts .social ul li.login-twitter,
.conts .social ul li.login-google {width:30px; height:30px; background:url('<?=$shop['mobile_url']?>/img/social.png') no-repeat; background-size:150px 60px; cursor:pointer;}
.conts .social ul li.login-naver {background-position:0 0;}
.conts .social ul li.login-naver:hover {background-position:0 -30px;}
.conts .social ul li.login-kakao {background-position:-30px 0;}
.conts .social ul li.login-kakao:hover {background-position:-30px -30px;}
.conts .social ul li.login-facebook {background-position:-60px 0;}
.conts .social ul li.login-facebook:hover {background-position:-60px -30px;}
.conts .social ul li.login-twitter {background-position:-90px 0;}
.conts .social ul li.login-twitter:hover {background-position:-90px -30px;}
.conts .social ul li.login-google {background-position:-120px 0;}
.conts .social ul li.login-google:hover {background-position:-120px -30px;}
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

    $("#user_id").focus();

});

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
<form method="post" name="formSignin" action="<?=$shop['url']?>/signin_update.php" onSubmit="return signinSubmit();" autocomplete="off">
<input type="hidden" name="url" value="<?=text($url)?>" />
<div style="border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">로그인</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">아이디</td>
    <td><input type="text" id="user_id" name="user_id" value="<?=text($user_id_save)?>" class="input" /></td>
</tr>
<tr>
    <td width="80">패스워드</td>
    <td><input type="password" name="user_pw" class="input" /></td>
</tr>
</table>
    </td>
    <td width="5"></td>
    <td valign="top"><input type="image" src="<?=$shop['mobile_url']?>/img/login.gif" border="0" style="margin-top:4px;" /></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80"></td>
    <td><input type="checkbox" name="user_id_save" value="1" class="checkbox" <?=$user_id_save_checked?> /></td>
    <td width="3"></td>
    <td><span class="id_save">ID저장</span></td>
</tr>
</table>

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
</div>
</div>
</form>
<?
include_once("./_bottom.php");
?>