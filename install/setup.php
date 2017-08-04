<?php
// 이미 생성
if (file_exists("../shop.database.php")) {

    echo "<script type='text/javascript'>location.replace('not.php');</script>";
    exit;

}

$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

if (!$_POST['assent']) {

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script type='text/javascript'>alert('이용약관에 동의하지 않으셨습니다.'); history.go(-1);</script>";
    exit;

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>디엠샵 설치 - 정보입력</title>
<link rel="stylesheet" href="../css/default.css" type="text/css" />
<style type="text/css">
body {width:100%; height:100%; background:url('./img/bg.gif') repeat 0 36px;}
.nav_bg {width:100%; height:36px; background:url('./img/nav_bg.gif') repeat-x;}
.contents {width:100%; padding:70px 0;}

.box_top {margin:0 auto; width:1000px; height:114px; background:url('./img/box_top.png') no-repeat;}
.box_middle {margin:0 auto; background-color:#ffffff; width:900px; height:620px; padding:0 48px 0px 48px; border-left:2px solid #2b97a4; border-right:2px solid #2b97a4; border-bottom:2px solid #2b97a4;}
.box_bottom {width:100%; height:80px; background:url('./img/box_bottom.png') no-repeat center top;}
.copyright {margin:0 auto; width:335px; height:73px; background:url('./img/copyright.gif') no-repeat;}

.step {width:330px; margin:0 auto;}

.maintitle {clear:both;}
.maintitle ul:after {display:block; clear:both; content:'';}
.maintitle ul {clear:both;}
.maintitle ul li {float:left;}
.maintitle ul li .title {margin-top:1px; font-weight:bold; line-height:28px; font-size:14px; color:#000000; font-family:gulim,굴림;}
.maintitle ul li .sub {line-height:13px; font-size:11px; color:#959595; font-family:gulim,굴림;}
.maintitle ul li p {padding:0px; margin:0px;}

.boxtitle {width:100%; height:40px; background:url('./img/box_title_bg.gif') repeat-x;}
.boxtitle {text-align:center; font-weight:bold; line-height:40px; font-size:14px; color:#000000; font-family:gulim,굴림;}
.title {font-weight:bold; line-height:40px; font-size:13px; color:#1a1a13; font-family:gulim,굴림;}
.text {text-align:center; line-height:40px; font-size:12px; color:#959595; font-family:gulim,굴림;}

.input {background-color:#ffffff; width:222px; height:22px; border:1px solid #c2c2c2; padding:0px 3px 0px 3px;}
.input {font-weight:bold; line-height:22px; font-size:13px; color:#1a1a13; font-family:gulim,굴림;}

.input1 {background:url('./img/input.gif') no-repeat 0 0;}
.input2 {background:url('./img/input.gif') no-repeat 0 -23px;}
.input3 {background:url('./img/input.gif') no-repeat 0 -46px;}
.input4 {background:url('./img/input.gif') no-repeat 0 -69px;}
.input5 {background:url('./img/input.gif') no-repeat 0 -92px;}

.message {padding:38px 0 30px 0; text-align:center; font-weight:bold; line-height:21px; font-size:13px; color:#959595; font-family:gulim,굴림;}
.message a {font-weight:bold; line-height:21px; font-size:13px; color:#1ea0b1; font-family:gulim,굴림;}

.btn {width:100%; padding-top:30px; border-top:1px solid #d7d7d7;}
</style>
</head>
<body>
<script type="text/javascript">
function installSubmit()
{

    var f = document.formInstall;

    if (f.mysql_host.value == '') {

        alert("MYSQL_HOST NAME을 입력하세요."); 
        f.mysql_host.focus();
        return false;

    }

    if (f.mysql_user.value == '') {

        alert("MYSQL_USER ID를 입력하세요."); 
        f.mysql_user.focus();
        return false;

    }

    if (f.mysql_password.value == '') {

        alert("MYSQL_PASSWORD를 입력하세요."); 
        f.mysql_password.focus();
        return false;

    }

    if (f.mysql_db.value == '') {

        alert("MYSQL_DB NAME을 입력하세요."); 
        f.mysql_db.focus();
        return false;

    }

    if (f.user_pw.value == '') {

        alert("관리자 비밀번호를 입력하세요."); 
        f.user_pw.focus();
        return false;

    }

    if (f.user_pw_re.value == '') {

        alert("관리자 비밀번호 재입력을 입력하세요."); 
        f.user_pw_re.focus();
        return false;

    }

    if (f.user_pw.value != f.user_pw_re.value) {

        alert("관리자 비밀번호와 재입력 비밀번호가 일치하지 않습니다."); 
        f.user_pw.focus();
        return false;

    }

    return true;

}

function installFocusIn(i)
{

    (i).style.border = "1px solid #0295a7";
    (i).style.padding = "0px 3px 0px 3px";

}

function installFocusOut(i)
{

    (i).style.border = "1px solid #c2c2c2";
    (i).style.padding = "0px 3px 0px 3px";

}

function inputFocus(mode, name)
{

    var f = document.formInstall;

    if (mode == 'in') {

        if (name == 'mysql_user') {

            f.mysql_user.className = "input";

        }

        if (name == 'mysql_password') {

            f.mysql_password.className = "input";

        }

        if (name == 'mysql_db') {

            f.mysql_db.className = "input";

        }

        if (name == 'user_pw') {

            f.user_pw.className = "input";

        }

        if (name == 'user_pw_re') {

            f.user_pw_re.className = "input";

        }

    } else {

        if (name == 'mysql_user' && f.mysql_user.value == '') {

            f.mysql_user.className = "input input1";

        }

        if (name == 'mysql_password' && f.mysql_password.value == '') {

            f.mysql_password.className = "input input2";

        }

        if (name == 'mysql_db' && f.mysql_db.value == '') {

            f.mysql_db.className = "input input3";

        }

        if (name == 'user_pw' && f.user_pw.value == '') {

            f.user_pw.className = "input input4";

        }

        if (name == 'user_pw_re' && f.user_pw_re.value == '') {

            f.user_pw_re.className = "input input5";

        }

    }

}
</script>
<div class="nav_bg"><a href="http://dmshopkorea.com" target="_blank"><img src="./img/logo.gif" border="0"></a></div>
<form method="post" name="formInstall" action="update.php" onsubmit="return installSubmit();" autocomplete="off">
<input type="hidden" name="assent" value="1" />
<div class="contents">
<div class="box_top"></div>
<div class="box_middle">
<div class="step"><img src="./img/step2.gif"></div>
<div class="maintitle">
<ul>
<li class="num"><img src="./img/num2.gif"></li>
<li class="num"><p class="title">DM샵 설치를 위하여 데이터베이스 정보와, 사용하실 쇼핑몰 관리자 정보를 입력 하세요.</p><p class="sub">데이터베이스(DB) 정보를 잘 모르실 경우, 이용중이신 서버 또는 웹호스팅 업체에 마이페이지를 참고하거나, 직접 문의하시기 바랍니다.</p></li>
</ul>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td width="435">
<div style="border:1px solid #d7d7d7; background-color:#fcfcfc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td class="boxtitle">::: 데이터베이스 정보 :::</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="18"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title"><font color="#959595">MYSQL_</font>HOST NAME</td>
    <td><input type="text" name="mysql_host" value="localhost" onfocus="installFocusIn(this);" onblur="installFocusOut(this);" class="input" /></td>
</tr>
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title"><font color="#959595">MYSQL_</font>USER ID</td>
    <td><input type="text" name="mysql_user" value="" onfocus="installFocusIn(this); inputFocus('in', 'mysql_user');" onblur="installFocusOut(this); inputFocus('out', 'mysql_user');" class="input input1" /></td>
</tr>
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title"><font color="#959595">MYSQL_</font>PASSWORD</td>
    <td><input type="password" name="mysql_password" value="" onfocus="installFocusIn(this); inputFocus('in', 'mysql_password');" onblur="installFocusOut(this); inputFocus('out', 'mysql_password');" class="input input2" /></td>
</tr>
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title"><font color="#959595">MYSQL_</font>DB NAME</td>
    <td><input type="text" name="mysql_db" value="" onfocus="installFocusIn(this); inputFocus('in', 'mysql_db');" onblur="installFocusOut(this); inputFocus('out', 'mysql_db');" class="input input3" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="17"><td></td></tr>
</table>
</div>
    </td>
    <td width="30"></td>
    <td width="435">
<div style="border:1px solid #d7d7d7; background-color:#fcfcfc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td class="boxtitle">::: 쇼핑몰 관리자 정보 :::</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="18"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title">관리자 아이디</td>
    <td><input type="text" name="user_id" value="admin" readonly onfocus="installFocusIn(this);" onblur="installFocusOut(this);" class="input" style="background-color:#e1e1e1;" /></td>
</tr>
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title">관리자 비밀번호</td>
    <td><input type="password" name="user_pw" value="" onfocus="installFocusIn(this); inputFocus('in', 'user_pw');" onblur="installFocusOut(this); inputFocus('out', 'user_pw');" class="input input4" /></td>
</tr>
<tr height="40">
    <td width="20"></td>
    <td width="160" class="title">관리자 비밀번호 재입력</td>
    <td><input type="password" name="user_pw_re" value="" onfocus="installFocusIn(this); inputFocus('in', 'user_pw_re');" onblur="installFocusOut(this); inputFocus('out', 'user_pw_re');" class="input input5" /></td>
</tr>
<tr height="40">
    <td colspan="3" class="text">관리자 로그인시 이용하실 임의의 비밀번호를 2회 입력 합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="17"><td></td></tr>
</table>
</div>
    </td>
</tr>
</table>

<div class="message">데이터베이스 정보를 정확히 입력하였으나 설치가 정상적으로<br>진행되지 않을 경우, <a href="http://dmshopkorea.com" target="_blank">DMSHOPKOREA.COM</a> 에 문의하시기 바랍니다.</div>

<div class="btn">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50%"><a href="#" onclick="history.go(-1); return false;"><img src="./img/btn_prev.gif" border="0"></a></td>
    <td width="50%" align="right"><input type="image" src="./img/btn_setup.gif" border="0" /></td>
</tr>
</table>
</div>
</div>
<div class="box_bottom"></div>
<div class="copyright"></div>
</div>
</form>
</body>
</html>