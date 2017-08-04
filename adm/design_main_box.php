<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 디자인 설정
$dmshop_design = shop_design();
?>
<div style="padding:10px;">
<table width="984" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<div id="design_main_display1"></div>
<div id="design_main_display2"></div>
<div id="design_main_display3"></div>
<div id="design_main_display4"></div>
<div id="design_main_display5"></div>

<script type="text/javascript">
setTimeout("displayBoxLoading('1');", 100);
setTimeout("displayBoxLoading('2');", 200);
setTimeout("displayBoxLoading('3');", 300);
setTimeout("displayBoxLoading('4');", 400);
setTimeout("displayBoxLoading('5');", 500);
</script>
    </td>
</tr>
</table>
</div>