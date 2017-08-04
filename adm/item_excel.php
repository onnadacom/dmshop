<?php
include_once("./_dmshop.php");

if ($m == 'check_item') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = shop_item(addslashes($_POST['item_id'][$k]));

    }

} else {

    $sql_search = " where 1 ";

    if ($m == 'item') {

        $sql_search .= " ";

    }

    $result = sql_query(" select * from $shop[item_table] $sql_search order by datetime desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

}

$filename="item.xls";
header("Content-Type: application/vnd.ms-xls");
header("Content-Disposition: inline; filename=$filename");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$shop['charset']?>" />
<title>xls</title>
<style type="text/css">
.text {mso-number-format:"\@";mso-text-control:shrinktofit;white-space:nowrap;}
</style>
</head>
<body>

<? if ($m == 'item' || $m == 'check_item') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="31" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>전체상품 목록</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">등록일시</td>
    <td align="center" bgcolor="#d9d9d9">상품명</td>
    <td align="center" bgcolor="#d9d9d9">키워드</td>
    <td align="center" bgcolor="#d9d9d9">상품코드</td>
    <td align="center" bgcolor="#d9d9d9">분류1</td>
    <td align="center" bgcolor="#d9d9d9">분류2</td>
    <td align="center" bgcolor="#d9d9d9">분류3</td>
    <td align="center" bgcolor="#d9d9d9">분류4</td>
    <td align="center" bgcolor="#d9d9d9">기획전 전시</td>
    <td align="center" bgcolor="#d9d9d9">상품 아이콘</td>
    <td align="center" bgcolor="#d9d9d9">진열선호도</td>
    <td align="center" bgcolor="#d9d9d9">시중가격</td>
    <td align="center" bgcolor="#d9d9d9">판매가격</td>
    <td align="center" bgcolor="#d9d9d9">적립금</td>
    <td align="center" bgcolor="#d9d9d9">주문옵션</td>
    <td align="center" bgcolor="#d9d9d9">재고수량</td>
    <td align="center" bgcolor="#d9d9d9">판매상태</td>
    <td align="center" bgcolor="#d9d9d9">안내1</td>
    <td align="center" bgcolor="#d9d9d9">안내2</td>
    <td align="center" bgcolor="#d9d9d9">안내3</td>
    <td align="center" bgcolor="#d9d9d9">안내4</td>
    <td align="center" bgcolor="#d9d9d9">안내5</td>
    <td align="center" bgcolor="#d9d9d9">안내6</td>
    <td align="center" bgcolor="#d9d9d9">안내7</td>
    <td align="center" bgcolor="#d9d9d9">안내8</td>
    <td align="center" bgcolor="#d9d9d9">안내9</td>
    <td align="center" bgcolor="#d9d9d9">안내10</td>
    <td align="center" bgcolor="#d9d9d9">조회수</td>
    <td align="center" bgcolor="#d9d9d9">누적 판매수량</td>
    <td align="center" bgcolor="#d9d9d9">상품평</td>
    <td align="center" bgcolor="#d9d9d9">상품문의</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr height="25">
    <td align="center"><?=text($list[$i]['datetime'])?></td>
    <td align="center"><?=text($list[$i]['item_title'])?></td>
    <td align="center"><?=text($list[$i]['item_keyword'])?></td>
    <td align="center"><?=text($list[$i]['item_code'])?></td>
    <td align="center"><?=shop_category_name($list[$i]['category1']);?></td>
    <td align="center"><?=shop_category_name($list[$i]['category2']);?></td>
    <td align="center"><?=shop_category_name($list[$i]['category3']);?></td>
    <td align="center"><?=shop_category_name($list[$i]['category4']);?></td>
    <td align="center">
<?
// 기획전 리스트
$result = sql_query(" select * from $shop[plan_item_table] where item_id = '".$list[$i]['id']."' order by position desc, datetime desc ");
for ($k=0; $row=sql_fetch_array($result); $k++) {

    if ($k > '0') {

        echo ", ";

    }

    echo text(shop_plan_name($row['plan_id']));

}
?>
    </td>
    <td align="center">
<?
$n = 0;
$str = explode("|", $list[$i]['item_icon']);
for ($k=0; $k<count($str); $k++) {

    if ($str[$k]) {

        $n++;

        if ($n > '1') {

            echo ", ";

        }

        $icon = shop_icon_file($str[$k]);

        if ($icon['id']) {

            echo text($icon['title']);

        } else {

            echo "[icon id : ".$str[$k]." 삭제됨]";

        }

    }

}
?>
    </td>
    <td align="center"><?=text($list[$i]['item_position'])?></td>
    <td align="center"><?=text($list[$i]['item_price'])?></td>
    <td align="center"><?=text($list[$i]['item_money'])?></td>
    <td align="center"><?=text($list[$i]['item_cash'])?></td>
    <td align="center">
<?
// 상품 옵션 사용
if ($list[$i]['item_option_use']) {

    $result = sql_query(" select * from $shop[item_option_table] where item_id = '".$list[$i]['id']."' and option_mode = '1' order by option_position asc ");
    for ($k=0; $row=sql_fetch_array($result); $k++) {

        if ($row['id']) {

            if ($k > '0') {

                echo ", ";

            }

            echo text($row['option_name'])."(".text($row['option_money']).")";

        }

    }

}
?>
    </td>
    <td align="center"><?=text($list[$i]['item_limit'])?></td>
    <td align="center">
<?
if ($list[$i]['item_use'] == '0') {

    echo "판매가능";

}

else if ($list[$i]['item_use'] == '1') {

    echo "일시중지";

}

else if ($list[$i]['item_use'] == '2') {

    echo "품절";

}

else if ($list[$i]['item_use'] == '3') {

    echo "숨김";

} else {

    echo "";

}
?>
    </td>
    <td align="center"><? if ($list[$i]['item_option1'] || $list[$i]['item_option1_text']) { echo text($list[$i]['item_option1'])." : ".text($list[$i]['item_option1_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option2'] || $list[$i]['item_option2_text']) { echo text($list[$i]['item_option2'])." : ".text($list[$i]['item_option2_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option3'] || $list[$i]['item_option3_text']) { echo text($list[$i]['item_option3'])." : ".text($list[$i]['item_option3_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option4'] || $list[$i]['item_option4_text']) { echo text($list[$i]['item_option4'])." : ".text($list[$i]['item_option4_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option5'] || $list[$i]['item_option5_text']) { echo text($list[$i]['item_option5'])." : ".text($list[$i]['item_option5_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option6'] || $list[$i]['item_option6_text']) { echo text($list[$i]['item_option6'])." : ".text($list[$i]['item_option6_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option7'] || $list[$i]['item_option7_text']) { echo text($list[$i]['item_option7'])." : ".text($list[$i]['item_option7_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option8'] || $list[$i]['item_option8_text']) { echo text($list[$i]['item_option8'])." : ".text($list[$i]['item_option8_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option9'] || $list[$i]['item_option9_text']) { echo text($list[$i]['item_option9'])." : ".text($list[$i]['item_option9_text']); } ?></td>
    <td align="center"><? if ($list[$i]['item_option10'] || $list[$i]['item_option10_text']) { echo text($list[$i]['item_option10'])." : ".text($list[$i]['item_option10_text']); } ?></td>
    <td align="center"><?=text($list[$i]['item_hit'])?></td>
    <td align="center"><?=text($list[$i]['item_sale'])?></td>
    <td align="center"><?=text($list[$i]['item_reply'])?></td>
    <td align="center"><?=text($list[$i]['item_qna'])?></td>
</tr>
<? } ?>
</table>
<? } ?>

</body>
</html>