<?php // 상단
if (!defined("_DMSHOP_")) exit;

if (!$shop['title']) {

    $shop['title'] = $dmshop['shop_name'];

}

$connect_url = 'http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (!$shop['meta_type']) {
    $shop['meta_type'] = "website";
}

$shop['meta_url'] = $connect_url;

// 상품분류
$menu = array();
$result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'category' order by position asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $menu[$i] = $row;
    $menu[$i]['href'] = $shop['mobile_url']."/list.php?ct_id=".$row['menu_id'];
    $menu[$i]['title'] = $row['title'];

    if ($row['menu_id'] == $ct_id || $row['menu_id'] == shop_split("|", $dmshop_category['log'], "1")) {

        $menu[$i]['hover'] = "hover";

    } else {

        $menu[$i]['hover'] = "";

    }

}

// 게시판
$menu2 = array();
$result = sql_query(" select * from $shop[design_hmlist_table] where menu_type = 'board' order by position asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $menu2[$i] = $row;
    $menu2[$i]['href'] = $shop['mobile_url']."/board.php?bbs_id=".$row['menu_id'];
    $menu2[$i]['title'] = $row['title'];

    if ($row['menu_id'] == $bbs_id) {

        $menu2[$i]['hover'] = "hover";

    } else {

        $menu2[$i]['hover'] = "";

    }

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="<?=$shop['charset']?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title><?=text($shop['title'])?></title>
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
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" type="text/css" />
<style type="text/css">
body {background-color:#323743; min-width:350px;}

.nav {position:fixed; z-index:1; top:0px; left:0px; width:100%; height:94px; background-color:#5396ea;}
.nav ul.logo {clear:both; width:100%; height:48px; border-bottom:1px solid #397dd1;}
.nav ul.logo li {width:100%; height:48px; text-align:center;}
.nav ul.logo li a {text-decoration:none; font-weight:800; line-height:48px; font-size:21px; color:#ffffff; font-family:'Nanum Gothic',gulim,serif;}
.nav ul.menu {clear:both; width:100%; height:45px;}
.nav ul.menu li {width:25%; height:45px; display:block; float:left;}
.nav ul.menu li a {padding:0 3px; border-left:1px solid #397dd1; height:45px; display:block; overflow:hidden; text-align:center;}
.nav ul.menu li a {text-decoration:none; font-weight:400; line-height:45px; font-size:12px; color:#ffffff; font-family:'Nanum Gothic',gulim,serif;}
.nav ul.menu li.hover {background-color:#3e83d9;}
.nav ul.menu li.hover a {font-weight:bold;}

.quick_icon {width:48px; height:48px; background:url('<?=$shop['mobile_url']?>/img/quick.png') no-repeat left top; cursor:pointer;}
.quick_open {position:absolute; top:0px; left:0;}
.quick_close {display:none; z-index:1000001; position:absolute; left:201px; top:0; background-position:0 -48px;}

.quick {display:none; z-index:1000000; position:fixed; left:-201px; top:0; width:200px; height:100%; border-right:1px solid #181b2d; background-color:#ffffff; overflow:auto; overflow-x:hidden;}
.quick .block {padding:10px 10px;}
.quick ul.menu {padding-bottom:10px;}
.quick ul.menu li a {height:40px; display:block; padding:0 5px; overflow:hidden;}
.quick ul.menu li a {text-decoration:none; font-weight:400; line-height:40px; font-size:15px; color:#181b2d; font-family:'Nanum Gothic',gulim,serif;}
.quick ul.menu li.hover a {color:#397dd1;}
.quick ul.menu2 {border-top:1px solid #dddddd; padding:10px 0 10px 0;}
.quick ul.menu2 li a {height:40px; display:block; padding:0 5px; overflow:hidden;}
.quick ul.menu2 li a {text-decoration:none; font-weight:400; line-height:40px; font-size:15px; color:#181b2d; font-family:'Nanum Gothic',gulim,serif;}
.quick ul.menu2 li.hover a {color:#397dd1;}

.conts {padding-top:94px; clear:both; width:100%; background-color:#ffffff;}
.conts .main {clear:both;}

.bmenu {clear:both; text-align:center; width:100%; border-top:1px solid #181b2d;}
.bmenu a {margin:0 5px; font-weight:400; line-height:50px; font-size:12px; color:#ffffff; font-family:'Nanum Gothic',gulim,serif}

.company {clear:both; padding:0 10px 20px 0; text-align:center; font-weight:400; line-height:18px; font-size:10px; color:#aaadb3; font-family:'Nanum Gothic',gulim,serif}
.company a {font-weight:400; line-height:18px; font-size:10px; color:#aaadb3; font-family:'Nanum Gothic',gulim,serif}
.company .line {padding:0 5px; font-weight:400; line-height:18px; font-size:9px; color:#7f8289; font-family:'Nanum Gothic',gulim,serif}
</style>
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
<script type="text/javascript" src="<?=$shop['path']?>/js/shop.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?=$shop['path']?>/js/swipe.js"></script>
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
<script type="text/javascript">
var quick_left = 0;
$(document).ready( function() {

    var overlay = $("#overlay");

    $('.quick_open').click(function() {

        $('.quick').show();

        quick_left = $('.quick').offset().left;

        $('.quick').stop().animate({'left': '0px'}, 300);
        $('.quick_close').fadeIn(300);

        overlay.css( { 'opacity' : '0.5'} );
        overlay.fadeIn(300);

    });

    $('.quick_close').click(function() {

        $('.quick').stop().animate({'left': quick_left+'px'}, 300);
        $('.quick_close').fadeOut(300);
        overlay.fadeOut(300);

    });

    overlay.click(function() {

        $('.quick_close').click();

    });

});
</script>
</head>
<body>
<div id="message_box"></div><div id="overlay"></div>

<div class="quick_icon quick_close"></div>
<div class="quick">
<div class="block">
<ul class="menu">
<?
for ($i=0; $i<count($menu); $i++) {

    echo "<li class='".$menu[$i]['hover']."'><a href='".$menu[$i]['href']."'>".text($menu[$i]['title'])."</a></li>";

}
?>
</ul>
<ul class="menu2">
<?
for ($i=0; $i<count($menu2); $i++) {

    echo "<li class='".$menu2[$i]['hover']."'><a href='".$menu2[$i]['href']."'>".text($menu2[$i]['title'])."</a></li>";

}
?>
</ul>
</div>
</div>

<div class="nav">
<ul class="logo">
<li><a href="<?=$shop['mobile_url']?>"><?=text($dmshop['shop_name'])?></a></li>
<div class="quick_icon quick_open"></div>
</ul>
<ul class="menu">
<?

for ($i=0; $i<count($menu); $i++) {
    
    if ($i == 4) {

        break;

    }

    echo "<li class='".$menu[$i]['hover']."'><a href='".$menu[$i]['href']."'>".text($menu[$i]['title'])."</a></li>";

}
?>
</ul>
</div>
<div class="conts">
<div class="main">