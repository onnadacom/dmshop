<?
if (!defined('_DMSHOP_')) exit;
?>

<style type="text/css">
.email {width:600px; height:446px; background:url('<?=$dmshop_email_path?>/img/bg.gif') no-repeat;}

.name {position:absolute; left:24px; top:77px;}
.email1 {position:absolute; left:125px; top:77px;}
.email2 {position:absolute; left:365px; top:77px;}

.input {width:200px; height:22px; border:0px; padding:0px 3px 0px 3px;}
<? if ($shop_user_login) { ?>
.input {line-height:22px; font-size:12px; color:#000000; font-family:dotum,돋움;}
<? } else { ?>
.input {line-height:22px; font-size:12px; color:#959595; font-family:dotum,돋움;}
<? } ?>

.input2 {background-color:transparent; width:480px; height:22px; border:0px; padding:0px 3px 0px 3px;}
.input2 {line-height:22px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.title {position:absolute; left:83px; top:140px;}

.content {position:absolute; left:85px; top:175px;}
.content textarea {width:488px; height:188px; background-color:transparent; border:0px; margin:auto;}
.content textarea {line-height:16px; font-size:12px; color:#000000; font-family:gulim,굴림;}

.send {position:absolute; left:200px; top:395px;}
.send a {display:block; width:101px; height:41px;}

.cancel {position:absolute; left:301px; top:395px;}
.cancel a {display:block; width:99px; height:41px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    shopResizeWindow("600", "446");
});
</script>

<script type="text/javascript">
function emailSubmit()
{

    var f = document.formEmail;

    if (f.name.value == '' || f.name.value == '이름 입력') {

        alert('이름을 입력하십시오.');
        f.name.focus();
        return false;

    }

    if (f.email1.value == '' || f.email1.value == '보내실 분의 메일주소 입력') {

        alert('보내실 분의 메일주소를 입력하십시오.');
        f.email1.focus();
        return false;

    }

    if (f.email2.value == '' || f.email2.value == '받으실 분의 메일주소 입력') {

        alert('받으실 분의 메일주소를 입력하십시오.');
        f.email2.focus();
        return false;

    }

    if (f.title.value == '') {

        alert('제목을 입력하십시오.');
        f.title.focus();
        return false;

    }

    if (f.content.value == '') {

        alert('내용을 입력하십시오.');
        f.content.focus();
        return false;

    }

    if (!confirm("전송하시겠습니까?")) {

        return false;

    }

    f.action = "./email_update.php";
    f.submit();

}
</script>

<div id="pop_wrap" class="email">
<form method="post" name="formEmail" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="item_code" value="<?=$item_code?>" />
<div class="name"><input type="text" name="name" value="<? if ($shop_user_login) { echo text($dmshop_user['user_name']); } else { echo "이름 입력"; } ?>" onclick="if (this.value=='이름 입력') { this.value = '' }" onfocus="if (this.value=='이름 입력') { this.value = '' }" class="input" style="width:80px;" /></div>
<div class="email1"><input type="text" name="email1" value="<? if ($shop_user_login) { echo text($dmshop_user['user_email']); } else { echo "보내실 분의 메일주소 입력"; } ?>" onclick="if (this.value=='보내실 분의 메일주소 입력') { this.value = '' }" onfocus="if (this.value=='보내실 분의 메일주소 입력') { this.value = '' }" class="input" /></div>
<div class="email2"><input type="text" name="email2" value="<? if ($email2) { echo text($email2); } else { echo "받으실 분의 메일주소 입력"; } ?>" onclick="if (this.value=='받으실 분의 메일주소 입력') { this.value = '' }" onfocus="if (this.value=='받으실 분의 메일주소 입력') { this.value = '' }" class="input" /></div>
<div class="title"><input type="text" name="title" value="<?=text($title)?>" class="input2" /></div>
<div class="content"><textarea name="content"><?=text($content)?></textarea></div>
<div class="send"><a href="#" onclick="emailSubmit(); return false;"></a></div>
<div class="cancel"><a href="#" onclick="window.close(); return false;"></a></div>
</form>
</div>