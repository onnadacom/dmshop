<?
if (!defined('_DMSHOP_')) exit;
?>

<style type="text/css">
.sms {width:240px; height:434px; background:url('<?=$dmshop_sms_path?>/img/bg.gif') no-repeat;}
.content {position:absolute; left:40px; top:100px;}
.content textarea {overflow:hidden; width:130px; height:110px; background-color:transparent; border:0px; margin:auto;}
.content textarea {font-weight:bold; line-height:16px; font-size:14px; color:#000000; font-family:arial,굴림체,gulim,굴림;}

.byte {position:absolute; right:20px; top:240px;}
.byte {font-weight:bold; line-height:14px; font-size:12px; color:#000000; font-family:arial,굴림체,gulim,굴림;}

.hp1 {position:absolute; left:23px; top:328px;}
.hp2 {position:absolute; left:23px; top:275px;}

.input {width:180px; height:22px; border:0px; padding:0px 5px 0px 5px;}
.input {font-weight:bold; line-height:22px; font-size:16px; color:#000000; font-family:arial,dotum,돋움;}

.send {position:absolute; left:20px; top:383px;}
.send a {display:block; width:101px; height:41px;}

.cancel {position:absolute; left:121px; top:383px;}
.cancel a {display:block; width:99px; height:41px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    shopResizeWindow("240", "434");
});
</script>

<script type="text/javascript">
function smsSubmit()
{

    var f = document.formSms;

    if (f.message.value == '') {

        alert('내용을 입력하십시오.');
        f.message.focus();
        return false;

    }

    if (f.hp2.value == '') {

        alert('발신자(보내는 사람) 번호를 입력해 주세요.');
        f.hp2.focus();
        return false;

    }

    if (f.hp1.value == '') {

        alert('수신자(받는 사람) 번호를 입력해 주세요.');
        f.hp1.focus();
        return false;

    }

    if (!confirm("전송하시겠습니까?")) {

        return false;

    }

    f.action = "./sms_update.php";
    f.submit();

}
</script>

<div id="pop_wrap" class="sms">
<form method="post" name="formSms" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="user_id" value="<?=$user_id?>" />
<input type="hidden" name="item_code" value="<?=$item_code?>" />
<div class="content"><textarea id="message" name="message" onkeyup="shopByte('message', 'message_bytes');" class="message"><?=$message?></textarea></div>
<div class="byte"><span id="message_bytes">0</span> / 80 byte</div>
<div class="hp2"><input type="text" name="hp2" value="<?=$hp2?>" class="input" /></div>
<div class="hp1"><input type="text" name="hp1" value="<?=$hp1?>" class="input" /></div>
<div class="send"><a href="#" onclick="smsSubmit(); return false;"></a></div>
<div class="cancel"><a href="#" onclick="window.close(); return false;"></a></div>
</form>
</div>