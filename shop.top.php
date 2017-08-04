<?
if (!defined("_DMSHOP_")) exit;

/*------------------------------
jquery 버전이 변경될 경우 system.lib.php 파일의 메세지 함수 부분도 변경을 합니다. (jquery-1.7.1.min.js)
------------------------------*/

if (!$shop['title']) {

    $shop['title'] = $dmshop['shop_name'];

}

$connect_url = 'http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (!$shop['meta_type']) {
    $shop['meta_type'] = "website";
}

$shop['meta_url'] = $connect_url;

/*
header("Content-Type: text/html; charset=$shop[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$shop['charset']?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,IE=9,chrome=1" />
<? if ($dmshop_item['item_keyword']) { ?>
<meta name="description" content="<?=text($dmshop_item['item_title']);?>" />
<meta name="keywords" content="<?=text($dmshop_item['item_keyword']);?>" />
<? } ?>
<title><?=$shop['title']?></title>
<meta name="twitter:card" content="summary_large_image" />
<meta property="fb:app_id" content="<?=text($dmshop['login_facebook_id'])?>" />
<meta property="og:url" content="<?=text($shop['meta_url'])?>" />
<meta property="og:type" content="<?=text($shop['meta_type'])?>" />
<meta property="og:title" content="<?=text($shop['title'])?>" />
<meta property="og:subject" content="<?=text($shop['meta_subject'])?>" />
<meta property="og:description" content="<?=text($shop['description'])?>" />
<meta property="og:image" content="<?=text($shop['meta_image'])?>" />
<meta property="og:image:width" content="<?=text($shop['meta_image_width'])?>" />
<meta property="og:image:height" content="<?=text($shop['meta_image_height'])?>" />
<meta property="og:locale" content="ko_KR" />
<meta property="og:site_name" content="<?=text($dmshop['shop_name'])?>" />
<link rel="stylesheet" href="<?=$shop['path']?>/css/default.css" type="text/css" />
<link rel="stylesheet" href="<?=$shop['path']?>/css/jquery.selectBox.css" type="text/css" />
<link rel="stylesheet" href="<?=$shop['path']?>/css/jquery.jscrollpane.css" type="text/css" />
<?
echo "<script type=\"text/javascript\">";
echo "var shop_charset = '".text($shop['charset'])."';";
echo "var shop_path = '".text($shop['path'])."';";
echo "var shop_user_login = '".text($shop_user_login)."';";
echo "var shop_domain = '".text($dmshop['domain'])."';";
echo "var shop_url = '".text($shop['url'])."';";
echo "var shop_user_admin = '".text($shop_user_admin)."';";
echo "var shop_kakaomsg = '".text($setup['title'])." ".text($shop['url'])."';";
echo "var shop_return_url = '".text($urlencode)."';";
echo "var check_touch= '".$check_touch."';";
echo "</script>\n";
?>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.simpletip-1.3.1.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.selectBox.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/jquery.banner.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/shop.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/showwindow.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/showwindow2.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?=$shop['path']?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
<![endif]-->
<? if ($shop_user_admin) { ?>
<script type="text/javascript" src="<?=$shop['path']?>/js/admin.js"></script>
<? } ?>
<?
// kakaotalk
if ($dmshop['login_kakao_key']) {
?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript">
Kakao.init('<?=text($dmshop['login_kakao_key'])?>');
function kakaoLink()
{

    var label = "";
    var label_subject = $('meta[property="og:subject"]').attr('content');
    var label_url = $('meta[property="og:url"]').attr('content');

    if (label_subject) { label += label_subject; }
    if (label_url) { label += "\n"+label_url; }

    Kakao.Link.sendTalkLink({
    label: label,
<? if ($shop['meta_image']) { ?>
    image: {
        src: $('meta[property="og:image"]').attr('content'),
        width: $('meta[property="og:image:width"]').attr('content'),
        height: $('meta[property="og:image:height"]').attr('content')
    }
<? } ?>
    });

}
</script>
<? } ?>
</head>
<body <? if ($dmshop['mouse_event']) { echo "oncontextmenu=\"return false\""; } ?>>
<div id="overlay"></div><div id="message_box"></div><div class="layout_top_bg"></div>