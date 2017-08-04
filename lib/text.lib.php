<?php
if (!defined('_DMSHOP_')) exit;

function shop_text_UCS2($text)
{

    $text = mb_convert_encoding($text, "UCS-2", "UTF-8");
    $data = "";
    for ($i=0; $i<strlen($text); $i+=2) {

        $data .= "&#".(ord(substr($text, $i, 1))*256+ord(substr($text, $i+1, 1))).";";

    }

    return $data;

}

// 이미지 생성
function shop_text_image($text, $font_file, $image_width, $image_height, $font_size, $font_color, $background_color, $transparent_background=false, $mode)
{

    global $shop;

    $text = shop_text_UCS2($text);

    $font_color = '#'.$font_color;
    $background_color = '#'.$background_color;

    if ($transparent_background) {

        $transparent_background  = false;

    } else {

        $transparent_background  = true;

    }

    $cache_images = true;
    $cache_folder = $shop['path']."/data/text/cache";

    $mime_type = 'image/png';
    $extension = '.png';
    $send_buffer_size = 4096;

    if (empty($text)) {
    
        return false;
    
    }

    if (get_magic_quotes_gpc()) {
    
        $text = stripslashes($text);
    
    }
    
    $text = javascript_to_html($text);
    
    // look for cached copy, send if it exists
    $hash = md5(basename($font_file) . $font_size . $font_color . $background_color . $transparent_background . $text);
    $cache_filename = $cache_folder . '/' . $hash . $extension;
    
    if (file_exists($cache_filename)) {

        if ($mode == 'path') {

            return $cache_filename;

        } else {

            return "<img src='".$cache_filename."' width='".$image_width."' height='".$image_height."' border='0'>";

        }

        return false;

    }

    if ($cache_images && ($file = @fopen($cache_filename,'rb'))) {

        while(!feof($file)) {
    
            print(($buffer = fread($file,$send_buffer_size)));
    
        }
    
        fclose($file);

        return false;
    
    }
    
    $font_found = is_readable($font_file);
    
    if (!$font_found) {
    
        //alert('지정된 폰트가 없습니다.');
        return false;
    
    }
    
    $background_rgb = hex_to_rgb($background_color);
    $font_rgb = hex_to_rgb($font_color);
    $dip = get_dip($font_file,$font_size);
    
/*
ImageTTFBBox
0 	lower left corner, X position
1 	lower left corner, Y position
2 	lower right corner, X position
3 	lower right corner, Y position
4 	upper right corner, X position
5 	upper right corner, Y position
6 	upper left corner, X position
7 	upper left corner, Y position
*/

    $box = @ImageTTFBBox($font_size, 0, $font_file, $text);

    $xcorr=0-$box[6]; //northwest X
    $ycorr=0-$box[7]; //northwest Y
    $tmp_box['left']=$box[6]+$xcorr;
    $tmp_box['top']=$box[7]+$ycorr;
    $tmp_box['width']=$box[2]+$xcorr;
    $tmp_box['height']=$box[3]+$ycorr;

    //$image = @ImageCreate(abs($box[2]-$box[0]),abs($box[5]-$dip));
    $image = @ImageCreate($image_width,$image_height);
    
    if(!$image || !$box) {
    
        //alert('Error: The server could not create this heading image.');
        return false;
    
    }
    
    $background_color = @ImageColorAllocate($image,$background_rgb['red'],$background_rgb['green'],$background_rgb['blue']);
    $font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);

    //ImageTTFText($image, $font_size, 0 , int $x , int $y , int $color , string $fontfile , string $text );
    //ImageTTFText($image, $font_size, 0, -$box[0], abs($box[5]-$box[3])-$box[1], $font_color, $font_file, $text);

    //ImageTTFText($image, $font_size, 0, 0, $tmp_box['height'], $font_color, $font_file, $text);
    ImageTTFText($image, $font_size, 0, 0, (int)(($image_height / 2) + ($font_size / 2)), $font_color, $font_file, $text);

    //echo "TTF : ".$box[0]."|".$box[1]."|".$box[2]."|".$box[3]."|".$box[4]."|".$box[5]."|".$box[6]."|".$box[7]."---".$tmp_box['left']."|".$tmp_box['top']."|".$tmp_box['width']."|".$tmp_box['height']."<br>";

    if ($transparent_background) {
    
        ImageColorTransparent($image,$background_color);
    
    }
    
    //header('Content-type: ' . $mime_type);
    //ImagePNG($image);
    
    if ($cache_images) {
    
        @ImagePNG($image,$cache_filename);

        ImageDestroy($image);

        if ($mode == 'path') {

            return $cache_filename;

        } else {

            return "<img src='".$cache_filename."' width='".$image_width."' height='".$image_height."' border='0'>";

        }

    } else {

        ImageDestroy($image);

        return false;

    }

}

function get_dip($font,$size)
{

    $test_chars = 'abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '1234567890' . '!@#$%^&*()\'"\\/;.,`~<>[]{}-+_-=';
    $box = @ImageTTFBBox($size,0,$font,$test_chars);

    return $box[3];

}

function hex_to_rgb($hex)
{

    if (substr($hex,0,1) == '#') {

        $hex = substr($hex,1);

    }

    if (strlen($hex) == 3) {

        $hex = substr($hex,0,1) . substr($hex,0,1) . substr($hex,1,1) . substr($hex,1,1) . substr($hex,2,1) . substr($hex,2,1);

    }

    if (strlen($hex) != 6) {

        //alert('Error: Invalid color "'.$hex.'"');
        return false;

    }

    $rgb['red'] = hexdec(substr($hex,0,2));
    $rgb['green'] = hexdec(substr($hex,2,2));
    $rgb['blue'] = hexdec(substr($hex,4,2));

    return $rgb;

}

function javascript_to_html($text)
{

    $matches = null;

    preg_match_all('/%u([0-9A-F]{4})/i',$text,$matches);

    if (!empty($matches)) {

        for($i=0;$i<sizeof($matches[0]);$i++) {

            $text = str_replace($matches[0][$i],'&#'.hexdec($matches[1][$i]).';',$text);

        }

    }

    return $text;

}
?>