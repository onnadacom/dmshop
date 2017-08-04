<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.find_box .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.find_box .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.find_box .move {line-height:40px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.find_box .user_pw_q {font-weight:bold; line-height:21px; font-size:13px; color:#3a3a3a; font-family:gulim,굴림;}

.find_box .input {width:190px; height:21px; border:2px solid #c9c9c9; padding:0px 5px 0px 5px;}
.find_box .input {font-weight:bold; line-height:21px; font-size:13px; color:#3a3a3a; font-family:gulim,굴림;}

.find_box .select {height:18px; border:1px solid #e4e4e4;}
.find_box .select {line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.find_box .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}

.find_box .find_id_not {border-bottom:1px solid #efefef;}
.find_box .find_id_not div {border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; background-color:#fbfbfb; height:40px; text-align:center;}
.find_box .find_id_not div {font-weight:bold; line-height:40px; font-size:12px; color:#ed145b; font-family:gulim,굴림;}

.find_box .find_id_wait {border-bottom:1px solid #efefef;}
.find_box .find_id_wait div {border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; background-color:#fbfbfb; text-align:center; padding:10px 0;}
.find_box .find_id_wait div {font-weight:bold; line-height:18px; font-size:12px; color:#787878; font-family:gulim,굴림;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/util.js"></script>
<script type="text/javascript" src="<?=$dmshop_find_path?>/find.js"></script>

<script type="text/javascript">
function findSubmit()
{

    var f = document.formFind;

    if (f.user_pw.value == "") {

        alert("비밀번호를 입력하세요.");
        f.user_pw.focus();
        return false;

    } else {

        res = isValid_passwd(f.user_pw.value);

        if (!res) {

            f.user_pw.focus();
            return false;

        }

    }

    if (f.user_pw_re.value == "") {

        alert("비밀번호 확인을 입력하세요.");
        f.user_pw_re.focus();
        return false;

    } else {

        res = isValid_passwd(f.user_pw_re.value);

        if (!res) {

            f.user_pw_re.focus();
            return false;

        }

    }

    $.post("./find_pw_new_update.php", {"form_check" : f.form_check.value, "user_id" : f.user_id.value, "user_pw" : f.user_pw.value, "user_pw_re" : f.user_pw_re.value}, function(data) {

        $("#find_id_message").html(data);

    });

}
</script>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="find_box">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_find_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/find_pw.php' class='off'>비밀번호 찾기</a></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="55">
    <td><img src="<?=$dmshop_find_path?>/img/message2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="find_box">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="padding:1px; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40" bgcolor="#fbfbfb">
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="move">이동</td>
    <td width="8"></td>
    <td>
<select id="move_list" name="move_list" onchange="shopMove(this.value);" class="select">
    <option value="find_id.php">아이디 찾기</option>
    <option value="find_pw.php">비밀번호 찾기</option>
    <option value="signin.php">로그인</option>
    <option value="signup.php">회원가입</option>
</select>

<script type="text/javascript">
document.getElementById("move_list").value = "find_pw.php";
</script>
    </td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
</div>

<div style="background-color:#ffffff; padding:80px 0 80px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<form method="post" name="formFind" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$user['datetime']?>" />
<input type="hidden" name="user_id" value="<?=$user_id?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_find_path?>/img/dot.gif"></td>
    <td width="10"></td>
    <td><img src="<?=$dmshop_find_path?>/img/title_pw.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<div id="find_id_message"><div class='find_id_wait'><div>본인 확인이 완료 되었습니다.<br>새로 이용하실 비밀번호를 2회 입력 하세요.</div></div></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="25">
    <td width="60"></td>
    <td align="right"><img src="<?=$dmshop_find_path?>/img/pw.gif"></td>
    <td width="10"></td>
    <td><input type="password" name="user_pw" onfocus="findFocusIn(this);" onblur="findFocusOut(this);" class="input" /></td>
    <td width="60"></td>
</tr>
<tr><td colspan="3" height="5"></td></tr>
<tr height="25">
    <td width="60"></td>
    <td align="right"><img src="<?=$dmshop_find_path?>/img/pw_re.gif"></td>
    <td width="10"></td>
    <td><input type="password" name="user_pw_re" onfocus="findFocusIn(this);" onblur="findFocusOut(this);" class="input" /></td>
    <td width="60"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div id="find_btn"><a href="#" onclick="findSubmit(); return false;"><img src="<?=$dmshop_find_path?>/img/ok.gif" border="0"></a></div></td>
</tr>
</table>
</form>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>