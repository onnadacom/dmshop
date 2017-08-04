<?
$shop_path = "..";
include_once("$shop_path/shop.common.php");

if (!$shop_user_login) {

    // 회원 세션 생성
    shop_set_session('ss_user_id', 'admin');

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>디엠샵 설치 - 설치완료</title>
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

.title {font-weight:bold; line-height:30px; font-size:13px; color:#1a1a13; font-family:gulim,굴림;}
.text {text-align:right; line-height:30px; font-size:11px; color:#959595; font-family:gulim,굴림;}

.message {padding:30px 0 29px 0; text-align:center; font-weight:bold; line-height:21px; font-size:13px; color:#959595; font-family:gulim,굴림;}
.message span {font-weight:bold; line-height:21px; font-size:13px; color:#1ea0b1; font-family:gulim,굴림;}

.btn {width:100%; padding-top:30px; border-top:1px solid #d7d7d7;}
</style>
</head>
<body>
<div class="nav_bg"><a href="http://dmshopkorea.com" target="_blank"><img src="./img/logo.gif" border="0"></a></div>
<form method="post" name="formInstall" action="update.php" onsubmit="return installSubmit();" autocomplete="off">
<input type="hidden" name="assent" value="1" />
<div class="contents">
<div class="box_top"></div>
<div class="box_middle">
<div class="step"><img src="./img/step3.gif"></div>
<div class="maintitle">
<ul>
<li class="num"><img src="./img/num3.gif"></li>
<li class="num"><p class="title">수고하셨습니다. DM샵의 기본 설치가 완료되었습니다.</p><p class="sub">관리자 모드 이동 후, 아래의 순서를 참고하시어 쇼핑몰 운영에 필요한 정보를 입력/설정 하시기 바랍니다.</p></li>
</ul>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td width="435">
<div style="border:1px solid #d7d7d7; background-color:#fcfcfc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="12"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">1. 기본 환경설정</td>
    <td class="text">기업/쇼핑몰 정보, 운영정책, 정품인증</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">2. 회원가입 양식</td>
    <td class="text">쇼핑몰 가입을 위한 회원가입폼 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">3. 서비스 이용약관</td>
    <td class="text">표준약관을 자신에 맞게 수정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">4. 개인정보 취급방침</td>
    <td class="text">표준방침을 자신에 맞게 수정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">5. 상품배송 안내</td>
    <td class="text">표준 배송 안내문을 자신에 맞게 수정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">6. 환불규정 안내</td>
    <td class="text">표준 교환/환불 안내문을 자신에 맞게 수정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">7. 상품분류 생성관리</td>
    <td class="text">쇼핑몰 카테고리(메뉴) 등록</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">8. 상품 등록</td>
    <td class="text">판매하실 상품 등록</td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="12"><td></td></tr>
</table>
</div>
    </td>
    <td width="30"></td>
    <td width="435">
<div style="border:1px solid #d7d7d7; background-color:#fcfcfc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="12"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">9. 전자결제(PG) 연동</td>
    <td class="text">전자결제(PG)사 가입 및 결제조건 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">10. 문자(SMS) 연동</td>
    <td class="text">문자(SMS)사 가입 및 발송정보 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">11. 배송·택배 연동</td>
    <td class="text">주 이용 택배사 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">12. 메인 디자인 설정</td>
    <td class="text">쇼핑몰 메인 페이지의 레이아웃 및 스킨 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">13. 서브 디자인 설정</td>
    <td class="text">쇼핑몰 서브 페이지의 레이아웃 및 스킨 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">14. 상품 페이지 설정</td>
    <td class="text">상품페이지의 레이아웃 및 출력물 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">15. 기타 폰트 설정</td>
    <td class="text">폰트 유형, 색상, 크기 설정</td>
    <td width="20"></td>
</tr>
<tr height="30">
    <td width="20"></td>
    <td width="160" class="title">16. 기타 스킨 설정</td>
    <td class="text">기타 페이지 및 부분 스킨 설정</td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr height="12"><td></td></tr>
</table>
</div>
    </td>
</tr>
</table>

<div class="message">위 메뉴는 설치된 DM샵의 관리자 모드 > 관리홈 > <span>바로가기 메뉴</span> 에<br />등록되어 있으므로 차근차근 순서대로 진행하시면 됩니다.</div>

<div class="btn">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="right"><a href="../adm/"><img src="./img/btn_admin.gif" border="0"></a></td>
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