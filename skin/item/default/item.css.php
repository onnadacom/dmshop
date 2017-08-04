<?
if (!defined('_DMSHOP_')) exit;

// 스타일 처리
echo "\n<style type=\"text/css\">\n";

// 상품명
echo ".item_information .item_title {";
if ($dmshop_design_item['item_title_font_family']) { echo "font-family:".$dmshop_design_item['item_title_font_family'].";"; }
if ($dmshop_design_item['item_title_font_size']) { echo "font-size:".$dmshop_design_item['item_title_font_size']."px;"; }
if ($dmshop_design_item['item_title_font_color']) { echo "color:#".$dmshop_design_item['item_title_font_color'].";"; }
if ($dmshop_design_item['item_title_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_title_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_title_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 상품정보 항목(서브타이틀)
echo ".item_information .item_subtitle {";
if ($dmshop_design_item['item_subtitle_font_family']) { echo "font-family:".$dmshop_design_item['item_subtitle_font_family'].";"; }
if ($dmshop_design_item['item_subtitle_font_size']) { echo "font-size:".$dmshop_design_item['item_subtitle_font_size']."px;"; }
if ($dmshop_design_item['item_subtitle_font_color']) { echo "color:#".$dmshop_design_item['item_subtitle_font_color'].";"; }
if ($dmshop_design_item['item_subtitle_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_subtitle_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_subtitle_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 시중가격
echo ".item_information .item_price {";
if ($dmshop_design_item['item_price_font_family']) { echo "font-family:".$dmshop_design_item['item_price_font_family'].";"; }
if ($dmshop_design_item['item_price_font_size']) { echo "font-size:".$dmshop_design_item['item_price_font_size']."px;"; }
if ($dmshop_design_item['item_price_font_color']) { echo "color:#".$dmshop_design_item['item_price_font_color'].";"; }
if ($dmshop_design_item['item_price_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_price_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_price_font_underline']) { echo "text-decoration:line-through;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 판매가격
echo ".item_information .item_money {";
if ($dmshop_design_item['item_money_font_family']) { echo "font-family:".$dmshop_design_item['item_money_font_family'].";"; }
if ($dmshop_design_item['item_money_font_size']) { echo "font-size:".$dmshop_design_item['item_money_font_size']."px;"; }
if ($dmshop_design_item['item_money_font_color']) { echo "color:#".$dmshop_design_item['item_money_font_color'].";"; }
if ($dmshop_design_item['item_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 적립금
echo ".item_information .item_cash {";
if ($dmshop_design_item['item_cash_font_family']) { echo "font-family:".$dmshop_design_item['item_cash_font_family'].";"; }
if ($dmshop_design_item['item_cash_font_size']) { echo "font-size:".$dmshop_design_item['item_cash_font_size']."px;"; }
if ($dmshop_design_item['item_cash_font_color']) { echo "color:#".$dmshop_design_item['item_cash_font_color'].";"; }
if ($dmshop_design_item['item_cash_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_cash_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_cash_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 재고수량
echo ".item_information .item_limit {";
if ($dmshop_design_item['item_limit_font_family']) { echo "font-family:".$dmshop_design_item['item_limit_font_family'].";"; }
if ($dmshop_design_item['item_limit_font_size']) { echo "font-size:".$dmshop_design_item['item_limit_font_size']."px;"; }
if ($dmshop_design_item['item_limit_font_color']) { echo "color:#".$dmshop_design_item['item_limit_font_color'].";"; }
if ($dmshop_design_item['item_limit_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_limit_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_limit_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 판매수량
echo ".item_information .item_sale_limit {";
if ($dmshop_design_item['item_sale_limit_font_family']) { echo "font-family:".$dmshop_design_item['item_sale_limit_font_family'].";"; }
if ($dmshop_design_item['item_sale_limit_font_size']) { echo "font-size:".$dmshop_design_item['item_sale_limit_font_size']."px;"; }
if ($dmshop_design_item['item_sale_limit_font_color']) { echo "color:#".$dmshop_design_item['item_sale_limit_font_color'].";"; }
if ($dmshop_design_item['item_sale_limit_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_sale_limit_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_sale_limit_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 배송비
echo ".item_information .item_delivery_money {";
if ($dmshop_design_item['item_delivery_money_font_family']) { echo "font-family:".$dmshop_design_item['item_delivery_money_font_family'].";"; }
if ($dmshop_design_item['item_delivery_money_font_size']) { echo "font-size:".$dmshop_design_item['item_delivery_money_font_size']."px;"; }
if ($dmshop_design_item['item_delivery_money_font_color']) { echo "color:#".$dmshop_design_item['item_delivery_money_font_color'].";"; }
if ($dmshop_design_item['item_delivery_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_delivery_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_delivery_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 주문금액
echo ".item_information .item_total_money {";
if ($dmshop_design_item['item_total_money_font_family']) { echo "font-family:".$dmshop_design_item['item_total_money_font_family'].";"; }
if ($dmshop_design_item['item_total_money_font_size']) { echo "font-size:".$dmshop_design_item['item_total_money_font_size']."px;"; }
if ($dmshop_design_item['item_total_money_font_color']) { echo "color:#".$dmshop_design_item['item_total_money_font_color'].";"; }
if ($dmshop_design_item['item_total_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_total_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_total_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 관련 상품명
echo ".relation_box .item_relation_title {";
if ($dmshop_design_item['item_relation_title_font_family']) { echo "font-family:".$dmshop_design_item['item_relation_title_font_family'].";"; }
if ($dmshop_design_item['item_relation_title_font_size']) { echo "font-size:".$dmshop_design_item['item_relation_title_font_size']."px;"; }
if ($dmshop_design_item['item_relation_title_font_color']) { echo "color:#".$dmshop_design_item['item_relation_title_font_color'].";"; }
if ($dmshop_design_item['item_relation_title_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_relation_title_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_relation_title_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 관련 상품 가격
echo ".relation_box .item_relation_money {";
if ($dmshop_design_item['item_relation_money_font_family']) { echo "font-family:".$dmshop_design_item['item_relation_money_font_family'].";"; }
if ($dmshop_design_item['item_relation_money_font_size']) { echo "font-size:".$dmshop_design_item['item_relation_money_font_size']."px;"; }
if ($dmshop_design_item['item_relation_money_font_color']) { echo "color:#".$dmshop_design_item['item_relation_money_font_color'].";"; }
if ($dmshop_design_item['item_relation_money_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_relation_money_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_relation_money_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 요약안내 항목
echo ".item_information .item_optiontitle {";
if ($dmshop_design_item['item_optiontitle_font_family']) { echo "font-family:".$dmshop_design_item['item_optiontitle_font_family'].";"; }
if ($dmshop_design_item['item_optiontitle_font_size']) { echo "font-size:".$dmshop_design_item['item_optiontitle_font_size']."px;"; }
if ($dmshop_design_item['item_optiontitle_font_color']) { echo "color:#".$dmshop_design_item['item_optiontitle_font_color'].";"; }
if ($dmshop_design_item['item_optiontitle_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_optiontitle_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_optiontitle_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 요약안내 내용
echo ".item_information .item_optioncontent {width:30%; padding:5px 0;";
if ($dmshop_design_item['item_optioncontent_font_family']) { echo "font-family:".$dmshop_design_item['item_optioncontent_font_family'].";"; }
if ($dmshop_design_item['item_optioncontent_font_size']) { echo "font-size:".$dmshop_design_item['item_optioncontent_font_size']."px;"; }
if ($dmshop_design_item['item_optioncontent_font_color']) { echo "color:#".$dmshop_design_item['item_optioncontent_font_color'].";"; }
if ($dmshop_design_item['item_optioncontent_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['item_optioncontent_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['item_optioncontent_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

// 도움말
echo ".item_information .help {";
if ($dmshop_design_item['help_font_family']) { echo "font-family:".$dmshop_design_item['help_font_family'].";"; }
if ($dmshop_design_item['help_font_size']) { echo "font-size:".$dmshop_design_item['help_font_size']."px;"; }
if ($dmshop_design_item['help_font_color']) { echo "color:#".$dmshop_design_item['help_font_color'].";"; }
if ($dmshop_design_item['help_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
if ($dmshop_design_item['help_font_italic']) { echo "font-style:italic;"; } else { echo "font-style:normal;"; }
if ($dmshop_design_item['help_font_underline']) { echo "text-decoration:underline;"; } else { echo "text-decoration:none;"; }
echo "}\n";

echo "</style>\n";
?>

<style type="text/css">
/* 분류 */
.item_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.item_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.item_position .title {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.item_position .code {line-height:14px; font-size:11px; color:#00a651; font-family:gulim,굴림;}

.item_next a {font-weight:bold; line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.item_next a:hover {font-weight:bold; line-height:14px; font-size:11px; color:#787878; font-family:gulim,굴림;}

/* 대표이미지 */
#image_default_zoom {display:block; <? if ($dmshop_design_item['image_default1_border']) { echo "border:".$dmshop_design_item['image_default1_border']."px solid #".$dmshop_design_item['image_default1_border_color']; } ?>}
#image_default_zoom .on {<? if ($dmshop_design_item['image_default2_border']) { echo "border:".$dmshop_design_item['image_default2_border']."px solid #".$dmshop_design_item['image_default2_border_color']; } else { if ($dmshop_design_item['image_default1_border']) { echo "border:0px;"; } } ?>}

.cloud-zoom-big {<? if ($dmshop_design_item['image_default2_border']) { echo "border:".$dmshop_design_item['image_default2_border']."px solid #".$dmshop_design_item['image_default2_border_color']; } else { if ($dmshop_design_item['image_default1_border']) { echo "border:0px;"; } } ?>}

/* 상품 갤러리 */
.item_gallery .btn_prev {width:10px; background:url('<?=$dmshop_item_path?>/img/btn_prev.gif') no-repeat left center; cursor:pointer;}
.item_gallery .btn_next {width:10px; background:url('<?=$dmshop_item_path?>/img/btn_next.gif') no-repeat right center; cursor:pointer;}
.item_gallery .btn_prev_out {width:10px;}
.item_gallery .btn_next_out {width:10px;}

.gallery_thumb {margin:0 auto;}
.gallery_thumb li {list-style:none; font-size:0px; line-height:0px; padding:0px;}
.gallery_thumb li img {<? if ($dmshop_design_item['image_gallery1_border']) { echo "border:".$dmshop_design_item['image_gallery1_border']."px solid #".$dmshop_design_item['image_gallery1_border_color']; } ?>; cursor:pointer; margin:0 3px 0 3px;}
.gallery_thumb li .on {<? if ($dmshop_design_item['image_gallery2_border']) { echo "border:".$dmshop_design_item['image_gallery2_border']."px solid #".$dmshop_design_item['image_gallery2_border_color']; } else { if ($dmshop_design_item['image_gallery1_border']) { echo "border:0px;"; } } ?>}

/* 관련상품 */
#relation_data .btn_prev {width:25px; background:url('<?=$dmshop_item_path?>/img/btn_prev2.gif') no-repeat center center; cursor:pointer;}
#relation_data .btn_next {width:25px; background:url('<?=$dmshop_item_path?>/img/btn_next2.gif') no-repeat center center; cursor:pointer;}
#relation_data .btn_prev_out {width:25px;}
#relation_data .btn_next_out {width:25px;}

.relation_list div {margin:0 18px 0 18px;}
.relation_list li {list-style:none;}
.relation_list li img {<? if ($dmshop_design_item['image_relation1_border']) { echo "border:".$dmshop_design_item['image_relation1_border']."px solid #".$dmshop_design_item['image_relation1_border_color']; } ?>}
.relation_list li .on {<? if ($dmshop_design_item['image_relation2_border']) { echo "border:".$dmshop_design_item['image_relation2_border']."px solid #".$dmshop_design_item['image_relation2_border_color']; } else { if ($dmshop_design_item['image_relation1_border']) { echo "border:0px;"; } } ?>}

/* 상품정보박스 */
.item_information .select {min-width:200px; height:18px; border:1px solid #c1c1c1; background-color:#ffffe5;}
.item_information .select {line-height:14px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.item_information .select option {padding:0px 3px 0px 3px; line-height:20px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.item_information .input {width:22px; height:17px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.item_information .input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}

.item_information .order_title {font-weight:bold; line-height:14px; font-size:11px; color:#888888; font-family:dotum,돋움;}
.item_information .order_title2 {line-height:14px; font-size:12px; color:#888888; font-family:dotum,돋움;}
.item_information .order_limit {line-height:14px; font-size:11px; color:#393939; font-family:gulim,굴림;}
.item_information .order_money {font-weight:bold; line-height:14px; font-size:11px; color:#393939; font-family:gulim,굴림;}
.item_information .sns_box {border:1px solid #eaeaea; width:100%; height:28px; background:url('<?=$dmshop_item_path?>/img/sns_bg.gif') repeat-x;}

/* 상품안내 탭*/
.item_view .tab_use1_off {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat 0px 0px;}
.item_view .tab_use1_on {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat 0px -32px;}
.item_view .tab_use2_off {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -141px 0px;}
.item_view .tab_use2_on {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -141px -32px;}
.item_view .tab_use3_off {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -282px 0px;}
.item_view .tab_use3_on {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -282px -32px;}
.item_view .tab_use4_off {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -423px 0px;}
.item_view .tab_use4_on {width:141px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -423px -32px;}
.item_view .tab_use5_off {width:142px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -564px 0px;}
.item_view .tab_use5_on {width:142px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab.gif') no-repeat -564px -32px;}
.item_view .tab_bg {height:32px; background:url('<?=$dmshop_item_path?>/img/tab_bg.gif') repeat-x;}
.item_view .tab_side {width:1px; height:32px; background:url('<?=$dmshop_item_path?>/img/tab_side.gif') no-repeat;}

.item_view .tab_count1 {padding:0 0 0 87px; font-weight:bold; line-height:14px; font-size:11px; color:#393939; font-family:dotum,돋움;}
.item_view .tab_count2 {padding:3px 0 0 87px; font-weight:bold; line-height:14px; font-size:11px; color:#419dae; font-family:dotum,돋움;}

.item_view .pointer {cursor:pointer;}

/* 상품평 */
.item_reply .count {font-weight:bold; line-height:14px; font-size:11px; color:#419dae; font-family:dotum,돋움;}
.item_reply .title {line-height:14px; font-size:12px; color:#39393a; font-family:gulim,굴림;}
.item_reply .content {line-height:15px; font-size:12px; color:#707070; font-family:gulim,굴림;}
.item_reply .name {line-height:14px; font-size:11px; color:#707070; font-family:dotum,돋움;}

.item_reply .star0 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat;}
.item_reply .star1 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -18px;}
.item_reply .star2 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -36px;}
.item_reply .star3 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -54px;}
.item_reply .star4 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -72px;}
.item_reply .star5 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -90px;}

/* 상품문의 */
.item_qna .count {font-weight:bold; line-height:14px; font-size:11px; color:#419dae; font-family:dotum,돋움;}
.item_qna .category {line-height:14px; font-size:12px; color:#999999; font-family:gulim,굴림;}
.item_qna .title {line-height:14px; font-size:12px; color:#39393a; font-family:gulim,굴림;}
.item_qna .content {line-height:15px; font-size:12px; color:#707070; font-family:gulim,굴림;}
.item_qna .name {line-height:14px; font-size:11px; color:#707070; font-family:dotum,돋움;}

.item_qna .smile0 {width:74px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/qna_smile.png') no-repeat;}
.item_qna .smile1 {width:74px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/qna_smile.png') no-repeat 0px -18px;}
</style>