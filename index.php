<?php
include_once("./_dmshop.php");

if ($m == 'pc') {

    $ss_name = "pc_ver";
    if (!shop_get_session($ss_name)) {

        shop_set_session($ss_name, true);

    }

}

if (preg_match("/(Mobile|Android)/", $_SERVER['HTTP_USER_AGENT'])) {

    $ss_name = "pc_ver";
    if (!shop_get_session($ss_name)) {

        shop_url($shop['mobile_path']);

    }

}

// 고정
if ($dmshop['domain_type']) {

    include_once("$shop[path]/home.php");

} else {
// 유동
// 새로고침 유지
$LastModified = gmdate("D d M Y H:i:s", filemtime($HTTP_SERVER_VARS[SCRIPT_FILENAME]));
header("Last-Modified: $LastModified GMT");
header("ETag: \"$LastModified\"");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$shop['charset']?>">
<title><?=$dmshop['shop_name']?></title>
<link rel="stylesheet" href="<?=$shop['path']?>/css/default.css" type="text/css" />
<script type="text/javascript">if (parent.frames.length) { parent.location.replace('<?=$shop['domain']?>'); }</script>
</head>
<frameset rows="*" frameborder="0" border="0">
<frame src="<?=$shop['path']?>/home.php" frameborder="0" marginwidth="0" marginheight="0" scrolling="yes" noresize>
</frameset>
</html>
<? } ?>