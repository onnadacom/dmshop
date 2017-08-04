<?
define("_DMSHOP_", TRUE);

$shop['charset'] = "utf-8";

$shop['image_path'] = $shop['path']."/image/shop";

$shop['smarteditor'] = "smarteditor";
$shop['smarteditor_path'] = $shop['path']."/".$shop['smarteditor'];

$shop['cheditor'] = "cheditor";
$shop['cheditor_path'] = $shop['path']."/".$shop['cheditor'];

$shop['server_time'] = time();
$shop['time_ymd']    = date("Y-m-d", $shop['server_time']);
$shop['time_his']    = date("H:i:s", $shop['server_time']);
$shop['time_ymdhis'] = date("Y-m-d H:i:s", $shop['server_time']);

$shop['table_prefix'] = "shop_";
$shop['session_table'] = $shop['table_prefix'] . "session"; // 세션
$shop['config_table'] = $shop['table_prefix'] . "config"; // 환경설정
$shop['signup_table'] = $shop['table_prefix'] . "signup"; // 가입설정
$shop['real_table'] = $shop['table_prefix'] . "real"; // 인증로그
$shop['service_table'] = $shop['table_prefix'] . "service"; // 서비스설정
$shop['service_file_table'] = $shop['table_prefix'] . "service_file"; // 서비스설정 파일
$shop['category_table'] = $shop['table_prefix'] . "category"; // 카테고리
$shop['category_file_table'] = $shop['table_prefix'] . "category_file"; // 카테고리 파일
$shop['item_table'] = $shop['table_prefix'] . "item"; // 상품
$shop['item_file_table'] = $shop['table_prefix'] . "item_file"; // 상품 파일
$shop['item_gallery_file_table'] = $shop['table_prefix'] . "item_gallery_file"; // 상품 갤러리 파일
$shop['item_option_table'] = $shop['table_prefix'] . "item_option"; // 상품 옵션
$shop['item_view_table'] = $shop['table_prefix'] . "item_view"; // 내가 본 상품
$shop['plan_table'] = $shop['table_prefix'] . "plan"; // 기획전
$shop['plan_file_table'] = $shop['table_prefix'] . "plan_file"; // 기획전 파일
$shop['plan_item_table'] = $shop['table_prefix'] . "plan_item"; // 기획전 상품
$shop['plan_item_file_table'] = $shop['table_prefix'] . "plan_item_file"; // 기획전 상품 파일
$shop['icon_table'] = $shop['table_prefix'] . "icon"; // 상품 아이콘
$shop['icon_file_table'] = $shop['table_prefix'] . "icon_file"; // 상품 아이콘 파일
$shop['relation_table'] = $shop['table_prefix'] . "relation"; // 관련상품
$shop['reply_table'] = $shop['table_prefix'] . "reply"; // 상품평
$shop['reply_file_table'] = $shop['table_prefix'] . "reply_file"; // 상품평 파일
$shop['qna_table'] = $shop['table_prefix'] . "qna"; // 상품문의
$shop['qna_file_table'] = $shop['table_prefix'] . "qna_file"; // 상품문의 파일
$shop['cart_table'] = $shop['table_prefix'] . "cart"; // 장바구니
$shop['favorite_table'] = $shop['table_prefix'] . "favorite"; // 관심상품
$shop['payment_table'] = $shop['table_prefix'] . "payment"; // 개별결제
$shop['order_table'] = $shop['table_prefix'] . "order"; // 주문내역
$shop['coupon_table'] = $shop['table_prefix'] . "coupon"; // 쿠폰
$shop['coupon_file_table'] = $shop['table_prefix'] . "coupon_file"; // 쿠폰 파일
$shop['coupon_list_table'] = $shop['table_prefix'] . "coupon_list"; // 쿠폰 내역
$shop['sms_config_table'] = $shop['table_prefix'] . "sms_config"; // sms 설정
$shop['sms_log_table'] = $shop['table_prefix'] . "sms_log"; // sms log
$shop['sms_auto_table'] = $shop['table_prefix'] . "sms_auto"; // sms auto
$shop['memo_table'] = $shop['table_prefix'] . "memo"; // 주문내역메모
$shop['help_table'] = $shop['table_prefix'] . "help"; // 1:1문의
$shop['help_file_table'] = $shop['table_prefix'] . "help_file"; // 1:1문의 파일
$shop['cash_table'] = $shop['table_prefix'] . "cash"; // cash 내역
$shop['user_table'] = $shop['table_prefix'] . "user"; // 회원테이블
$shop['user_level_table'] = $shop['table_prefix'] . "user_level"; // 회원 레벨명
$shop['user_level_file_table'] = $shop['table_prefix'] . "user_level_file"; // 등급설정 파일
$shop['user_memo_table'] = $shop['table_prefix'] . "user_memo"; // 회원 메모
$shop['user_login_table'] = $shop['table_prefix'] . "user_login"; // 회원 로그인
$shop['page_table'] = $shop['table_prefix'] . "page"; // 페이지
$shop['banner_group_table'] = $shop['table_prefix'] . "banner_group"; // 배너그룹
$shop['banner_table'] = $shop['table_prefix'] . "banner"; // 배너
$shop['popup_table'] = $shop['table_prefix'] . "popup"; // 팝업
$shop['visit_table'] = $shop['table_prefix'] . "visit"; // 방문자
$shop['calendar_table'] = $shop['table_prefix'] . "calendar"; // 캘린더
$shop['bookmark_table'] = $shop['table_prefix'] . "bookmark"; // 바로가기
$shop['board_table'] = $shop['table_prefix'] . "board"; // 게시판 설정
$shop['article_table'] = $shop['table_prefix'] . "article_"; // 게시판 테이블
$shop['article_reply_table'] = $shop['table_prefix'] . "article_reply"; // 댓글 테이블
$shop['article_file_table'] = $shop['table_prefix'] . "article_file"; // 게시판 파일 테이블

// 디자인
$shop['design_table'] = $shop['table_prefix'] . "design"; // 디자인설정
$shop['design_skin_table'] = $shop['table_prefix'] . "design_skin"; // 디자인스킨
$shop['design_top_table'] = $shop['table_prefix'] . "design_top"; // 상단스킨
$shop['design_bottom_table'] = $shop['table_prefix'] . "design_bottom"; // 하단스킨
$shop['design_menu_table'] = $shop['table_prefix'] . "design_menu"; // 메뉴스킨
$shop['design_wmbar_table'] = $shop['table_prefix'] . "design_wmbar"; // 가로메뉴바
$shop['design_wmlist_table'] = $shop['table_prefix'] . "design_wmlist"; // 가로메뉴 리스트
$shop['design_hmbar_table'] = $shop['table_prefix'] . "design_hmbar"; // 세로메뉴바
$shop['design_hmlist_table'] = $shop['table_prefix'] . "design_hmlist"; // 세로메뉴 리스트
$shop['design_image_table'] = $shop['table_prefix'] . "design_image"; // 통합이미지 설정
$shop['design_item_table'] = $shop['table_prefix'] . "design_item"; // 상품페이지
$shop['design_font_table'] = $shop['table_prefix'] . "design_font"; // 통합폰트 설정
$shop['design_file_table'] = $shop['table_prefix'] . "design_file"; // 디자인설정 파일
$shop['display_box_type_table'] = $shop['table_prefix'] . "display_box_type"; // display_box_type
$shop['display_box_list_table'] = $shop['table_prefix'] . "display_box_list"; // display_box_list
$shop['display_box_file_table'] = $shop['table_prefix'] . "display_box_file"; // display_box_file
$shop['display_item_table'] = $shop['table_prefix'] . "display_item"; // 메인중앙 등록상품

// gifsicle 사용시 경로
$shop['gifsicle_path'] = "/usr/local/bin/gifsicle";
$shop['gifsicle_use'] = "0";
?>