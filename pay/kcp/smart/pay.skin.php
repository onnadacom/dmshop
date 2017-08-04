<?php
if (!defined('_DMSHOP_')) exit;
?>
결제수단 : <?=shop_pay_name($dmshop_order['order_pay_type'])?><br />
하단의 결제요청 버튼을 클릭하여주세요.<br />
<br />
<input type="button" onClick="kcp_AJAX();" value="결제요청" id="btn_pay" />
<input type="button" onClick="location.href='../../../m/cart.php';" value="장바구니로 돌아가기" />