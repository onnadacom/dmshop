<?php
include_once("./_dmshop.php");
$top_id = "3";
include_once("$shop[path]/shop.top.php");

$frame_url = "";
if ($frame == '1') {

    $frame_url = "http://dmshopkorea.com/community.php";

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<!-- DMSHOPKOREA AUTO LOGIN START //-->
<iframe id="dmklogin" name="dmklogin" style="display:none;"></iframe>
<form method="post" name="formLogin" action="http://dmshopkorea.com/dm_login.php">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="user_id" value="<?=text($dmshop['dm_user_id'])?>" />
<input type="hidden" name="user_pw" value="<?=text($dmshop['dm_user_pw'])?>" />
</form>
<script type="text/javascript">document.formLogin.target = "dmklogin"; document.formLogin.submit();</script>
<!-- DMSHOPKOREA AUTO LOGIN END //-->

<script type="text/javascript">
setTimeout( function() { parent.document.getElementById("bodyframe").src = "<?=$frame_url?>"; }, 1000 );
</script>

<?
include_once("./top_menu.php");
include_once("$shop[path]/shop.bottom.php");
?>