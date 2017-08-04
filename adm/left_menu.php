<?php
if (!defined('_DMSHOP_')) exit;
?>
<div class="box">
<div class="tab">
    <a name="1" href="#" class="tab1_off" onclick="return false;"></a>
    <a name="2" href="#" class="tab2_off" onclick="return false;"></a>
    <a name="3" href="#" class="tab3_off" onclick="return false;"></a>
    <a name="4" href="#" class="tab4_off" onclick="return false;"></a>
    <a name="5" href="#" class="tab5_off" onclick="return false;"></a>
    <a name="6" href="#" class="tab6_off" onclick="return false;"></a>
    <a name="7" href="#" class="tab7_off" onclick="return false;"></a>
    <a name="8" href="#" class="tab8_off" onclick="return false;"></a>
    <a name="9" href="#" class="tab9_off" onclick="return false;"></a>
</div>
<div class="tab_view">
<div class="view_box tab1_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title01.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/" class="off"><span>관리자 홈<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:8px;">
    <li style="padding:7px 0 3px 0;"><span><b class="up5">바로가기</b><img src="<?=$shop['image_path']?>/adm/bookmark_setting.gif" style="margin-left:70px;" class="up1 pointer" onclick="bookmakrPopup();"></span></li>
</ul>
<ul class="ms hover">
<?
$result = sql_query(" select * from $shop[bookmark_table] where mode = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($row['title'] == 'PG사 홈페이지') {

        $row['url'] = shop_http(shop_pg_admin($dmshop['order_pg']));
        $row['target'] = true;

    }

    else if ($row['title'] == '택배사 홈페이지') {

        $row['url'] = shop_http($dmshop['parcel_url']);
        $row['target'] = true;

    } else {

        // pass

    }

    if ($row['url'] == 'none') {

        echo "<li style='margin:3px 0; border-top:1px solid #4a4e59;'></li>";

    } else {

        echo "<li><a name=\"$i\" href=\"".text($row['url'])."\" class=\"off\"";
        if ($row['target']) { echo " target=\"_blank\" "; }
        echo "><span>".text($row['title'])."<b></b></span></a></li>";

    }

}
?>
</ul>
<ul class="line"><li></li></ul>
<div style="margin-bottom:1px; padding:5px;">
<div style="background-color:#30333d; border:1px solid #3a3d48; padding:7px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/ip_icon.gif"></td>
    <td width="8"></td>
    <td><p class="ip1">ADM IP CHECK</p><p class="ip2"><?=text($_SERVER['REMOTE_ADDR'])?></p></td>
</tr>
</table>
</div>
</div>
<ul class="line"><li></li></ul>
</div>
<div class="view_box tab2_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title02.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/order_all_list.php" class="off"><span>전체 주문내역<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/order_day_list.php" class="off"><span>일일 주문내역<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:8px;">
    <li><span>상태별 일괄처리</span></li>
</ul>
<ul class="ms hover">
    <li><a name="200" href="<?=$shop['path']?>/adm/order_bank_list.php?order_type=100" class="off"><span>무통장 입금<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/order_prepare_list.php?order_type=101" class="off"><span>배송 준비<b></b></span></a></li>
    <li><a name="202" href="<?=$shop['path']?>/adm/order_delivery_list.php?order_type=200" class="off"><span>상품 발송<b></b></span></a></li>
    <li><a name="203" href="<?=$shop['path']?>/adm/order_cancel_list.php?order_type=300" class="off"><span>취소 접수<b></b></span></a></li>
    <li><a name="204" href="<?=$shop['path']?>/adm/order_exchange_list.php?order_type=400" class="off"><span>교환 접수<b></b></span></a></li>
    <li><a name="205" href="<?=$shop['path']?>/adm/order_refund_list.php?order_type=500" class="off"><span>환불 접수<b></b></span></a></li>
</ul>
<ul class="line"><li></li></ul>
<ul class="mt hover" style="margin-top:8px;">
    <li><a name="300" href="<?=$shop['path']?>/adm/order_receipt_list.php" class="off"><span>영수증 관리<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:8px;">
    <li><a name="400" href="<?=shop_http(shop_pg_admin($dmshop['order_pg']));?>" class="off" target="_blank"><span>PG사 홈페이지</span></a></li>
    <li><a name="401" href="<?=shop_http($dmshop['parcel_url']);?>" class="off" target="_blank"><span>택배사 홈페이지</span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
</div>
<div class="view_box tab3_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title03.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/item_list.php" class="off"><span>전체 상품목록<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/item_write.php" class="off"><span>상품 등록<b></b></span></a></li>
    <li><a name="102" href="<?=$shop['path']?>/adm/relation_list.php" class="off"><span>관련상품 설정<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="200" href="<?=$shop['path']?>/adm/plan_list.php" class="off"><span>기획전 목록<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/plan_write.php" class="off"><span>기획전 등록<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="300" href="<?=$shop['path']?>/adm/icon_list.php" class="off"><span>혜택별 상품 아이콘<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/icon_all.php" class="off"><span>아이콘 일괄 적용<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="400" href="<?=$shop['path']?>/adm/category_config.php" class="off"><span>상품분류 생성·관리<b></b></span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/category_list.php" class="off"><span>상품목록 화면설정<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
</div>
<div class="view_box tab4_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title04.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/help_list.php" class="off"><span>1:1 문의 내역<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/qna_list.php" class="off"><span>상품문의 내역<b></b></span></a></li>
    <li><a name="102" href="<?=$shop['path']?>/adm/reply_list.php" class="off"><span>상품평 내역<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="300" href="<?=$shop['path']?>/adm/payment_list.php" class="off"><span>개별결제창 발급내역<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/payment_write.php" class="off"><span>개별결제창 발급<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="400" href="<?=$shop['path']?>/adm/user_list.php" class="off"><span>전체 회원목록<b></b></span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/user_regist.php" class="off"><span>회원 등록<b></b></span></a></li>
    <li><a name="402" href="#" class="off" onclick="userPopupLevel(''); return false;"><span>회원 등급 관리<b></b></span></a></li>
    <li><a name="403" href="<?=$shop['path']?>/adm/user_level_config.php" class="off"><span>등급 명칭·아이콘<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
</div>
<div class="view_box tab5_view">
<ul><img src="<?=$shop['image_path']?>/adm/menu_title05.gif"></ul>
<ul class="ma" style="border-top:0px;">
    <li style="border-top:0px;"><span>적립금</span></li>
</ul>
<ul class="ms hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/cash_list.php" class="off"><span>지급·사용 내역<b></b></span></a></li>
    <li><a name="101" href="#" class="off" onclick="cashPopupMake('plus', ''); return false;"><span>적립금 직권 지급<b></b></span></a></li>
    <li><a name="102" href="#" class="off" onclick="cashPopupMake('minus', ''); return false;"><span>적립금 직권 차감<b></b></span></a></li>
    <li><a name="103" href="<?=$shop['path']?>/adm/config_cash.php" class="off"><span>적립금 자동지급 설정<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>쿠폰</span></li>
</ul>
<ul class="ms hover">
    <li><a name="200" href="<?=$shop['path']?>/adm/coupon_config_list.php" class="off"><span>전체 쿠폰목록<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/coupon_config.php" class="off"><span>쿠폰 등록<b></b></span></a></li>
    <li><a name="202" href="#" class="off" onclick="couponPopupMake(''); return false;"><span>쿠폰 직권 지급<b></b></span></a></li>
    <li><a name="203" href="#" class="off" onclick="couponPopupAuto(''); return false;"><span>쿠폰 자동지급 설정<b></b></span></a></li>
    <li><a name="204" href="<?=$shop['path']?>/adm/coupon_make_list.php" class="off"><span>쿠폰 지급내역<b></b></span></a></li>
    <li><a name="205" href="<?=$shop['path']?>/adm/coupon_order_list.php" class="off"><span>쿠폰 사용내역<b></b></span></a></li>
    <li><a name="206" href="<?=$shop['path']?>/adm/coupon_make_number.php" class="off"><span>인쇄용 쿠폰 등록현황<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>SMS 문자</span></li>
</ul>
<ul class="ms hover">
    <li><a name="300" href="<?=$shop['path']?>/adm/sms_config.php" class="off"><span>고객용 자동발송<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/sms_config.php?sms_list=1" class="off"><span>관리자용 자동발송<b></b></span></a></li>
    <li><a name="302" href="<?=$shop['path']?>/adm/sms_send.php" class="off"><span>개별·단체 즉시발송<b></b></span></a></li>
    <li><a name="303" href="<?=$shop['path']?>/adm/sms_log.php" class="off"><span>문자 발송내역<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:1px;"><li></li></ul>
</div>
<div class="view_box tab6_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title06.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/board_list.php" class="off"><span>게시판 목록<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/board_write.php" class="off"><span>게시판 생성<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="200" href="<?=$shop['path']?>/adm/page_list.php" class="off"><span>웹페이지 목록<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/page_write.php" class="off"><span>웹페이지 생성<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="300" href="<?=$shop['path']?>/adm/banner_list.php" class="off"><span>배너 목록<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/banner_write.php" class="off"><span>배너 생성<b></b></span></a></li>
    <li><a name="302" href="#" class="off" onclick="bannerGroup(); return false;"><span>배너 그룹 설정<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="400" href="<?=$shop['path']?>/adm/popup_list.php" class="off"><span>팝업창 목록<b></b></span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/popup_write.php" class="off"><span>팝업창 생성<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:7px;">
    <li><a name="500" href="<?=$shop['path']?>/adm/calendar.php" class="off"><span>일정관리<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
</div>
<div class="view_box tab7_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title07.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/reporting_total.php" class="off"><span>종합 통계분석<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/reporting_visit_list.php" class="off"><span>개별 방문기록<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:8px;">
    <li><span>매출 분석</span></li>
</ul>
<ul class="ms hover">
    <li><a name="200" href="<?=$shop['path']?>/adm/reporting_sales.php?reporting=1" class="off"><span>추정 매출<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/reporting_sales.php?reporting=2" class="off"><span>결제 금액<b></b></span></a></li>
    <li><a name="202" href="<?=$shop['path']?>/adm/reporting_sales.php?reporting=3" class="off"><span>주문 금액<b></b></span></a></li>
    <li><a name="203" href="<?=$shop['path']?>/adm/reporting_sales.php?reporting=4" class="off"><span>유입 경로별<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>상품 분석</span></li>
</ul>
<ul class="ms hover">
    <li><a name="300" href="<?=$shop['path']?>/adm/reporting_item.php?reporting=1" class="off"><span>주문 금액<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/reporting_item.php?reporting=2" class="off"><span>판매량<b></b></span></a></li>
    <li><a name="302" href="<?=$shop['path']?>/adm/reporting_item.php?reporting=3" class="off"><span>취소<b></b></span></a></li>
    <li><a name="303" href="<?=$shop['path']?>/adm/reporting_item.php?reporting=4" class="off"><span>교환<b></b></span></a></li>
    <li><a name="304" href="<?=$shop['path']?>/adm/reporting_item.php?reporting=5" class="off"><span>환불<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>회원 분석</span></li>
</ul>
<ul class="ms hover">
    <li><a name="400" href="<?=$shop['path']?>/adm/reporting_user.php?reporting=1" class="off"><span>주문<b></b></span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/reporting_user.php?reporting=2" class="off"><span>성별<b></b></span></a></li>
    <li><a name="402" href="<?=$shop['path']?>/adm/reporting_user.php?reporting=3" class="off"><span>연령<b></b></span></a></li>
    <li><a name="403" href="<?=$shop['path']?>/adm/reporting_user.php?reporting=4" class="off"><span>거주지<b></b></span></a></li>
    <li><a name="404" href="<?=$shop['path']?>/adm/reporting_user.php?reporting=5" class="off"><span>추천인<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>방문자 분석</span></li>
</ul>
<ul class="ms hover">
    <li><a name="500" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=1" class="off"><span>방문자<b></b></span></a></li>
    <li><a name="501" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=2" class="off"><span>재방문자<b></b></span></a></li>
    <li><a name="502" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=3" class="off"><span>포털별 유입현황<b></b></span></a></li>
    <li><a name="503" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=4" class="off"><span>포털 키워드 분석<b></b></span></a></li>
    <li><a name="504" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=5" class="off"><span>웹 브라우저<b></b></span></a></li>
    <li><a name="505" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=6" class="off"><span>운영체제<b></b></span></a></li>
    <li><a name="506" href="<?=$shop['path']?>/adm/reporting_visit.php?reporting=7" class="off"><span>모니터 해상도<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:1px;"><li></li></ul>
</div>
<div class="view_box tab8_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title08.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/design_layout_main.php" class="off"><span>메인 디자인 설정<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/design_layout_sub.php" class="off"><span>서브 디자인 설정<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:8px;">
    <li><span>직접 만들기</span></li>
</ul>
<ul class="ms hover">
    <li><a name="200" href="<?=$shop['path']?>/adm/design_top.php" class="off"><span>상단 (TOP)<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/design_menu.php" class="off"><span>메뉴 (MENU)<b></b></span></a></li>
    <li><a name="202" href="<?=$shop['path']?>/adm/design_bottom.php" class="off"><span>하단 (BOTTOM)<b></b></span></a></li>
    <li><a name="203" href="<?=$shop['path']?>/adm/design_main.php" class="off"><span>메인중앙 (MAIN)<b></b></span></a></li>
    <li><a name="204" href="<?=$shop['path']?>/adm/design_wmbar.php" class="off"><span>가로 메뉴바 (WMBAR)<b></b></span></a></li>
    <li><a name="205" href="<?=$shop['path']?>/adm/design_hmbar.php" class="off"><span>세로 메뉴바 (HMBAR)<b></b></span></a></li>
</ul>
<ul class="line"><li></li></ul>
<ul class="mt hover" style="margin-top:8px;">
    <li><a name="300" href="<?=$shop['path']?>/adm/design_item.php" class="off"><span>상품 페이지 설정</span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
<ul class="mt hover" style="margin-top:8px;">
    <li><a name="400" href="<?=$shop['path']?>/adm/design_image.php" class="off"><span>기타 이미지 설정</span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/design_font.php" class="off"><span>기타 폰트 설정</span></a></li>
    <li><a name="402" href="<?=$shop['path']?>/adm/design_skin.php" class="off"><span>기타 스킨 설정</span></a></li>
</ul>
<ul class="line" style="margin-top:8px;"><li></li></ul>
</div>
<div class="view_box tab9_view">
<ul class="title"><img src="<?=$shop['image_path']?>/adm/menu_title09.gif"></ul>
<ul class="mt hover">
    <li><a name="100" href="<?=$shop['path']?>/adm/config_dmshop.php" class="off"><span>기본 환경설정<b></b></span></a></li>
    <li><a name="101" href="<?=$shop['path']?>/adm/config_version.php" class="off"><span>솔루션 업데이트<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:8px;">
    <li><span>서비스 연동</span></li>
</ul>
<ul class="ms hover">
    <li><a name="200" href="<?=$shop['path']?>/adm/config_pg.php" class="off"><span>전자결제 (PG)<b></b></span></a></li>
    <li><a name="201" href="<?=$shop['path']?>/adm/config_sms.php" class="off"><span>문자 (SMS)<b></b></span></a></li>
    <li><a name="203" href="<?=$shop['path']?>/adm/config_delivery.php" class="off"><span>배송·택배<b></b></span></a></li>
    <li><a name="204" href="<?=$shop['path']?>/adm/config_syndi.php" class="off"><span>신디케이션<b></b></span></a></li>
    <li><a name="205" href="<?=$shop['path']?>/adm/config_social.php" class="off"><span>소셜<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>회원 가입·약관</span></li>
</ul>
<ul class="ms hover">
    <li><a name="300" href="<?=$shop['path']?>/adm/config_signup.php" class="off"><span>회원가입 양식<b></b></span></a></li>
    <li><a name="301" href="<?=$shop['path']?>/adm/config_service.php" class="off"><span>서비스 이용약관<b></b></span></a></li>
    <li><a name="302" href="<?=$shop['path']?>/adm/config_privacy.php" class="off"><span>개인정보 취급방침<b></b></span></a></li>
</ul>
<ul class="ma" style="margin-top:1px;">
    <li><span>공통설정</span></li>
</ul>
<ul class="ms hover">
    <li><a name="400" href="<?=$shop['path']?>/adm/config_item.php" class="off"><span>상품배송 안내<b></b></span></a></li>
    <li><a name="401" href="<?=$shop['path']?>/adm/config_refund.php" class="off"><span>환불규정 안내<b></b></span></a></li>
</ul>
<ul class="line" style="margin-top:1px;"><li></li></ul>
</div>
<div class="view_box tab10_view">&nbsp;</div>
</div>
</div>

<script type="text/javascript">
var left_id = <?=text($left_id)?>;
var menu_id = <?=text($menu_id)?>;

$(function() {

    var leftMenu = function(mode) {

        if (mode == 'open') {

            if (left_id != '10') {

                $(".contents .btn_open").hide();
                $(".contents .btn_close").show();

            }

            $(".contents").addClass("left_menu_bg1");
            $(".left_menu").show();
            $.cookie('left_menu', 'ok', { expires: 0, path: '/' });

        } else {

            if (left_id != '10') {

                $(".contents .btn_open").show();
                $(".contents .btn_close").hide();

            }

            $(".contents").removeClass("left_menu_bg1");
            $(".left_menu").hide();
            $.cookie('left_menu', 'ok', { expires: 1, path: '/' });

        }

    };

    var leftTab = function(mode, this_id) {

        if (mode == 'load' || mode == 'out' || mode == 'click') {

            $(".left_menu .tab a[name='1']").removeClass("tab1_on");
            $(".left_menu .tab a[name='2']").removeClass("tab2_on");
            $(".left_menu .tab a[name='3']").removeClass("tab3_on");
            $(".left_menu .tab a[name='4']").removeClass("tab4_on");
            $(".left_menu .tab a[name='5']").removeClass("tab5_on");
            $(".left_menu .tab a[name='6']").removeClass("tab6_on");
            $(".left_menu .tab a[name='7']").removeClass("tab7_on");
            $(".left_menu .tab a[name='8']").removeClass("tab8_on");
            $(".left_menu .tab a[name='9']").removeClass("tab9_on");
            $(".left_menu .tab a[name='10']").removeClass("tab10_on");
            $(".left_menu .tab a[name='"+this_id+"']").addClass("tab"+this_id+"_on");

        }

        if (this_id == '10') {

            if (mode == 'load' || mode == 'out') {

                $(".left_menu .tab_view .view_box").hide();
                $(".contents .ads").hide();
                $(".contents .btn_close").hide();
                $(".left_menu").css({ 'min-width' : '50px', 'width' : '52px' });
                $(".contents").addClass("left_menu_bg2");

            }

            return false;

        }

        if (mode == 'load' || mode == 'out' || mode == 'click') {

            $(".left_menu .tab_view .view_box").hide();

            $(".left_menu .tab_view .tab"+this_id+"_view").show();
            $(".left_menu .tab_view .tab"+left_id+"_view .hover a[name='"+menu_id+"']").addClass("this");

            $(".contents .ads").show();
            $(".contents .btn_close").show();
            $(".left_menu").css({ 'min-width' : '220px', 'width' : '220px' });
            $(".contents").removeClass("left_menu_bg2");

            $.post("./left_menu_load.php", {"left_id" : this_id}, function(data) {

                $("#dmshop_update").html(data);

            });

        }

    };

    $(".left_menu .tab a").mouseenter(function() {

        leftTab('over', $(this).attr("name"), '');

    });

    $(".left_menu .tab a").click(function() {

        leftTab('click', $(this).attr("name"), '');

    });

    $(".left_menu .tab_view .hover a").mouseover(function() {

        $(this).addClass("on");

    }).mouseout(function(){

        $(this).removeClass("on");

    });

    $(".contents .btn_open").click(function() {

        leftMenu('open');

    });

    $(".contents .btn_close").click(function() {

        leftMenu('close');

    });

    $(".left_menu").mouseleave(function() {

        leftTab('out', left_id, 'ok');

    });

    var left_menu_close = $.cookie('left_menu');

    if (left_menu_close == 'ok') {

        leftTab('load', left_id, 'ok');
        leftMenu('close');

    } else {

        leftTab('load', left_id, 'ok');
        leftMenu('open');

    }

});
</script>