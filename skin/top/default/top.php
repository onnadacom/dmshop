<?
if (!defined('_DMSHOP_')) exit;

// 상단 설정
$dmshop_top = shop_design_top();
?>
<style type="text/css">
body {background:url('<?=$dmshop_top_path?>/img/top_bg.gif') repeat-x;}

.layout_top {margin-bottom:10px;}
.layout_top .layer0 {position:relative; left:0; top:0px; width:100%; text-align:center;}
.layout_top .layer0 .layer1 {margin:0 auto;}
.layout_top .layer0 .layer2 {position:absolute; right:0px; top:0px;}

.layout_top .service_menu .line {padding:0 5px; line-height:14px; font-size:12px; color:#eeeeee; font-family:gulim,굴림;}
.layout_top .service_menu a {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.layout_top .service_menu a:hover {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0" class="service_menu">
<tr height="28">
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
    </td>
</tr>
</table>

<div class="layer0">

    <div class="layer1"><? /* 직접만들기(상단)의 로고를 출력합니다. */ $file = shop_design_file("top_logo"); if ($file['upload_file']) { echo "<a href='".$shop['url']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</a>"; } ?></div>
    <div class="layer2"><div><a href="<?=$shop['https_url']?>/signup.php"><img src="<?=$dmshop_top_path?>/img/banner.gif" border="0"></a></div><?=shop_searchbox_skin("default_top");?></div>

</div>

<?=shop_wmbar_skin("default"); /* 직접만들기 > 가로메뉴바 > 표기항목에 체크된 메뉴만 출력합니다. */ ?>