<?
if (!defined('_DMSHOP_')) exit;
// 기본 서비스메뉴
?>
<table border="0" cellspacing="0" cellpadding="0" class="service_menu">
<tr height="25">
    <td><a href="#" onclick="shopBookmark('<?=filter1($dmshop['shop_name']);?>', '<? if ($dmshop['domain']) { echo shop_http($dmshop['domain']); } else { echo $shop['url']; } ?>'); return false;">즐겨찾기</a></td>
    <td><span class="line">|</span></td>
<? if ($shop_user_login) { ?>
<? if ($shop_user_admin) { ?>
    <td><a href="<?=$shop['url']?>/adm/">관리홈</a></td>
    <td><span class="line">|</span></td>
<? } ?>
    <td><a href="<?=$shop['url']?>/signout.php">로그아웃</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/signup_check.php">정보수정</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/mypage.php">마이페이지</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/cart.php">장바구니</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/order_list.php">주문내역</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/favorite.php">관심상품</a></td>
<?
} else {

$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
    <td><a href="<?=$shop['https_url']?>/signin.php?url=<?=$return_url?>">로그인</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/signup.php">회원가입</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/mypage.php">마이페이지</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/cart.php">장바구니</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/order_list.php">주문내역</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/favorite.php">관심상품</a></td>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/order_guest.php">비회원 주문조회</a></td>
<? } ?>
</tr>
</table>