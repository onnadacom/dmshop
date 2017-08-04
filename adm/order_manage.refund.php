<?php
if (!defined('_DMSHOP_')) exit;

if ($tab == 'refund') {

// help 데이터
$dmshop_help = shop_help_new($order_code, "500");
?>
<!-- 환불접수 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t10.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<? if ($dmshop_order['order_refund']) { ?>
<form method="post" name="formRefund" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">환불 접수일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_order['order_refund_datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_order['order_refund_datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">상담 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_help['subject'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">상담 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($dmshop_help['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='".$shop['path']."/download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">환불 상태</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=shop_order_type($dmshop_order['order_type']);?></td>
</tr>
<?
if ($dmshop_order['order_refund_ok_datetime']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">환불 승인일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_order['order_refund_ok_datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_order['order_refund_ok_datetime']));?></span></td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<? if ($dmshop_order['order_refund'] == '1') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="submitRefund('refund_ok'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_refund_ok.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="submitRefund('refund_cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_refund_cancel.gif" border="0"></a></td>
</tr>
</table>
<? } ?>
</form>
<!-- 환불접수 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<?
if ($dmshop_help['help_count']) {

// help 답변 데이터
$dmshop_help_reply = shop_help_reply($dmshop_help['id']);
?>
<!-- 답변 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t8.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_help_reply['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_help_reply['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_help_reply['subject'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($dmshop_help_reply['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help_reply['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='".$shop['path']."/download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="./help_list.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/manage_help_go.gif" border="0"></a></td>
</tr>
</table>
<!-- 답변 end //-->
<? } else { ?>
<!-- 답변등록 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t7.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<form method="post" name="formHelp" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="help" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<input type="hidden" name="help_id" value="<?=$dmshop_help['id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="subject" class="input" style="width:429px;" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<textarea name="content" class="textarea1" style="width:425px; height:180px;"></textarea>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file" class="file" size="30" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><p class="help1">이미지 등의 증빙파일을 첨부하고자 하실 경우 우측 ‘찾아보기’버튼 클릭</p><p class="help1">첨부파일이 많을 경우, 압축후 등록해 주시기 바랍니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="submitHelp(); return false;"><img src="<?=$shop['image_path']?>/adm/manage_reply_ok.gif" border="0"></a></td>
</tr>
</table>
</form>
<!-- 답변등록 end //-->
<? } ?>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="150">
    <td class="not">환불접수 내역이 없습니다.</td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_msg">
<tr>
    <td>
<div style="border:1px solid #e2cb91; background-color:#ffeec4; padding:5px;">
<div style="padding:15px 20px; background-color:#fffdea;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<p class="help4">- 주문자가 상품수령 후, 환경설정의 교환/환불 신청기간 내에 환불을 요청한 상태 입니다.</p>
<p class="help4">- 환불접수 내역을 확인하고, 환불승인 전 상담을 통해 아래의 사항을 꼭 체크하시기 바랍니다.</p>
<p class="help4">&nbsp;&nbsp;(1) 소비자 or 판매자의 과실, (2) 제품사용 여부, (3) 왕복 택배비 부담, (4) 반품주소 안내</p>
<p class="help4">- 환불승인 시, 결제수단이 전자결제일 경우 PG사의 홈페이지를 방문하여 해당 결제건의 승인취소를 요청 하시고, <br />
  &nbsp;&nbsp;무통장입금일 경우, 상담을 통해 소비자의 계좌로 환불금액을 직접 송금하시기 바랍니다.</p>
<p class="help4">- 환불거절 시, 본 주문건은 전산상 “배송완료” 처리 됩니다.</p>
<p class="help4">- 답변 바로하기를 통해 답변 작성 후, 답변의 수정이나 확인은 1:1문의내역에서 관리하실 수 있습니다.</p>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>
<? } ?>