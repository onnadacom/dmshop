<?php
// 이미 생성
if (file_exists("../shop.database.php")) {

    //echo "<script type='text/javascript'>location.replace('not.php');</script>";
    //exit;

}

// 검사
if (!is_writable("..")) {

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script type='text/javascript'>alert('상위 디렉토리의 퍼미션을 읽기, 쓰기, 실행가능한 707으로 변경하여 주시기 바랍니다.');</script>";
    exit;

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>디엠샵 설치 - 약관동의</title>
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

.tex {clear:both; margin:10px auto 0 auto; width:898px; height:360px; border:1px solid #e5e5e5; overflow:auto; overflow-x:hidden; position:relative;}
.tex div {padding:10px 10px 10px 10px; line-height:24px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.assent {margin:30px auto 0 auto; width:195px;}
</style>
</head>
<body>
<script type="text/javascript">
function installSubmit()
{

    return true;

}
</script>
<div class="nav_bg"><a href="http://dmshopkorea.com" target="_blank"><img src="./img/logo.gif" border="0"></a></div>
<form method="post" name="formInstall" action="setup.php" onsubmit="return installSubmit();" autocomplete="off">
<input type="hidden" name="assent" value="1" />
<div class="contents">
<div class="box_top"></div>
<div class="box_middle">
<div class="step"><img src="./img/step1.gif"></div>
<div class="maintitle">
<ul>
<li class="num"><img src="./img/num1.gif"></li>
<li class="num"><p class="title">DM샵을 이용하시려면 반드시 아래의 이용약관에 동의하셔야 합니다.</p><p class="sub">아래의 모든 이용약관을 읽으시고, 이에 모두 동의하시는 분들만 DM샵을 이용하실 수 있습니다.</p></li>
</ul>
</div>
<div class="tex">

    <div>
<!-- 이용약관 //-->
제 1조 목적<br><br>본 이용약관은 독립형 쇼핑몰 솔루션 디엠샵을 무상 제공하는 디엠샵코리아(이하 “회사”)와 본 솔루션을 운영하는 쇼핑몰 사용자(이하 “사용자”) 간에 솔루션 이용에 관한 권리와 의무, 책임 및 기타 제반 사항을 규정하는 것을 목적으로 합니다.<br><br>제2조 용어의 정의<br><br>① 솔루션 : 본 약관상의 솔루션이란, 전자상거래 및 홈페이지 구축을 위해 무상 제공되는 디엠샵을 말하며 이에 제반 되는 주문·배송, 상품·메뉴, 고객지원, 프로모션, 기타기능, 통계분석, 디자인, 환경설정, 부가서비스 등의 기능과 그에 따른 모든 소스코드와 디자인을 포함 합니다.<br>② 공식 사이트 : 솔루션 디엠샵의 다운로드 및 정품인증, 고객지원 서비스를 제공하는 배포 사이트인 디엠샵 코리아(www.dmshopkorea.com)를 말합니다.<br>③ 이용권리 : 회원가입, 시리얼 발급 등(4조 2항 참고)을 통해 회사로부터 사용자가 부여 받는 솔루션의 사용 권리를 말하며, 이는 소유권, 저작권과는 무관합니다.<br>④ 시리얼 번호: 이용약관의 동의 및 사용자 정보 등록 후, 사용자에게 부여되는 일련번호로서 이를 통해 정식 사용자를 식별하는 용도로 사용됩니다.<br><br>제3조 (솔루션의 저작권)<br><br>① 본 솔루션의 소유권 및 저작권은 개발사에 있으며, 소유권은 타인에게 제공되지 않습니다.<br>② 솔루션의 저작권은 한국저작권위원회(등록번호 : C-2012-003399)로부터 보호받고 있으며, 대한민국과 국제적인 저작권법, 조약, 저작권 협정으로 부터 보호받고 있습니다.<br>③ 솔루션에 포함된 일부, 공개 소스코드와 플러그인의 저작권은 해당 소스코드 제작자에게 있습니다.<br>④ 별도로 제공되는 모든 스킨(템플릿), 플러그인, 디자인 등의 저작권은 본 이용약관과는 무관한 개별적인 저작권과 약관을 따르며, 그에 맞게 사용하시기 바랍니다.<br><br>제4조 (사용 권리와 이용범위)<br><br>① 본 솔루션은 본 이용약관에 따른 독자적인 라이선스를 적용합니다.<br>② 개발사가 제공하는 솔루션의 사용 권리는 아래의 과정을 통해서만 제공되며, 이는 2조 4항에 의거 “정식 사용자”로 분류합니다.<br>&nbsp;&nbsp;&nbsp; 가. 공식 사이트의 “회원약관” 동의를 통한, 회원가입<br>&nbsp;&nbsp;&nbsp; 나. 디엠샵의 “이용약관” 동의를 통한, 다운로드<br>&nbsp;&nbsp;&nbsp; 다. 마이페이지 &gt; 시리얼 발급 메뉴를 통한 “사용자 정보 등록”<br>&nbsp;&nbsp;&nbsp; 라. 사용자 정보 등록 후 발급되는 “시리얼 번호”를 관리자 모드에 등록<br><br>제5조 (불법복제 및 무단배포 금지)<br><br>① 사용자는 개발사의 동의 없이 솔루션의 “사용 권리”를 제삼자에게 양도하거나 판매하실 수 없습니다.<br>② 제삼자에게 사용권리를 양도하고자 할 경우, 공식사이트를 통하여 사전 발급된 자신의 인증서를 폐기하고, 제삼자의 인증서를 신규 등록함으로써 권리를 양도할 수 있습니다.<br>③ 사용자는 개발사의 솔루션을 인터넷을 통해 직접 배포할 수 없습니다.<br>④ 개작 또는 변경을 통하여 2차 저작물을 만들었을 경우에도 회사의 저작물이 포함될 경우, 이를 배포하거나 저작권을 취득하실 수 없습니다.<br>⑤ 독자적인 기능 개선 및 추가기능을 직접 개발하여 배포할 경우, 자신이 개발한 범위에 한하여 개별적인 이용약관을 명시할 수 있습니다.<br>⑥ 개발사는 솔루션 내, “보안 및 정식/불법 사용자 구분”을 위해 별도의 암호화된 파일을 제공합니다. 위 사유로 제공되는 암호화 파일을 제거 또는 변조하거나, 이를 무력화 하는 별도의 파일을 개발하여 이용 및 배포 시에는 저작권 침해 행위로 간주합니다.<br>⑦ 위에 명시된 조항에 동의하지 않거나, 위배되는 사용자는 본 솔루션을 이용하실 수 없습니다. 본 이용약관을 무시하고 무단 사용 시, 컴퓨터프로그램 보호법 46조의 벌칙 규정에 따라 법적인 책임과 손해 배상이 따를 수 있습니다.<br><br>제6조 (솔루션의 변경 및 사용)<br><br>① 사용자는 솔루션을 자신의 용도에 맞추어 직접 또는 제삼자를 통하여 변경 하거나, 추가기능을 개발하여 탑재·이용하실 수 있습니다.<br>② 자신이 제작한 변경파일, 추가기능 등은 공식사이트를 통해 배포하실 수 있으며 개발사의 저작물이 포함되어 있지 않을 경우, 자신의 사이트를 통해서도 배포하실 수 있습니다.<br>③ 솔루션의 변경(customizing)작업으로 인한 피해 발생 시, 그 책임은 사용자 또는 변경작업을 수행한 제삼자에게 있으며, 원 개발사는 이에 일절 관여하지 않습니다.<br><br>제7조 (사용자 및 쇼핑몰의 정보수집)<br><br>① 개발사는 공식 사이트의 회원가입을 통해 사용자의 아이디, 비밀번호, 닉네임과 휴대폰, 이메일, 홈페이지 등의 정보를 수집합니다.<br>② 추가적으로 시리얼 번호의 발급 과정을 통하여 사용자의 사업자번호와 설치 도메인 정보를 수집합니다. 이는 개발사의 사용자 통계 및 사용자 간의 신뢰성 있는 서비스 제공을 목적으로 활용하며, 수집된 정보는 제삼자에게 제공하지 않습니다.<br><br>제8조 (회사의 고객지원 의무)<br><br>① 회사는 솔루션의 사용 권리를 무상 제공함에 있어 사용자에게 설치, 하자보수, 고객지원 등의 의무와 책임을 지지 않습니다.<br>② 사용자의 편의를 위하여, 공식 사이트를 통한 업데이트·패치·질문답변 등의 서비스를 무상 제공하나, 이는 개발사의 책임 및 의무사항이 아닙니다.<br>② 개발사는 사용자의 데이터베이스 및 프로그램으로 인한 오류 발생 시, 이에 책임지지 않습니다.<br>③ 사용자는 운영 중인 쇼핑몰(솔루션)에 가입한 회원의 정보를 보호할 의무가 있으며, 사용자의 실수 또는 해킹 등으로 인한 피해 발생 시, 그 책임은 사용자 본인에게 있습니다.<br><br>제9조 (면책조항)<br><br>① 회사는 천재지변, 전쟁 및 기타, 경영악화로 인한 사유 또는 이에 준하는 불가항력으로 인하여 서비스 종료 시 이에 대한 모든 책임이 면책됩니다.<br>② 회사는 사용자의 운영 부실, 소스파일 변형, 불법 복제물 설치 등과 관련하여 발생하는 모든 종류의 문제와 손해에 대한 책임을 지지 않습니다.<br>③ 회사는 사용자의 컴퓨터 또는 솔루션이 구동되는 서버의 오류 등으로 인한 장애와 발생 시, 이에 책임을 지지 않습니다.<br>④ 회사는 사용자의 솔루션 내 가입한 "회원"의 개인정보 및 기타정보의 유출 사고 발생 시, 어떠한 책임도 지지 않으며, 이에 개입하지 않습니다.<br>⑤ 회사는 사용자가 제삼자와 함께 솔루션을 사용하며 발생하는 모든 분쟁에 대해, 어떠한 책임도 지지 않으며, 이에 개입하지 않습니다.<br><br>제10조 (그 외 기타 사항)<br><br>① 본 이용약관에 명시되지 않은 사항에 대해서는 관계 법령 및 한국 소프트웨어 저작권 협회의 법령과 판례를 따릅니다.<br><br>제11조 (효력의 발생)<br><br>① 본 이용약관과 관련하여 발생하는 제반·분쟁사항에 대한 소송은 회사의 소재지관할 법원으로 합니다.<br><br>부칙 (시행일)<br><br>① 시행일 : 본 약관은 2012년 1월 2일부터 시행합니다.
<!-- 이용약관 //-->
    </div>

</div>
<div class="assent"><input type="image" src="./img/assent.gif" border="0" /></div>
</div>
<div class="box_bottom"></div>
<div class="copyright"></div>
</div>
</form>
</body>
</html>