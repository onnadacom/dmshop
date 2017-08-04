<?php
// 새로고침 유지
$LastModified = gmdate("D d M Y H:i:s", filemtime($HTTP_SERVER_VARS[SCRIPT_FILENAME]));
header("Last-Modified: $LastModified GMT");
header("ETag: \"$LastModified\"");
include_once("./_dmshop.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$shop['charset']?>">
<title>디엠샵코리아 커뮤니티</title>
<link rel="stylesheet" href="<?=$shop['path']?>/css/default.css" type="text/css" />
</head>
<frameset rows="36,*" frameborder="0" border="0">
<frame src="./_top_menu.php?frame=1" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" noresize>
<frame id="bodyframe" name="bodyframe" frameborder="0" marginwidth="0" marginheight="0" scrolling="yes" noresize style="overflow-x:hidden;">
</frameset>
</html>