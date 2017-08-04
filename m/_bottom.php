<?php // 하단
if (!defined("_DMSHOP_")) exit;
$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
</div>
</div>
<div class="bmenu">
<a href="<?=$shop['mobile_url']?>">홈으로</a>
<? if ($shop_user_login) { ?>
<a href="<?=$shop['url']?>/signout.php?url=<?=$shop['mobile_url']?>">로그아웃</a>
<? } else { ?>
<a href="<?=$shop['mobile_url']?>/signin.php?url=<?=text($return_url)?>">로그인</a>
<? } ?>
<a href="<?=$shop['mobile_url']?>/cart.php">장바구니</a>
<? if ($shop_user_login) { ?>
<a href="<?=$shop['url']?>/order_list.php">주문내역</a>
<? } else { ?>
<a href="<?=$shop['url']?>/order_guest.php">주문조회</a>
<? } ?>
<a href="<?=$shop['url']?>/?m=pc">PC버전</a>
</div>
<div class="company">
<?=text($dmshop['company_name'])?><span class="line">|</span>대표 : <?=text($dmshop['ceo_name'])?><span class="line">|</span>대표전화 : <?=text($dmshop['number1'])?>-<?=text($dmshop['number2'])?>-<?=text($dmshop['number3'])?><br />
사업자 등록번호 : <?=text($dmshop['company_number1'])?><span class="line">|</span><a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp?searchKey=04&searchVal=<?=text($dmshop['company_number1'])?>" target="_blank">사업자정보확인</a><br />
통신판매업 신고번호 : <?=text($dmshop['company_number2'])?><br />
주소 : <?=text($dmshop['addr1'])?> <?=text($dmshop['addr2'])?><br />
</div>
</body>
</html>