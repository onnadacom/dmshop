<?
if (!defined('_DMSHOP_')) exit;

if ($dmshop_skin['skin_sub_top']) { $dmshop_top_path = $shop['path']."/skin/top/".$dmshop_skin['skin_sub_top']; } else { $dmshop_top_path = $dmshop_layout_path; }
if ($dmshop_skin['skin_sub_menu']) { $dmshop_menu_path = $shop['path']."/skin/menu/".$dmshop_skin['skin_sub_menu']; } else { $dmshop_menu_path = $dmshop_layout_path; }

// 가입 (약관,폼,완료)
if ($page_id == 'signup' && $m == '' || $page_id == 'signup_form' && $m == '' || $page_id == 'signup_result' && $m == '') {

    // pass

}

// 카트, 주문, 검색
else if ($page_id == 'cart' || $page_id == 'order' || $page_id == 'search') {

    // 레이아웃 메뉴 제거형으로 변경
    $layout_auto_set = 2;

} else {
// 기타

    // 마이페이지
    if ($dmshop_mypage_path || $page_id == 'faq') {

        // 레이아웃 메뉴 좌측 기본형으로 변경
        $layout_auto_set = 0;

        // faq 게시판일 때 마이페이지 호출
        if ($page_id == 'faq') {

            // 마이페이지 스킨경로 설정
            $dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

            // 왼쪽메뉴 스킨경로를 마이페이지로 설정
            $dmshop_menu_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

        } else {
        // 기타

            $dmshop_menu_path = $dmshop_mypage_path;

        }

    }

}

if ($dmshop_skin['skin_sub_bottom']) { $dmshop_bottom_path = $shop['path']."/skin/bottom/".$dmshop_skin['skin_sub_bottom']; } else { $dmshop_bottom_path = $dmshop_layout_path; }

include_once("$shop[path]/shop.top.php");
include_once("$dmshop_layout_path/layout.top.php");
?>