<?php
if (!defined('_DMSHOP_')) exit;

$list_line = "";
for ($k=1; $k<=$list['category']; $k++) {

    if ($k == '1') {

        if ($list_category_ic1) {

            $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:0px;'>&nbsp;</div></td>";

        } else {

            $n++;

            if ($n == '1') {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:0px;'>&nbsp;</div></td>";

            } else {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:0px;'>&nbsp;</div></td>";

            }

        }

    }

    else if ($k == '2') {

        if ($list_category_ic2) {

            $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

        } else {

            $nn++;

            if ($nn == '1') {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

            } else {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'>&nbsp;</div></td>";

            }

        }

    }

    else if ($k == '3') {

        if ($list_category_ic3) {

            $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

        } else {

            $nnn++;

            if ($nnn == '1') {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

            } else {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'>&nbsp;</div></td>";

            }

        }

    }

    else if ($k == '4') {

        if ($list_category_ic4) {

            $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

        } else {

            $nnnn++;

            if ($nnnn == '1') {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'><div class='category_line'>&nbsp;</div></div></td>";

            } else {

                $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'>&nbsp;</div></td>";

            }

        }

    } else {

        $list_line .= "<td valign='top'><div style='position:relative; left:0; top:0; width:25px;'>&nbsp;</div></td>";

    }

}

$list_margin = "";
if ($list['category'] == '1') {

    $list_margin = "<td width='15></td>";
    $list_color = "#fffee7";

} else {

    $list_margin = "<td width='0'></td>";
    $list_color = "#ffffff";

}

$list_data .= "<input type='hidden' name='category_id[".$c."]' value='".$list['id']."' />";
$list_data .= "<tr height='39' bgcolor='".$list_color."'>
    <td></td>
    <td class='chk_id'><input type='checkbox' name='chk_id[]' value='".$c."' class='checkbox' /></td>
    <td class='bc1'></td>
    <td align='center'>
<select id='view[".$c."]' name='view[".$c."]' class='select'>
    <option value='1'>보임</option>
    <option value='0'>숨김</option>
</select>
    </td>
    <td class='bc1'></td>
    <td valign='top'>
<table border='0' cellspacing='0' cellpadding='0'>
<tr height='39'>
".$list_margin.$list_line."
    <td valign='top'>
<table border='0' cellspacing='0' cellpadding='0' style='margin-top:10px;'>
<tr>
    <td width='1'></td>
    <td><img src='".$shop['image_path']."/adm/category".$list['category'].".gif' class='ic'></td>
    <td width='10'></td>
    <td><input type='text' name='subject[".$c."]' value='".text($list['subject'])."' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:200px;' /></td>
    <td width='10'></td>
    <td><a href='".$shop['path']."/list.php?ct_id=".$list['id']."' target='_blank'><img src='".$shop['image_path']."/adm/blank.gif' border='0'></a></td>
</tr>
</table>
    </td>
</tr>
</table></td>
    <td class='bc1'></td>
    <td align='center'>
<table border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td><input type='text' name='item_width[".$c."]' value='".$list['item_width']."' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:33px;' /></td>
    <td width='4'></td>
    <td class='tx1'>개 /</td>
    <td width='4'></td>
    <td><input type='text' name='item_height[".$c."]' value='".$list['item_height']."' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:33px;' /></td>
    <td width='4'></td>
    <td class='tx1'>개</td>
</tr>
</table>
    </td>
    <td class='bc1'></td>
    <td align='center'>
<table border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td><input type='text' name='thumb_width[".$c."]' value='".$list['thumb_width']."' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:33px;' /></td>
    <td width='4'></td>
    <td class='tx1'>px /</td>
    <td width='4'></td>
    <td><input type='text' name='thumb_height[".$c."]' value='".$list['thumb_height']."' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:33px;' /></td>
    <td width='4'></td>
    <td class='tx1'>px</td>
</tr>
</table>
    </td>
    <td class='bc1'></td>
    <td align='right' class='none'>
<table border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td><a href='./category_setting.php?id=".$list['id']."'><img src='".$shop['image_path']."/adm/list_config.gif' border='0'></a></td>
    <td width='4'></td>
    <td><a href='#' onclick=\"listDelete('".$list['id']."'); return false;\"><img src='".$shop['image_path']."/adm/list_delete.gif' border='0'></a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan='".$colspan."' height='1' class='bc1'></td></tr>";

$list_data_script .= "document.getElementById('view[".$c."]').value = '".$list['view']."';";
?>